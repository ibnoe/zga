<?php

class composite_canlist extends Controller {

	function composite_canlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('composite');
$this->db->join('uom', 'composite.uom_id = uom.id', 'left');

$this->db->join('uom', 'composite.uom_id = uom.id', 'left');

$this->db->select('composite.name as composite__name');
$this->db->select('composite.diameter as composite__diameter');
$this->db->select('composite.length as composite__length');
$this->db->select('composite.minquantity as composite__minquantity');
$this->db->select('composite.maxquantity as composite__maxquantity');
$this->db->select('composite.buffer3months as composite__buffer3months');
$this->db->select('uom.name as uom__name');
$this->db->select('uom.name as uom__name');
$this->db->select('composite.purchaseable as composite__purchaseable');
$this->db->select('composite.sellable as composite__sellable');
$this->db->select('composite.id as id');
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "composite.name like '%".$_POST['searchtext']."%'";$where .= " || composite.diameter like '%".$_POST['searchtext']."%'";$where .= " || composite.length like '%".$_POST['searchtext']."%'";$where .= " || composite.minquantity like '%".$_POST['searchtext']."%'";$where .= " || composite.maxquantity like '%".$_POST['searchtext']."%'";$where .= " || composite.buffer3months like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || composite.purchaseable like '%".$_POST['searchtext']."%'";$where .= " || composite.sellable like '%".$_POST['searchtext']."%'";
			
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
		
		$data['fields'] = array('composite__name' => 'Name', 'composite__diameter' => 'Diameter', 'composite__length' => 'Length', 'composite__minquantity' => 'Minimum Quantity', 'composite__maxquantity' => 'Maximum Quantity', 'composite__buffer3months' => 'Buffer 3 Months', 'uom__name' => 'Buy Uom', 'uom__name' => 'Sell Uom', 'composite__purchaseable' => 'Is Purchasable?', 'composite__sellable' => 'Is Sellable?');
		
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
		$this->load->view('composite_can_list_view', $data);
	}
}

?>