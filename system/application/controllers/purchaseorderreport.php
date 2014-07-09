<?php

class PurchaseOrderReport extends Controller {

	function PurchaseOrderReport()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index() 
	{
		$data = array();
		
		$today = getdate();
		//$data['currentdate'] = $today['year']."-".$today['mon']."-".$today['mday'];
		$data['currentdate'] = $today['mday']."-".$today['mon']."-".$today['year'];
		
		$this->load->view('purchase_order_report_filter_view.php', $data);
	
	}
	
	function submit()
	{		
		$date_from = $_POST['purchasereport__datefrom'];
		$date_to = $_POST['purchasereport__dateto'];
		
		//$this->db->set('date', "str_to_date('".$_POST['purchaseorder__date']."', '%d-%m-%Y')", false);
		$this->db->from('purchaseorder');
		$this->db->where('date <=', "str_to_date('".$date_to."', '%d-%m-%Y')", false);
		$this->db->where('date >=', "str_to_date('".$date_from."', '%d-%m-%Y')", false);
		//$this->db->where('date <=', $date_to);
		//$this->db->where('date >=', $date_from);
		$this->db->select('*');
		$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
		$q=$this->db->get();
		
		$data['results'] = $q->result_array();
		
		$data['beginningdate'] = $date_from;
		$data['endingdate'] = $date_to;
		// load view
		$this->load->view('purchase_report_print_view', $data);
		
	}
}

?>