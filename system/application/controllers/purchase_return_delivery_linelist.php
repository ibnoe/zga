<?php

class purchase_return_delivery_linelist extends Controller {

	function purchase_return_delivery_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('purchasereturndeliveryline');
$this->db->join('item', 'item.id = purchasereturndeliveryline.item_id', 'left');
$this->db->join('uom', 'uom.id = purchasereturndeliveryline.uom_id', 'left');
$this->db->where('purchasereturndeliveryline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('purchasereturndeliveryline.item_id as purchasereturndeliveryline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('purchasereturndeliveryline.uom_id as purchasereturndeliveryline__uom_id', false);
$this->db->select('purchasereturndeliveryline.id as id', false);
$this->db->select('purchasereturndeliveryline.quantitytosend as purchasereturndeliveryline__quantitytosend', false);
$this->db->select('purchasereturndeliveryline.purchasereturnorderline_id as purchasereturndeliveryline__purchasereturnorderline_id', false);
$this->db->select('purchasereturndeliveryline.lastupdate as purchasereturndeliveryline__lastupdate', false);
$this->db->select('purchasereturndeliveryline.updatedby as purchasereturndeliveryline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || purchasereturndeliveryline.quantitytosend like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || purchasereturndeliveryline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || purchasereturndeliveryline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('purchasereturndeliveryline__item_id', 'asc');
$this->db->order_by('purchasereturndeliveryline__lastupdate', 'desc');
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
		
		$data['fields'] = array('item__name' => 'Item', 'purchasereturndeliveryline__quantitytosend' => 'Quantity', 'uom__name' => 'Unit', 'purchasereturndeliveryline__lastupdate' => 'Last Update', 'purchasereturndeliveryline__updatedby' => 'Last Update By');
		
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
		$this->load->view('purchase_return_delivery_line_list_view', $data);
	}
}

?>