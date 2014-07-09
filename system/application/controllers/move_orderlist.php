<?php

class move_orderlist extends Controller {

	function move_orderlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('moveorder');
$this->db->join('warehouse', 'warehouse.id = moveorder.from_warehouse_id', 'left');
$this->db->join('warehouse as warehouse1', 'warehouse1.id = moveorder.to_warehouse_id', 'left');
$this->db->where('moveorder.disabled = 0');
$this->db->select('warehouse.name as warehouse__name', false);
$this->db->select('moveorder.from_warehouse_id as moveorder__from_warehouse_id', false);
$this->db->select('warehouse1.name as warehouse1__name', false);
$this->db->select('moveorder.to_warehouse_id as moveorder__to_warehouse_id', false);
$this->db->select('moveorder.id as id', false);
$this->db->select('moveorder.orderid as moveorder__orderid', false);
$this->db->select('DATE_FORMAT(moveorder.date, "%d-%m-%Y") as moveorder__date', false);
$this->db->select('moveorder.notes as moveorder__notes', false);
$this->db->select('moveorder.lastupdate as moveorder__lastupdate', false);
$this->db->select('moveorder.updatedby as moveorder__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "moveorder.orderid like '%".$_POST['searchtext']."%'";$where .= " || moveorder.date like '%".$_POST['searchtext']."%'";$where .= " || warehouse.name like '%".$_POST['searchtext']."%'";$where .= " || warehouse1.name like '%".$_POST['searchtext']."%'";$where .= " || moveorder.notes like '%".$_POST['searchtext']."%'";$where .= " || moveorder.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || moveorder.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('moveorder__orderid', 'asc');
$this->db->order_by('moveorder__date', 'desc');
$this->db->order_by('moveorder__lastupdate', 'desc');
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
		
		$data['fields'] = array('moveorder__orderid' => 'ID', 'moveorder__date' => 'Date', 'warehouse__name' => 'From Location', 'warehouse1__name' => 'To Location', 'moveorder__notes' => 'Notes', 'moveorder__lastupdate' => 'Last Update', 'moveorder__updatedby' => 'Last Update By');
		
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
		$this->load->view('move_order_list_view', $data);
	}
}

?>