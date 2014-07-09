<?php

class purchase_orderlist extends Controller {

	function purchase_orderlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('purchaseorder');
$this->db->join('suratpermintaanpembelian', 'suratpermintaanpembelian.id = purchaseorder.suratpermintaanpembelian_id', 'left');
$this->db->join('supplier', 'supplier.id = purchaseorder.supplier_id', 'left');
$this->db->join('currency', 'currency.id = purchaseorder.currency_id', 'left');
$this->db->join('supplier as supplier1', 'supplier1.id = purchaseorder.supplier2_id', 'left');
$this->db->join('supplier as supplier2', 'supplier2.id = purchaseorder.supplier3_id', 'left');
$this->db->join('forwarder', 'forwarder.id = purchaseorder.forwarder_id', 'left');
$this->db->where('purchaseorder.disabled = 0');
$this->db->select('suratpermintaanpembelian.orderid as suratpermintaanpembelian__orderid', false);
$this->db->select('purchaseorder.suratpermintaanpembelian_id as purchaseorder__suratpermintaanpembelian_id', false);
$this->db->select('supplier.firstname as supplier__firstname', false);
$this->db->select('purchaseorder.supplier_id as purchaseorder__supplier_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('purchaseorder.currency_id as purchaseorder__currency_id', false);
$this->db->select('supplier1.firstname as supplier1__firstname', false);
$this->db->select('purchaseorder.supplier2_id as purchaseorder__supplier2_id', false);
$this->db->select('supplier2.firstname as supplier2__firstname', false);
$this->db->select('purchaseorder.supplier3_id as purchaseorder__supplier3_id', false);
$this->db->select('forwarder.name as forwarder__name', false);
$this->db->select('purchaseorder.forwarder_id as purchaseorder__forwarder_id', false);
$this->db->select('purchaseorder.id as id', false);
$this->db->select('purchaseorder.orderid as purchaseorder__orderid', false);
$this->db->select('DATE_FORMAT(purchaseorder.date, "%d-%m-%Y") as purchaseorder__date', false);
$this->db->select('purchaseorder.buysource as purchaseorder__buysource', false);
$this->db->select('purchaseorder.currencyrate as purchaseorder__currencyrate', false);
$this->db->select('purchaseorder.quote1 as purchaseorder__quote1', false);
$this->db->select('purchaseorder.notes as purchaseorder__notes', false);
$this->db->select('purchaseorder.quote2 as purchaseorder__quote2', false);
$this->db->select('purchaseorder.notes2 as purchaseorder__notes2', false);
$this->db->select('purchaseorder.quote3 as purchaseorder__quote3', false);
$this->db->select('purchaseorder.notes3 as purchaseorder__notes3', false);
$this->db->select('purchaseorder.shipmethod as purchaseorder__shipmethod', false);
$this->db->select('DATE_FORMAT(purchaseorder.estarrivaldate, "%d-%m-%Y") as purchaseorder__estarrivaldate', false);
$this->db->select('purchaseorder.total as purchaseorder__total', false);
$this->db->select('purchaseorder.lastupdate as purchaseorder__lastupdate', false);
$this->db->select('purchaseorder.updatedby as purchaseorder__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "purchaseorder.orderid like '%".$_POST['searchtext']."%'";$where .= " || purchaseorder.date like '%".$_POST['searchtext']."%'";$where .= " || suratpermintaanpembelian.orderid like '%".$_POST['searchtext']."%'";$where .= " || supplier.firstname like '%".$_POST['searchtext']."%'";$where .= " || purchaseorder.buysource like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || purchaseorder.currencyrate like '%".$_POST['searchtext']."%'";$where .= " || purchaseorder.quote1 like '%".$_POST['searchtext']."%'";$where .= " || purchaseorder.notes like '%".$_POST['searchtext']."%'";$where .= " || supplier1.firstname like '%".$_POST['searchtext']."%'";$where .= " || purchaseorder.quote2 like '%".$_POST['searchtext']."%'";$where .= " || purchaseorder.notes2 like '%".$_POST['searchtext']."%'";$where .= " || supplier2.firstname like '%".$_POST['searchtext']."%'";$where .= " || purchaseorder.quote3 like '%".$_POST['searchtext']."%'";$where .= " || purchaseorder.notes3 like '%".$_POST['searchtext']."%'";$where .= " || forwarder.name like '%".$_POST['searchtext']."%'";$where .= " || purchaseorder.shipmethod like '%".$_POST['searchtext']."%'";$where .= " || purchaseorder.estarrivaldate like '%".$_POST['searchtext']."%'";$where .= " || purchaseorder.total like '%".$_POST['searchtext']."%'";$where .= " || purchaseorder.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || purchaseorder.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('purchaseorder__orderid', 'asc');
$this->db->order_by('purchaseorder__date', 'desc');
$this->db->order_by('purchaseorder__lastupdate', 'desc');
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
		
		$data['fields'] = array('purchaseorder__orderid' => 'PO ID', 'purchaseorder__date' => 'Date', 'suratpermintaanpembelian__orderid' => 'SPP', 'supplier__firstname' => 'Supplier', 'purchaseorder__buysource' => 'Buy Source', 'currency__name' => 'Currency', 'purchaseorder__currencyrate' => 'Currency Rate', 'purchaseorder__quote1' => 'PO Quote 1', 'purchaseorder__notes' => 'Notes', 'supplier1__firstname' => 'Supplier 2', 'purchaseorder__quote2' => 'PO Quote 2', 'purchaseorder__notes2' => 'Notes 2', 'supplier2__firstname' => 'Supplier 3', 'purchaseorder__quote3' => 'PO Quote 3', 'purchaseorder__notes3' => 'Notes 3', 'forwarder__name' => 'Forwarder', 'purchaseorder__shipmethod' => 'Ship Method', 'purchaseorder__estarrivaldate' => 'Est Arrival Date', 'purchaseorder__total' => 'Total Amount', 'purchaseorder__lastupdate' => 'Last Update', 'purchaseorder__updatedby' => 'Last Update By');
		
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
		$this->load->view('purchase_order_list_view', $data);
	}
}

?>