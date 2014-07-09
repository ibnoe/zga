<?php

class receive_items_for_invoicelookup extends Controller {

	function receive_items_for_invoicelookup()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('receiveditem');
$this->db->join('supplier', 'supplier.id = receiveditem.supplier_id', 'left');
$this->db->join('warehouse', 'warehouse.id = receiveditem.warehouse_id', 'left');
$this->db->join('purchaseinvoice', 'receiveditem.id = purchaseinvoice.receiveditem_id', 'left');
$this->db->where('receiveditem.disabled = 0');
$this->db->where('purchaseinvoice.receiveditem_id is NULL');
$this->db->select('supplier.firstname as supplier__firstname', false);
$this->db->select('receiveditem.supplier_id as receiveditem__supplier_id', false);
$this->db->select('warehouse.name as warehouse__name', false);
$this->db->select('receiveditem.warehouse_id as receiveditem__warehouse_id', false);
$this->db->select('receiveditem.id as id', false);
$this->db->select('DATE_FORMAT(receiveditem.date, "%d-%m-%Y") as receiveditem__date', false);
$this->db->select('receiveditem.orderid as receiveditem__orderid', false);
$this->db->select('receiveditem.suratjalanno as receiveditem__suratjalanno', false);
$this->db->select('receiveditem.lastupdate as receiveditem__lastupdate', false);
$this->db->select('receiveditem.updatedby as receiveditem__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "receiveditem.date like '%".$_POST['searchtext']."%'";$where .= " || receiveditem.orderid like '%".$_POST['searchtext']."%'";$where .= " || receiveditem.suratjalanno like '%".$_POST['searchtext']."%'";$where .= " || supplier.firstname like '%".$_POST['searchtext']."%'";$where .= " || warehouse.name like '%".$_POST['searchtext']."%'";$where .= " || receiveditem.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || receiveditem.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('receiveditem__date', 'asc');
$this->db->order_by('receiveditem__date', 'desc');
$this->db->order_by('receiveditem__lastupdate', 'desc');
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
		
		$data['fields'] = array('receiveditem__date' => 'Date', 'receiveditem__orderid' => 'Receive Item No', 'receiveditem__suratjalanno' => 'Surat Jalan No', 'supplier__firstname' => 'Supplier', 'warehouse__name' => 'Warehouse', 'receiveditem__lastupdate' => 'Last Update', 'receiveditem__updatedby' => 'Last Update By');
		
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
		$this->load->view('receive_items_for_invoice_lookup_view', $data);
	}
}

?>