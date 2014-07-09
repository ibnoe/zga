<?php

class price_listedit extends Controller {

	function price_listedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($price_list_id=0)
	{
		if ($price_list_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $price_list_id);
$this->db->select('*');
$q = $this->db->get('pricelist');
if ($q->num_rows() > 0) {
$data = array();
$data['price_list_id'] = $price_list_id;
foreach ($q->result() as $r) {
$data['pricelist__idstring'] = $r->idstring;
$data['pricelist__name'] = $r->name;
$data['pricelist__lastupdate'] = $r->lastupdate;
$data['pricelist__updatedby'] = $r->updatedby;
$data['pricelist__created'] = $r->created;
$data['pricelist__createdby'] = $r->createdby;}
$this->load->view('price_list_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['pricelist__idstring']) && ($_POST['pricelist__idstring'] == "" || $_POST['pricelist__idstring'] == null))
$error .= "<span class='error'>Pricelist ID must not be empty"."</span><br>";

if (isset($_POST['pricelist__idstring'])) {$this->db->where("id !=", $_POST['price_list_id']);
$this->db->where('idstring', $_POST['pricelist__idstring']);
$q = $this->db->get('pricelist');
if ($q->num_rows() > 0) $error .= "<span class='error'>Pricelist ID must be unique"."</span><br>";}

if (isset($_POST['pricelist__name']) && ($_POST['pricelist__name'] == "" || $_POST['pricelist__name'] == null))
$error .= "<span class='error'>Pricelist Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['pricelist__idstring']))
$data['idstring'] = $_POST['pricelist__idstring'];if (isset($_POST['pricelist__name']))
$data['name'] = $_POST['pricelist__name'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['price_list_id']);
$this->db->update('pricelist', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('price_listedit','pricelist','afteredit', $_POST['price_list_id']);
			
			
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