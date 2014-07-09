<?php

class blanket_identification_formlist extends Controller {

	function blanket_identification_formlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('bif');
$this->db->join('marketingofficer', 'marketingofficer.id = bif.marketingofficer_id', 'left');
$this->db->join('customer', 'customer.id = bif.customer_id', 'left');
$this->db->where('bif.disabled = 0');
$this->db->select('marketingofficer.name as marketingofficer__name', false);
$this->db->select('bif.marketingofficer_id as bif__marketingofficer_id', false);
$this->db->select('customer.firstname as customer__firstname', false);
$this->db->select('bif.customer_id as bif__customer_id', false);
$this->db->select('bif.id as id', false);
$this->db->select('bif.idstring as bif__idstring', false);
$this->db->select('DATE_FORMAT(bif.date, "%d-%m-%Y") as bif__date', false);
$this->db->select('bif.pressmodel as bif__pressmodel', false);
$this->db->select('bif.ac as bif__ac', false);
$this->db->select('bif.ar as bif__ar', false);
$this->db->select('bif.thickness as bif__thickness', false);
$this->db->select('bif.typebar1 as bif__typebar1', false);
$this->db->select('bif.lengthbar1 as bif__lengthbar1', false);
$this->db->select('bif.positionbar1 as bif__positionbar1', false);
$this->db->select('bif.typebar2 as bif__typebar2', false);
$this->db->select('bif.lengthbar2 as bif__lengthbar2', false);
$this->db->select('bif.positionbar2 as bif__positionbar2', false);
$this->db->select('bif.corner as bif__corner', false);
$this->db->select('bif.needs as bif__needs', false);
$this->db->select('bif.drawingfile as bif__drawingfile', false);
$this->db->select('bif.notes as bif__notes', false);
$this->db->select('bif.lastupdate as bif__lastupdate', false);
$this->db->select('bif.updatedby as bif__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "bif.idstring like '%".$_POST['searchtext']."%'";$where .= " || bif.date like '%".$_POST['searchtext']."%'";$where .= " || marketingofficer.name like '%".$_POST['searchtext']."%'";$where .= " || customer.firstname like '%".$_POST['searchtext']."%'";$where .= " || bif.pressmodel like '%".$_POST['searchtext']."%'";$where .= " || bif.ac like '%".$_POST['searchtext']."%'";$where .= " || bif.ar like '%".$_POST['searchtext']."%'";$where .= " || bif.thickness like '%".$_POST['searchtext']."%'";$where .= " || bif.typebar1 like '%".$_POST['searchtext']."%'";$where .= " || bif.lengthbar1 like '%".$_POST['searchtext']."%'";$where .= " || bif.positionbar1 like '%".$_POST['searchtext']."%'";$where .= " || bif.typebar2 like '%".$_POST['searchtext']."%'";$where .= " || bif.lengthbar2 like '%".$_POST['searchtext']."%'";$where .= " || bif.positionbar2 like '%".$_POST['searchtext']."%'";$where .= " || bif.corner like '%".$_POST['searchtext']."%'";$where .= " || bif.needs like '%".$_POST['searchtext']."%'";$where .= " || bif.drawingfile like '%".$_POST['searchtext']."%'";$where .= " || bif.notes like '%".$_POST['searchtext']."%'";$where .= " || bif.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || bif.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('bif__idstring', 'asc');
$this->db->order_by('bif__date', 'desc');
$this->db->order_by('bif__lastupdate', 'desc');
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
		
		$data['fields'] = array('bif__idstring' => 'ID', 'bif__date' => 'Date', 'marketingofficer__name' => 'Marketing Officer', 'customer__firstname' => 'Customer', 'bif__pressmodel' => 'Press Model', 'bif__ac' => 'AC', 'bif__ar' => 'AR', 'bif__thickness' => 'Thickness', 'bif__typebar1' => 'Type Bar 1', 'bif__lengthbar1' => 'Length Bar 1', 'bif__positionbar1' => 'Position Bar 1', 'bif__typebar2' => 'Type Bar 2', 'bif__lengthbar2' => 'Length Bar 2', 'bif__positionbar2' => 'Position Bar 2', 'bif__corner' => 'Corner', 'bif__needs' => 'Needs', 'bif__drawingfile' => 'Drawing', 'bif__notes' => 'Notes', 'bif__lastupdate' => 'Last Update', 'bif__updatedby' => 'Last Update By');
		
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
		$this->load->view('blanket_identification_form_list_view', $data);
	}
}

?>