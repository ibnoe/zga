<?php

class sales_returnlist extends Controller {

	function sales_returnlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('sreturn');
$this->db->join('sorder', 'sreturn.sorder_id = sorder.id', 'left');

$this->db->join('contact', 'sreturn.contact_id = contact.id', 'left');

$this->db->join('sorder', 'sreturn.sorder_id = sorder.id', 'left');

$this->db->join('contact', 'sreturn.contact_id = contact.id', 'left');

$this->db->select('sreturn.orderid as sreturn__orderid');
$this->db->select('sreturn.date as sreturn__date');
$this->db->select('sorder.orderid as sorder__orderid');
$this->db->select('contact.firstname as contact__firstname');
$this->db->select('sreturn.orderid as sreturn__orderid');
$this->db->select('sreturn.date as sreturn__date');
$this->db->select('sorder.orderid as sorder__orderid');
$this->db->select('contact.firstname as contact__firstname');
$this->db->select('sreturn. as sreturn__');
$this->db->select('sreturn.id as id');
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "sreturn.orderid like '%".$_POST['searchtext']."%'";$where .= " || sreturn.date like '%".$_POST['searchtext']."%'";$where .= " || sorder.orderid like '%".$_POST['searchtext']."%'";$where .= " || contact.firstname like '%".$_POST['searchtext']."%'";$where .= " || sreturn.orderid like '%".$_POST['searchtext']."%'";$where .= " || sreturn.date like '%".$_POST['searchtext']."%'";$where .= " || sorder.orderid like '%".$_POST['searchtext']."%'";$where .= " || contact.firstname like '%".$_POST['searchtext']."%'";$where .= " || sreturn. like '%".$_POST['searchtext']."%'";
			
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
		
		$data['fields'] = array('sreturn__orderid' => 'Order ID', 'sreturn__date' => 'Date', 'sorder__orderid' => 'Sales Order', 'contact__firstname' => 'Return To Location', 'sreturn__orderid' => 'Order ID', 'sreturn__date' => 'Date', 'sorder__orderid' => 'Sales Order', 'contact__firstname' => 'Return To Location', 'sreturn__' => 'Details');
		
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
		$this->load->view('sales_return_list_view', $data);
	}
}

?>