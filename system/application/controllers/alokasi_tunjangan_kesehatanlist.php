<?php

class alokasi_tunjangan_kesehatanlist extends Controller {

	function alokasi_tunjangan_kesehatanlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $karyawan_id)
	{
		
$this->db->where('tunjangankesehatanallowance.karyawan_id', $karyawan_id);$this->db->from('tunjangankesehatanallowance');
$this->db->where('tunjangankesehatanallowance.disabled = 0');
$this->db->select('tunjangankesehatanallowance.id as id', false);
$this->db->select('DATE_FORMAT(tunjangankesehatanallowance.date, "%d-%m-%Y") as tunjangankesehatanallowance__date', false);
$this->db->select('tunjangankesehatanallowance.description as tunjangankesehatanallowance__description', false);
$this->db->select('tunjangankesehatanallowance.amount as tunjangankesehatanallowance__amount', false);
$this->db->select('tunjangankesehatanallowance.notes as tunjangankesehatanallowance__notes', false);
$this->db->select('tunjangankesehatanallowance.lastupdate as tunjangankesehatanallowance__lastupdate', false);
$this->db->select('tunjangankesehatanallowance.updatedby as tunjangankesehatanallowance__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "tunjangankesehatanallowance.date like '%".$_POST['searchtext']."%'";$where .= " || tunjangankesehatanallowance.description like '%".$_POST['searchtext']."%'";$where .= " || tunjangankesehatanallowance.amount like '%".$_POST['searchtext']."%'";$where .= " || tunjangankesehatanallowance.notes like '%".$_POST['searchtext']."%'";$where .= " || tunjangankesehatanallowance.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || tunjangankesehatanallowance.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('tunjangankesehatanallowance__date', 'asc');
$this->db->order_by('tunjangankesehatanallowance__date', 'desc');
$this->db->order_by('tunjangankesehatanallowance__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($karyawan_id=0)
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
		
		$data['foreign_id'] = $karyawan_id;$data['fields'] = array('tunjangankesehatanallowance__date' => 'Date', 'tunjangankesehatanallowance__description' => 'Description', 'tunjangankesehatanallowance__amount' => 'Amount', 'tunjangankesehatanallowance__notes' => 'Notes', 'tunjangankesehatanallowance__lastupdate' => 'Last Update', 'tunjangankesehatanallowance__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $karyawan_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $karyawan_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('alokasi_tunjangan_kesehatan_list_view', $data);
	}
}

?>