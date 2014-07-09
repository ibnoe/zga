<?php

class move_order_linelist extends Controller {

	function move_order_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $moveorder_id)
	{
		
$this->db->where('moveorderline.moveorder_id', $moveorder_id);$this->db->from('moveorderline');
$this->db->join('item', 'item.id = moveorderline.item_id', 'left');
$this->db->join('uom', 'uom.id = moveorderline.uom_id', 'left');
$this->db->where('moveorderline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('moveorderline.item_id as moveorderline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('moveorderline.uom_id as moveorderline__uom_id', false);
$this->db->select('moveorderline.id as id', false);
$this->db->select('moveorderline.orderid as moveorderline__orderid', false);
$this->db->select('moveorderline.date as moveorderline__date', false);
$this->db->select('moveorderline.from_warehouse_id as moveorderline__from_warehouse_id', false);
$this->db->select('moveorderline.to_warehouse_id as moveorderline__to_warehouse_id', false);
$this->db->select('moveorderline.quantity as moveorderline__quantity', false);
$this->db->select('moveorderline.lastupdate as moveorderline__lastupdate', false);
$this->db->select('moveorderline.updatedby as moveorderline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || moveorderline.quantity like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || moveorderline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || moveorderline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('moveorderline__orderid', 'asc');
$this->db->order_by('moveorderline__date', 'desc');
$this->db->order_by('moveorderline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($moveorder_id=0)
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
		
		$data['foreign_id'] = $moveorder_id;$data['fields'] = array('item__name' => 'Item', 'moveorderline__quantity' => 'Quantity', 'uom__name' => 'Unit', 'moveorderline__lastupdate' => 'Last Update', 'moveorderline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $moveorder_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $moveorder_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('move_order_line_list_view', $data);
	}
}

?>