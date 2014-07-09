<?php

class mesinlist extends Controller {

	function mesinlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('mesin');
$this->db->join('merkmesin', 'merkmesin.id = mesin.merkmesin_id', 'left');
$this->db->where('mesin.disabled = 0');
$this->db->select('merkmesin.name as merkmesin__name', false);
$this->db->select('mesin.merkmesin_id as mesin__merkmesin_id', false);
$this->db->select('mesin.id as id', false);
$this->db->select('mesin.idstring as mesin__idstring', false);
$this->db->select('mesin.typename as mesin__typename', false);
$this->db->select('mesin.lastupdate as mesin__lastupdate', false);
$this->db->select('mesin.updatedby as mesin__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "mesin.idstring like '%".$_POST['searchtext']."%'";$where .= " || mesin.typename like '%".$_POST['searchtext']."%'";$where .= " || merkmesin.name like '%".$_POST['searchtext']."%'";$where .= " || mesin.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || mesin.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('mesin__idstring', 'asc');
$this->db->order_by('mesin__lastupdate', 'desc');
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
		
		$data['fields'] = array('mesin__idstring' => 'Kode Mesin', 'mesin__typename' => 'Tipe Mesin', 'merkmesin__name' => 'Merk Mesin', 'mesin__lastupdate' => 'Last Update', 'mesin__updatedby' => 'Last Update By');
		
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
		$this->load->view('mesin_list_view', $data);
	}
}

?>