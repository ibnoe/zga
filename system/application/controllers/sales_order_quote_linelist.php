<?php

class sales_order_quote_linelist extends Controller {

	function sales_order_quote_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $salesorder_id)
	{
		
$this->db->where('salesorderline.salesorder_id', $salesorder_id);$this->db->from('salesorderline');
$this->db->join('item', 'item.id = salesorderline.item_id', 'left');
$this->db->join('uom', 'uom.id = salesorderline.uom_id', 'left');
$this->db->where('salesorderline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('salesorderline.item_id as salesorderline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('salesorderline.uom_id as salesorderline__uom_id', false);
$this->db->select('salesorderline.id as id', false);
$this->db->select('salesorderline.orderid as salesorderline__orderid', false);
$this->db->select('salesorderline.date as salesorderline__date', false);
$this->db->select('salesorderline.notes as salesorderline__notes', false);
$this->db->select('salesorderline.customer_id as salesorderline__customer_id', false);
$this->db->select('salesorderline.currency_id as salesorderline__currency_id', false);
$this->db->select('salesorderline.currencyrate as salesorderline__currencyrate', false);
$this->db->select('salesorderline.warehouse_id as salesorderline__warehouse_id', false);
$this->db->select('salesorderline.status as salesorderline__status', false);
$this->db->select('salesorderline.type as salesorderline__type', false);
$this->db->select('salesorderline.quantity as salesorderline__quantity', false);
$this->db->select('salesorderline.price as salesorderline__price', false);
$this->db->select('salesorderline.pdisc as salesorderline__pdisc', false);
$this->db->select('salesorderline.modulename as salesorderline__modulename', false);
$this->db->select('salesorderline.subtotal as salesorderline__subtotal', false);
$this->db->select('salesorderline.lastupdate as salesorderline__lastupdate', false);
$this->db->select('salesorderline.updatedby as salesorderline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "salesorderline.type like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.quantity like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.price like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.pdisc like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.subtotal like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('salesorderline__orderid', 'asc');
$this->db->order_by('salesorderline__date', 'desc');
$this->db->order_by('salesorderline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($salesorder_id=0)
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
		
		$data['foreign_id'] = $salesorder_id;$data['fields'] = array('salesorderline__type' => 'Type', 'item__name' => 'Item', 'salesorderline__quantity' => 'Quantity', 'uom__name' => 'Unit', 'salesorderline__price' => 'Price', 'salesorderline__pdisc' => 'Disc %', 'salesorderline__subtotal' => 'SubTotal', 'salesorderline__lastupdate' => 'Last Update', 'salesorderline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $salesorder_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $salesorder_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('sales_order_quote_line_list_view', $data);
	}
}

?>