<?php

class inking_unit_foillist extends Controller {

	function inking_unit_foillist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('inkingunitfoil');
$this->db->join('uom', 'inkingunitfoil.uom_id = uom.id', 'left');

$this->db->join('uom', 'inkingunitfoil.uom_id = uom.id', 'left');

$this->db->select('inkingunitfoil.name as inkingunitfoil__name');
$this->db->select('inkingunitfoil.category as inkingunitfoil__category');
$this->db->select('inkingunitfoil.color as inkingunitfoil__color');
$this->db->select('inkingunitfoil.ac as inkingunitfoil__ac');
$this->db->select('inkingunitfoil.ar as inkingunitfoil__ar');
$this->db->select('inkingunitfoil.thickness as inkingunitfoil__thickness');
$this->db->select('inkingunitfoil.minquantity as inkingunitfoil__minquantity');
$this->db->select('inkingunitfoil.maxquantity as inkingunitfoil__maxquantity');
$this->db->select('inkingunitfoil.buffer3months as inkingunitfoil__buffer3months');
$this->db->select('uom.name as uom__name');
$this->db->select('uom.name as uom__name');
$this->db->select('inkingunitfoil.purchaseable as inkingunitfoil__purchaseable');
$this->db->select('inkingunitfoil.sellable as inkingunitfoil__sellable');
$this->db->select('inkingunitfoil.id as id');
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "inkingunitfoil.name like '%".$_POST['searchtext']."%'";$where .= " || inkingunitfoil.category like '%".$_POST['searchtext']."%'";$where .= " || inkingunitfoil.color like '%".$_POST['searchtext']."%'";$where .= " || inkingunitfoil.ac like '%".$_POST['searchtext']."%'";$where .= " || inkingunitfoil.ar like '%".$_POST['searchtext']."%'";$where .= " || inkingunitfoil.thickness like '%".$_POST['searchtext']."%'";$where .= " || inkingunitfoil.minquantity like '%".$_POST['searchtext']."%'";$where .= " || inkingunitfoil.maxquantity like '%".$_POST['searchtext']."%'";$where .= " || inkingunitfoil.buffer3months like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || inkingunitfoil.purchaseable like '%".$_POST['searchtext']."%'";$where .= " || inkingunitfoil.sellable like '%".$_POST['searchtext']."%'";
			
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
		
		$data['fields'] = array('inkingunitfoil__name' => 'Name', 'inkingunitfoil__category' => 'Category', 'inkingunitfoil__color' => 'Color', 'inkingunitfoil__ac' => 'AC', 'inkingunitfoil__ar' => 'AR', 'inkingunitfoil__thickness' => 'Thickness', 'inkingunitfoil__minquantity' => 'Minimum Quantity', 'inkingunitfoil__maxquantity' => 'Maximum Quantity', 'inkingunitfoil__buffer3months' => 'Buffer 3 Months', 'uom__name' => 'Buy Uom', 'uom__name' => 'Sell Uom', 'inkingunitfoil__purchaseable' => 'Is Purchasable?', 'inkingunitfoil__sellable' => 'Is Sellable?');
		
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
		$this->load->view('inking_unit_foil_list_view', $data);
	}
}

?>