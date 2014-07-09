<?php

class purchase_return_order_linelist extends Controller {

	function purchase_return_order_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('purchasereturnorderline');
$this->db->join('item', 'item.id = purchasereturnorderline.item_id', 'left');
$this->db->join('uom', 'uom.id = purchasereturnorderline.uom_id', 'left');
$this->db->where('purchasereturnorderline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('purchasereturnorderline.item_id as purchasereturnorderline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('purchasereturnorderline.uom_id as purchasereturnorderline__uom_id', false);
$this->db->select('purchasereturnorderline.id as id', false);
$this->db->select('purchasereturnorderline.quantitytosend as purchasereturnorderline__quantitytosend', false);
$this->db->select('purchasereturnorderline.receiveditemline_id as purchasereturnorderline__receiveditemline_id', false);
$this->db->select('purchasereturnorderline.lastupdate as purchasereturnorderline__lastupdate', false);
$this->db->select('purchasereturnorderline.updatedby as purchasereturnorderline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnorderline.quantitytosend like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnorderline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnorderline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('purchasereturnorderline__item_id', 'asc');
$this->db->order_by('purchasereturnorderline__lastupdate', 'desc');
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
		
		$data['fields'] = array('item__name' => 'Item', 'purchasereturnorderline__quantitytosend' => 'Quantity', 'uom__name' => 'Unit', 'purchasereturnorderline__lastupdate' => 'Last Update', 'purchasereturnorderline__updatedby' => 'Last Update By');
		
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
		$this->load->view('purchase_return_order_line_list_view', $data);
	}
}

?>