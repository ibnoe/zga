<?php

class reject_manufacturing_line_viewlist extends Controller {

	function reject_manufacturing_line_viewlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $rejectmanufacturing_id)
	{
		
$this->db->where('rejectmanufacturingline.rejectmanufacturing_id', $rejectmanufacturing_id);$this->db->from('rejectmanufacturingline');
$this->db->join('item', 'item.id = rejectmanufacturingline.item_id', 'left');
$this->db->join('uom', 'uom.id = rejectmanufacturingline.uom_id', 'left');
$this->db->where('rejectmanufacturingline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('rejectmanufacturingline.item_id as rejectmanufacturingline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('rejectmanufacturingline.uom_id as rejectmanufacturingline__uom_id', false);
$this->db->select('rejectmanufacturingline.id as id', false);
$this->db->select('rejectmanufacturingline.quantitytoprocess as rejectmanufacturingline__quantitytoprocess', false);
$this->db->select('rejectmanufacturingline.manufacturingorderdoneline_id as rejectmanufacturingline__manufacturingorderdoneline_id', false);
$this->db->select('rejectmanufacturingline.lastupdate as rejectmanufacturingline__lastupdate', false);
$this->db->select('rejectmanufacturingline.updatedby as rejectmanufacturingline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || rejectmanufacturingline.quantitytoprocess like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || rejectmanufacturingline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || rejectmanufacturingline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('rejectmanufacturingline__item_id', 'asc');
$this->db->order_by('rejectmanufacturingline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($rejectmanufacturing_id=0)
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
		
		$data['foreign_id'] = $rejectmanufacturing_id;$data['fields'] = array('item__name' => 'Item', 'rejectmanufacturingline__quantitytoprocess' => 'Quantity', 'uom__name' => 'Unit', 'rejectmanufacturingline__lastupdate' => 'Last Update', 'rejectmanufacturingline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $rejectmanufacturing_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $rejectmanufacturing_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('reject_manufacturing_line_view_list_view', $data);
	}
}

?>