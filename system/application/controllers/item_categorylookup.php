<?php

class item_categorylookup extends Controller {

	function item_categorylookup()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('itemcategory');
$this->db->where('itemcategory.disabled = 0');
$this->db->select('itemcategory.id as id', false);
$this->db->select('itemcategory.name as itemcategory__name', false);
$this->db->select('itemcategory.notes as itemcategory__notes', false);
$this->db->select('itemcategory.lastupdate as itemcategory__lastupdate', false);
$this->db->select('itemcategory.updatedby as itemcategory__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "itemcategory.name like '%".$_POST['searchtext']."%'";$where .= " || itemcategory.notes like '%".$_POST['searchtext']."%'";$where .= " || itemcategory.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || itemcategory.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('itemcategory__name', 'asc');
$this->db->order_by('itemcategory__lastupdate', 'desc');
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
		
		$data['fields'] = array('itemcategory__name' => 'Name', 'itemcategory__notes' => 'Notes', 'itemcategory__lastupdate' => 'Last Update', 'itemcategory__updatedby' => 'Last Update By');
		
		if (count($_POST) == 0)
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
		$this->load->view('item_category_lookup_view', $data);
	}
}

?>