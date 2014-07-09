<?php

class price_listlist extends Controller {

	function price_listlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $customer_id)
	{
		
$this->db->where('pricelist.customer_id', $customer_id);$this->db->from('pricelist');
$this->db->where('pricelist.disabled = 0');
$this->db->select('pricelist.id as id', false);
$this->db->select('pricelist.idstring as pricelist__idstring', false);
$this->db->select('pricelist.name as pricelist__name', false);
$this->db->select('pricelist.lastupdate as pricelist__lastupdate', false);
$this->db->select('pricelist.updatedby as pricelist__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "pricelist.idstring like '%".$_POST['searchtext']."%'";$where .= " || pricelist.name like '%".$_POST['searchtext']."%'";$where .= " || pricelist.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || pricelist.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('pricelist__idstring', 'asc');
$this->db->order_by('pricelist__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($customer_id=0)
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
		
		$data['foreign_id'] = $customer_id;$data['fields'] = array('pricelist__idstring' => 'Pricelist ID', 'pricelist__name' => 'Pricelist Name', 'pricelist__lastupdate' => 'Last Update', 'pricelist__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $customer_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $customer_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('price_list_list_view', $data);
	}
}

?>