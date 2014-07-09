<?php

class productionrequestorderlist extends Controller {

	function productionrequestorderlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('productionrequestorder');
$this->db->join('customer', 'customer.id = productionrequestorder.customer_id', 'left');
$this->db->where('productionrequestorder.disabled = 0');
$this->db->select('customer.idstring as customer__idstring', false);
$this->db->select('productionrequestorder.customer_id as productionrequestorder__customer_id', false);
$this->db->select('productionrequestorder.id as id', false);
$this->db->select('productionrequestorder.idstring as productionrequestorder__idstring', false);
$this->db->select('productionrequestorder.idstring as productionrequestorder__idstring', false);
$this->db->select('productionrequestorder.lastupdate as productionrequestorder__lastupdate', false);
$this->db->select('productionrequestorder.updatedby as productionrequestorder__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "productionrequestorder.idstring like '%".$_POST['searchtext']."%'";$where .= " || customer.idstring like '%".$_POST['searchtext']."%'";$where .= " || productionrequestorder.idstring like '%".$_POST['searchtext']."%'";$where .= " || productionrequestorder.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || productionrequestorder.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('productionrequestorder__idstring', 'asc');
$this->db->order_by('productionrequestorder__lastupdate', 'desc');
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
		
		$data['fields'] = array('productionrequestorder__idstring' => 'Order No', 'customer__idstring' => 'Customer', 'productionrequestorder__idstring' => 'Order No', 'productionrequestorder__lastupdate' => 'Last Update', 'productionrequestorder__updatedby' => 'Last Update By');
		
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
		$this->load->view('productionrequestorder_list_view', $data);
	}
}

?>