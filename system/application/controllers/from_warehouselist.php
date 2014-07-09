<?php

class from_warehouselist extends Controller {

	function from_warehouselist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('warehouse');
$this->db->where('warehouse.disabled = 0');
$this->db->select('warehouse.id as id', false);
$this->db->select('warehouse.name as warehouse__name', false);
$this->db->select('warehouse.address as warehouse__address', false);
$this->db->select('warehouse.phone as warehouse__phone', false);
$this->db->select('warehouse.fax as warehouse__fax', false);
$this->db->select('warehouse.lastupdate as warehouse__lastupdate', false);
$this->db->select('warehouse.updatedby as warehouse__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "warehouse.name like '%".$_POST['searchtext']."%'";$where .= " || warehouse.address like '%".$_POST['searchtext']."%'";$where .= " || warehouse.phone like '%".$_POST['searchtext']."%'";$where .= " || warehouse.fax like '%".$_POST['searchtext']."%'";$where .= " || warehouse.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || warehouse.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('warehouse__name', 'asc');
$this->db->order_by('warehouse__lastupdate', 'desc');
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
		
		$data['fields'] = array('warehouse__name' => 'Name', 'warehouse__address' => 'Address', 'warehouse__phone' => 'Phone', 'warehouse__fax' => 'Fax', 'warehouse__lastupdate' => 'Last Update', 'warehouse__updatedby' => 'Last Update By');
		
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
		$this->load->view('from_warehouse_list_view', $data);
	}
}

?>