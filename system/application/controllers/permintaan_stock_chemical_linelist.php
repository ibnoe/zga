<?php

class permintaan_stock_chemical_linelist extends Controller {

	function permintaan_stock_chemical_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $permintaanstockchemical_id)
	{
		
$this->db->where('permintaanstockchemicalline.permintaanstockchemical_id', $permintaanstockchemical_id);$this->db->from('permintaanstockchemicalline');
$this->db->join('item', 'item.id = permintaanstockchemicalline.item_id', 'left');
$this->db->join('uom', 'uom.id = permintaanstockchemicalline.uom_id', 'left');
$this->db->where('permintaanstockchemicalline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('permintaanstockchemicalline.item_id as permintaanstockchemicalline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('permintaanstockchemicalline.uom_id as permintaanstockchemicalline__uom_id', false);
$this->db->select('permintaanstockchemicalline.id as id', false);
$this->db->select('permintaanstockchemicalline.idstring as permintaanstockchemicalline__idstring', false);
$this->db->select('permintaanstockchemicalline.date as permintaanstockchemicalline__date', false);
$this->db->select('permintaanstockchemicalline.notes as permintaanstockchemicalline__notes', false);
$this->db->select('permintaanstockchemicalline.quantity as permintaanstockchemicalline__quantity', false);
$this->db->select('permintaanstockchemicalline.lastupdate as permintaanstockchemicalline__lastupdate', false);
$this->db->select('permintaanstockchemicalline.updatedby as permintaanstockchemicalline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || permintaanstockchemicalline.quantity like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || permintaanstockchemicalline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || permintaanstockchemicalline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('permintaanstockchemicalline__idstring', 'asc');
$this->db->order_by('permintaanstockchemicalline__date', 'desc');
$this->db->order_by('permintaanstockchemicalline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($permintaanstockchemical_id=0)
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
		
		$data['foreign_id'] = $permintaanstockchemical_id;$data['fields'] = array('item__name' => 'Item', 'permintaanstockchemicalline__quantity' => 'Quantity', 'uom__name' => 'Unit', 'permintaanstockchemicalline__lastupdate' => 'Last Update', 'permintaanstockchemicalline__updatedby' => 'Last Update By');
		
		$data = $this->_qhelp($data, $permintaanstockchemical_id);
		
		
		
		$q = $this->db->get();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $permintaanstockchemical_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		///
		$this->load->view('permintaan_stock_chemical_line_list_view', $data);
	}
}

?>