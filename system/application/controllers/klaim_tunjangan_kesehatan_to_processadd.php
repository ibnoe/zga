<?php

class klaim_tunjangan_kesehatan_to_processadd extends Controller {

	function klaim_tunjangan_kesehatan_to_processadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['tunjangankesehatanusage__lastupdate'] = '';
$data['tunjangankesehatanusage__updatedby'] = '';
$data['tunjangankesehatanusage__created'] = '';
$data['tunjangankesehatanusage__createdby'] = '';
		

		$this->load->view('klaim_tunjangan_kesehatan_to_process_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('tunjangankesehatanusage', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$tunjangankesehatanusage_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('klaim_tunjangan_kesehatan_to_processadd','tunjangankesehatanusage','aftersave', $tunjangankesehatanusage_id);
			
		
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
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