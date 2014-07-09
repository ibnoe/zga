<?php

class purchase_payment_line_viewadd extends Controller {

	function purchase_payment_line_viewadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$purchaseinvoice_opt = array();
$purchaseinvoice_opt[''] = 'None';
$q = $this->db->get('purchaseinvoice');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $purchaseinvoice_opt[$row->id] = $row->orderid; }
$data['purchaseinvoice_opt'] = $purchaseinvoice_opt;
$data['purchasepaymentline__purchaseinvoice_id'] = '';
$data['purchasepaymentline__lastupdate'] = '';
$data['purchasepaymentline__updatedby'] = '';
$data['purchasepaymentline__created'] = '';
$data['purchasepaymentline__createdby'] = '';
		

		$this->load->view('purchase_payment_line_view_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchasepaymentline__purchaseinvoice_id']))
$data['purchaseinvoice_id'] = $_POST['purchasepaymentline__purchaseinvoice_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('purchasepaymentline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchasepaymentline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_payment_line_viewadd','purchasepaymentline','aftersave', $purchasepaymentline_id);
			
		
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