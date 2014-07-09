<?php

class permintaan_stock_linelist extends Controller {

	function permintaan_stock_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $permintaanstock_id)
	{
		
$this->db->where('permintaanstockline.permintaanstock_id', $permintaanstock_id);$this->db->from('permintaanstockline');
$this->db->join('item', 'item.id = permintaanstockline.item_id', 'left');
$this->db->join('uom', 'uom.id = permintaanstockline.uom_id', 'left');
$this->db->where('permintaanstockline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('permintaanstockline.item_id as permintaanstockline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('permintaanstockline.uom_id as permintaanstockline__uom_id', false);
$this->db->select('permintaanstockline.id as id', false);
$this->db->select('permintaanstockline.idstring as permintaanstockline__idstring', false);
$this->db->select('permintaanstockline.date as permintaanstockline__date', false);
$this->db->select('permintaanstockline.notes as permintaanstockline__notes', false);
$this->db->select('permintaanstockline.quantity as permintaanstockline__quantity', false);
$this->db->select('permintaanstockline.lastupdate as permintaanstockline__lastupdate', false);
$this->db->select('permintaanstockline.updatedby as permintaanstockline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || permintaanstockline.quantity like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || permintaanstockline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || permintaanstockline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('permintaanstockline__idstring', 'asc');
$this->db->order_by('permintaanstockline__date', 'desc');
$this->db->order_by('permintaanstockline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($permintaanstock_id=0)
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
		
		$data['foreign_id'] = $permintaanstock_id;$data['fields'] = array('item__name' => 'Item', 'permintaanstockline__quantity' => 'Quantity', 'uom__name' => 'Unit', 'permintaanstockline__lastupdate' => 'Last Update', 'permintaanstockline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $permintaanstock_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $permintaanstock_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('permintaan_stock_line_list_view', $data);
	}
}

?>