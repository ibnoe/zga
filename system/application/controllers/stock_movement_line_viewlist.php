<?php

class stock_movement_line_viewlist extends Controller {

	function stock_movement_line_viewlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $moveaction_id)
	{
		
$this->db->where('moveactionline.moveaction_id', $moveaction_id);$this->db->from('moveactionline');
$this->db->join('item', 'item.id = moveactionline.item_id', 'left');
$this->db->join('uom', 'uom.id = moveactionline.uom_id', 'left');
$this->db->where('moveactionline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('moveactionline.item_id as moveactionline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('moveactionline.uom_id as moveactionline__uom_id', false);
$this->db->select('moveactionline.id as id', false);
$this->db->select('moveactionline.quantitytomove as moveactionline__quantitytomove', false);
$this->db->select('moveactionline.moveorderline_id as moveactionline__moveorderline_id', false);
$this->db->select('moveactionline.lastupdate as moveactionline__lastupdate', false);
$this->db->select('moveactionline.updatedby as moveactionline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || moveactionline.quantitytomove like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || moveactionline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || moveactionline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('moveactionline__item_id', 'asc');
$this->db->order_by('moveactionline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($moveaction_id=0)
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
		
		$data['foreign_id'] = $moveaction_id;$data['fields'] = array('item__name' => 'Item', 'moveactionline__quantitytomove' => 'Quantity', 'uom__name' => 'Unit', 'moveactionline__lastupdate' => 'Last Update', 'moveactionline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $moveaction_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $moveaction_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('stock_movement_line_view_list_view', $data);
	}
}

?>