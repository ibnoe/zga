<?php

class other_itemlist extends Controller {

	function other_itemlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('item');
$this->db->join('uom', 'item.uom_id = uom.id', 'left');

$this->db->join('uom', 'item.uom_id = uom.id', 'left');

$this->db->select('item.name as item__name');
$this->db->select('item.type as item__type');
$this->db->select('uom.name as uom__name');
$this->db->select('uom.name as uom__name');
$this->db->select('item.purchaseable as item__purchaseable');
$this->db->select('item.sellable as item__sellable');
$this->db->select('item.id as id');
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || item.type like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || item.purchaseable like '%".$_POST['searchtext']."%'";$where .= " || item.sellable like '%".$_POST['searchtext']."%'";
			
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
		
		$data['fields'] = array('item__name' => 'Name', 'item__type' => 'Item Type', 'uom__name' => 'Buy Uom', 'uom__name' => 'Sell Uom', 'item__purchaseable' => 'Is Purchasable?', 'item__sellable' => 'Is Sellable?');
		
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
		$this->load->view('other_item_list_view', $data);
	}
}

?>