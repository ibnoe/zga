<?php

class stock_adjustment_linelist extends Controller {

	function stock_adjustment_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $stockadjustment_id)
	{
		
$this->db->where('stockadjustmentline.stockadjustment_id', $stockadjustment_id);$this->db->from('stockadjustmentline');
$this->db->join('coa', 'coa.id = stockadjustmentline.coa_id', 'left');
$this->db->join('item', 'item.id = stockadjustmentline.item_id', 'left');
$this->db->join('uom', 'uom.id = stockadjustmentline.uom_id', 'left');
$this->db->where('stockadjustmentline.disabled = 0');
$this->db->select('coa.name as coa__name', false);
$this->db->select('stockadjustmentline.coa_id as stockadjustmentline__coa_id', false);
$this->db->select('item.name as item__name', false);
$this->db->select('stockadjustmentline.item_id as stockadjustmentline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('stockadjustmentline.uom_id as stockadjustmentline__uom_id', false);
$this->db->select('stockadjustmentline.id as id', false);
$this->db->select('stockadjustmentline.idstring as stockadjustmentline__idstring', false);
$this->db->select('stockadjustmentline.date as stockadjustmentline__date', false);
$this->db->select('stockadjustmentline.notes as stockadjustmentline__notes', false);
$this->db->select('stockadjustmentline.warehouse_id as stockadjustmentline__warehouse_id', false);
$this->db->select('stockadjustmentline.quantity as stockadjustmentline__quantity', false);
$this->db->select('stockadjustmentline.lastupdate as stockadjustmentline__lastupdate', false);
$this->db->select('stockadjustmentline.updatedby as stockadjustmentline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "coa.name like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || stockadjustmentline.quantity like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || stockadjustmentline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || stockadjustmentline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('stockadjustmentline__idstring', 'asc');
$this->db->order_by('stockadjustmentline__date', 'desc');
$this->db->order_by('stockadjustmentline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($stockadjustment_id=0)
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
		
		$data['foreign_id'] = $stockadjustment_id;$data['fields'] = array('coa__name' => 'Account', 'item__name' => 'Item', 'stockadjustmentline__quantity' => 'Quantity', 'uom__name' => 'Unit', 'stockadjustmentline__lastupdate' => 'Last Update', 'stockadjustmentline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $stockadjustment_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $stockadjustment_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('stock_adjustment_line_list_view', $data);
	}
}

?>