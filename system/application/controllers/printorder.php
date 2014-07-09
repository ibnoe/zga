<?php

class PrintOrder extends Controller {

	function PrintOrder()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	
	function index()
	{
		$data = array();
		
		$this->load->view('sales_order_print_view.php', $data);
	
			
	}
	
	
	function salesorderquote()
	{
		$data = array();
		
		$this->load->view('sales_order_quote_print_view.php', $data);				
	}

	function deliveryorder()
	{
		$data = array();
		
		$this->load->view('delivery_order_print_view.php', $data);				
	}

	function salesinvoice()
	{
		$data = array();
		
		$this->load->view('sales_invoice_print_view.php', $data);				
	}	
	
	function salespayment()
	{
		$data = array();
		
		$this->load->view('sales_invoice_receipt_print_view.php', $data);				
	}	
	
	function fakturpajak()
	{
		$data = array();
		
		$this->load->view('fakturpajak_print_view_withcurrency.php', $data);				
	}
	
	function fakturpajakidr()
	{
		$data = array();
		
		$this->load->view('fakturpajak_print_view.php', $data);				
	}
	
	function journalreceipt()
	{
		$data = array();
		
		$this->load->view('journal_receipt_print_view.php', $data);				
	}
	
	function creditnoteout()
	{
		$data = array();
		
		$this->load->view('creditnoteout_print_view.php', $data);				
	}
	
	function rcn()
	{
		$data = array();
		
		$this->load->view('rcn_print_view.php', $data);				
	}

	function purchaseorder()
	{
		$data = array();
		
		$this->load->view('purchase_order_print_view.php', $data);				
	}
	
	function rif()
	{
		$data = array();
		
		$this->load->view('rif_print_view.php', $data);				
	}
}

?>