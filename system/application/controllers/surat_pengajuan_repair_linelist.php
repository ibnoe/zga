<?php

class surat_pengajuan_repair_linelist extends Controller {

	function surat_pengajuan_repair_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $suratpengajuanrepair_id)
	{
		
$this->db->where('suratpengajuanrepairline.suratpengajuanrepair_id', $suratpengajuanrepair_id);$this->db->from('suratpengajuanrepairline');
$this->db->join('item', 'item.id = suratpengajuanrepairline.item_id', 'left');
$this->db->join('customer', 'customer.id = suratpengajuanrepairline.customer_id', 'left');
$this->db->join('mesin', 'mesin.id = suratpengajuanrepairline.mesin_id', 'left');
$this->db->where('suratpengajuanrepairline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('suratpengajuanrepairline.item_id as suratpengajuanrepairline__item_id', false);
$this->db->select('customer.idstring as customer__idstring', false);
$this->db->select('suratpengajuanrepairline.customer_id as suratpengajuanrepairline__customer_id', false);
$this->db->select('mesin.typename as mesin__typename', false);
$this->db->select('suratpengajuanrepairline.mesin_id as suratpengajuanrepairline__mesin_id', false);
$this->db->select('suratpengajuanrepairline.id as id', false);
$this->db->select('suratpengajuanrepairline.nodiss as suratpengajuanrepairline__nodiss', false);
$this->db->select('suratpengajuanrepairline.tipecore as suratpengajuanrepairline__tipecore', false);
$this->db->select('suratpengajuanrepairline.rolldiameter as suratpengajuanrepairline__rolldiameter', false);
$this->db->select('suratpengajuanrepairline.bearingseatdiameter as suratpengajuanrepairline__bearingseatdiameter', false);
$this->db->select('suratpengajuanrepairline.totallength as suratpengajuanrepairline__totallength', false);
$this->db->select('suratpengajuanrepairline.quantity as suratpengajuanrepairline__quantity', false);
$this->db->select('suratpengajuanrepairline.jenisrepair as suratpengajuanrepairline__jenisrepair', false);
$this->db->select('suratpengajuanrepairline.notes as suratpengajuanrepairline__notes', false);
$this->db->select('suratpengajuanrepairline.lastupdate as suratpengajuanrepairline__lastupdate', false);
$this->db->select('suratpengajuanrepairline.updatedby as suratpengajuanrepairline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "suratpengajuanrepairline.nodiss like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || customer.idstring like '%".$_POST['searchtext']."%'";$where .= " || mesin.typename like '%".$_POST['searchtext']."%'";$where .= " || suratpengajuanrepairline.tipecore like '%".$_POST['searchtext']."%'";$where .= " || suratpengajuanrepairline.rolldiameter like '%".$_POST['searchtext']."%'";$where .= " || suratpengajuanrepairline.bearingseatdiameter like '%".$_POST['searchtext']."%'";$where .= " || suratpengajuanrepairline.totallength like '%".$_POST['searchtext']."%'";$where .= " || suratpengajuanrepairline.quantity like '%".$_POST['searchtext']."%'";$where .= " || suratpengajuanrepairline.jenisrepair like '%".$_POST['searchtext']."%'";$where .= " || suratpengajuanrepairline.notes like '%".$_POST['searchtext']."%'";$where .= " || suratpengajuanrepairline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || suratpengajuanrepairline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('suratpengajuanrepairline__nodiss', 'asc');
$this->db->order_by('suratpengajuanrepairline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($suratpengajuanrepair_id=0)
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
		
		$data['foreign_id'] = $suratpengajuanrepair_id;$data['fields'] = array('suratpengajuanrepairline__nodiss' => 'No Diss', 'item__name' => 'Barang', 'customer__idstring' => 'Customer', 'mesin__typename' => 'Mesin', 'suratpengajuanrepairline__tipecore' => 'Tipe Core', 'suratpengajuanrepairline__rolldiameter' => 'Roll Diameter', 'suratpengajuanrepairline__bearingseatdiameter' => 'Bearing Seat Diameter', 'suratpengajuanrepairline__totallength' => 'Total Length (TL)', 'suratpengajuanrepairline__quantity' => 'Quantity', 'suratpengajuanrepairline__jenisrepair' => 'Jenis Repair', 'suratpengajuanrepairline__notes' => 'Notes', 'suratpengajuanrepairline__lastupdate' => 'Last Update', 'suratpengajuanrepairline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $suratpengajuanrepair_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $suratpengajuanrepair_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('surat_pengajuan_repair_line_list_view', $data);
	}
}

?>