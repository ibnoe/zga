<?php

class locationlist extends Controller {

	function locationlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('contact');
$this->db->select('contact.firstname as contact__firstname');
$this->db->select('contact.address as contact__address');
$this->db->select('contact.phone as contact__phone');
$this->db->select('contact.fax as contact__fax');
$this->db->select('contact.email as contact__email');
$this->db->select('contact.iscustomer as contact__iscustomer');
$this->db->select('contact.issupplier as contact__issupplier');
$this->db->select('contact.iswarehouse as contact__iswarehouse');
$this->db->select('contact.id as id');
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "contact.firstname like '%".$_POST['searchtext']."%'";$where .= " || contact.address like '%".$_POST['searchtext']."%'";$where .= " || contact.phone like '%".$_POST['searchtext']."%'";$where .= " || contact.fax like '%".$_POST['searchtext']."%'";$where .= " || contact.email like '%".$_POST['searchtext']."%'";$where .= " || contact.iscustomer like '%".$_POST['searchtext']."%'";$where .= " || contact.issupplier like '%".$_POST['searchtext']."%'";$where .= " || contact.iswarehouse like '%".$_POST['searchtext']."%'";
			
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
		
		$data['fields'] = array('contact__firstname' => 'Name', 'contact__address' => 'Address', 'contact__phone' => 'Phone', 'contact__fax' => 'Fax', 'contact__email' => 'Email', 'contact__iscustomer' => 'Is Customer?', 'contact__issupplier' => 'Is Supplier?', 'contact__iswarehouse' => 'Is Warehouse?');
		
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
		$this->load->view('location_list_view', $data);
	}
}

?>