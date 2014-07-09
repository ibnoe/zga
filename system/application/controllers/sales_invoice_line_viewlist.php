<?php

class sales_invoice_line_viewlist extends Controller {

	function sales_invoice_line_viewlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $salesinvoice_id)
	{
		
$this->db->where('salesinvoiceline.salesinvoice_id', $salesinvoice_id);$this->db->from('salesinvoiceline');
$this->db->join('item', 'item.id = salesinvoiceline.item_id', 'left');
$this->db->join('uom', 'uom.id = salesinvoiceline.uom_id', 'left');
$this->db->where('salesinvoiceline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('salesinvoiceline.item_id as salesinvoiceline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('salesinvoiceline.uom_id as salesinvoiceline__uom_id', false);
$this->db->select('salesinvoiceline.id as id', false);
$this->db->select('salesinvoiceline.quantity as salesinvoiceline__quantity', false);
$this->db->select('salesinvoiceline.price as salesinvoiceline__price', false);
$this->db->select('salesinvoiceline.salesorderline_id as salesinvoiceline__salesorderline_id', false);
$this->db->select('salesinvoiceline.subtotal as salesinvoiceline__subtotal', false);
$this->db->select('salesinvoiceline.lastupdate as salesinvoiceline__lastupdate', false);
$this->db->select('salesinvoiceline.updatedby as salesinvoiceline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || salesinvoiceline.quantity like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || salesinvoiceline.price like '%".$_POST['searchtext']."%'";$where .= " || salesinvoiceline.subtotal like '%".$_POST['searchtext']."%'";$where .= " || salesinvoiceline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salesinvoiceline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('salesinvoiceline__item_id', 'asc');
$this->db->order_by('salesinvoiceline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($salesinvoice_id=0)
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
		
		$data['foreign_id'] = $salesinvoice_id;$data['fields'] = array('item__name' => 'Item', 'salesinvoiceline__quantity' => 'Quantity', 'uom__name' => 'Unit', 'salesinvoiceline__price' => 'Price', 'salesinvoiceline__subtotal' => 'SubTotal', 'salesinvoiceline__lastupdate' => 'Last Update', 'salesinvoiceline__updatedby' => 'Last Update By');
		
		$data = $this->_qhelp($data, $salesinvoice_id);
		
		
		
		$q = $this->db->get();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $salesinvoice_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		///
		$this->load->view('sales_invoice_line_view_list_view', $data);
	}
}

?>