<?php

class purchase_return_payment_line_viewlist extends Controller {

	function purchase_return_payment_line_viewlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('purchasereturnpaymentline');
$this->db->join('purchasereturninvoice', 'purchasereturninvoice.id = purchasereturnpaymentline.purchasereturninvoice_id', 'left');
$this->db->where('purchasereturnpaymentline.disabled = 0');
$this->db->select('purchasereturninvoice.purchasereturninvoiceid as purchasereturninvoice__purchasereturninvoiceid', false);
$this->db->select('purchasereturnpaymentline.purchasereturninvoice_id as purchasereturnpaymentline__purchasereturninvoice_id', false);
$this->db->select('purchasereturnpaymentline.id as id', false);
$this->db->select('purchasereturnpaymentline.lastupdate as purchasereturnpaymentline__lastupdate', false);
$this->db->select('purchasereturnpaymentline.updatedby as purchasereturnpaymentline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "purchasereturninvoice.purchasereturninvoiceid like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnpaymentline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnpaymentline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('purchasereturnpaymentline__purchasereturninvoice_id', 'asc');
$this->db->order_by('purchasereturnpaymentline__lastupdate', 'desc');
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
		
		$data['fields'] = array('purchasereturninvoice__purchasereturninvoiceid' => 'Purchase Return Invoice', 'purchasereturnpaymentline__lastupdate' => 'Last Update', 'purchasereturnpaymentline__updatedby' => 'Last Update By');
		
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
		$this->load->view('purchase_return_payment_line_view_list_view', $data);
	}
}

?>