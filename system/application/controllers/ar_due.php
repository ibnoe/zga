<?php

class ar_due extends Controller {

	function ar_due()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	
	// misc functions
	
	/*function _is_coa_credit_first($coa_id)
	{
		$this->db->from("coa");
		$this->db->join("coatype", "coa.coatype_id = coatype.id");
		$this->db->where("coa.id", $coa_id);
		$this->db->select("coatype.classtype as coa_type, coa.id as coa_id");
		
		$q = $this->db->get();
		
		$coa_type = $q->row()->coa_type;
		
		if (strpos($coa_type, "Asset") !== false and strpos($coa_type, "Asset") == 0 or
			strpos($coa_type, "Expense") !== false and strpos($coa_type, "Expense") == 0)
			return false;
		return true;
	}*/
	
	/*function _GetTotal($coa_id, $fromdate, $todate, $var)
	{
		$this->db->where("date <=", $todate);
		$this->db->where("date >=", $fromdate);
		$this->db->where("coa_id",$coa_id);
		$this->db->from("journal");
		$this->db->select_sum($var);
		$q = $this->db->get();
		
		if (is_numeric($q->row()->{$var}))
			return $q->row()->{$var};
		return 0;
	}*/
	
	/*function _getCOAOfClass($intclass)
	{
	
		$this->db->from("coa");
		$this->db->join("coatype", "coa.coatype_id = coatype.id");
		$this->db->select("coa.*");
		$this->db->where("coatype.name", $intclass);
		$q = $this->db->get();
	
		if ($q->num_rows() > 0)
		{
		
			return $q->result();
		}
		
		return array();
	}*/
	
	/*function _getCOAOfType($intcoatype)
	{
		$this->db->from("coa");
		$this->db->join("coatype", "coa.coatype_id = coatype.id");
		$this->db->select("coa.*");
		$this->db->where("coatype.name", $intcoatype);
		$q = $this->db->get();
	
		if ($q->num_rows() > 0)
			return $q->result_array();
		
		return array();
	}*/
	
	// a little helper
	function _id_in_array($id, $arr)
	{
		foreach ($arr as $srow)
		{
			if ($srow['id'] == $id)
			{
				return true;
			}
		}
		
		return false;
	}
	
	function _getCustomerName($cust_id)
	{
		$this->db->from('customer');
		$this->db->where('id', $cust_id);
		$q = $this->db->get();
		$row = $q->row_array();
		return $row['idstring'];
	}
	
	function _checkInvoicePaid($invoice_id)
	{
		$this->db->from('salespaymentline');
		$this->db->where('salesinvoice_id', $invoice_id);
		$q = $this->db->get();
		if($q->num_rows() > 0)
			return true;
		return false;
		
	}
	
	function _getCurrencyName($curr_id) 
	{
		$this->db->from('currency');
		$this->db->where('id', $curr_id);
		$this->db->select('name');
		$q = $this->db->get();
		if($q->num_rows() > 0)
		{
			$curr = $q->row_array();
			return $curr['name'];
		}
		return "Rp.";
	}
	
	function index() 
	{
		$data = array();
		
		$today = getdate();
		$data['currentdate'] = $today['year']."-".$today['mon']."-".$today['mday'];
		
		$ar_opt = array();
		
		//get coa type id for type="account receivable"
		/*$this->db->from('coatype');
		$this->db->where('name',"Account Receivable");
		$this->db->select('id');
		$r = $this->db->get();
		$row = $r->row_array();
		
		$coatypeid= $row['id'];
		
		//get coa where type = "account receivable"
		$this->db->from('coa');
		$this->db->where('coatype_id',$coatypeid);
		$q = $this->db->get();
		*/
		
		
		$ar_opt[0] = "All";
		/*if ($q->num_rows() > 0)
			foreach ($q->result() as $row) 
			{ 
				$ar_opt[$row->id] = $row->name; 
			}	
		*/
			
		//get all customers
		$cust = $this->db->get('customer');
		if ($cust->num_rows() > 0)
			foreach ($cust->result() as $row) 
			{ 
				$ar_opt[$row->id] = $row->idstring; 
			}	
		$data['ar_opt'] = $ar_opt;
	
		$this->load->view('ar_due_filter_view.php', $data);
	
	}
	
	function submit()
	{
		
		//$date_from = $_POST['ardue__datefrom'];
		$ar_customer = $_POST['ardue__customer_id'];
		
		$data['customer'] = "";
		if($ar_customer != 0)
			$data['customer'] = $this->_getCustomerName($ar_customer);
			
		$entries = array();
		
		$this->db->from('salesinvoice');
		if($ar_customer > 0)
			$this->db->where('customer_id', $ar_customer);
		//$this->db->order_by("date","asc");
		$q = $this->db->get();
		$invoices = $q->result_array();
		
		//print_r($invoices);
		
		//1 week = 7 days
		//2 weeks = 14 days
		//30 days
		// 60 days
		
		$counter = 0;
		foreach($invoices as $invoice) 
		{
			//kalau invoice sudah dibayar, jangan dimunculkan lagi
			if($this->_checkInvoicePaid($invoice['id']) == true)
				continue;
			$invdate = $invoice['date'];
			$top = $invoice['top'];
			$curr_id = $invoice['currency_id'];
			$currency = $this->_getCurrencyName($curr_id);
			
			
			if($top == "1 week") {
				$duedate = new DateTime($invdate);
				$duedate->modify('+1 week');
			}
			else if($top == "2 weeks") {
				
				$duedate = new DateTime($invdate);
				$duedate->modify('+2 week');
			}
			else if($top == "30 days") {
				
				$duedate = new DateTime($invdate);
				$duedate->modify('+1 month');
			}
			else {
				
				$duedate = new DateTime($invdate);
				$duedate->modify('+2 month');
			}
				
			$entries[$counter]['invoiceid'] = $invoice['orderid'];
			
			//get invoice customer
			$custname = $this->_getCustomerName($invoice['customer_id']);
			$entries[$counter]['customer'] = $custname;
			$invoicedate = new DateTime($invoice['date']);
			$entries[$counter]['date'] = $invoicedate->format('d-m-Y');
			$entries[$counter]['duedate'] = $duedate;
			$entries[$counter]['currency'] = $currency;
			$entries[$counter]['amount'] = $invoice['grandtotal'];
		}
		
		/*foreach ($data as $k=>$row)
		{
			echo $k." => ";
			print_r($row);
			echo "<br>";
		}*/
		
		$data['entries'] = $entries;
		//$data['customer'] = $this->_getCustomerName($ar_customer);
		// load view
		
		$this->load->view('ar_due_view', $data);
		
	}
}

?>