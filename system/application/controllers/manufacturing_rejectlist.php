<?php

class manufacturing_rejectlist extends Controller {

	function manufacturing_rejectlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('manufacturingreject');
$this->db->join('item', 'item.id = manufacturingreject.item_id', 'left');
$this->db->join('warehouse', 'warehouse.id = manufacturingreject.warehouse_id', 'left');
$this->db->join('uom', 'uom.id = manufacturingreject.uom_id', 'left');
$this->db->where('manufacturingreject.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('manufacturingreject.item_id as manufacturingreject__item_id', false);
$this->db->select('warehouse.name as warehouse__name', false);
$this->db->select('manufacturingreject.warehouse_id as manufacturingreject__warehouse_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('manufacturingreject.uom_id as manufacturingreject__uom_id', false);
$this->db->select('manufacturingreject.id as id', false);
$this->db->select('manufacturingreject.idstring as manufacturingreject__idstring', false);
$this->db->select('DATE_FORMAT(manufacturingreject.date, "%d-%m-%Y") as manufacturingreject__date', false);
$this->db->select('manufacturingreject.quantity as manufacturingreject__quantity', false);
$this->db->select('manufacturingreject.lastupdate as manufacturingreject__lastupdate', false);
$this->db->select('manufacturingreject.updatedby as manufacturingreject__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "manufacturingreject.idstring like '%".$_POST['searchtext']."%'";$where .= " || manufacturingreject.date like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || warehouse.name like '%".$_POST['searchtext']."%'";$where .= " || manufacturingreject.quantity like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || manufacturingreject.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || manufacturingreject.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('manufacturingreject__idstring', 'asc');
$this->db->order_by('manufacturingreject__date', 'desc');
$this->db->order_by('manufacturingreject__lastupdate', 'desc');
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
		
		$data['fields'] = array('manufacturingreject__idstring' => 'ID', 'manufacturingreject__date' => 'Date', 'item__name' => 'Item', 'warehouse__name' => 'Goods Location', 'manufacturingreject__quantity' => 'Quantity', 'uom__name' => 'Unit', 'manufacturingreject__lastupdate' => 'Last Update', 'manufacturingreject__updatedby' => 'Last Update By');
		
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
		$this->load->view('manufacturing_reject_list_view', $data);
	}
}

?>