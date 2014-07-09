<?php

class spp_linelist extends Controller {

	function spp_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $suratpermintaanpembelian_id)
	{
		
$this->db->where('suratpermintaanpembelianline.suratpermintaanpembelian_id', $suratpermintaanpembelian_id);$this->db->from('suratpermintaanpembelianline');
$this->db->join('item', 'item.id = suratpermintaanpembelianline.item_id', 'left');
$this->db->join('uom', 'uom.id = suratpermintaanpembelianline.uom_id', 'left');
$this->db->where('suratpermintaanpembelianline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('suratpermintaanpembelianline.item_id as suratpermintaanpembelianline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('suratpermintaanpembelianline.uom_id as suratpermintaanpembelianline__uom_id', false);
$this->db->select('suratpermintaanpembelianline.id as id', false);
$this->db->select('suratpermintaanpembelianline.orderid as suratpermintaanpembelianline__orderid', false);
$this->db->select('suratpermintaanpembelianline.date as suratpermintaanpembelianline__date', false);
$this->db->select('suratpermintaanpembelianline.notes as suratpermintaanpembelianline__notes', false);
$this->db->select('suratpermintaanpembelianline.quantity as suratpermintaanpembelianline__quantity', false);
$this->db->select('suratpermintaanpembelianline.lastupdate as suratpermintaanpembelianline__lastupdate', false);
$this->db->select('suratpermintaanpembelianline.updatedby as suratpermintaanpembelianline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || suratpermintaanpembelianline.quantity like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || suratpermintaanpembelianline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || suratpermintaanpembelianline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('suratpermintaanpembelianline__orderid', 'asc');
$this->db->order_by('suratpermintaanpembelianline__date', 'desc');
$this->db->order_by('suratpermintaanpembelianline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($suratpermintaanpembelian_id=0)
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
		
		$data['foreign_id'] = $suratpermintaanpembelian_id;$data['fields'] = array('item__name' => 'Item', 'suratpermintaanpembelianline__quantity' => 'Quantity', 'uom__name' => 'Unit', 'suratpermintaanpembelianline__lastupdate' => 'Last Update', 'suratpermintaanpembelianline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $suratpermintaanpembelian_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $suratpermintaanpembelian_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('spp_line_list_view', $data);
	}
}

?>