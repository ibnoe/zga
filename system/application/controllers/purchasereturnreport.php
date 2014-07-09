<?php

class PurchaseReturnReport extends Controller {

	function PurchaseReturnReport()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index() 
	{
		$data = array();
		
		$today = getdate();
		$data['currentdate'] = $today['year']."-".$today['mon']."-".$today['mday'];
		
		$this->load->view('purchase_return_report_filter_view.php', $data);
	
	}
	
	function submit()
	{		
		$date_from = $_POST['purchasereturnreport__datefrom'];
		$date_to = $_POST['purchasereturnreport__dateto'];
		
		$this->db->from('purchasereturnorder');
		$this->db->where('date <=',$date_to);
		$this->db->where('date >=',$date_from);
		$q=$this->db->get();
		
		$data['results'] = $q->result_array();
		
		$data['beginningdate'] = $date_from;
		$data['endingdate'] = $date_to;
		// load view
		$this->load->view('purchase_return_report_print_view', $data);
		
	}
}

?>