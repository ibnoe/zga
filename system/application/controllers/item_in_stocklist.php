<?php

class item_in_stocklist extends Controller {

	function item_in_stocklist()
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
$this->db->join('stock', 'item.id = stock.item_id');
$this->db->where('item.disabled = 0');
$this->db->select('itemcategory.name as itemcategory__name', false);
$this->db->select('item.itemcategory_id as item__itemcategory_id', false);
$this->db->select('item.id as id', false);
$this->db->select('item.idstring as item__idstring', false);
$this->db->select('item.name as item__name', false);
$this->db->select('item.minquantity as item__minquantity', false);
$this->db->select('item.maxquantity as item__maxquantity', false);
$this->db->select('item.buffer3months as item__buffer3months', false);
$this->db->select('item.lastupdate as item__lastupdate', false);
$this->db->select('item.updatedby as item__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.idstring like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || item.minquantity like '%".$_POST['searchtext']."%'";$where .= " || item.maxquantity like '%".$_POST['searchtext']."%'";$where .= " || item.buffer3months like '%".$_POST['searchtext']."%'";$where .= " || itemcategory.name like '%".$_POST['searchtext']."%'";$where .= " || item.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || item.updatedby like '%".$_POST['searchtext']."%'";
			
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
		$data['perpage'] = 20;
		
		$data['sortby'] = array();$data['sortdirection'] = array();
		if (isset($_POST['sortby'])) $data['sortby'] = $_POST['sortby'];
		if (isset($_POST['sortdirection'])) $data['sortdirection'] = $_POST['sortdirection'];
		
		$data['fields'] = array('item__idstring' => 'Item ID', 'item__name' => 'Name', 'item__minquantity' => 'Minimum Quantity', 'item__maxquantity' => 'Maximum Quantity', 'item__buffer3months' => 'Buffer 3 Months', 'itemcategory__name' => 'Category', 'item__lastupdate' => 'Last Update', 'item__updatedby' => 'Last Update By');
		
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
		$this->load->view('item_in_stock_list_view', $data);
	}
}

?>