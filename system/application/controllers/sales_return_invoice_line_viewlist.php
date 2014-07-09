<?php

class sales_return_invoice_line_viewlist extends Controller {

	function sales_return_invoice_line_viewlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $salesreturninvoice_id)
	{
		
$this->db->where('salesreturninvoiceline.salesreturninvoice_id', $salesreturninvoice_id);$this->db->from('salesreturninvoiceline');
$this->db->join('item', 'item.id = salesreturninvoiceline.item_id', 'left');
$this->db->join('uom', 'uom.id = salesreturninvoiceline.uom_id', 'left');
$this->db->where('salesreturninvoiceline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('salesreturninvoiceline.item_id as salesreturninvoiceline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('salesreturninvoiceline.uom_id as salesreturninvoiceline__uom_id', false);
$this->db->select('salesreturninvoiceline.id as id', false);
$this->db->select('salesreturninvoiceline.quantity as salesreturninvoiceline__quantity', false);
$this->db->select('salesreturninvoiceline.price as salesreturninvoiceline__price', false);
$this->db->select('salesreturninvoiceline.salesreturnorderline_id as salesreturninvoiceline__salesreturnorderline_id', false);
$this->db->select('salesreturninvoiceline.subtotal as salesreturninvoiceline__subtotal', false);
$this->db->select('salesreturninvoiceline.lastupdate as salesreturninvoiceline__lastupdate', false);
$this->db->select('salesreturninvoiceline.updatedby as salesreturninvoiceline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || salesreturninvoiceline.quantity like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || salesreturninvoiceline.price like '%".$_POST['searchtext']."%'";$where .= " || salesreturninvoiceline.subtotal like '%".$_POST['searchtext']."%'";$where .= " || salesreturninvoiceline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salesreturninvoiceline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('salesreturninvoiceline__item_id', 'asc');
$this->db->order_by('salesreturninvoiceline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($salesreturninvoice_id=0)
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
		
		$data['foreign_id'] = $salesreturninvoice_id;$data['fields'] = array('item__name' => 'Item', 'salesreturninvoiceline__quantity' => 'Quantity', 'uom__name' => 'Unit', 'salesreturninvoiceline__price' => 'Price', 'salesreturninvoiceline__subtotal' => 'SubTotal', 'salesreturninvoiceline__lastupdate' => 'Last Update', 'salesreturninvoiceline__updatedby' => 'Last Update By');
		
		$data = $this->_qhelp($data, $salesreturninvoice_id);
		
		
		
		$q = $this->db->get();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $salesreturninvoice_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		///
		$this->load->view('sales_return_invoice_line_view_list_view', $data);
	}
}

?>