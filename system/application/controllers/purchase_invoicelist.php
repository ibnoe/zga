<?php

class purchase_invoicelist extends Controller {

	function purchase_invoicelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('purchaseinvoice');
$this->db->join('receiveditem', 'receiveditem.id = purchaseinvoice.receiveditem_id', 'left');
$this->db->join('ongkoskirimimport', 'ongkoskirimimport.id = purchaseinvoice.ongkoskirimimport_id', 'left');
$this->db->where('purchaseinvoice.disabled = 0');
$this->db->select('receiveditem.suratjalanno as receiveditem__suratjalanno', false);
$this->db->select('purchaseinvoice.receiveditem_id as purchaseinvoice__receiveditem_id', false);
$this->db->select('ongkoskirimimport.idstring as ongkoskirimimport__idstring', false);
$this->db->select('purchaseinvoice.ongkoskirimimport_id as purchaseinvoice__ongkoskirimimport_id', false);
$this->db->select('purchaseinvoice.id as id', false);
$this->db->select('DATE_FORMAT(purchaseinvoice.date, "%d-%m-%Y") as purchaseinvoice__date', false);
$this->db->select('purchaseinvoice.orderid as purchaseinvoice__orderid', false);
$this->db->select('purchaseinvoice.supplier_id as purchaseinvoice__supplier_id', false);
$this->db->select('purchaseinvoice.currency_id as purchaseinvoice__currency_id', false);
$this->db->select('purchaseinvoice.currencyrate as purchaseinvoice__currencyrate', false);
$this->db->select('purchaseinvoice.total as purchaseinvoice__total', false);
$this->db->select('purchaseinvoice.top as purchaseinvoice__top', false);
$this->db->select('purchaseinvoice.lastupdate as purchaseinvoice__lastupdate', false);
$this->db->select('purchaseinvoice.updatedby as purchaseinvoice__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "purchaseinvoice.date like '%".$_POST['searchtext']."%'";$where .= " || purchaseinvoice.orderid like '%".$_POST['searchtext']."%'";$where .= " || receiveditem.suratjalanno like '%".$_POST['searchtext']."%'";$where .= " || purchaseinvoice.total like '%".$_POST['searchtext']."%'";$where .= " || purchaseinvoice.top like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.idstring like '%".$_POST['searchtext']."%'";$where .= " || purchaseinvoice.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || purchaseinvoice.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('purchaseinvoice__date', 'asc');
$this->db->order_by('purchaseinvoice__date', 'desc');
$this->db->order_by('purchaseinvoice__lastupdate', 'desc');
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
		
		$data['fields'] = array('purchaseinvoice__date' => 'Date', 'purchaseinvoice__orderid' => 'Purchase Invoice No', 'receiveditem__suratjalanno' => 'Receive Items', 'purchaseinvoice__total' => 'Total', 'purchaseinvoice__top' => 'Payment Term', 'ongkoskirimimport__idstring' => 'Ongkos Kirim Import', 'purchaseinvoice__lastupdate' => 'Last Update', 'purchaseinvoice__updatedby' => 'Last Update By');
		
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
		$this->load->view('purchase_invoice_list_view', $data);
	}
}

?>