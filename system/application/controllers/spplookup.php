<?php

class spplookup extends Controller {

	function spplookup()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('suratpermintaanpembelian');
$this->db->where('suratpermintaanpembelian.disabled = 0');
$this->db->select('suratpermintaanpembelian.id as id', false);
$this->db->select('suratpermintaanpembelian.orderid as suratpermintaanpembelian__orderid', false);
$this->db->select('DATE_FORMAT(suratpermintaanpembelian.date, "%d-%m-%Y") as suratpermintaanpembelian__date', false);
$this->db->select('suratpermintaanpembelian.requester as suratpermintaanpembelian__requester', false);
$this->db->select('suratpermintaanpembelian.divisi as suratpermintaanpembelian__divisi', false);
$this->db->select('suratpermintaanpembelian.buysource as suratpermintaanpembelian__buysource', false);
$this->db->select('suratpermintaanpembelian.notes as suratpermintaanpembelian__notes', false);
$this->db->select('suratpermintaanpembelian.status as suratpermintaanpembelian__status', false);
$this->db->select('suratpermintaanpembelian.lastupdate as suratpermintaanpembelian__lastupdate', false);
$this->db->select('suratpermintaanpembelian.updatedby as suratpermintaanpembelian__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "suratpermintaanpembelian.orderid like '%".$_POST['searchtext']."%'";$where .= " || suratpermintaanpembelian.date like '%".$_POST['searchtext']."%'";$where .= " || suratpermintaanpembelian.requester like '%".$_POST['searchtext']."%'";$where .= " || suratpermintaanpembelian.divisi like '%".$_POST['searchtext']."%'";$where .= " || suratpermintaanpembelian.buysource like '%".$_POST['searchtext']."%'";$where .= " || suratpermintaanpembelian.notes like '%".$_POST['searchtext']."%'";$where .= " || suratpermintaanpembelian.status like '%".$_POST['searchtext']."%'";$where .= " || suratpermintaanpembelian.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || suratpermintaanpembelian.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('suratpermintaanpembelian__orderid', 'asc');
$this->db->order_by('suratpermintaanpembelian__date', 'desc');
$this->db->order_by('suratpermintaanpembelian__lastupdate', 'desc');
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
		$data['perpage'] = 10000;
		
		$data['sortby'] = array();$data['sortdirection'] = array();
		if (isset($_POST['sortby'])) $data['sortby'] = $_POST['sortby'];
		if (isset($_POST['sortdirection'])) $data['sortdirection'] = $_POST['sortdirection'];
		
		$data['fields'] = array('suratpermintaanpembelian__orderid' => 'No SPP', 'suratpermintaanpembelian__date' => 'Date', 'suratpermintaanpembelian__requester' => 'Requester', 'suratpermintaanpembelian__divisi' => 'Divisi', 'suratpermintaanpembelian__buysource' => 'Buy Source', 'suratpermintaanpembelian__notes' => 'Description', 'suratpermintaanpembelian__status' => 'Status', 'suratpermintaanpembelian__lastupdate' => 'Last Update', 'suratpermintaanpembelian__updatedby' => 'Last Update By');
		
		if (count($_POST) == 0)
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
		$this->load->view('spp_lookup_view', $data);
	}
}

?>