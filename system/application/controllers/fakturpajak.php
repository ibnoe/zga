<?php

class FakturPajak extends Controller {

	function FakturPajak()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($invoice_id=0) 
	{
		$data = array();
		
		$today = getdate();
		//$data['currentdate'] = $today['year']."-".$today['mon']."-".$today['mday'];
		$data['invoice_id'] = $invoice_id;
		
		$q = $this->db->get('salesinvoice');
		
		foreach ($q->result() as $row)
		{
			$salesinvoice_opt[$row->id] = $row->orderid;
		}
		$data['salesinvoice_opt'] = $salesinvoice_opt;
		
		$this->load->view('fakturpajak_filter_view.php', $data);
	
	}
	
	function submit()
	{
		$code = $_POST['fakturpajak__code'];
		
		if(isset($_POST['fakturpajak__rate']))
			$rate = $_POST['fakturpajak__rate'];
		else
			$rate = 1;
		$invoice_id = $_POST['fakturpajak__salesinvoice_id'];
		
		//get customer details
		$this->db->from('salesinvoice');
		$this->db->where('id',$invoice_id);
		$c=$this->db->get();
		$cust = $c->row_array();
		$data['salesinvoice'] = $cust;
		
		//print_r($cust);
		
		$this->db->from('customer');
		$this->db->where('id',$cust['customer_id']);
		$cc = $this->db->get();
		$data['customer_detail'] = $cc->row_array();
		
		
		//get sales invoice line details
		//$this->db->from('salesinvoiceline');
		////$this->db->join('salesinvoiceline','salesinvoiceline.salesinvoice_id = salesinvoice.id');
		//$this->db->where('salesinvoice_id',$invoice_id);
		$this->db->where('salesinvoice.id',$invoice_id);
		$this->db->from('salesinvoice');
		$q=$this->db->get();
		$results = $q->result_array();
		
		$data['results'] = $results;
		$data['code'] = $code;
		$data['rate'] = $rate;
		$data['invoice_id'] = $invoice_id;
		
	
		// load view
		$this->load->view('fakturpajak_print_view', $data);
		
	}
}

?>