<?php

class mesinview extends Controller {

	function mesinview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($mesin_id=0)
	{
		if ($mesin_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $mesin_id);
$this->db->select('*');
$q = $this->db->get('mesin');
if ($q->num_rows() > 0) {
$data = array();
$data['mesin_id'] = $mesin_id;
foreach ($q->result() as $r) {
$data['mesin__idstring'] = $r->idstring;
$data['mesin__typename'] = $r->typename;
$merkmesin_opt = array();
$q = $this->db->get('merkmesin');
foreach ($q->result() as $row) { $merkmesin_opt[$row->id] = $row->name; }
$data['merkmesin_opt'] = $merkmesin_opt;
$data['mesin__merkmesin_id'] = $r->merkmesin_id;
$data['mesin__lastupdate'] = $r->lastupdate;
$data['mesin__updatedby'] = $r->updatedby;
$data['mesin__created'] = $r->created;
$data['mesin__createdby'] = $r->createdby;}
$this->load->view('mesin_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['mesin__idstring'];
$data['typename'] = $_POST['mesin__typename'];
$data['merkmesin_id'] = $_POST['mesin__merkmesin_id'];
$data['lastupdate'] = $_POST['mesin__lastupdate'];
$data['updatedby'] = $_POST['mesin__updatedby'];
$data['created'] = $_POST['mesin__created'];
$data['createdby'] = $_POST['mesin__createdby'];
$this->db->where('id', $data['mesin_id']);
$this->db->update('mesin', $data);
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