<?php

class filter_vacuumlist extends Controller {

	function filter_vacuumlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('filtervacuum');
$this->db->join('uom', 'filtervacuum.uom_id = uom.id', 'left');

$this->db->join('uom', 'filtervacuum.uom_id = uom.id', 'left');

$this->db->select('filtervacuum.name as filtervacuum__name');
$this->db->select('filtervacuum.subcategory as filtervacuum__subcategory');
$this->db->select('filtervacuum.minquantity as filtervacuum__minquantity');
$this->db->select('filtervacuum.maxquantity as filtervacuum__maxquantity');
$this->db->select('filtervacuum.buffer3months as filtervacuum__buffer3months');
$this->db->select('uom.name as uom__name');
$this->db->select('uom.name as uom__name');
$this->db->select('filtervacuum.purchaseable as filtervacuum__purchaseable');
$this->db->select('filtervacuum.sellable as filtervacuum__sellable');
$this->db->select('filtervacuum.id as id');
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "filtervacuum.name like '%".$_POST['searchtext']."%'";$where .= " || filtervacuum.subcategory like '%".$_POST['searchtext']."%'";$where .= " || filtervacuum.minquantity like '%".$_POST['searchtext']."%'";$where .= " || filtervacuum.maxquantity like '%".$_POST['searchtext']."%'";$where .= " || filtervacuum.buffer3months like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || filtervacuum.purchaseable like '%".$_POST['searchtext']."%'";$where .= " || filtervacuum.sellable like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
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
		
		$data['fields'] = array('filtervacuum__name' => 'Name', 'filtervacuum__subcategory' => 'Category', 'filtervacuum__minquantity' => 'Minimum Quantity', 'filtervacuum__maxquantity' => 'Maximum Quantity', 'filtervacuum__buffer3months' => 'Buffer 3 Months', 'uom__name' => 'Buy Uom', 'uom__name' => 'Sell Uom', 'filtervacuum__purchaseable' => 'Is Purchasable?', 'filtervacuum__sellable' => 'Is Sellable?');
		
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
		$this->load->view('filter_vacuum_list_view', $data);
	}
}

?>