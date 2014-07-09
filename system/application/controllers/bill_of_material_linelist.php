<?php

class bill_of_material_linelist extends Controller {

	function bill_of_material_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $bom_id)
	{
		
$this->db->where('bomline.bom_id', $bom_id);$this->db->from('bomline');
$this->db->join('item', 'item.id = bomline.item_id', 'left');
$this->db->join('uom', 'uom.id = bomline.uom_id', 'left');
$this->db->where('bomline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('bomline.item_id as bomline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('bomline.uom_id as bomline__uom_id', false);
$this->db->select('bomline.id as id', false);
$this->db->select('bomline.quantity as bomline__quantity', false);
$this->db->select('bomline.lastupdate as bomline__lastupdate', false);
$this->db->select('bomline.updatedby as bomline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || bomline.quantity like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || bomline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || bomline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('bomline__item_id', 'asc');
$this->db->order_by('bomline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($bom_id=0)
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
		
		$data['foreign_id'] = $bom_id;$data['fields'] = array('item__name' => 'Item', 'bomline__quantity' => 'Quantity', 'uom__name' => 'Unit', 'bomline__lastupdate' => 'Last Update', 'bomline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $bom_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $bom_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('bill_of_material_line_list_view', $data);
	}
}

?>