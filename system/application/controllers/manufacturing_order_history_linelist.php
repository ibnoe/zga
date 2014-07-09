<?php

class manufacturing_order_history_linelist extends Controller {

	function manufacturing_order_history_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $manufacturingorderdone_id)
	{
		
$this->db->where('manufacturingorderdoneline.manufacturingorderdone_id', $manufacturingorderdone_id);$this->db->from('manufacturingorderdoneline');
$this->db->join('item', 'item.id = manufacturingorderdoneline.item_id', 'left');
$this->db->join('uom', 'uom.id = manufacturingorderdoneline.uom_id', 'left');
$this->db->where('manufacturingorderdoneline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('manufacturingorderdoneline.item_id as manufacturingorderdoneline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('manufacturingorderdoneline.uom_id as manufacturingorderdoneline__uom_id', false);
$this->db->select('manufacturingorderdoneline.id as id', false);
$this->db->select('manufacturingorderdoneline.idstring as manufacturingorderdoneline__idstring', false);
$this->db->select('manufacturingorderdoneline.date as manufacturingorderdoneline__date', false);
$this->db->select('manufacturingorderdoneline.quantitytoprocess as manufacturingorderdoneline__quantitytoprocess', false);
$this->db->select('manufacturingorderdoneline.manufacturingorder_id as manufacturingorderdoneline__manufacturingorder_id', false);
$this->db->select('manufacturingorderdoneline.lastupdate as manufacturingorderdoneline__lastupdate', false);
$this->db->select('manufacturingorderdoneline.updatedby as manufacturingorderdoneline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorderdoneline.quantitytoprocess like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorderdoneline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorderdoneline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('manufacturingorderdoneline__idstring', 'asc');
$this->db->order_by('manufacturingorderdoneline__date', 'desc');
$this->db->order_by('manufacturingorderdoneline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($manufacturingorderdone_id=0)
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
		
		$data['foreign_id'] = $manufacturingorderdone_id;$data['fields'] = array('item__name' => 'Item', 'manufacturingorderdoneline__quantitytoprocess' => 'Quantity', 'uom__name' => 'Unit', 'manufacturingorderdoneline__lastupdate' => 'Last Update', 'manufacturingorderdoneline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $manufacturingorderdone_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $manufacturingorderdone_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('manufacturing_order_history_line_list_view', $data);
	}
}

?>