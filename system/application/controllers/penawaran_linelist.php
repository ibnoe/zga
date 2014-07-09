<?php

class penawaran_linelist extends Controller {

	function penawaran_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $salesorderquote_id)
	{
		
$this->db->where('salesorderquoteline.salesorderquote_id', $salesorderquote_id);$this->db->from('salesorderquoteline');
$this->db->join('item', 'item.id = salesorderquoteline.item_id', 'left');
$this->db->join('uom', 'uom.id = salesorderquoteline.uom_id', 'left');
$this->db->where('salesorderquoteline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('salesorderquoteline.item_id as salesorderquoteline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('salesorderquoteline.uom_id as salesorderquoteline__uom_id', false);
$this->db->select('salesorderquoteline.id as id', false);
$this->db->select('salesorderquoteline.orderid as salesorderquoteline__orderid', false);
$this->db->select('salesorderquoteline.date as salesorderquoteline__date', false);
$this->db->select('salesorderquoteline.notes as salesorderquoteline__notes', false);
$this->db->select('salesorderquoteline.customer_id as salesorderquoteline__customer_id', false);
$this->db->select('salesorderquoteline.currency_id as salesorderquoteline__currency_id', false);
$this->db->select('salesorderquoteline.currencyrate as salesorderquoteline__currencyrate', false);
$this->db->select('salesorderquoteline.warehouse_id as salesorderquoteline__warehouse_id', false);
$this->db->select('salesorderquoteline.status as salesorderquoteline__status', false);
$this->db->select('salesorderquoteline.type as salesorderquoteline__type', false);
$this->db->select('salesorderquoteline.quantity as salesorderquoteline__quantity', false);
$this->db->select('salesorderquoteline.price as salesorderquoteline__price', false);
$this->db->select('salesorderquoteline.pdisc as salesorderquoteline__pdisc', false);
$this->db->select('salesorderquoteline.modulename as salesorderquoteline__modulename', false);
$this->db->select('salesorderquoteline.subtotal as salesorderquoteline__subtotal', false);
$this->db->select('salesorderquoteline.lastupdate as salesorderquoteline__lastupdate', false);
$this->db->select('salesorderquoteline.updatedby as salesorderquoteline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "salesorderquoteline.type like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || salesorderquoteline.quantity like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || salesorderquoteline.price like '%".$_POST['searchtext']."%'";$where .= " || salesorderquoteline.pdisc like '%".$_POST['searchtext']."%'";$where .= " || salesorderquoteline.subtotal like '%".$_POST['searchtext']."%'";$where .= " || salesorderquoteline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salesorderquoteline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('salesorderquoteline__orderid', 'asc');
$this->db->order_by('salesorderquoteline__date', 'desc');
$this->db->order_by('salesorderquoteline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($salesorderquote_id=0)
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
		
		$data['foreign_id'] = $salesorderquote_id;$data['fields'] = array('salesorderquoteline__type' => 'Type', 'item__name' => 'Item', 'salesorderquoteline__quantity' => 'Quantity', 'uom__name' => 'Unit', 'salesorderquoteline__price' => 'Price', 'salesorderquoteline__pdisc' => 'Disc %', 'salesorderquoteline__subtotal' => 'SubTotal', 'salesorderquoteline__lastupdate' => 'Last Update', 'salesorderquoteline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $salesorderquote_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $salesorderquote_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('penawaran_line_list_view', $data);
	}
}

?>