<?php

class manufacturing_order_progresslist extends Controller {

	function manufacturing_order_progresslist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('manufacturingorder');
$this->db->join('item', 'item.id = manufacturingorder.item_id', 'left');
$this->db->join('itemcategory', 'itemcategory.id = manufacturingorder.itemcategory_id', 'left');
$this->db->join('uom', 'uom.id = manufacturingorder.uom_id', 'left');
$this->db->join('bom', 'bom.id = manufacturingorder.bom_id', 'left');
$this->db->where('manufacturingorder.disabled = 0');
$this->db->where('manufacturingorder.quantitytoprocess > 0');
$this->db->select('item.name as item__name', false);
$this->db->select('manufacturingorder.item_id as manufacturingorder__item_id', false);
$this->db->select('itemcategory.name as itemcategory__name', false);
$this->db->select('manufacturingorder.itemcategory_id as manufacturingorder__itemcategory_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('manufacturingorder.uom_id as manufacturingorder__uom_id', false);
$this->db->select('bom.name as bom__name', false);
$this->db->select('manufacturingorder.bom_id as manufacturingorder__bom_id', false);
$this->db->select('manufacturingorder.id as id', false);
$this->db->select('manufacturingorder.id as manufacturingorder__id', false);
$this->db->select('DATE_FORMAT(manufacturingorder.date, "%d-%m-%Y") as manufacturingorder__date', false);
$this->db->select('manufacturingorder.idstring as manufacturingorder__idstring', false);
$this->db->select('manufacturingorder.quantity as manufacturingorder__quantity', false);
$this->db->select('manufacturingorder.quantitytoprocess as manufacturingorder__quantitytoprocess', false);
$this->db->select('manufacturingorder.lastupdate as manufacturingorder__lastupdate', false);
$this->db->select('manufacturingorder.updatedby as manufacturingorder__updatedby', false);if (isset($_POST['item_id']) && $_POST['item_id'] != -1)$this->db->where('manufacturingorder.item_id', $_POST['item_id']);if (isset($_POST['itemcategory_id']) && $_POST['itemcategory_id'] != -1)$this->db->where('manufacturingorder.itemcategory_id', $_POST['itemcategory_id']);if (isset($_POST['date']) && $_POST['date'] != -1)$this->db->where('DATE_FORMAT(manufacturingorder.date, "%d-%m-%Y") = "'.$_POST['date'].'"');
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "manufacturingorder.id like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorder.date like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorder.idstring like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || itemcategory.name like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorder.quantity like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorder.quantitytoprocess like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || bom.name like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorder.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorder.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('manufacturingorder__id', 'asc');
$this->db->order_by('manufacturingorder__date', 'desc');
$this->db->order_by('manufacturingorder__lastupdate', 'desc');
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
		
		$data['fields'] = array('manufacturingorder__date' => 'Date', 'manufacturingorder__idstring' => 'ID', 'item__name' => 'Item', 'itemcategory__name' => 'Category', 'manufacturingorder__quantity' => 'Quantity', 'manufacturingorder__quantitytoprocess' => 'Quantity To Process', 'uom__name' => 'Unit', 'bom__name' => 'Bom', 'manufacturingorder__lastupdate' => 'Last Update', 'manufacturingorder__updatedby' => 'Last Update By');
		
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
		
		
		
		$this->db->from('manufacturingorder');$this->db->join('item', 'item.id = manufacturingorder.item_id');$this->db->select('item_id as id, item.name as name');$q = $this->db->get();$item_opt = array('-1' => 'All');foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }$data['item_opt'] = $item_opt;foreach ($item_opt as $k=>$v) { $data['item_id'] = $k; break; }if (isset($_POST['item_id']))$data['item_id'] = $_POST['item_id'];$this->db->from('manufacturingorder');$this->db->join('itemcategory', 'itemcategory.id = manufacturingorder.itemcategory_id');$this->db->select('itemcategory_id as id, itemcategory.name as name');$q = $this->db->get();$itemcategory_opt = array('-1' => 'All');foreach ($q->result() as $row) { $itemcategory_opt[$row->id] = $row->name; }$data['itemcategory_opt'] = $itemcategory_opt;foreach ($itemcategory_opt as $k=>$v) { $data['itemcategory_id'] = $k; break; }if (isset($_POST['itemcategory_id']))$data['itemcategory_id'] = $_POST['itemcategory_id'];$date_opt = array('-1' => 'All');$this->db->from('manufacturingorder');$this->db->select('DATE_FORMAT(manufacturingorder.date, "%d-%m-%Y") as date', false);$q = $this->db->get();foreach ($q->result_array() as $row) { $date_opt[$row['date']] = $row['date']; }$data['date_opt'] = $date_opt;foreach ($date_opt as $k=>$v) { $data['date'] = $k; break; }if (isset($_POST['date']))$data['date'] = $_POST['date'];
		}
		///
		$this->load->view('manufacturing_order_progress_list_view', $data);
	}
}

?>