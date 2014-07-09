<?php

class sales_return_delivery_linelist extends Controller {

	function sales_return_delivery_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $salesreturndelivery_id)
	{
		
$this->db->where('salesreturndeliveryline.salesreturndelivery_id', $salesreturndelivery_id);$this->db->from('salesreturndeliveryline');
$this->db->join('item', 'item.id = salesreturndeliveryline.item_id', 'left');
$this->db->join('uom', 'uom.id = salesreturndeliveryline.uom_id', 'left');
$this->db->where('salesreturndeliveryline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('salesreturndeliveryline.item_id as salesreturndeliveryline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('salesreturndeliveryline.uom_id as salesreturndeliveryline__uom_id', false);
$this->db->select('salesreturndeliveryline.id as id', false);
$this->db->select('salesreturndeliveryline.quantitytoreceive as salesreturndeliveryline__quantitytoreceive', false);
$this->db->select('salesreturndeliveryline.salesreturnorderline_id as salesreturndeliveryline__salesreturnorderline_id', false);
$this->db->select('salesreturndeliveryline.lastupdate as salesreturndeliveryline__lastupdate', false);
$this->db->select('salesreturndeliveryline.updatedby as salesreturndeliveryline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || salesreturndeliveryline.quantitytoreceive like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || salesreturndeliveryline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salesreturndeliveryline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('salesreturndeliveryline__item_id', 'asc');
$this->db->order_by('salesreturndeliveryline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($salesreturndelivery_id=0)
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
		
		$data['foreign_id'] = $salesreturndelivery_id;$data['fields'] = array('item__name' => 'Item', 'salesreturndeliveryline__quantitytoreceive' => 'Quantity', 'uom__name' => 'Unit', 'salesreturndeliveryline__lastupdate' => 'Last Update', 'salesreturndeliveryline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $salesreturndelivery_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $salesreturndelivery_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('sales_return_delivery_line_list_view', $data);
	}
}

?>