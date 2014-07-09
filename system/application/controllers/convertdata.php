<?php

class convertdata extends Controller {

	function convertdata()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($fromtable, $fromtable_id, $totable, $fromtableline='', $totableline='')
	{
		$this->db->where("id", $fromtable_id);
		$q = $this->db->get($fromtable);
		
		foreach ($q->result_array() as $row)
		{
			$fields = $this->db->list_fields($fromtable);

			foreach ($fields as $field)
			{
				if ($field != "id" && $this->db->field_exists($field, $totable))
				{
					$data[$field] = $row[$field];
				}
			}
			
			$data[$fromtable."_id"] = $row['id'];
		}
		
		if (count($data) > 0)
		{
			$this->db->insert($totable, $data);
			$totable_id = $this->db->insert_id();
			
			$data = array();
			
			if ($fromtableline != '')
			{
				$this->db->where($fromtable."_id", $fromtable_id);
				$q = $this->db->get($fromtableline);
				
				foreach ($q->result_array() as $row)
				{
					$fields = $this->db->list_fields($fromtableline);

					foreach ($fields as $field)
					{
						if ($field != "id" && $this->db->field_exists($field, $totableline))
						{
							$data[$field] = $row[$field];
						}
					}
					
					$data[$totable."_id"] = $totable_id;
				}
				
				if (count($data) > 0)
				{
					$this->db->insert($totableline, $data);
				}
			}
		}
	}
}
?>