<?php

class sales_return_order_linelist extends Controller {

	function sales_return_order_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $salesreturnorder_id)
	{
		
$this->db->where('salesreturnorderline.salesreturnorder_id', $salesreturnorder_id);$this->db->from('salesreturnorderline');
$this->db->join('item', 'item.id = salesreturnorderline.item_id', 'left');
$this->db->join('uom', 'uom.id = salesreturnorderline.uom_id', 'left');
$this->db->where('salesreturnorderline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('salesreturnorderline.item_id as salesreturnorderline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('salesreturnorderline.uom_id as salesreturnorderline__uom_id', false);
$this->db->select('salesreturnorderline.id as id', false);
$this->db->select('salesreturnorderline.quantitytoreceive as salesreturnorderline__quantitytoreceive', false);
$this->db->select('salesreturnorderline.deliveryorderline_id as salesreturnorderline__deliveryorderline_id', false);
$this->db->select('salesreturnorderline.lastupdate as salesreturnorderline__lastupdate', false);
$this->db->select('salesreturnorderline.updatedby as salesreturnorderline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || salesreturnorderline.quantitytoreceive like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || salesreturnorderline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salesreturnorderline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('salesreturnorderline__item_id', 'asc');
$this->db->order_by('salesreturnorderline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($salesreturnorder_id=0)
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
		
		$data['foreign_id'] = $salesreturnorder_id;$data['fields'] = array('item__name' => 'Item', 'salesreturnorderline__quantitytoreceive' => 'Quantity', 'uom__name' => 'Unit', 'salesreturnorderline__lastupdate' => 'Last Update', 'salesreturnorderline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $salesreturnorder_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $salesreturnorder_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('sales_return_order_line_list_view', $data);
	}
}

?>