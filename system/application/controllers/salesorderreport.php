<?php

class SalesOrderReport extends Controller {

	function SalesOrderReport()
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
		
		$this->load->view('sales_order_report_filter_view.php', $data);
	
	}
	
	function submit()
	{		
		$date_from = $_POST['salesreport__datefrom'];
		$date_to = $_POST['salesreport__dateto'];
		
		$this->db->from('salesorder');
		//$this->db->where('date <=',$date_to);
		//$this->db->where('date >=',$date_from);
		$this->db->where('date <=', "str_to_date('".$date_to."', '%d-%m-%Y')", false);
		$this->db->where('date >=', "str_to_date('".$date_from."', '%d-%m-%Y')", false);
		$this->db->select('*');
		$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
		$q=$this->db->get();
		
		$data['results'] = $q->result_array();
		
		$data['beginningdate'] = $date_from;
		$data['endingdate'] = $date_to;
		// load view
		$this->load->view('sales_report_print_view', $data);
		//$this->load->view('laporan_penjualan_bulanan2', $data);
		
	}
}

?>