<?php

class Capture_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->database();
	}
	var $table_capture = 'vall_capture';
	var $column_order_capture = array(null, 'ID','VIPCAM', 'VLOCATION_NAME', 'VLICENSEPLAT','DCREATED'); 
	var $column_search_capture = array('ID','VIPCAM', 'VLOCATION_NAME', 'VLICENSEPLAT','DCREATED'); 
	var $order_capture = array('ID'=> 'DESC'); 
	
	
	

	// AWAL capture
	private function _get_datatables_query_capture()
	{
		// $this->db->select('mtcapture.id');
		// $this->db->from('mtcapture');
		// $this->db->join('mtsetting', 'mtsetting.VIPCAM = mtcapture.VIPCAM');
		// $query = $this->db->get();
		$this->db->from($this->table_capture);

		$i = 0;
	
		foreach ($this->column_search_capture as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search_capture) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order_capture[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order_capture))
		{
			$order = $this->order_capture;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables_capture()
	{
		$this->_get_datatables_query_capture();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_capture()
	{
		$this->_get_datatables_query_capture();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_capture()
	{
		$this->db->from($this->table_capture);
		return $this->db->count_all_results();
	}

	public function get_total_truck()
	{
    	// $hariini = date('Y-m-d');
		$query = $this->db->query("
		select count(distinct VLICENSEPLAT) as TOTAL_TRUCK from cctv_db.mtcapture
		");
		return  $query->row_array();
	}

	public function get_total_location()
	{
    	// $hariini = date('Y-m-d');
		$query = $this->db->query("
		select count(VLOCATION_NAME) as TOTAL_LOCATION from cctv_db.mtsetting
		");
		return  $query->row_array();
	}

	public function get_data_ritase_today()
    {

		$query = $this->db->query("
		SELECT * 
		FROM VW_TARGET_CHART_RITASE
		ORDER BY FIELD(VLOCATION_NAME,'TARGET') DESC
		");
		return  $query->result();
    }

	public function get_data_tonase_today()
    {

		$query = $this->db->query("
		SELECT * 
		FROM VW_TARGET_CHART_TONASE
		ORDER BY FIELD(VLOCATION_NAME,'TARGET') DESC
		");
		return  $query->result();
    }

	public function get_target_chart_today()
    {

		$query = $this->db->query("
		SELECT 
			b.VLOCATION_NAME,
			a.VLICENSEPLAT,
			c.fvalue,
			a.DCREATED as time
		FROM cctv_db.mtcapture a
		LEFT JOIN cctv_db.mtsetting b on a.VIPCAM = b.VIPCAM
		LEFT JOIN cctv_db.mtweight c on a.ID = c.IDCAPTURE
		WHERE date(a.DCREATED) = CURDATE()
		");
		return  $query->result();
    }

	public function get_total_all_ritase_today ()
	{ 
		$query = $this->db->query("
		SELECT 
			sum(fvalue) AS ftotal_ritase  
		FROM vw_target_chart_ritase 
		");
		return  $query->row_array();
	}

	public function get_total_all_tonase_today ()
	{ 
		$query = $this->db->query("
		SELECT 
			sum(fvalue) AS ftotal_tonase 
		FROM vw_target_chart_tonase
		");
		return  $query->row_array();
	}


	public function get_total_hauler_ritase_today ()
	{ 
		$query = $this->db->query("
		SELECT
		count(DISTINCT VLICENSEPLAT) as fhauler
		FROM 
		mtcapture
		WHERE
		VIPCAM = '192.168.10.21' AND 
		DCREATED BETWEEN date_format(CURDATE(), '%Y-%m-%d 09:00:00') AND date_format(DATE_ADD(CURDATE(), INTERVAL 1 DAY), 		'%Y-%m-%d 	06:00:00')
		ORDER BY DCREATED DESC
		");
		return  $query->row_array();
	}

	public function get_total_hauler_tonase_today ()
	{ 
		$query = $this->db->query("
		SELECT
		count(DISTINCT VLICENSEPLAT) as fhauler
		FROM 
		mtcapture
		WHERE
		VIPCAM = '172.16.10.32' AND 
		DCREATED BETWEEN date_format(CURDATE(), '%Y-%m-%d 09:00:00') AND date_format(DATE_ADD(CURDATE(), INTERVAL 1 DAY), 		'%Y-%m-%d 	06:00:00')
		ORDER BY DCREATED DESC
		");
		return  $query->row_array();
	}


	public function count_lahat_in ()
	{ 
		$query = $this->db->query("
		SELECT COUNT(*) AS FCOUNT
		FROM `mtcapture` 
		where VIPCAM = '172.16.10.30' and date(DCREATED) = CURDATE()
		");
		return  $query->row_array();
	}

	public function count_lahat_out ()
	{ 
		$query = $this->db->query("
		SELECT COUNT(*) AS FCOUNT
		FROM `mtcapture` 
		where VIPCAM = '192.168.10.21' and DCREATED BETWEEN date_format(CURDATE(), '%Y-%m-%d 09:00:00') AND date_format(DATE_ADD(CURDATE(), INTERVAL 1 DAY), '%Y-%m-%d 	06:00:00')
		");
		return  $query->row_array();
	}

	public function count_sucin_in ()
	{ 
		$query = $this->db->query("
		SELECT COUNT(*) AS FCOUNT
		FROM `mtcapture` 
		where VIPCAM = '172.16.10.32' and date(DCREATED) = CURDATE()
		");
		return  $query->row_array();
	}

	public function count_sucin_out ()
	{ 
		$query = $this->db->query("
		SELECT COUNT(*) AS FCOUNT
		FROM `mtcapture` 
		where VIPCAM = '172.16.10.33' and date(DCREATED) = CURDATE()
		");
		return  $query->row_array();
	}

	public function count_hauling_inout ()
	{ 
		$query = $this->db->query("
		SELECT COUNT(*) AS FCOUNT
		FROM `mtcapture` 
		where VIPCAM = '172.16.10.34' and date(DCREATED) = CURDATE()
		");
		return  $query->row_array();
	}

	public function get_all_detail_today_by_location($temp)
    {
		// var_dump($tempt);
        $query = $this->db->query("
		SELECT 
			b.VLOCATION_NAME,
			a.VLICENSEPLAT,
			c.FVALUE,
			a.DCREATED
		FROM cctv_db.mtcapture a
		LEFT JOIN cctv_db.mtsetting b on a.VIPCAM = b.VIPCAM
		LEFT JOIN cctv_db.mtweight c on a.ID = c.IDCAPTURE
		WHERE b.ID = $temp and date(a.DCREATED) = CURDATE() 
		ORDER BY a.ID DESC
        ");
        return $query->result();
        
	}


	// public function insert_capture($add_created,$add_ad,$add_name)
    // {
       
	// 	$data_capture = array(
	// 		'VNAME'    => $add_name,
	// 		'VSTATUS'      		=> '1',
	// 		'VUSER'      	    => $add_ad,
	// 		'DCREATED'			=> $add_created
	// 	);
	// 	// var_dump($data_capture);
	// 	$insert_capture= $this->db->insert('capture',$data_capture);  
	// 	redirect('Admin/Master_controller/capture_index','refresh');
	// }

	// function show_all_departement(){
	// 	$data = array();
    //     $query = $this->db->query("
	// 	SELECT * FROM capture 
    //     ");
    //     if($query!==FALSE and $query->num_rows()>0)
    //     {
    //         foreach($query->result_array() as $row)
    //         {
    //             $data[] = $row;
    //         }
    //     }
    //     return $data;
    //     $query->free_result(); 
	// }

	// public function get_capture_by_id($id)
    // {
    //     $query = $this->db->query("select *from capture where ID = $id");
    //     return $query->row();
	// }

	// public function edit_capture($change_id,$change_departement,$change_status)
	// {
	// 	$update = $this->db->query("UPDATE capture SET VNAME = '$change_departement', VSTATUS = '$change_status' WHERE ID = '$change_id'");
	// 	redirect('Admin/Master_controller/capture_index','refresh');
	// }

	// public function delete_capture($delete_id,$delete_departement)
	// {
	// 	$delete = $this->db->query("DELETE FROM capture WHERE ID = '$delete_id'");
	// 	redirect('Admin/Master_controller/capture_index','refresh');
	// }


	// AKHIR capture

	

}
