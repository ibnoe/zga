<?php

class stock_adjustmentlist extends Controller {

	function stock_adjustmentlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('stockadjustment');
$this->db->join('warehouse', 'warehouse.id = stockadjustment.warehouse_id', 'left');
$this->db->where('stockadjustment.disabled = 0');
$this->db->select('warehouse.name as warehouse__name', false);
$this->db->select('stockadjustment.warehouse_id as stockadjustment__warehouse_id', false);
$this->db->select('stockadjustment.id as id', false);
$this->db->select('stockadjustment.idstring as stockadjustment__idstring', false);
$this->db->select('DATE_FORMAT(stockadjustment.date, "%d-%m-%Y") as stockadjustment__date', false);
$this->db->select('stockadjustment.notes as stockadjustment__notes', false);
$this->db->select('stockadjustment.lastupdate as stockadjustment__lastupdate', false);
$this->db->select('stockadjustment.updatedby as stockadjustment__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "stockadjustment.idstring like '%".$_POST['searchtext']."%'";$where .= " || stockadjustment.date like '%".$_POST['searchtext']."%'";$where .= " || stockadjustment.notes like '%".$_POST['searchtext']."%'";$where .= " || warehouse.name like '%".$_POST['searchtext']."%'";$where .= " || stockadjustment.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || stockadjustment.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('stockadjustment__idstring', 'asc');
$this->db->order_by('stockadjustment__date', 'desc');
$this->db->order_by('stockadjustment__lastupdate', 'desc');
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
		
		$data['fields'] = array('stockadjustment__idstring' => 'ID', 'stockadjustment__date' => 'Date', 'stockadjustment__notes' => 'Description', 'warehouse__name' => 'Location', 'stockadjustment__lastupdate' => 'Last Update', 'stockadjustment__updatedby' => 'Last Update By');
		
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
		$this->load->view('stock_adjustment_list_view', $data);
	}
}

?>