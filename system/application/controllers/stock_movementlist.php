<?php

class stock_movementlist extends Controller {

	function stock_movementlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('moveaction');
$this->db->join('warehouse', 'warehouse.id = moveaction.from_warehouse_id', 'left');
$this->db->join('warehouse as warehouse1', 'warehouse1.id = moveaction.to_warehouse_id', 'left');
$this->db->where('moveaction.disabled = 0');
$this->db->select('warehouse.name as warehouse__name', false);
$this->db->select('moveaction.from_warehouse_id as moveaction__from_warehouse_id', false);
$this->db->select('warehouse1.name as warehouse1__name', false);
$this->db->select('moveaction.to_warehouse_id as moveaction__to_warehouse_id', false);
$this->db->select('moveaction.id as id', false);
$this->db->select('DATE_FORMAT(moveaction.date, "%d-%m-%Y") as moveaction__date', false);
$this->db->select('moveaction.orderid as moveaction__orderid', false);
$this->db->select('moveaction.lastupdate as moveaction__lastupdate', false);
$this->db->select('moveaction.updatedby as moveaction__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "moveaction.date like '%".$_POST['searchtext']."%'";$where .= " || moveaction.orderid like '%".$_POST['searchtext']."%'";$where .= " || warehouse.name like '%".$_POST['searchtext']."%'";$where .= " || warehouse1.name like '%".$_POST['searchtext']."%'";$where .= " || moveaction.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || moveaction.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('moveaction__date', 'asc');
$this->db->order_by('moveaction__date', 'desc');
$this->db->order_by('moveaction__lastupdate', 'desc');
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
		
		$data['fields'] = array('moveaction__date' => 'Date', 'moveaction__orderid' => 'ID', 'warehouse__name' => 'From Warehouse', 'warehouse1__name' => 'To Warehouse', 'moveaction__lastupdate' => 'Last Update', 'moveaction__updatedby' => 'Last Update By');
		
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
		$this->load->view('stock_movement_list_view', $data);
	}
}

?>