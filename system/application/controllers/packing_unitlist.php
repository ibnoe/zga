<?php

class packing_unitlist extends Controller {

	function packing_unitlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('packingunit');
$this->db->join('uom', 'uom.id = packingunit.uom_id', 'left');
$this->db->where('packingunit.disabled = 0');
$this->db->select('uom.name as uom__name', false);
$this->db->select('packingunit.uom_id as packingunit__uom_id', false);
$this->db->select('packingunit.id as id', false);
$this->db->select('packingunit.name as packingunit__name', false);
$this->db->select('packingunit.ratio as packingunit__ratio', false);
$this->db->select('packingunit.lastupdate as packingunit__lastupdate', false);
$this->db->select('packingunit.updatedby as packingunit__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "packingunit.name like '%".$_POST['searchtext']."%'";$where .= " || packingunit.ratio like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || packingunit.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || packingunit.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('packingunit__name', 'asc');
$this->db->order_by('packingunit__lastupdate', 'desc');
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
		
		$data['fields'] = array('packingunit__name' => 'Name', 'packingunit__ratio' => 'Ratio', 'uom__name' => 'Uom', 'packingunit__lastupdate' => 'Last Update', 'packingunit__updatedby' => 'Last Update By');
		
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
		$this->load->view('packing_unit_list_view', $data);
	}
}

?>