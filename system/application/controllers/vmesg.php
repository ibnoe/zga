<?php

class vmesg extends Controller {

	function vmesg()
	{
		parent::Controller();	
		
		$this->load->helper('url');
	}
	
	function index()
	{
		$this->load->library('generallib');
		//$arr = $this->generallib->commonfunction('purchase_order_lineadd','purchaseorderline','aftersave', 1);
		//$arr = $this->generallib->callGetVMesg();

		//print_r($arr);
		
		$user = $this->session->userdata('user');
		
		if ($user != null && $user != "")
		{
			$this->db->where("createdby", $user);
			$this->db->where("alreadyread", false);
			$q = $this->db->get("vmessagenotification");
			
			if ($q->num_rows() > 0)
			{
				echo "<div >";
				echo '<table id="msgtable">';
				foreach ($q->result() as $row)
				{
					echo "<tr>";
					echo "<td>";
					echo $row->summary;
					echo "</td>";
					echo "<td>";
					echo $row->message;
					echo "</td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "</div>";
				
				foreach ($q->result() as $row)
				{
					$this->db->where("id", $row->id);
					$data['alreadyread'] = true;
					$this->db->update("vmessagenotification", $data);
				}
			}
		}
	}
}

?>