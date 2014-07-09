<?php

class alokasi_tunjangan_kesehatanedit extends Controller {

	function alokasi_tunjangan_kesehatanedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($alokasi_tunjangan_kesehatan_id=0)
	{
		if ($alokasi_tunjangan_kesehatan_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $alokasi_tunjangan_kesehatan_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('tunjangankesehatanallowance');
if ($q->num_rows() > 0) {
$data = array();
$data['alokasi_tunjangan_kesehatan_id'] = $alokasi_tunjangan_kesehatan_id;
foreach ($q->result() as $r) {
$data['tunjangankesehatanallowance__date'] = $r->date;
$data['tunjangankesehatanallowance__description'] = $r->description;
$data['tunjangankesehatanallowance__amount'] = $r->amount;
$data['tunjangankesehatanallowance__notes'] = $r->notes;
$data['tunjangankesehatanallowance__lastupdate'] = $r->lastupdate;
$data['tunjangankesehatanallowance__updatedby'] = $r->updatedby;
$data['tunjangankesehatanallowance__created'] = $r->created;
$data['tunjangankesehatanallowance__createdby'] = $r->createdby;}
$this->load->view('alokasi_tunjangan_kesehatan_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['tunjangankesehatanallowance__date']) && ($_POST['tunjangankesehatanallowance__date'] == "" || $_POST['tunjangankesehatanallowance__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['tunjangankesehatanallowance__date']))
$this->db->set('date', "str_to_date('".$_POST['tunjangankesehatanallowance__date']."', '%d-%m-%Y')", false);if (isset($_POST['tunjangankesehatanallowance__description']))
$data['description'] = $_POST['tunjangankesehatanallowance__description'];if (isset($_POST['tunjangankesehatanallowance__amount']))
$data['amount'] = $_POST['tunjangankesehatanallowance__amount'];if (isset($_POST['tunjangankesehatanallowance__notes']))
$data['notes'] = $_POST['tunjangankesehatanallowance__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['alokasi_tunjangan_kesehatan_id']);
$this->db->update('tunjangankesehatanallowance', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('alokasi_tunjangan_kesehatanedit','tunjangankesehatanallowance','afteredit', $_POST['alokasi_tunjangan_kesehatan_id']);
			
			
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