<?php

class test extends Controller {

	function test()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function index()
	{
		//$this->load->library('generallib');
		//$arr = $this->generallib->commonfunction('purchase_order_lineadd','purchaseorderline','aftersave', 1);
		$arr = $this->generallib->callGetTrialBalance();
		//$arr = $this->generallib->callGetGeneralLedger();

		
		//$date_string = $json -> DateOfBirth;
		//preg_match( '/([\d]{9})/', $date_string, $matches ); // gets just the first 9 digits in that string
		//echo date( 'm-d-Y', $matches[0] );

		//print_r($arr);
		
		date_default_timezone_set('Asia/Jakarta');
		
		foreach ($arr['Report'] as $k=>$row)
		{
			if (isset($row['date']))
			{
				$date_string = $row['date'];
				preg_match( '/([\d]{10})/', $date_string, $matches ); // gets just the first 10 digits in that string
				//echo date( 'Y-m-d', $matches[0] );
				//echo date( 'm-d-Y', $matches[0] );
				//echo date( 'd-m-Y', $matches[0] );
				//echo $matches[0];
				//echo $date_string;
				//print_r( $row);
				//echo "<br>";
				$row['date'] = date( 'Y-m-d', $matches[0] );
				$arr['Report'][$k] = $row;
			}
			print_r($row);
			echo "<br>";
		}
		
		//print_r($arr);
	}
	
	function test2()
	{
		$data = array();
		$data['quantity'] = 9;
		
		//$arr = $this->generallib->commonfunction('supplieradd','supplier','validation', 0, array());
		//$arr = $this->generallib->commonfunction('purchase_order_lineadd','purchaseorder','validation', 0, array());
		$arr = $this->generallib->commonfunction('purchase_order_lineadd','purchaseorderline','validation', 0, $data);
		
		print_r($arr);
	}
	
	function test3()
	{
		$this->db->from('purchaseinvoice');
$this->db->join('supplier', 'supplier.id = purchaseinvoice.supplier_id', 'left');
$this->db->join('currency', 'currency.id = purchaseinvoice.currency_id', 'left');
/*
$this->db->select('supplier.firstname as supplier__firstname', false);
$this->db->select('purchaseinvoice.supplier_id as purchaseinvoice__supplier_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('purchaseinvoice.currency_id as purchaseinvoice__currency_id', false);
$this->db->select('purchaseinvoice.id as id', false);
$this->db->select('DATE_FORMAT(purchaseinvoice.date, "%d-%m-%Y") as purchaseinvoice__date', false);
$this->db->select('purchaseinvoice.orderid as purchaseinvoice__orderid', false);
$this->db->select('purchaseinvoice.top as purchaseinvoice__top', false);
$this->db->select('purchaseinvoice.total as purchaseinvoice__total', false);
$this->db->select('purchaseinvoice.lastupdate as purchaseinvoice__lastupdate', false);
$this->db->select('purchaseinvoice.updatedby as purchaseinvoice__updatedby', false);
$this->db->select('purchaseinvoice.created as purchaseinvoice__created', false);
$this->db->select('purchaseinvoice.createdby as purchaseinvoice__createdby', false);
$this->db->order_by('purchaseinvoice__date', 'desc');
	*/	
		$this->db->select_sum('purchaseinvoice.total', 'sum_total');
		
		$q = $this->db->get();
		
		foreach ($q->result_array() as $row)
		{
			print_r($row);
		}
	}
	
	function test4()
	{
		$date = '2011-10-1';
		$arr = explode("-", $date);
		$year = $arr[0];
		$month = $arr[1];
		$day = $arr[2];
		//print_r($arr);
		$timestamp = mktime(0, 0, 0, $month, $day, $year);
		$date = date('Y-m-d', $timestamp);
		
		echo $date;
	}
	
	function test5()
	{
		$this->db->from('bif');
		$this->db->join('customer', 'bif.customer_id = customer.id', 'left');
		$this->db->join('marketingofficer', 'bif.marketingofficer_id = marketingofficer.id', 'left');
		$this->db->select('customer.firstname as customer_firstname');
		$this->db->select('marketingofficer.name as marketingofficer_name');
		$this->db->select('bif.*');
		$q = $this->db->get();
		
		$data = $q->row_array();
		
		$this->load->view("blanket_converting_work_instruction_form", $data);
	}
	
	function test6()
	{
		$data = array();
		//$this->db->from('bif');
		$q = $this->db->get('penambahanstockchemical');
		$data = $q->row_array();
		$this->load->view("chemical_work_instruction_form", $data);
	}
}

?>