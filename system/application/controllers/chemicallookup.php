<?php

class chemicallookup extends Controller {

	function chemicallookup()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('item');
$this->db->join('itemcategory', 'itemcategory.id = item.itemcategory_id', 'left');
$this->db->where('item.disabled = 0');
$this->db->where('item.intitemtype = "chemical"');
$this->db->select('itemcategory.name as itemcategory__name', false);
$this->db->select('item.itemcategory_id as item__itemcategory_id', false);
$this->db->select('item.id as id', false);
$this->db->select('item.idstring as item__idstring', false);
$this->db->select('item.name as item__name', false);
$this->db->select('item.chemicalcode as item__chemicalcode', false);
$this->db->select('item.chemicaltype as item__chemicaltype', false);
$this->db->select('item.packingsize as item__packingsize', false);
$this->db->select('item.intitemtype as item__intitemtype', false);
$this->db->select('item.itemcategory_id as item__itemcategory_id', false);
$this->db->select('item.lastupdate as item__lastupdate', false);
$this->db->select('item.updatedby as item__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.idstring like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || item.chemicalcode like '%".$_POST['searchtext']."%'";$where .= " || item.chemicaltype like '%".$_POST['searchtext']."%'";$where .= " || item.packingsize like '%".$_POST['searchtext']."%'";$where .= " || itemcategory.name like '%".$_POST['searchtext']."%'";$where .= " || item.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || item.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('item__idstring', 'asc');
$this->db->order_by('item__lastupdate', 'desc');
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
		
		$data['fields'] = array('item__idstring' => 'Item ID', 'item__name' => 'Name', 'item__chemicalcode' => 'Product Code', 'item__chemicaltype' => 'Product Classification', 'item__packingsize' => 'Packing Size', 'itemcategory__name' => 'Category', 'item__lastupdate' => 'Last Update', 'item__updatedby' => 'Last Update By');
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		
		
		$q = $this->db->get();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		///
		$this->load->view('chemical_lookup_view', $data);
	}
}

?>