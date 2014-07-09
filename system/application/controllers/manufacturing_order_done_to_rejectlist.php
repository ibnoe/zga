<?php

class manufacturing_order_done_to_rejectlist extends Controller {

	function manufacturing_order_done_to_rejectlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('manufacturingorderdoneline');
$this->db->join('warehouse', 'warehouse.id = manufacturingorderdoneline.warehouse_id', 'left');
$this->db->join('item', 'item.id = manufacturingorderdoneline.item_id', 'left');
$this->db->join('uom', 'uom.id = manufacturingorderdoneline.uom_id', 'left');
$this->db->where('manufacturingorderdoneline.disabled = 0');
$this->db->select('warehouse.name as warehouse__name', false);
$this->db->select('manufacturingorderdoneline.warehouse_id as manufacturingorderdoneline__warehouse_id', false);
$this->db->select('item.name as item__name', false);
$this->db->select('manufacturingorderdoneline.item_id as manufacturingorderdoneline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('manufacturingorderdoneline.uom_id as manufacturingorderdoneline__uom_id', false);
$this->db->select('manufacturingorderdoneline.id as id', false);
$this->db->select('manufacturingorderdoneline.id as manufacturingorderdoneline__id', false);
$this->db->select('DATE_FORMAT(manufacturingorderdoneline.date, "%d-%m-%Y") as manufacturingorderdoneline__date', false);
$this->db->select('manufacturingorderdoneline.idstring as manufacturingorderdoneline__idstring', false);
$this->db->select('manufacturingorderdoneline.quantitytoprocess as manufacturingorderdoneline__quantitytoprocess', false);
$this->db->select('manufacturingorderdoneline.lastupdate as manufacturingorderdoneline__lastupdate', false);
$this->db->select('manufacturingorderdoneline.updatedby as manufacturingorderdoneline__updatedby', false);if (isset($_POST['item_id']) && $_POST['item_id'] != -1)$this->db->where('manufacturingorderdoneline.item_id', $_POST['item_id']);if (isset($_POST['warehouse_id']) && $_POST['warehouse_id'] != -1)$this->db->where('manufacturingorderdoneline.warehouse_id', $_POST['warehouse_id']);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "manufacturingorderdoneline.id like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorderdoneline.date like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorderdoneline.idstring like '%".$_POST['searchtext']."%'";$where .= " || warehouse.name like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorderdoneline.quantitytoprocess like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorderdoneline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorderdoneline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('manufacturingorderdoneline__id', 'asc');
$this->db->order_by('manufacturingorderdoneline__date', 'desc');
$this->db->order_by('manufacturingorderdoneline__lastupdate', 'desc');
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
		
		$data['fields'] = array('manufacturingorderdoneline__date' => 'Date', 'manufacturingorderdoneline__idstring' => 'ID', 'warehouse__name' => 'Warehouse', 'item__name' => 'Item', 'manufacturingorderdoneline__quantitytoprocess' => 'Quantity', 'uom__name' => 'Unit', 'manufacturingorderdoneline__lastupdate' => 'Last Update', 'manufacturingorderdoneline__updatedby' => 'Last Update By');
		
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
		
		
		
		$this->db->from('manufacturingorderdoneline');$this->db->join('item', 'item.id = manufacturingorderdoneline.item_id');$this->db->select('item_id as id, item.name as name');$q = $this->db->get();$item_opt = array('-1' => 'All');foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }$data['item_opt'] = $item_opt;foreach ($item_opt as $k=>$v) { $data['item_id'] = $k; break; }if (isset($_POST['item_id']))$data['item_id'] = $_POST['item_id'];$this->db->from('manufacturingorderdoneline');$this->db->join('warehouse', 'warehouse.id = manufacturingorderdoneline.warehouse_id');$this->db->select('warehouse_id as id, warehouse.name as name');$q = $this->db->get();$warehouse_opt = array('-1' => 'All');foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }$data['warehouse_opt'] = $warehouse_opt;foreach ($warehouse_opt as $k=>$v) { $data['warehouse_id'] = $k; break; }if (isset($_POST['warehouse_id']))$data['warehouse_id'] = $_POST['warehouse_id'];
		}
		///
		$this->load->view('manufacturing_order_done_to_reject_list_view', $data);
	}
}

?>