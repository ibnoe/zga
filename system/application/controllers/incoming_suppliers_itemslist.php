<?php

class incoming_suppliers_itemslist extends Controller {

	function incoming_suppliers_itemslist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('purchaseorderline');
$this->db->join('supplier', 'supplier.id = purchaseorderline.supplier_id', 'left');
$this->db->join('warehouse', 'warehouse.id = purchaseorderline.warehouse_id', 'left');
$this->db->join('item', 'item.id = purchaseorderline.item_id', 'left');
$this->db->join('uom', 'uom.id = purchaseorderline.uom_id', 'left');
$this->db->where('purchaseorderline.disabled = 0');
$this->db->where('purchaseorderline.quantitytoreceive > 0');
$this->db->select('supplier.firstname as supplier__firstname', false);
$this->db->select('purchaseorderline.supplier_id as purchaseorderline__supplier_id', false);
$this->db->select('warehouse.name as warehouse__name', false);
$this->db->select('purchaseorderline.warehouse_id as purchaseorderline__warehouse_id', false);
$this->db->select('item.name as item__name', false);
$this->db->select('purchaseorderline.item_id as purchaseorderline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('purchaseorderline.uom_id as purchaseorderline__uom_id', false);
$this->db->select('purchaseorderline.id as id', false);
$this->db->select('purchaseorderline.id as purchaseorderline__id', false);
$this->db->select('DATE_FORMAT(purchaseorderline.date, "%d-%m-%Y") as purchaseorderline__date', false);
$this->db->select('purchaseorderline.orderid as purchaseorderline__orderid', false);
$this->db->select('purchaseorderline.quantity as purchaseorderline__quantity', false);
$this->db->select('purchaseorderline.quantityalreadyreceived as purchaseorderline__quantityalreadyreceived', false);
$this->db->select('purchaseorderline.quantitytoreceive as purchaseorderline__quantitytoreceive', false);
$this->db->select('purchaseorderline.lastupdate as purchaseorderline__lastupdate', false);
$this->db->select('purchaseorderline.updatedby as purchaseorderline__updatedby', false);if (isset($_POST['supplier_id']) && $_POST['supplier_id'] != -1)$this->db->where('purchaseorderline.supplier_id', $_POST['supplier_id']);if (isset($_POST['warehouse_id']) && $_POST['warehouse_id'] != -1)$this->db->where('purchaseorderline.warehouse_id', $_POST['warehouse_id']);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "purchaseorderline.id like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.date like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.orderid like '%".$_POST['searchtext']."%'";$where .= " || supplier.firstname like '%".$_POST['searchtext']."%'";$where .= " || warehouse.name like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.quantity like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.quantityalreadyreceived like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.quantitytoreceive like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('purchaseorderline__id', 'asc');
$this->db->order_by('purchaseorderline__date', 'desc');
$this->db->order_by('purchaseorderline__lastupdate', 'desc');
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
		
		$data['fields'] = array('purchaseorderline__date' => 'Date', 'purchaseorderline__orderid' => 'PO ID', 'supplier__firstname' => 'Supplier', 'warehouse__name' => 'Warehouse', 'item__name' => 'Item', 'purchaseorderline__quantity' => 'Quantity', 'purchaseorderline__quantityalreadyreceived' => 'Quantity Received', 'purchaseorderline__quantitytoreceive' => 'Quantity Remaining', 'uom__name' => 'Unit', 'purchaseorderline__lastupdate' => 'Last Update', 'purchaseorderline__updatedby' => 'Last Update By');
		
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
		
		
		
		$this->db->from('purchaseorderline');$this->db->join('supplier', 'supplier.id = purchaseorderline.supplier_id');$this->db->select('supplier_id as id, supplier.firstname as name');$q = $this->db->get();$supplier_opt = array('-1' => 'All');foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->name; }$data['supplier_opt'] = $supplier_opt;foreach ($supplier_opt as $k=>$v) { $data['supplier_id'] = $k; break; }if (isset($_POST['supplier_id']))$data['supplier_id'] = $_POST['supplier_id'];$this->db->from('purchaseorderline');$this->db->join('warehouse', 'warehouse.id = purchaseorderline.warehouse_id');$this->db->select('warehouse_id as id, warehouse.name as name');$q = $this->db->get();$warehouse_opt = array('-1' => 'All');foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }$data['warehouse_opt'] = $warehouse_opt;foreach ($warehouse_opt as $k=>$v) { $data['warehouse_id'] = $k; break; }if (isset($_POST['warehouse_id']))$data['warehouse_id'] = $_POST['warehouse_id'];
		}
		///
		$this->load->view('incoming_suppliers_items_list_view', $data);
	}
}

?>