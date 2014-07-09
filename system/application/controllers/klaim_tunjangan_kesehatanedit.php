<?php

class klaim_tunjangan_kesehatanedit extends Controller {

	function klaim_tunjangan_kesehatanedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($klaim_tunjangan_kesehatan_id=0)
	{
		if ($klaim_tunjangan_kesehatan_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $klaim_tunjangan_kesehatan_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('tunjangankesehatanusage');
if ($q->num_rows() > 0) {
$data = array();
$data['klaim_tunjangan_kesehatan_id'] = $klaim_tunjangan_kesehatan_id;
foreach ($q->result() as $r) {
$data['tunjangankesehatanusage__date'] = $r->date;
$data['tunjangankesehatanusage__description'] = $r->description;
$data['tunjangankesehatanusage__amount'] = $r->amount;
$data['tunjangankesehatanusage__amountpaid'] = $r->amountpaid;
$data['tunjangankesehatanusage__notes'] = $r->notes;
$data['tunjangankesehatanusage__lastupdate'] = $r->lastupdate;
$data['tunjangankesehatanusage__updatedby'] = $r->updatedby;
$data['tunjangankesehatanusage__created'] = $r->created;
$data['tunjangankesehatanusage__createdby'] = $r->createdby;}
$this->load->view('klaim_tunjangan_kesehatan_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['tunjangankesehatanusage__date']) && ($_POST['tunjangankesehatanusage__date'] == "" || $_POST['tunjangankesehatanusage__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['tunjangankesehatanusage__date']))
$this->db->set('date', "str_to_date('".$_POST['tunjangankesehatanusage__date']."', '%d-%m-%Y')", false);if (isset($_POST['tunjangankesehatanusage__description']))
$data['description'] = $_POST['tunjangankesehatanusage__description'];if (isset($_POST['tunjangankesehatanusage__amount']))
$data['amount'] = $_POST['tunjangankesehatanusage__amount'];if (isset($_POST['tunjangankesehatanusage__amountpaid']))
$data['amountpaid'] = $_POST['tunjangankesehatanusage__amountpaid'];if (isset($_POST['tunjangankesehatanusage__notes']))
$data['notes'] = $_POST['tunjangankesehatanusage__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['klaim_tunjangan_kesehatan_id']);
$this->db->update('tunjangankesehatanusage', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('klaim_tunjangan_kesehatanedit','tunjangankesehatanusage','afteredit', $_POST['klaim_tunjangan_kesehatan_id']);
			
			
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