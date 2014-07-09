<?php

class under_packing_blanketlist extends Controller {

	function under_packing_blanketlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('underpackingblanket');
$this->db->join('uom', 'underpackingblanket.uom_id = uom.id', 'left');

$this->db->join('uom', 'underpackingblanket.uom_id = uom.id', 'left');

$this->db->select('underpackingblanket.name as underpackingblanket__name');
$this->db->select('underpackingblanket.category as underpackingblanket__category');
$this->db->select('underpackingblanket.color as underpackingblanket__color');
$this->db->select('underpackingblanket.ac as underpackingblanket__ac');
$this->db->select('underpackingblanket.ar as underpackingblanket__ar');
$this->db->select('underpackingblanket.thickness as underpackingblanket__thickness');
$this->db->select('underpackingblanket.minquantity as underpackingblanket__minquantity');
$this->db->select('underpackingblanket.maxquantity as underpackingblanket__maxquantity');
$this->db->select('underpackingblanket.buffer3months as underpackingblanket__buffer3months');
$this->db->select('uom.name as uom__name');
$this->db->select('uom.name as uom__name');
$this->db->select('underpackingblanket.purchaseable as underpackingblanket__purchaseable');
$this->db->select('underpackingblanket.sellable as underpackingblanket__sellable');
$this->db->select('underpackingblanket.id as id');
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "underpackingblanket.name like '%".$_POST['searchtext']."%'";$where .= " || underpackingblanket.category like '%".$_POST['searchtext']."%'";$where .= " || underpackingblanket.color like '%".$_POST['searchtext']."%'";$where .= " || underpackingblanket.ac like '%".$_POST['searchtext']."%'";$where .= " || underpackingblanket.ar like '%".$_POST['searchtext']."%'";$where .= " || underpackingblanket.thickness like '%".$_POST['searchtext']."%'";$where .= " || underpackingblanket.minquantity like '%".$_POST['searchtext']."%'";$where .= " || underpackingblanket.maxquantity like '%".$_POST['searchtext']."%'";$where .= " || underpackingblanket.buffer3months like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || underpackingblanket.purchaseable like '%".$_POST['searchtext']."%'";$where .= " || underpackingblanket.sellable like '%".$_POST['searchtext']."%'";
			
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
		
		$data['fields'] = array('underpackingblanket__name' => 'Name', 'underpackingblanket__category' => 'Category', 'underpackingblanket__color' => 'Color', 'underpackingblanket__ac' => 'AC', 'underpackingblanket__ar' => 'AR', 'underpackingblanket__thickness' => 'Thickness', 'underpackingblanket__minquantity' => 'Minimum Quantity', 'underpackingblanket__maxquantity' => 'Maximum Quantity', 'underpackingblanket__buffer3months' => 'Buffer 3 Months', 'uom__name' => 'Buy Uom', 'uom__name' => 'Sell Uom', 'underpackingblanket__purchaseable' => 'Is Purchasable?', 'underpackingblanket__sellable' => 'Is Sellable?');
		
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
		$this->load->view('under_packing_blanket_list_view', $data);
	}
}

?>