<?php

class move_order_between_warehouselist extends Controller {

	function move_order_between_warehouselist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('porder');
$this->db->join('contact', 'porder.contact_id = contact.id', 'left');

$this->db->join('contact', 'porder.contact_id = contact.id', 'left');

$this->db->join('contact', 'porder.contact_id = contact.id', 'left');

$this->db->join('contact', 'porder.contact_id = contact.id', 'left');

$this->db->select('porder.orderid as porder__orderid');
$this->db->select('porder.date as porder__date');
$this->db->select('porder.notes as porder__notes');
$this->db->select('contact.firstname as contact__firstname');
$this->db->select('contact.firstname as contact__firstname');
$this->db->select('porder.orderid as porder__orderid');
$this->db->select('porder.date as porder__date');
$this->db->select('porder.notes as porder__notes');
$this->db->select('contact.firstname as contact__firstname');
$this->db->select('contact.firstname as contact__firstname');
$this->db->select('porder. as porder__');
$this->db->select('porder.id as id');
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "porder.orderid like '%".$_POST['searchtext']."%'";$where .= " || porder.date like '%".$_POST['searchtext']."%'";$where .= " || porder.notes like '%".$_POST['searchtext']."%'";$where .= " || contact.firstname like '%".$_POST['searchtext']."%'";$where .= " || contact.firstname like '%".$_POST['searchtext']."%'";$where .= " || porder.orderid like '%".$_POST['searchtext']."%'";$where .= " || porder.date like '%".$_POST['searchtext']."%'";$where .= " || porder.notes like '%".$_POST['searchtext']."%'";$where .= " || contact.firstname like '%".$_POST['searchtext']."%'";$where .= " || contact.firstname like '%".$_POST['searchtext']."%'";$where .= " || porder. like '%".$_POST['searchtext']."%'";
			
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
		
		$data['fields'] = array('porder__orderid' => 'Order ID', 'porder__date' => 'Date', 'porder__notes' => 'Description', 'contact__firstname' => 'From Location', 'contact__firstname' => 'To Location', 'porder__orderid' => 'Order ID', 'porder__date' => 'Date', 'porder__notes' => 'Description', 'contact__firstname' => 'From Location', 'contact__firstname' => 'To Location', 'porder__' => 'Details');
		
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
		$this->load->view('move_order_between_warehouse_list_view', $data);
	}
}

?>