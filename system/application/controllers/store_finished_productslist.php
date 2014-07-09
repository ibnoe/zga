<?php

class store_finished_productslist extends Controller {

	function store_finished_productslist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('morder');
$this->db->join('contact', 'morder.contact_id = contact.id', 'left');

$this->db->join('contact', 'morder.contact_id = contact.id', 'left');

$this->db->join('contact', 'morder.contact_id = contact.id', 'left');

$this->db->join('contact', 'morder.contact_id = contact.id', 'left');

$this->db->select('morder.orderid as morder__orderid');
$this->db->select('morder.date as morder__date');
$this->db->select('morder.notes as morder__notes');
$this->db->select('contact.firstname as contact__firstname');
$this->db->select('contact.firstname as contact__firstname');
$this->db->select('morder.orderid as morder__orderid');
$this->db->select('morder.date as morder__date');
$this->db->select('morder.notes as morder__notes');
$this->db->select('contact.firstname as contact__firstname');
$this->db->select('contact.firstname as contact__firstname');
$this->db->select('morder. as morder__');
$this->db->select('morder.id as id');
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "morder.orderid like '%".$_POST['searchtext']."%'";$where .= " || morder.date like '%".$_POST['searchtext']."%'";$where .= " || morder.notes like '%".$_POST['searchtext']."%'";$where .= " || contact.firstname like '%".$_POST['searchtext']."%'";$where .= " || contact.firstname like '%".$_POST['searchtext']."%'";$where .= " || morder.orderid like '%".$_POST['searchtext']."%'";$where .= " || morder.date like '%".$_POST['searchtext']."%'";$where .= " || morder.notes like '%".$_POST['searchtext']."%'";$where .= " || contact.firstname like '%".$_POST['searchtext']."%'";$where .= " || contact.firstname like '%".$_POST['searchtext']."%'";$where .= " || morder. like '%".$_POST['searchtext']."%'";
			
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
		
		$data['fields'] = array('morder__orderid' => 'Order ID', 'morder__date' => 'Date', 'morder__notes' => 'Description', 'contact__firstname' => 'From Location', 'contact__firstname' => 'To Location', 'morder__orderid' => 'Order ID', 'morder__date' => 'Date', 'morder__notes' => 'Description', 'contact__firstname' => 'From Location', 'contact__firstname' => 'To Location', 'morder__' => 'Details');
		
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
		$this->load->view('store_finished_products_list_view', $data);
	}
}

?>