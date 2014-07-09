<?php

class purchase_return_orderlist extends Controller {

	function purchase_return_orderlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('purchasereturnorder');
$this->db->join('supplier', 'supplier.id = purchasereturnorder.supplier_id', 'left');
$this->db->join('currency', 'currency.id = purchasereturnorder.currency_id', 'left');
$this->db->where('purchasereturnorder.disabled = 0');
$this->db->select('supplier.firstname as supplier__firstname', false);
$this->db->select('purchasereturnorder.supplier_id as purchasereturnorder__supplier_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('purchasereturnorder.currency_id as purchasereturnorder__currency_id', false);
$this->db->select('purchasereturnorder.id as id', false);
$this->db->select('DATE_FORMAT(purchasereturnorder.date, "%d-%m-%Y") as purchasereturnorder__date', false);
$this->db->select('purchasereturnorder.purchasereturnorderid as purchasereturnorder__purchasereturnorderid', false);
$this->db->select('purchasereturnorder.currencyrate as purchasereturnorder__currencyrate', false);
$this->db->select('purchasereturnorder.notes as purchasereturnorder__notes', false);
$this->db->select('purchasereturnorder.lastupdate as purchasereturnorder__lastupdate', false);
$this->db->select('purchasereturnorder.updatedby as purchasereturnorder__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "purchasereturnorder.date like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnorder.purchasereturnorderid like '%".$_POST['searchtext']."%'";$where .= " || supplier.firstname like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnorder.currencyrate like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnorder.notes like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnorder.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnorder.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('purchasereturnorder__date', 'asc');
$this->db->order_by('purchasereturnorder__date', 'desc');
$this->db->order_by('purchasereturnorder__lastupdate', 'desc');
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
		
		$data['fields'] = array('purchasereturnorder__date' => 'Date', 'purchasereturnorder__purchasereturnorderid' => 'Return ID', 'supplier__firstname' => 'Supplier', 'currency__name' => 'Currency', 'purchasereturnorder__currencyrate' => 'Currency Rate', 'purchasereturnorder__notes' => 'Notes', 'purchasereturnorder__lastupdate' => 'Last Update', 'purchasereturnorder__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('purchase_return_order_list_view', $data);
	}
}

?>