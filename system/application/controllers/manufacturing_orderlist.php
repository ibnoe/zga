<?php

class manufacturing_orderlist extends Controller {

	function manufacturing_orderlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('manufacturingorder');
$this->db->join('item', 'item.id = manufacturingorder.item_id', 'left');
$this->db->join('warehouse', 'warehouse.id = manufacturingorder.from_warehouse_id', 'left');
$this->db->join('warehouse as warehouse1', 'warehouse1.id = manufacturingorder.to_warehouse_id', 'left');
$this->db->join('bom', 'bom.id = manufacturingorder.bom_id', 'left');
$this->db->join('uom', 'uom.id = manufacturingorder.uom_id', 'left');
$this->db->where('manufacturingorder.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('manufacturingorder.item_id as manufacturingorder__item_id', false);
$this->db->select('warehouse.name as warehouse__name', false);
$this->db->select('manufacturingorder.from_warehouse_id as manufacturingorder__from_warehouse_id', false);
$this->db->select('warehouse1.name as warehouse1__name', false);
$this->db->select('manufacturingorder.to_warehouse_id as manufacturingorder__to_warehouse_id', false);
$this->db->select('bom.name as bom__name', false);
$this->db->select('manufacturingorder.bom_id as manufacturingorder__bom_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('manufacturingorder.uom_id as manufacturingorder__uom_id', false);
$this->db->select('manufacturingorder.id as id', false);
$this->db->select('manufacturingorder.idstring as manufacturingorder__idstring', false);
$this->db->select('DATE_FORMAT(manufacturingorder.date, "%d-%m-%Y") as manufacturingorder__date', false);
$this->db->select('manufacturingorder.quantity as manufacturingorder__quantity', false);
$this->db->select('manufacturingorder.type as manufacturingorder__type', false);
$this->db->select('manufacturingorder.lastupdate as manufacturingorder__lastupdate', false);
$this->db->select('manufacturingorder.updatedby as manufacturingorder__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "manufacturingorder.idstring like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorder.date like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || warehouse.name like '%".$_POST['searchtext']."%'";$where .= " || warehouse1.name like '%".$_POST['searchtext']."%'";$where .= " || bom.name like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorder.quantity like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorder.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorder.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('manufacturingorder__idstring', 'asc');
$this->db->order_by('manufacturingorder__date', 'desc');
$this->db->order_by('manufacturingorder__lastupdate', 'desc');
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
		$data['perpage'] = 20;
		
		$data['sortby'] = array();$data['sortdirection'] = array();
		if (isset($_POST['sortby'])) $data['sortby'] = $_POST['sortby'];
		if (isset($_POST['sortdirection'])) $data['sortdirection'] = $_POST['sortdirection'];
		
		$data['fields'] = array('manufacturingorder__idstring' => 'ID', 'manufacturingorder__date' => 'Date', 'item__name' => 'Item', 'warehouse__name' => 'Raw Material Location', 'warehouse1__name' => 'Finish Goods Location', 'bom__name' => 'Bill Of Material', 'manufacturingorder__quantity' => 'Quantity', 'uom__name' => 'Unit', 'manufacturingorder__lastupdate' => 'Last Update', 'manufacturingorder__updatedby' => 'Last Update By');
		
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
		
		
		
		
		}
		///
		$this->load->view('manufacturing_order_list_view', $data);
	}
}

?>