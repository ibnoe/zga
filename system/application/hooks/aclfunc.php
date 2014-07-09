<?php



function check()
{
	$disable_groups_access = true;
	$ci =& get_instance();
	$ci->load->helper('url');
	
	$current_class = $ci->uri->rsegment(1);
	$current_method = $ci->uri->rsegment(2);
	$current_class_method = $current_class . "." . $current_method;
		
	if ($disable_groups_access)
	{
		$user = $ci->session->userdata('user');
		
		if ($user == null || $user == "")
		{
			if ($current_class_method != "login.index" &&
				$current_class_method != "heartbeat.index")
			{
				//echo $current_class_method;
				redirect("login/index");
			}
		}
		
		return;
	}
		
	$ci->db->where("funct", $current_class_method);
	$q = $ci->db->get("accessline");
		
	if ($q->num_rows() == 0)
	{
		$data['funct'] = $current_class_method;
		$data['name'] = $current_class . " " . $current_method;
		$ci->db->insert("accessline", $data);
			
		//echo $current_class_method." inserted.";
	}
	else
	{
		//echo $current_class_method;
	}
	//if ($current_class != "marketingmain")
		//redirect("login/index");
		
	$user = $ci->session->userdata('user');
		
	if ($user == null || $user == "")
	{
		if ($current_class_method != "login.index")
			redirect("login/index");
	}
	else
	{
		$q = $ci->db->get("accessline");
		
		foreach ($q->result_array() as $row)
		{
			$ci->db->where("username", $user);
			$qq = $ci->db->get("users");
			
			if ($qq->num_rows() > 0)
			{
				$group_id = $qq->row()->group_id;
				
				$ci->db->where("group_id", $group_id);
				$qqq = $ci->db->get("groupdetail");
				
				if ($qqq->num_rows() == 0)
				{
					//$ci->db->where("id", $group_id);
					$data['group_id'] = $group_id;
					$data['funct'] = $row['funct'];
					$data['name'] = $row['name'];
					$ci->db->insert("groupdetail", $data);
				}
				else
				{
					$found = false;
					foreach ($qqq->result_array() as $qqqrow)
					{
						if ($qqqrow['funct'] == $row['funct'])
						{
							$found = true;
							break;
						}
					}
					if (!$found)
					{
						$data['group_id'] = $group_id;
						$data['funct'] = $row['funct'];
						$data['name'] = $row['name'];
						$ci->db->insert("groupdetail", $data);
					}
				}
			}
		}
	}
		
}

function checkpost()
{
	//echo "hey";
		
}

function disp()
{
	$disable_groups_access = true;
	
	$ci =& get_instance();
	$current_class = $ci->uri->rsegment(1);
	$current_method = $ci->uri->rsegment(2);
	$current_class_method = $current_class . "." . $current_method;
	//echo $current_class;
	
	//echo "XX";
	if ($current_class == "login")
	{
		echo $ci->output->get_output();
		return;
	}
	
	$user = $ci->session->userdata('user');
		
	if ($user == null || $user == "")
	{
		echo "";
	}
	else if ($disable_groups_access)
	{
		echo $ci->output->get_output();
	}
	else
	{
		$ci->db->where("username", $user);
		$q = $ci->db->get("users");
		
		if ($q->num_rows() > 0)
		{
			$group_id = $q->row()->group_id;
			
			$ci->db->where("group_id", $group_id);
			$ci->db->where("funct", $current_class_method);
			$qq = $ci->db->get("groupdetail");
			
			if ($qq->num_rows() > 0 && $qq->row()->haveaccess)
			{
				echo $ci->output->get_output();
			}
			else
				echo "";
		}
		else
			echo "";
		
	}
	
	//echo $ci->output->get_output();
}
	
?>