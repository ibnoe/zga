<?php

class purchase_return_order_line_optionslist extends Controller {

	function purchase_return_order_line_optionslist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('purchasereturnorderline');
$this->db->join('supplier', 'supplier.id = purchasereturnorderline.supplier_id', 'left');
$this->db->join('warehouse', 'warehouse.id = purchasereturnorderline.warehouse_id', 'left');
$this->db->join('item', 'item.id = purchasereturnorderline.item_id', 'left');
$this->db->join('uom', 'uom.id = purchasereturnorderline.uom_id', 'left');
$this->db->where('purchasereturnorderline.disabled = 0');
$this->db->where('purchasereturnorderline.quantitytosendactual > 0');
$this->db->select('supplier.firstname as supplier__firstname', false);
$this->db->select('purchasereturnorderline.supplier_id as purchasereturnorderline__supplier_id', false);
$this->db->select('warehouse.name as warehouse__name', false);
$this->db->select('purchasereturnorderline.warehouse_id as purchasereturnorderline__warehouse_id', false);
$this->db->select('item.name as item__name', false);
$this->db->select('purchasereturnorderline.item_id as purchasereturnorderline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('purchasereturnorderline.uom_id as purchasereturnorderline__uom_id', false);
$this->db->select('purchasereturnorderline.id as id', false);
$this->db->select('purchasereturnorderline.id as purchasereturnorderline__id', false);
$this->db->select('DATE_FORMAT(purchasereturnorderline.date, "%d-%m-%Y") as purchasereturnorderline__date', false);
$this->db->select('purchasereturnorderline.purchasereturnorderid as purchasereturnorderline__purchasereturnorderid', false);
$this->db->select('purchasereturnorderline.quantitytosend as purchasereturnorderline__quantitytosend', false);
$this->db->select('purchasereturnorderline.quantitytosendactual as purchasereturnorderline__quantitytosendactual', false);
$this->db->select('purchasereturnorderline.lastupdate as purchasereturnorderline__lastupdate', false);if (isset($_POST['supplier_id']) && $_POST['supplier_id'] != -1)$this->db->where('purchasereturnorderline.supplier_id', $_POST['supplier_id']);if (isset($_POST['warehouse_id']) && $_POST['warehouse_id'] != -1)$this->db->where('purchasereturnorderline.warehouse_id', $_POST['warehouse_id']);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "purchasereturnorderline.id like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnorderline.date like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnorderline.purchasereturnorderid like '%".$_POST['searchtext']."%'";$where .= " || supplier.firstname like '%".$_POST['searchtext']."%'";$where .= " || warehouse.name like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnorderline.quantitytosend like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnorderline.quantitytosendactual like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnorderline.lastupdate like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('purchasereturnorderline__id', 'asc');
$this->db->order_by('purchasereturnorderline__date', 'desc');
$this->db->order_by('purchasereturnorderline__lastupdate', 'desc');
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
		
		$data['fields'] = array('purchasereturnorderline__date' => 'Date', 'purchasereturnorderline__purchasereturnorderid' => 'ID', 'supplier__firstname' => 'Supplier', 'warehouse__name' => 'Warehouse', 'item__name' => 'Item', 'purchasereturnorderline__quantitytosend' => 'Quantity', 'purchasereturnorderline__quantitytosendactual' => 'Quantity To Send', 'uom__name' => 'Unit', 'purchasereturnorderline__lastupdate' => 'Last Update');
		
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
		
		
		
		$this->db->from('purchasereturnorderline');$this->db->join('supplier', 'supplier.id = purchasereturnorderline.supplier_id');$this->db->select('supplier_id as id, supplier.firstname as name');$q = $this->db->get();$supplier_opt = array('-1' => 'All');foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->name; }$data['supplier_opt'] = $supplier_opt;foreach ($supplier_opt as $k=>$v) { $data['supplier_id'] = $k; break; }if (isset($_POST['supplier_id']))$data['supplier_id'] = $_POST['supplier_id'];$this->db->from('purchasereturnorderline');$this->db->join('warehouse', 'warehouse.id = purchasereturnorderline.warehouse_id');$this->db->select('warehouse_id as id, warehouse.name as name');$q = $this->db->get();$warehouse_opt = array('-1' => 'All');foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }$data['warehouse_opt'] = $warehouse_opt;foreach ($warehouse_opt as $k=>$v) { $data['warehouse_id'] = $k; break; }if (isset($_POST['warehouse_id']))$data['warehouse_id'] = $_POST['warehouse_id'];
		}
		///
		$this->load->view('purchase_return_order_line_options_list_view', $data);
	}
}

?>