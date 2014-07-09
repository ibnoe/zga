<?php

class bank_report extends Controller {

	function bank_report()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index()
	{
		$data = array();
		
		
		$data['bankreport__from_date'] = '';
		$data['bankreport__to_date'] = '';
		
		$coa_opt = array();
		
		$this->db->from('cashbank');
		$this->db->or_like('name','bank');
		$this->db->or_like('name','Bank');
		$this->db->or_like('name','BANK');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) { 
				$coa_opt[$row->coa_id] = $row->name; 
			}
		}
		$data['coa_opt'] = $coa_opt;
		$data['bankreport__coa_id'] = '';
		
		$this->load->view('bank_report_filter_view', $data);
	}
	
	function _getBalanceUpToDate($coa_id, $date)
	{
		$this->db->where("coa_id", $coa_id);
		//$this->db->where("date <=", $date);
		$this->db->where('date <=', "str_to_date('".$date."', '%d-%m-%Y')", false);
		$this->db->from("coabalance");
		$this->db->select_sum("balance");
		$q = $this->db->get();
		
		if ($q->num_rows() > 0)
		{
			if (is_numeric($q->row()->balance))
				return $q->row()->balance;
			else
				return 0;
		}
		
		return 0;
	}
	
	function submit()
	{
		$fromdate = $_POST['bankreport__from_date'];
		$todate = $_POST['bankreport__to_date'];
		$coa_id = $_POST['bankreport__coa_id'];
		
		
		//initializing variables
		$data['error_msg'] = "";
		$data['date_from'] = $fromdate;
		$data['date_to'] = $todate;
		
		//get bank account's name
		$this->db->from('cashbank');
		$this->db->where('coa_id',$coa_id);
		$this->db->select('name');
		$r = $this->db->get();
		$rr = $r->row_array();
		$data['bank_name'] = $rr['name'];
		
		//get transactions
		$this->db->from("journal");
		$this->db->select('DATE_FORMAT(journal.date, "%d-%m-%Y") as date',false);
		$this->db->select("reference");
		$this->db->select("debit");
		$this->db->select("credit");
		$this->db->where('coa_id', $coa_id);
		$this->db->where('date >=', $fromdate);
		$this->db->where('date <=', $todate);
		$q = $this->db->get();
		
		if($q->num_rows() > 0) {
			$results = $q->result_array();
			$data['results'] = $results;
		}
		else {
			$data['error_msg'] = "There is no transaction for this bank account";
		}
		
		//get beginning balance for this particular coa
		$data['initialbalance'] = $this->_getBalanceUpToDate($coa_id, $fromdate);
			
		
		$this->load->view('bank_report_view', $data);
	}
}

?>