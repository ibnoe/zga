<?php

class open_sales_order_for_invoicinglist extends Controller {

	function open_sales_order_for_invoicinglist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('salesorderline');
$this->db->join('customer', 'customer.id = salesorderline.customer_id', 'left');
$this->db->join('currency', 'currency.id = salesorderline.currency_id', 'left');
$this->db->join('item', 'item.id = salesorderline.item_id', 'left');
$this->db->join('rcn', 'rcn.id = salesorderline.rcn_id', 'left');
$this->db->join('uom', 'uom.id = salesorderline.uom_id', 'left');
$this->db->join('salesinvoiceline', 'salesorderline.id = salesinvoiceline.salesorderline_id', 'left');
$this->db->where('salesorderline.disabled = 0');
$this->db->where('salesinvoiceline.salesorderline_id is NULL');
$this->db->select('customer.firstname as customer__firstname', false);
$this->db->select('salesorderline.customer_id as salesorderline__customer_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('salesorderline.currency_id as salesorderline__currency_id', false);
$this->db->select('item.name as item__name', false);
$this->db->select('salesorderline.item_id as salesorderline__item_id', false);
$this->db->select('rcn.norcn as rcn__norcn', false);
$this->db->select('salesorderline.rcn_id as salesorderline__rcn_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('salesorderline.uom_id as salesorderline__uom_id', false);
$this->db->select('salesorderline.id as id', false);
$this->db->select('salesorderline.id as salesorderline__id', false);
$this->db->select('DATE_FORMAT(salesorderline.date, "%d-%m-%Y") as salesorderline__date', false);
$this->db->select('salesorderline.orderid as salesorderline__orderid', false);
$this->db->select('salesorderline.type as salesorderline__type', false);
$this->db->select('salesorderline.quantity as salesorderline__quantity', false);
$this->db->select('salesorderline.price as salesorderline__price', false);
$this->db->select('salesorderline.subtotal as salesorderline__subtotal', false);
$this->db->select('salesorderline.lastupdate as salesorderline__lastupdate', false);
$this->db->select('salesorderline.updatedby as salesorderline__updatedby', false);if (isset($_POST['customer_id']) && $_POST['customer_id'] != -1)$this->db->where('salesorderline.customer_id', $_POST['customer_id']);if (isset($_POST['currency_id']) && $_POST['currency_id'] != -1)$this->db->where('salesorderline.currency_id', $_POST['currency_id']);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "salesorderline.id like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.date like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.orderid like '%".$_POST['searchtext']."%'";$where .= " || customer.firstname like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.type like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || rcn.norcn like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.quantity like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.price like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.subtotal like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('salesorderline__id', 'asc');
$this->db->order_by('salesorderline__date', 'desc');
$this->db->order_by('salesorderline__lastupdate', 'desc');
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
		
		$data['fields'] = array('salesorderline__date' => 'Date', 'salesorderline__orderid' => 'Sales Invoice No', 'customer__firstname' => 'Customer', 'currency__name' => 'Currency', 'salesorderline__type' => 'Type', 'item__name' => 'Item', 'rcn__norcn' => 'RCN', 'salesorderline__quantity' => 'Quantity', 'uom__name' => 'Unit', 'salesorderline__price' => 'Price', 'salesorderline__subtotal' => 'SubTotal', 'salesorderline__lastupdate' => 'Last Update', 'salesorderline__updatedby' => 'Last Update By');
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		
		
		$q = $this->db->get();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		$this->db->from('salesorderline');$this->db->join('customer', 'customer.id = salesorderline.customer_id');$this->db->select('customer_id as id, customer.firstname as name');$q = $this->db->get();$customer_opt = array('-1' => 'All');foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->name; }$data['customer_opt'] = $customer_opt;foreach ($customer_opt as $k=>$v) { $data['customer_id'] = $k; break; }if (isset($_POST['customer_id']))$data['customer_id'] = $_POST['customer_id'];$this->db->from('salesorderline');$this->db->join('currency', 'currency.id = salesorderline.currency_id');$this->db->select('currency_id as id, currency.name as name');$q = $this->db->get();$currency_opt = array('-1' => 'All');foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }$data['currency_opt'] = $currency_opt;foreach ($currency_opt as $k=>$v) { $data['currency_id'] = $k; break; }if (isset($_POST['currency_id']))$data['currency_id'] = $_POST['currency_id'];
		///
		$this->load->view('open_sales_order_for_invoicing_list_view', $data);
	}
}

?>