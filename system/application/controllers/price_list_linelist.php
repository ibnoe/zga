<?php

class price_list_linelist extends Controller {

	function price_list_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $pricelist_id)
	{
		
$this->db->where('pricelistline.pricelist_id', $pricelist_id);$this->db->from('pricelistline');
$this->db->join('item', 'item.id = pricelistline.item_id', 'left');
$this->db->where('pricelistline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('pricelistline.item_id as pricelistline__item_id', false);
$this->db->select('pricelistline.id as id', false);
$this->db->select('pricelistline.pdisc as pricelistline__pdisc', false);
$this->db->select('pricelistline.price as pricelistline__price', false);
$this->db->select('pricelistline.lastupdate as pricelistline__lastupdate', false);
$this->db->select('pricelistline.updatedby as pricelistline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || pricelistline.pdisc like '%".$_POST['searchtext']."%'";$where .= " || pricelistline.price like '%".$_POST['searchtext']."%'";$where .= " || pricelistline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || pricelistline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('pricelistline__item_id', 'asc');
$this->db->order_by('pricelistline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($pricelist_id=0)
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
		
		$data['foreign_id'] = $pricelist_id;$data['fields'] = array('item__name' => 'Item', 'pricelistline__pdisc' => 'Discount', 'pricelistline__price' => 'Price', 'pricelistline__lastupdate' => 'Last Update', 'pricelistline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $pricelist_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $pricelist_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('price_list_line_list_view', $data);
	}
}

?>