<?php

class receive_items_linelist extends Controller {

	function receive_items_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('receiveditemline');
$this->db->join('item', 'item.id = receiveditemline.item_id', 'left');
$this->db->join('uom', 'uom.id = receiveditemline.uom_id', 'left');
$this->db->where('receiveditemline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('receiveditemline.item_id as receiveditemline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('receiveditemline.uom_id as receiveditemline__uom_id', false);
$this->db->select('receiveditemline.id as id', false);
$this->db->select('receiveditemline.quantitytoreceive as receiveditemline__quantitytoreceive', false);
$this->db->select('receiveditemline.purchaseorderline_id as receiveditemline__purchaseorderline_id', false);
$this->db->select('receiveditemline.serialno as receiveditemline__serialno', false);
$this->db->select('DATE_FORMAT(receiveditemline.mfgdate, "%d-%m-%Y") as receiveditemline__mfgdate', false);
$this->db->select('DATE_FORMAT(receiveditemline.expireddate, "%d-%m-%Y") as receiveditemline__expireddate', false);
$this->db->select('receiveditemline.batchno as receiveditemline__batchno', false);
$this->db->select('receiveditemline.palletno as receiveditemline__palletno', false);
$this->db->select('receiveditemline.rollno as receiveditemline__rollno', false);
$this->db->select('receiveditemline.lastupdate as receiveditemline__lastupdate', false);
$this->db->select('receiveditemline.updatedby as receiveditemline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || receiveditemline.quantitytoreceive like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || receiveditemline.serialno like '%".$_POST['searchtext']."%'";$where .= " || receiveditemline.mfgdate like '%".$_POST['searchtext']."%'";$where .= " || receiveditemline.expireddate like '%".$_POST['searchtext']."%'";$where .= " || receiveditemline.batchno like '%".$_POST['searchtext']."%'";$where .= " || receiveditemline.palletno like '%".$_POST['searchtext']."%'";$where .= " || receiveditemline.rollno like '%".$_POST['searchtext']."%'";$where .= " || receiveditemline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || receiveditemline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('receiveditemline__item_id', 'asc');
$this->db->order_by('receiveditemline__lastupdate', 'desc');
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
		
		$data['fields'] = array('item__name' => 'Item', 'receiveditemline__quantitytoreceive' => 'Quantity', 'uom__name' => 'Unit', 'receiveditemline__serialno' => 'Serial No', 'receiveditemline__mfgdate' => 'Mfg Date', 'receiveditemline__expireddate' => 'Expired Date', 'receiveditemline__batchno' => 'Batch No', 'receiveditemline__palletno' => 'Pallete No', 'receiveditemline__rollno' => 'Roll No', 'receiveditemline__lastupdate' => 'Last Update', 'receiveditemline__updatedby' => 'Last Update By');
		
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
		$this->load->view('receive_items_line_list_view', $data);
	}
}

?>