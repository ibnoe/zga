<?php

class under_packing_folexlist extends Controller {

	function under_packing_folexlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('itemzengraunderpackingfolex');
$this->db->join('uom', 'itemzengraunderpackingfolex.uom_id = uom.id', 'left');

$this->db->join('uom', 'itemzengraunderpackingfolex.uom_id = uom.id', 'left');

$this->db->select('itemzengraunderpackingfolex.name as itemzengraunderpackingfolex__name');
$this->db->select('itemzengraunderpackingfolex.netsqm as itemzengraunderpackingfolex__netsqm');
$this->db->select('itemzengraunderpackingfolex.grosssqm as itemzengraunderpackingfolex__grosssqm');
$this->db->select('itemzengraunderpackingfolex.minquantity as itemzengraunderpackingfolex__minquantity');
$this->db->select('itemzengraunderpackingfolex.maxquantity as itemzengraunderpackingfolex__maxquantity');
$this->db->select('itemzengraunderpackingfolex.buffer3months as itemzengraunderpackingfolex__buffer3months');
$this->db->select('uom.name as uom__name');
$this->db->select('uom.name as uom__name');
$this->db->select('itemzengraunderpackingfolex.purchaseable as itemzengraunderpackingfolex__purchaseable');
$this->db->select('itemzengraunderpackingfolex.sellable as itemzengraunderpackingfolex__sellable');
$this->db->select('itemzengraunderpackingfolex.id as id');
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "itemzengraunderpackingfolex.name like '%".$_POST['searchtext']."%'";$where .= " || itemzengraunderpackingfolex.netsqm like '%".$_POST['searchtext']."%'";$where .= " || itemzengraunderpackingfolex.grosssqm like '%".$_POST['searchtext']."%'";$where .= " || itemzengraunderpackingfolex.minquantity like '%".$_POST['searchtext']."%'";$where .= " || itemzengraunderpackingfolex.maxquantity like '%".$_POST['searchtext']."%'";$where .= " || itemzengraunderpackingfolex.buffer3months like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || itemzengraunderpackingfolex.purchaseable like '%".$_POST['searchtext']."%'";$where .= " || itemzengraunderpackingfolex.sellable like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
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
		
		$data['fields'] = array('itemzengraunderpackingfolex__name' => 'Name', 'itemzengraunderpackingfolex__netsqm' => 'Net SQM', 'itemzengraunderpackingfolex__grosssqm' => 'Gross SQM', 'itemzengraunderpackingfolex__minquantity' => 'Minimum Quantity', 'itemzengraunderpackingfolex__maxquantity' => 'Maximum Quantity', 'itemzengraunderpackingfolex__buffer3months' => 'Buffer 3 Months', 'uom__name' => 'Buy Uom', 'uom__name' => 'Sell Uom', 'itemzengraunderpackingfolex__purchaseable' => 'Is Purchasable?', 'itemzengraunderpackingfolex__sellable' => 'Is Sellable?');
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		$q = $this->db->get();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		///
		$this->load->view('under_packing_folex_list_view', $data);
	}
}

?>