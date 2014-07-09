<?php

class penawaran_lineview extends Controller {

	function penawaran_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($penawaran_line_id=0)
	{
		if ($penawaran_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $penawaran_line_id);
$this->db->select('*');
$q = $this->db->get('salesorderquoteline');
if ($q->num_rows() > 0) {
$data = array();
$data['penawaran_line_id'] = $penawaran_line_id;
foreach ($q->result() as $r) {
$data['salesorderquoteline__type'] = $r->type;
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['salesorderquoteline__item_id'] = $r->item_id;
$data['salesorderquoteline__quantity'] = $r->quantity;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['salesorderquoteline__uom_id'] = $r->uom_id;
$data['salesorderquoteline__price'] = $r->price;
$data['salesorderquoteline__pdisc'] = $r->pdisc;
$data['salesorderquoteline__subtotal'] = $r->subtotal;
$data['salesorderquoteline__lastupdate'] = $r->lastupdate;
$data['salesorderquoteline__updatedby'] = $r->updatedby;
$data['salesorderquoteline__created'] = $r->created;
$data['salesorderquoteline__createdby'] = $r->createdby;}
$this->load->view('penawaran_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['type'] = $_POST['salesorderquoteline__type'];
$data['item_id'] = $_POST['salesorderquoteline__item_id'];
$data['quantity'] = $_POST['salesorderquoteline__quantity'];
$data['uom_id'] = $_POST['salesorderquoteline__uom_id'];
$data['price'] = $_POST['salesorderquoteline__price'];
$data['pdisc'] = $_POST['salesorderquoteline__pdisc'];
$data['subtotal'] = $_POST['salesorderquoteline__subtotal'];
$data['lastupdate'] = $_POST['salesorderquoteline__lastupdate'];
$data['updatedby'] = $_POST['salesorderquoteline__updatedby'];
$data['created'] = $_POST['salesorderquoteline__created'];
$data['createdby'] = $_POST['salesorderquoteline__createdby'];
$this->db->where('id', $data['penawaran_line_id']);
$this->db->update('salesorderquoteline', $data);
			validationonserver();
			
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully updated.";
			}
			else
			{
				echo "<span style='background-color:red'>   </span> ".$error;
			}
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>