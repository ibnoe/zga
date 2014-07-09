<?php

class insert_item_linelist extends Controller {

	function insert_item_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $insertitem_id)
	{
		
$this->db->where('insertitemline.insertitem_id', $insertitem_id);$this->db->from('insertitemline');
$this->db->join('warehouse', 'warehouse.id = insertitemline.warehouse_id', 'left');
$this->db->join('item', 'item.id = insertitemline.item_id', 'left');
$this->db->join('uom', 'uom.id = insertitemline.uom_id', 'left');
$this->db->where('insertitemline.disabled = 0');
$this->db->select('warehouse.name as warehouse__name', false);
$this->db->select('insertitemline.warehouse_id as insertitemline__warehouse_id', false);
$this->db->select('item.name as item__name', false);
$this->db->select('insertitemline.item_id as insertitemline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('insertitemline.uom_id as insertitemline__uom_id', false);
$this->db->select('insertitemline.id as id', false);
$this->db->select('insertitemline.idstring as insertitemline__idstring', false);
$this->db->select('insertitemline.date as insertitemline__date', false);
$this->db->select('insertitemline.notes as insertitemline__notes', false);
$this->db->select('insertitemline.quantity as insertitemline__quantity', false);
$this->db->select('insertitemline.lastupdate as insertitemline__lastupdate', false);
$this->db->select('insertitemline.updatedby as insertitemline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "warehouse.name like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || insertitemline.quantity like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || insertitemline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || insertitemline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('insertitemline__idstring', 'asc');
$this->db->order_by('insertitemline__date', 'desc');
$this->db->order_by('insertitemline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($insertitem_id=0)
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
		
		$data['foreign_id'] = $insertitem_id;$data['fields'] = array('warehouse__name' => 'Location', 'item__name' => 'Item', 'insertitemline__quantity' => 'Quantity', 'uom__name' => 'Unit', 'insertitemline__lastupdate' => 'Last Update', 'insertitemline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $insertitem_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $insertitem_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('insert_item_line_list_view', $data);
	}
}

?>