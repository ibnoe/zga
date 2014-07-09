<?php

class delivery_order_line_viewlist extends Controller {

	function delivery_order_line_viewlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $deliveryorder_id)
	{
		
$this->db->where('deliveryorderline.deliveryorder_id', $deliveryorder_id);$this->db->from('deliveryorderline');
$this->db->join('item', 'item.id = deliveryorderline.item_id', 'left');
$this->db->join('uom', 'uom.id = deliveryorderline.uom_id', 'left');
$this->db->where('deliveryorderline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('deliveryorderline.item_id as deliveryorderline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('deliveryorderline.uom_id as deliveryorderline__uom_id', false);
$this->db->select('deliveryorderline.id as id', false);
$this->db->select('deliveryorderline.quantitytosend as deliveryorderline__quantitytosend', false);
$this->db->select('deliveryorderline.salesorderline_id as deliveryorderline__salesorderline_id', false);
$this->db->select('deliveryorderline.lastupdate as deliveryorderline__lastupdate', false);
$this->db->select('deliveryorderline.updatedby as deliveryorderline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || deliveryorderline.quantitytosend like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || deliveryorderline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || deliveryorderline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('deliveryorderline__item_id', 'asc');
$this->db->order_by('deliveryorderline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($deliveryorder_id=0)
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
		
		$data['foreign_id'] = $deliveryorder_id;$data['fields'] = array('item__name' => 'Item', 'deliveryorderline__quantitytosend' => 'Quantity', 'uom__name' => 'Unit', 'deliveryorderline__lastupdate' => 'Last Update', 'deliveryorderline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $deliveryorder_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $deliveryorder_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('delivery_order_line_view_list_view', $data);
	}
}

?>