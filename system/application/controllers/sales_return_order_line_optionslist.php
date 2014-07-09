<?php

class sales_return_order_line_optionslist extends Controller {

	function sales_return_order_line_optionslist()
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
$this->db->join('warehouse', 'warehouse.id = salesreturnorderline.warehouse_id', 'left');
$this->db->join('item', 'item.id = salesreturnorderline.item_id', 'left');
$this->db->join('uom', 'uom.id = salesreturnorderline.uom_id', 'left');
$this->db->where('salesreturnorderline.disabled = 0');
$this->db->where('salesreturnorderline.quantitytoreceiveactual > 0');
$this->db->select('customer.firstname as customer__firstname', false);
$this->db->select('salesreturnorderline.customer_id as salesreturnorderline__customer_id', false);
$this->db->select('warehouse.name as warehouse__name', false);
$this->db->select('salesreturnorderline.warehouse_id as salesreturnorderline__warehouse_id', false);
$this->db->select('item.name as item__name', false);
$this->db->select('salesreturnorderline.item_id as salesreturnorderline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('salesreturnorderline.uom_id as salesreturnorderline__uom_id', false);
$this->db->select('salesreturnorderline.id as id', false);
$this->db->select('salesreturnorderline.id as salesreturnorderline__id', false);
$this->db->select('DATE_FORMAT(salesreturnorderline.date, "%d-%m-%Y") as salesreturnorderline__date', false);
$this->db->select('salesreturnorderline.salesreturnorderid as salesreturnorderline__salesreturnorderid', false);
$this->db->select('salesreturnorderline.quantitytoreceive as salesreturnorderline__quantitytoreceive', false);
$this->db->select('salesreturnorderline.quantitytoreceiveactual as salesreturnorderline__quantitytoreceiveactual', false);
$this->db->select('salesreturnorderline.lastupdate as salesreturnorderline__lastupdate', false);
$this->db->select('salesreturnorderline.updatedby as salesreturnorderline__updatedby', false);if (isset($_POST['customer_id']) && $_POST['customer_id'] != -1)$this->db->where('salesreturnorderline.customer_id', $_POST['customer_id']);if (isset($_POST['warehouse_id']) && $_POST['warehouse_id'] != -1)$this->db->where('salesreturnorderline.warehouse_id', $_POST['warehouse_id']);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "salesreturnorderline.id like '%".$_POST['searchtext']."%'";$where .= " || salesreturnorderline.date like '%".$_POST['searchtext']."%'";$where .= " || salesreturnorderline.salesreturnorderid like '%".$_POST['searchtext']."%'";$where .= " || customer.firstname like '%".$_POST['searchtext']."%'";$where .= " || warehouse.name like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || salesreturnorderline.quantitytoreceive like '%".$_POST['searchtext']."%'";$where .= " || salesreturnorderline.quantitytoreceiveactual like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || salesreturnorderline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salesreturnorderline.updatedby like '%".$_POST['searchtext']."%'";
			
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
		
		$data['fields'] = array('salesreturnorderline__date' => 'Date', 'salesreturnorderline__salesreturnorderid' => 'ID', 'customer__firstname' => 'Customer', 'warehouse__name' => 'Warehouse', 'item__name' => 'Item', 'salesreturnorderline__quantitytoreceive' => 'Quantity', 'salesreturnorderline__quantitytoreceiveactual' => 'Quantity To Receive', 'uom__name' => 'Unit', 'salesreturnorderline__lastupdate' => 'Last Update', 'salesreturnorderline__updatedby' => 'Last Update By');
		
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
		
		
		
		$this->db->from('salesreturnorderline');$this->db->join('customer', 'customer.id = salesreturnorderline.customer_id');$this->db->select('customer_id as id, customer.firstname as name');$q = $this->db->get();$customer_opt = array('-1' => 'All');foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->name; }$data['customer_opt'] = $customer_opt;foreach ($customer_opt as $k=>$v) { $data['customer_id'] = $k; break; }if (isset($_POST['customer_id']))$data['customer_id'] = $_POST['customer_id'];$this->db->from('salesreturnorderline');$this->db->join('warehouse', 'warehouse.id = salesreturnorderline.warehouse_id');$this->db->select('warehouse_id as id, warehouse.name as name');$q = $this->db->get();$warehouse_opt = array('-1' => 'All');foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }$data['warehouse_opt'] = $warehouse_opt;foreach ($warehouse_opt as $k=>$v) { $data['warehouse_id'] = $k; break; }if (isset($_POST['warehouse_id']))$data['warehouse_id'] = $_POST['warehouse_id'];
		}
		///
		$this->load->view('sales_return_order_line_options_list_view', $data);
	}
}

?>