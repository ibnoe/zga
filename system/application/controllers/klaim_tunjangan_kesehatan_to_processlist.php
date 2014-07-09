<?php

class klaim_tunjangan_kesehatan_to_processlist extends Controller {

	function klaim_tunjangan_kesehatan_to_processlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('tunjangankesehatanusage');
$this->db->where('tunjangankesehatanusage.disabled = 0');
$this->db->where('tunjangankesehatanusage.processed = 0');
$this->db->select('tunjangankesehatanusage.id as id', false);
$this->db->select('tunjangankesehatanusage.id as tunjangankesehatanusage__id', false);
$this->db->select('DATE_FORMAT(tunjangankesehatanusage.date, "%d-%m-%Y") as tunjangankesehatanusage__date', false);
$this->db->select('tunjangankesehatanusage.description as tunjangankesehatanusage__description', false);
$this->db->select('tunjangankesehatanusage.amount as tunjangankesehatanusage__amount', false);
$this->db->select('tunjangankesehatanusage.amountpaid as tunjangankesehatanusage__amountpaid', false);
$this->db->select('tunjangankesehatanusage.notes as tunjangankesehatanusage__notes', false);
$this->db->select('tunjangankesehatanusage.processed as tunjangankesehatanusage__processed', false);
$this->db->select('tunjangankesehatanusage.lastupdate as tunjangankesehatanusage__lastupdate', false);
$this->db->select('tunjangankesehatanusage.updatedby as tunjangankesehatanusage__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "tunjangankesehatanusage.id like '%".$_POST['searchtext']."%'";$where .= " || tunjangankesehatanusage.date like '%".$_POST['searchtext']."%'";$where .= " || tunjangankesehatanusage.description like '%".$_POST['searchtext']."%'";$where .= " || tunjangankesehatanusage.amount like '%".$_POST['searchtext']."%'";$where .= " || tunjangankesehatanusage.amountpaid like '%".$_POST['searchtext']."%'";$where .= " || tunjangankesehatanusage.notes like '%".$_POST['searchtext']."%'";$where .= " || tunjangankesehatanusage.processed like '%".$_POST['searchtext']."%'";$where .= " || tunjangankesehatanusage.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || tunjangankesehatanusage.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('tunjangankesehatanusage__id', 'asc');
$this->db->order_by('tunjangankesehatanusage__date', 'desc');
$this->db->order_by('tunjangankesehatanusage__lastupdate', 'desc');
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
		
		$data['fields'] = array('tunjangankesehatanusage__date' => 'Date', 'tunjangankesehatanusage__description' => 'Receipt From', 'tunjangankesehatanusage__amount' => 'Total Receipt', 'tunjangankesehatanusage__amountpaid' => 'Company Paid', 'tunjangankesehatanusage__notes' => 'Notes', 'tunjangankesehatanusage__processed' => 'Processed', 'tunjangankesehatanusage__lastupdate' => 'Last Update', 'tunjangankesehatanusage__updatedby' => 'Last Update By');
		
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
		$this->load->view('klaim_tunjangan_kesehatan_to_process_list_view', $data);
	}
}

?>