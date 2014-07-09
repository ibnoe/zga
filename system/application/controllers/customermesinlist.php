<?php

class customermesinlist extends Controller {

	function customermesinlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $customer_id)
	{
		
$this->db->where('customermesin.customer_id', $customer_id);$this->db->from('customermesin');
$this->db->join('mesin', 'mesin.id = customermesin.mesin_id', 'left');
$this->db->where('customermesin.disabled = 0');
$this->db->select('mesin.typename as mesin__typename', false);
$this->db->select('customermesin.mesin_id as customermesin__mesin_id', false);
$this->db->select('customermesin.id as id', false);
$this->db->select('customermesin.nomesin as customermesin__nomesin', false);
$this->db->select('customermesin.noserimesin as customermesin__noserimesin', false);
$this->db->select('customermesin.tahun as customermesin__tahun', false);
$this->db->select('customermesin.konfigurasi as customermesin__konfigurasi', false);
$this->db->select('customermesin.jumlahblanket as customermesin__jumlahblanket', false);
$this->db->select('customermesin.jumlahroll as customermesin__jumlahroll', false);
$this->db->select('customermesin.notes as customermesin__notes', false);
$this->db->select('customermesin.lastupdate as customermesin__lastupdate', false);
$this->db->select('customermesin.updatedby as customermesin__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "mesin.typename like '%".$_POST['searchtext']."%'";$where .= " || customermesin.nomesin like '%".$_POST['searchtext']."%'";$where .= " || customermesin.noserimesin like '%".$_POST['searchtext']."%'";$where .= " || customermesin.tahun like '%".$_POST['searchtext']."%'";$where .= " || customermesin.konfigurasi like '%".$_POST['searchtext']."%'";$where .= " || customermesin.jumlahblanket like '%".$_POST['searchtext']."%'";$where .= " || customermesin.jumlahroll like '%".$_POST['searchtext']."%'";$where .= " || customermesin.notes like '%".$_POST['searchtext']."%'";$where .= " || customermesin.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || customermesin.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('customermesin__mesin_id', 'asc');
$this->db->order_by('customermesin__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($customer_id=0)
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
		
		$data['foreign_id'] = $customer_id;$data['fields'] = array('mesin__typename' => 'Mesin ID', 'customermesin__nomesin' => 'No Mesin', 'customermesin__noserimesin' => 'No Seri Mesin', 'customermesin__tahun' => 'Tahun', 'customermesin__konfigurasi' => 'Konfigurasi', 'customermesin__jumlahblanket' => 'Jumlah Blanket', 'customermesin__jumlahroll' => 'Jumlah Roll', 'customermesin__notes' => 'Notes', 'customermesin__lastupdate' => 'Last Update', 'customermesin__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $customer_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $customer_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('customermesin_list_view', $data);
	}
}

?>