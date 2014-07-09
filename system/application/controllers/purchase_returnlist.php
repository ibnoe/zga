<?php

class purchase_returnlist extends Controller {

	function purchase_returnlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('preturn');
$this->db->join('porder', 'preturn.porder_id = porder.id', 'left');

$this->db->join('contact', 'preturn.contact_id = contact.id', 'left');

$this->db->join('porder', 'preturn.porder_id = porder.id', 'left');

$this->db->join('contact', 'preturn.contact_id = contact.id', 'left');

$this->db->select('preturn.orderid as preturn__orderid');
$this->db->select('preturn.date as preturn__date');
$this->db->select('porder.orderid as porder__orderid');
$this->db->select('contact.firstname as contact__firstname');
$this->db->select('preturn.orderid as preturn__orderid');
$this->db->select('preturn.date as preturn__date');
$this->db->select('porder.orderid as porder__orderid');
$this->db->select('contact.firstname as contact__firstname');
$this->db->select('preturn. as preturn__');
$this->db->select('preturn.id as id');
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "preturn.orderid like '%".$_POST['searchtext']."%'";$where .= " || preturn.date like '%".$_POST['searchtext']."%'";$where .= " || porder.orderid like '%".$_POST['searchtext']."%'";$where .= " || contact.firstname like '%".$_POST['searchtext']."%'";$where .= " || preturn.orderid like '%".$_POST['searchtext']."%'";$where .= " || preturn.date like '%".$_POST['searchtext']."%'";$where .= " || porder.orderid like '%".$_POST['searchtext']."%'";$where .= " || contact.firstname like '%".$_POST['searchtext']."%'";$where .= " || preturn. like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
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
		
		$data['fields'] = array('preturn__orderid' => 'Order ID', 'preturn__date' => 'Date', 'porder__orderid' => 'Purchase Order', 'contact__firstname' => 'Return To Location', 'preturn__orderid' => 'Order ID', 'preturn__date' => 'Date', 'porder__orderid' => 'Purchase Order', 'contact__firstname' => 'Return To Location', 'preturn__' => 'Details');
		
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
		$this->load->view('purchase_return_list_view', $data);
	}
}

?>