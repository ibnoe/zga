<?php

class sales_return_for_invoicinglist extends Controller {

	function sales_return_for_invoicinglist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('salesreturnorderline');
$this->db->join('customer', 'customer.id = salesreturnorderline.customer_id', 'left');
$this->db->join('currency', 'currency.id = salesreturnorderline.currency_id', 'left');
$this->db->join('item', 'item.id = salesreturnorderline.item_id', 'left');
$this->db->join('uom', 'uom.id = salesreturnorderline.uom_id', 'left');
$this->db->join('salesreturninvoiceline', 'salesreturnorderline.id = salesreturninvoiceline.salesreturnorderline_id', 'left');
$this->db->where('salesreturnorderline.disabled = 0');
$this->db->where('salesreturninvoiceline.salesreturnorderline_id is NULL');
$this->db->select('customer.firstname as customer__firstname', false);
$this->db->select('salesreturnorderline.customer_id as salesreturnorderline__customer_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('salesreturnorderline.currency_id as salesreturnorderline__currency_id', false);
$this->db->select('item.name as item__name', false);
$this->db->select('salesreturnorderline.item_id as salesreturnorderline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('salesreturnorderline.uom_id as salesreturnorderline__uom_id', false);
$this->db->select('salesreturnorderline.id as id', false);
$this->db->select('salesreturnorderline.id as salesreturnorderline__id', false);
$this->db->select('DATE_FORMAT(salesreturnorderline.date, "%d-%m-%Y") as salesreturnorderline__date', false);
$this->db->select('salesreturnorderline.salesreturnorderid as salesreturnorderline__salesreturnorderid', false);
$this->db->select('salesreturnorderline.quantitytoreceive as salesreturnorderline__quantitytoreceive', false);
$this->db->select('salesreturnorderline.lastupdate as salesreturnorderline__lastupdate', false);
$this->db->select('salesreturnorderline.updatedby as salesreturnorderline__updatedby', false);if (isset($_POST['customer_id']) && $_POST['customer_id'] != -1)$this->db->where('salesreturnorderline.customer_id', $_POST['customer_id']);if (isset($_POST['currency_id']) && $_POST['currency_id'] != -1)$this->db->where('salesreturnorderline.currency_id', $_POST['currency_id']);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "salesreturnorderline.id like '%".$_POST['searchtext']."%'";$where .= " || salesreturnorderline.date like '%".$_POST['searchtext']."%'";$where .= " || salesreturnorderline.salesreturnorderid like '%".$_POST['searchtext']."%'";$where .= " || customer.firstname like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || salesreturnorderline.quantitytoreceive like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || salesreturnorderline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salesreturnorderline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('salesreturnorderline__id', 'asc');
$this->db->order_by('salesreturnorderline__date', 'desc');
$this->db->order_by('salesreturnorderline__lastupdate', 'desc');
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
		
		$data['fields'] = array('salesreturnorderline__date' => 'Date', 'salesreturnorderline__salesreturnorderid' => 'ID', 'customer__firstname' => 'Customer', 'currency__name' => 'Currency', 'item__name' => 'Item', 'salesreturnorderline__quantitytoreceive' => 'Quantity', 'uom__name' => 'Unit', 'salesreturnorderline__lastupdate' => 'Last Update', 'salesreturnorderline__updatedby' => 'Last Update By');
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		
		
		$q = $this->db->get();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		$this->db->from('salesreturnorderline');$this->db->join('customer', 'customer.id = salesreturnorderline.customer_id');$this->db->select('customer_id as id, customer.firstname as name');$q = $this->db->get();$customer_opt = array('-1' => 'All');foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->name; }$data['customer_opt'] = $customer_opt;foreach ($customer_opt as $k=>$v) { $data['customer_id'] = $k; break; }if (isset($_POST['customer_id']))$data['customer_id'] = $_POST['customer_id'];$this->db->from('salesreturnorderline');$this->db->join('currency', 'currency.id = salesreturnorderline.currency_id');$this->db->select('currency_id as id, currency.name as name');$q = $this->db->get();$currency_opt = array('-1' => 'All');foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }$data['currency_opt'] = $currency_opt;foreach ($currency_opt as $k=>$v) { $data['currency_id'] = $k; break; }if (isset($_POST['currency_id']))$data['currency_id'] = $_POST['currency_id'];
		///
		$this->load->view('sales_return_for_invoicing_list_view', $data);
	}
}

?>