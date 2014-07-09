<?php

class purchase_payment_line_viewlist extends Controller {

	function purchase_payment_line_viewlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('purchasepaymentline');
$this->db->join('purchaseinvoice', 'purchaseinvoice.id = purchasepaymentline.purchaseinvoice_id', 'left');
$this->db->where('purchasepaymentline.disabled = 0');
$this->db->select('purchaseinvoice.orderid as purchaseinvoice__orderid', false);
$this->db->select('purchasepaymentline.purchaseinvoice_id as purchasepaymentline__purchaseinvoice_id', false);
$this->db->select('purchasepaymentline.id as id', false);
$this->db->select('purchasepaymentline.lastupdate as purchasepaymentline__lastupdate', false);
$this->db->select('purchasepaymentline.updatedby as purchasepaymentline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "purchaseinvoice.orderid like '%".$_POST['searchtext']."%'";$where .= " || purchasepaymentline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || purchasepaymentline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('purchasepaymentline__purchaseinvoice_id', 'asc');
$this->db->order_by('purchasepaymentline__lastupdate', 'desc');
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
		
		$data['fields'] = array('purchaseinvoice__orderid' => 'Purchase Invoice', 'purchasepaymentline__lastupdate' => 'Last Update', 'purchasepaymentline__updatedby' => 'Last Update By');
		
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
		$this->load->view('purchase_payment_line_view_list_view', $data);
	}
}

?>