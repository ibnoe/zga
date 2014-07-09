<?php

class received_suppliers_itemslist extends Controller {

	function received_suppliers_itemslist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('receiveditemline');
$this->db->join('supplier', 'supplier.id = receiveditemline.supplier_id', 'left');
$this->db->join('warehouse', 'warehouse.id = receiveditemline.warehouse_id', 'left');
$this->db->join('item', 'item.id = receiveditemline.item_id', 'left');
$this->db->join('uom', 'uom.id = receiveditemline.uom_id', 'left');
$this->db->where('receiveditemline.disabled = 0');
$this->db->select('supplier.firstname as supplier__firstname', false);
$this->db->select('receiveditemline.supplier_id as receiveditemline__supplier_id', false);
$this->db->select('warehouse.name as warehouse__name', false);
$this->db->select('receiveditemline.warehouse_id as receiveditemline__warehouse_id', false);
$this->db->select('item.name as item__name', false);
$this->db->select('receiveditemline.item_id as receiveditemline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('receiveditemline.uom_id as receiveditemline__uom_id', false);
$this->db->select('receiveditemline.id as id', false);
$this->db->select('receiveditemline.id as receiveditemline__id', false);
$this->db->select('DATE_FORMAT(receiveditemline.date, "%d-%m-%Y") as receiveditemline__date', false);
$this->db->select('receiveditemline.orderid as receiveditemline__orderid', false);
$this->db->select('receiveditemline.suratjalannumber as receiveditemline__suratjalannumber', false);
$this->db->select('receiveditemline.invoiceno as receiveditemline__invoiceno', false);
$this->db->select('receiveditemline.quantitytoreceive as receiveditemline__quantitytoreceive', false);
$this->db->select('receiveditemline.lastupdate as receiveditemline__lastupdate', false);
$this->db->select('receiveditemline.updatedby as receiveditemline__updatedby', false);if (isset($_POST['supplier_id']) && $_POST['supplier_id'] != -1)$this->db->where('receiveditemline.supplier_id', $_POST['supplier_id']);if (isset($_POST['warehouse_id']) && $_POST['warehouse_id'] != -1)$this->db->where('receiveditemline.warehouse_id', $_POST['warehouse_id']);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "receiveditemline.id like '%".$_POST['searchtext']."%'";$where .= " || receiveditemline.date like '%".$_POST['searchtext']."%'";$where .= " || receiveditemline.orderid like '%".$_POST['searchtext']."%'";$where .= " || receiveditemline.suratjalannumber like '%".$_POST['searchtext']."%'";$where .= " || receiveditemline.invoiceno like '%".$_POST['searchtext']."%'";$where .= " || supplier.firstname like '%".$_POST['searchtext']."%'";$where .= " || warehouse.name like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || receiveditemline.quantitytoreceive like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || receiveditemline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || receiveditemline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('receiveditemline__id', 'asc');
$this->db->order_by('receiveditemline__date', 'desc');
$this->db->order_by('receiveditemline__lastupdate', 'desc');
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
		
		$data['fields'] = array('receiveditemline__date' => 'Date', 'receiveditemline__orderid' => 'Receive Item No', 'receiveditemline__suratjalannumber' => 'No Surat Jalan', 'receiveditemline__invoiceno' => 'No Invoice', 'supplier__firstname' => 'Supplier', 'warehouse__name' => 'Warehouse', 'item__name' => 'Item', 'receiveditemline__quantitytoreceive' => 'Quantity', 'uom__name' => 'Unit', 'receiveditemline__lastupdate' => 'Last Update', 'receiveditemline__updatedby' => 'Last Update By');
		
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
		
		
		
		$this->db->from('receiveditemline');$this->db->join('supplier', 'supplier.id = receiveditemline.supplier_id');$this->db->select('supplier_id as id, supplier.firstname as name');$q = $this->db->get();$supplier_opt = array('-1' => 'All');foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->name; }$data['supplier_opt'] = $supplier_opt;foreach ($supplier_opt as $k=>$v) { $data['supplier_id'] = $k; break; }if (isset($_POST['supplier_id']))$data['supplier_id'] = $_POST['supplier_id'];$this->db->from('receiveditemline');$this->db->join('warehouse', 'warehouse.id = receiveditemline.warehouse_id');$this->db->select('warehouse_id as id, warehouse.name as name');$q = $this->db->get();$warehouse_opt = array('-1' => 'All');foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }$data['warehouse_opt'] = $warehouse_opt;foreach ($warehouse_opt as $k=>$v) { $data['warehouse_id'] = $k; break; }if (isset($_POST['warehouse_id']))$data['warehouse_id'] = $_POST['warehouse_id'];
		}
		///
		$this->load->view('received_suppliers_items_list_view', $data);
	}
}

?>