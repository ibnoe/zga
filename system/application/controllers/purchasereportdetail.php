<?php

class PurchaseReportDetail extends Controller {

	function PurchaseReportDetail()
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
		
		$this->db->from('purchaseorder
		
		$this->load->view('yearlypurchasereport_filter_view.php', $data);
	}
	
	
}

?>