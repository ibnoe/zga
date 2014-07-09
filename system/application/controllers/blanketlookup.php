<?php

class blanketlookup extends Controller {

	function blanketlookup()
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
$this->db->where('item.intitemtype = "blanket"');
$this->db->select('itemcategory.name as itemcategory__name', false);
$this->db->select('item.itemcategory_id as item__itemcategory_id', false);
$this->db->select('item.id as id', false);
$this->db->select('item.idstring as item__idstring', false);
$this->db->select('item.name as item__name', false);
$this->db->select('item.palleteno as item__palleteno', false);
$this->db->select('item.codebaru as item__codebaru', false);
$this->db->select('item.pressntype as item__pressntype', false);
$this->db->select('item.ac as item__ac', false);
$this->db->select('item.ar as item__ar', false);
$this->db->select('item.thickness as item__thickness', false);
$this->db->select('item.bartype as item__bartype', false);
$this->db->select('item.movingspeed as item__movingspeed', false);
$this->db->select('item.minquantity as item__minquantity', false);
$this->db->select('item.maxquantity as item__maxquantity', false);
$this->db->select('item.barorigin as item__barorigin', false);
$this->db->select('item.barnonbar as item__barnonbar', false);
$this->db->select('item.buffer3months as item__buffer3months', false);
$this->db->select('item.intitemtype as item__intitemtype', false);
$this->db->select('item.itemcategory_id as item__itemcategory_id', false);
$this->db->select('item.lastupdate as item__lastupdate', false);
$this->db->select('item.updatedby as item__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.idstring like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || item.palleteno like '%".$_POST['searchtext']."%'";$where .= " || item.codebaru like '%".$_POST['searchtext']."%'";$where .= " || item.pressntype like '%".$_POST['searchtext']."%'";$where .= " || item.ac like '%".$_POST['searchtext']."%'";$where .= " || item.ar like '%".$_POST['searchtext']."%'";$where .= " || item.thickness like '%".$_POST['searchtext']."%'";$where .= " || item.bartype like '%".$_POST['searchtext']."%'";$where .= " || item.movingspeed like '%".$_POST['searchtext']."%'";$where .= " || item.minquantity like '%".$_POST['searchtext']."%'";$where .= " || item.maxquantity like '%".$_POST['searchtext']."%'";$where .= " || item.barorigin like '%".$_POST['searchtext']."%'";$where .= " || item.barnonbar like '%".$_POST['searchtext']."%'";$where .= " || item.buffer3months like '%".$_POST['searchtext']."%'";$where .= " || itemcategory.name like '%".$_POST['searchtext']."%'";$where .= " || item.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || item.updatedby like '%".$_POST['searchtext']."%'";
			
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
		
		$data['fields'] = array('item__idstring' => 'Item ID', 'item__name' => 'Name', 'item__palleteno' => 'Pallete No', 'item__codebaru' => 'Code Baru', 'item__pressntype' => 'Press & Type', 'item__ac' => 'AC', 'item__ar' => 'AR', 'item__thickness' => 'Thickness', 'item__bartype' => 'Bar Type', 'item__movingspeed' => 'Moving Speed', 'item__minquantity' => 'Minimum Stock', 'item__maxquantity' => 'Maximum Stock', 'item__barorigin' => 'Converting Place', 'item__barnonbar' => 'Bar/Non Bar', 'item__buffer3months' => 'Buffer 3 Months', 'itemcategory__name' => 'Category', 'item__lastupdate' => 'Last Update', 'item__updatedby' => 'Last Update By');
		
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
		$this->load->view('blanket_lookup_view', $data);
	}
}

?>