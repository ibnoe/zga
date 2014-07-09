<?php

class open_sales_invoice_for_paymentlist extends Controller {

	function open_sales_invoice_for_paymentlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('salesinvoice');
$this->db->join('customer', 'customer.id = salesinvoice.customer_id', 'left');
$this->db->join('currency', 'currency.id = salesinvoice.currency_id', 'left');
$this->db->join('salespaymentline', 'salesinvoice.id = salespaymentline.salesinvoice_id', 'left');
$this->db->where('salesinvoice.disabled = 0');
$this->db->where('salespaymentline.salesinvoice_id is NULL');
$this->db->select('customer.firstname as customer__firstname', false);
$this->db->select('salesinvoice.customer_id as salesinvoice__customer_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('salesinvoice.currency_id as salesinvoice__currency_id', false);
$this->db->select('salesinvoice.id as id', false);
$this->db->select('salesinvoice.id as salesinvoice__id', false);
$this->db->select('DATE_FORMAT(salesinvoice.date, "%d-%m-%Y") as salesinvoice__date', false);
$this->db->select('salesinvoice.orderid as salesinvoice__orderid', false);
$this->db->select('salesinvoice.total as salesinvoice__total', false);
$this->db->select('salesinvoice.lastupdate as salesinvoice__lastupdate', false);
$this->db->select('salesinvoice.updatedby as salesinvoice__updatedby', false);if (isset($_POST['customer_id']) && $_POST['customer_id'] != -1)$this->db->where('salesinvoice.customer_id', $_POST['customer_id']);if (isset($_POST['currency_id']) && $_POST['currency_id'] != -1)$this->db->where('salesinvoice.currency_id', $_POST['currency_id']);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "salesinvoice.id like '%".$_POST['searchtext']."%'";$where .= " || salesinvoice.date like '%".$_POST['searchtext']."%'";$where .= " || salesinvoice.orderid like '%".$_POST['searchtext']."%'";$where .= " || customer.firstname like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || salesinvoice.total like '%".$_POST['searchtext']."%'";$where .= " || salesinvoice.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salesinvoice.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('salesinvoice__id', 'asc');
$this->db->order_by('salesinvoice__date', 'desc');
$this->db->order_by('salesinvoice__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($edit_module_id=0)
	{
		$data = array();
		
		
		
		$data['pageno'] = 0;
		if (isset($_POST['pageno'])) 
		{
			$data['pageno'] = $_POST['pageno'];
		}
		//echo $data['pageno'];
		$data['perpage'] = 10000;
		
		$data['sortby'] = array();$data['sortdirection'] = array();
		if (isset($_POST['sortby'])) $data['sortby'] = $_POST['sortby'];
		if (isset($_POST['sortdirection'])) $data['sortdirection'] = $_POST['sortdirection'];
		
		$data['fields'] = array('salesinvoice__date' => 'Date', 'salesinvoice__orderid' => 'Sales Invoice No', 'customer__firstname' => 'Customer', 'currency__name' => 'Currency', 'salesinvoice__total' => 'Total', 'salesinvoice__lastupdate' => 'Last Update', 'salesinvoice__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		$this->db->from('salesinvoice');$this->db->join('customer', 'customer.id = salesinvoice.customer_id');$this->db->select('customer_id as id, customer.firstname as name');$q = $this->db->get();$customer_opt = array('-1' => 'All');foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->name; }$data['customer_opt'] = $customer_opt;foreach ($customer_opt as $k=>$v) { $data['customer_id'] = $k; break; }if (isset($_POST['customer_id']))$data['customer_id'] = $_POST['customer_id'];$this->db->from('salesinvoice');$this->db->join('currency', 'currency.id = salesinvoice.currency_id');$this->db->select('currency_id as id, currency.name as name');$q = $this->db->get();$currency_opt = array('-1' => 'All');foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }$data['currency_opt'] = $currency_opt;foreach ($currency_opt as $k=>$v) { $data['currency_id'] = $k; break; }if (isset($_POST['currency_id']))$data['currency_id'] = $_POST['currency_id'];
		}
		///
		$this->load->view('open_sales_invoice_for_payment_list_view', $data);
	}
}

?>