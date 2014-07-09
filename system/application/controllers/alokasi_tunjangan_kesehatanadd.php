<?php

class alokasi_tunjangan_kesehatanadd extends Controller {

	function alokasi_tunjangan_kesehatanadd()
	{
		parent::Controller();	

		$this->load->helper('form');
		$this->load->helper('url');
	}

	function index($id = 0)
	{
		$data = array();

		$data['karyawan_id'] = $id;
		$data['tunjangankesehatanallowance__date'] = '';
		$data['tunjangankesehatanallowance__description'] = '';
		$data['tunjangankesehatanallowance__amount'] = '';
		$data['tunjangankesehatanallowance__notes'] = '';
		$data['tunjangankesehatanallowance__lastupdate'] = '';
		$data['tunjangankesehatanallowance__updatedby'] = '';
		$data['tunjangankesehatanallowance__created'] = '';
		$data['tunjangankesehatanallowance__createdby'] = '';
		$karyawan = array();
		$this->db->where('id', $id);
		$q = $this->db->get('karyawan');
		if ($q->num_rows() > 0)
			$karyawan = $q->row_array();
		$data['tunjangankesehatanallowance__notes'] = $karyawan['notes'];
		$data['tunjangankesehatanallowance__lastupdate'] = $karyawan['lastupdate'];
		$data['tunjangankesehatanallowance__updatedby'] = $karyawan['updatedby'];
		$data['tunjangankesehatanallowance__created'] = $karyawan['created'];
		$data['tunjangankesehatanallowance__createdby'] = $karyawan['createdby'];


		$this->load->view('alokasi_tunjangan_kesehatan_add_form', $data);
	}

	function submit()
	{
		$error = "";


		if (isset($_POST['tunjangankesehatanallowance__date']) && ($_POST['tunjangankesehatanallowance__date'] == "" || $_POST['tunjangankesehatanallowance__date'] == null))
			$error .= "<span class='error'>Date must not be empty"."</span><br>";


		if ($error == "")
		{

			$data = array();
			$data['karyawan_id'] = $_POST['karyawan_id'];if (isset($_POST['tunjangankesehatanallowance__date']))
				$this->db->set('date', "str_to_date('".$_POST['tunjangankesehatanallowance__date']."', '%d-%m-%Y')", false);if (isset($_POST['tunjangankesehatanallowance__description']))
				$data['description'] = $_POST['tunjangankesehatanallowance__description'];if (isset($_POST['tunjangankesehatanallowance__amount']))
				$data['amount'] = $_POST['tunjangankesehatanallowance__amount'];if (isset($_POST['tunjangankesehatanallowance__notes']))
				$data['notes'] = $_POST['tunjangankesehatanallowance__notes'];
			$data['lastupdate'] = date('Y-m-d H:i:s');
			$data['updatedby'] = $this->session->userdata('user');
			$data['created'] = date('Y-m-d H:i:s');
			$data['createdby'] = $this->session->userdata('user');
			$this->db->insert('tunjangankesehatanallowance', $data);
			$this->session->set_userdata('last_insert_id', $this->db->insert_id());
			$tunjangankesehatanallowance_id = $this->db->insert_id();
			$this->load->library('generallib');
			$error .= $this->generallib->commonfunction('alokasi_tunjangan_kesehatanadd','tunjangankesehatanallowance','aftersave', $tunjangankesehatanallowance_id);


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