<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mbg extends CI_Model {

	function add_to_db($table, $data)
	{
	    $this->db->insert($table,$data);		
	    $insert_id = $this->db->insert_id();
    	return $insert_id;
	}

	function update_to_db($table, $data, $where, $valuewhere)
	{
	    $this->db->where($where, $valuewhere);
			return $this->db->update($table, $data);
	}

	function delete_to_db($table, $where, $valuewhere)
	{
		$this->db->where($where, $valuewhere);
    $this->db->delete($table);
	}
	function getWhere($table, $data)
	{
		return $this->db->get_where($table,$data)->row_array();
	}

	function getWhereList($table, $data)
	{
		return $this->db->get_where($table,$data)->result_array();
	}

	function getWhereOrderByLimit($table, $data, $limit, $order, $valueOrder)
	{
		$this->db->order_by($order, $valueOrder); 
		$this->db->limit($limit);
		return $this->db->get_where($table, $data)->row_array(); 
	}

	function getAllData($table)
	{
		return $this->db->get($table)->result_array(); 
	}

	function getAllMasterWhereOneCondition($table, $where, $valuewhere)
	{
		return $this->db->query("SELECT * FROM $table where $where='$valuewhere'")->result_array();
	}

	function getAllMasterWhereOneConditionLIKE($table, $where, $valuewhere)
	{
		return $this->db->query("SELECT * FROM $table where $where LIKE '%$valuewhere%'")->result_array();
	}
	function checkUserExist($nik, $handphone)
	{
		return $this->db->query("SELECT * FROM user WHERE (nik='$nik' OR handphone = '$handphone')")->num_rows();
	}

	function getParameter($namaParameter)
	{
		$result = "";
        $a = $this->db->query("SELECT * FROM parameter where nama_parameter='$namaParameter'")->row_array();
        if ($a){
          $result = $a['value_parameter'];
    	}
    	return $result;
	}

	function add_log_history($nama, $deskripsi)
	{
		$localIP = getHostByName(getHostName());
   		ob_start();  
   		// system('ipconfig /all');  
   		$configdata=ob_get_contents();  
   		ob_clean(); 
	    $mac = "Physical";  
	    $pmac = strpos($configdata, $mac);
   		$macaddr=substr($configdata,($pmac+36),17);  
	    $browserName =  $_SERVER['HTTP_USER_AGENT'];
	    

		$data = [
			'nik' => $nama,
			'ipaddress' => $localIP,
			'macaddress' => $macaddr,
			'browser' => $browserName,
			'action' => $deskripsi
		];

		$this->db->insert('log_history',$data);		
		$insert_id = $this->db->insert_id();
    return $insert_id;
	}
	
	function get_order_booking($where, $valuewhere)
	{
		$query = "SELECT
					  ob.id_order_booking,
					  ob.id_user,
  					  ob.id_master_kelas,
					  ob.time_history,
					  ob.metode_bayar,
					  ob.status_order,
					  ob.status_certificate,
					  us.nama_lengkap,
  					  us.handphone,
					  mk.nama_kelas,
					  mk.deskripsi_kelas,
					  mk.foto_kelas
					FROM
					  (SELECT
					    *
					  FROM
					    order_booking
					  WHERE $where = '$valuewhere') ob,
					  (SELECT
					    id_user,
					    nama_lengkap,
					    handphone
					  FROM
					    user) us,
					  (SELECT * FROM master_kelas) mk
					  WHERE ob.id_master_kelas = mk.id_master_kelas AND ob.id_user = us.id_user
					  ORDER BY ob.time_history DESC
					";
		return $this->db->query($query)->result_array();
	}

	function get_order_booking_list_kelas($where, $valuewhere)
	{
		$query = "SELECT
					  ob.id_order_booking,
					  ob.id_user,
  					  ob.id_master_kelas,
					  ob.time_history,
					  ob.metode_bayar,
					  ob.status_order,
					  ob.status_certificate,
					  us.nama_lengkap,
					  us.handphone,
					  us.reference,
					  us.pic,
					  us.angkatan,
					  ob.list_kelas
					FROM
					  (SELECT
					    *
					  FROM
					    order_booking
					  WHERE $where = '$valuewhere') ob,
					  (SELECT
					    id_user,
					    nama_lengkap,
					    handphone,
					    reference,
						  pic,
						  angkatan
					  FROM
					    user) us
					  WHERE ob.id_user = us.id_user
					  ORDER BY ob.time_history DESC
					";
		return $this->db->query($query)->result_array();
	}

	function get_order_booking_not_approve($where, $valuewhere)
	{
		$query = "SELECT
					  ob.id_order_booking,
					  ob.id_user,
  					ob.id_master_kelas,
					  ob.time_history,
					  ob.metode_bayar,
					  ob.status_order,
					  ob.status_certificate,
					  us.nama_lengkap,
					  us.handphone,
					  us.reference,
					  us.pic,
					  us.angkatan,
					  ob.list_kelas
					FROM
					  (SELECT
					    *
					  FROM
					    order_booking
					  WHERE $where = '$valuewhere' AND status_certificate = 'P') ob,
					  (SELECT
					    id_user,
					    nama_lengkap,
					    handphone,
					    reference,
						  pic,
						  angkatan
					  FROM
					    user) us
					  WHERE ob.id_user = us.id_user
					  ORDER BY ob.time_history DESC
					";
		return $this->db->query($query)->result_array();
	}

	function get_order_booking_approved($where, $valuewhere)
	{
		$query = "SELECT
					  ob.id_order_booking,
					  ob.id_user,
  					ob.id_master_kelas,
					  ob.time_history,
					  TIMESTAMPDIFF(MINUTE, ob.time_history, NOW()) AS minutes_since,
					  ob.metode_bayar,
					  ob.status_order,
					  ob.status_certificate,
					  us.nama_lengkap,
					  us.handphone,
					  us.reference,
					  us.pic,
					  us.angkatan,
					  ob.list_kelas
					FROM
					  (SELECT
					    *
					  FROM
					    order_booking
					  WHERE $where = '$valuewhere' AND status_certificate = 'A') ob,
					  (SELECT
					    id_user,
					    nama_lengkap,
					    handphone,
					    reference,
						  pic,
						  angkatan
					  FROM
					    user) us
					  WHERE ob.id_user = us.id_user
					  ORDER BY ob.time_history DESC
					";
		return $this->db->query($query)->result_array();
	}
	
	function get_order_booking_valid($id_user, $id_order_booking)
	{
		$query = "SELECT
					  ob.id_order_booking,
					  ob.id_user,
  					  ob.id_master_kelas,
					  ob.time_history,
					  ob.metode_bayar,
					  ob.status_order,
					  ob.list_kelas,
					  ob.status_certificate,
					  ob.angkatan_kelas,
					  ob.is_paid,
					  us.nama_lengkap,
  					us.handphone,
  					us.reference,
					  us.pic,
					  us.angkatan,
					  us.foto_ktp,
					  us.is_new_user
					FROM
					  (SELECT
					    *
					  FROM
					    order_booking
					  WHERE id_user = '$id_user' AND id_order_booking='$id_order_booking') ob,
					  (SELECT
					    id_user,
					    nama_lengkap,
					    handphone,
					    reference,
						  pic,
						  angkatan,
						  foto_ktp,
						  is_new_user
					  FROM
					    user) us
					  WHERE ob.id_user = us.id_user
					";
		return $this->db->query($query)->row_array();
	}

	function get_count_order_payment_status($id_order_booking)
	{
		$query = "SELECT
					  id_order_booking,
					  status_payment
					FROM
					  order_payment
					WHERE id_order_booking = '$id_order_booking'
					GROUP BY status_payment";
		return $this->db->query($query)->result_array();
	}

	function get_detail_certificate($id_user, $id_order_booking)
	{
		$query = "SELECT
					  ac.*,
					  us.nama_lengkap,
					  mk.nama_kelas,
  					  mk.foto_sertifikat,
  					  mk.prefix_certificate
					FROM
					  (SELECT
					    *
					  FROM
					    approve_cetificate
					  WHERE id_user = '$id_user'
					    AND id_order_booking = '$id_order_booking') AS ac,
					   (SELECT * FROM user) us,
  					 (SELECT * FROM master_kelas) mk,
  					 (SELECT
							    *
							  FROM
							    order_booking) ob
							WHERE ac.id_user = us.id_user
							  AND ac.id_master_kelas = mk.id_master_kelas
							  AND ac.id_order_booking = ob.id_order_booking
							  AND FIND_IN_SET(
							    ac.id_master_kelas,
							    REPLACE(ob.list_kelas, '~', ',')
							  ) > 0";
		return $this->db->query($query)->result_array();
	}
	function get_log_history($nik,$action, $time_history)
	{
		$query = "SELECT * FROM log_history";
		if($nik != "" || $action != "" || $time_history != "" ){
				$query = $query . " WHERE time_history >= '$time_history'";
		}
		if($nik != ""){
			  $query = $query . " AND nik LIKE '%$nik%'";
		}
		if($action != ""){
			  $query = $query . " AND action LIKE '%$action%'";
		}
		return $this->db->query($query)->result_array();
	}
	function get_report($nama_peserta, $time_history, $id_master_kelas, $status_sertifikat, $status_lunas, $reference, $pic, $angkatan)
	{
		$query = "SELECT
							  temp.*,
							  us.nik,
							  us.email,
							  us.nama_lengkap,
							  us.handphone,
							  us.usia,
							  us.asal_kampus,
							  us.semester,
							  us.nik,
							  us.reference,
							  us.pic,
							  us.angkatan,
							  op.id_virtual_account,
							  op.sequence_payment,
							  op.nominal_payment,
							  op.date_payment,
							  op.status_payment
							FROM
							  (SELECT
							    ob.id_order_booking,
							    ob.time_history,
							    ob.id_user,
							    ob.metode_bayar,
							    ob.status_order,
							    ob.status_certificate,
							    ob.list_kelas,
							    
							    IFNULL(GROUP_CONCAT(
							      DISTINCT ac.number_certificate
							      ORDER BY mk.nama_kelas SEPARATOR ', '
							    ),'') AS number_certificate,
							    
							    GROUP_CONCAT(
							      DISTINCT mk.nama_kelas
							      ORDER BY mk.nama_kelas SEPARATOR ', '
							    ) AS nama_kelas,
							    GROUP_CONCAT(
							      DISTINCT mk.deskripsi_kelas
							      ORDER BY mk.deskripsi_kelas SEPARATOR ', '
							    ) AS deskripsi_kelas,
							    GROUP_CONCAT(
							      DISTINCT mk.link_group_wa
							      ORDER BY mk.link_group_wa SEPARATOR ', '
							    ) AS link_group_wa
							   FROM
							    order_booking ob
							    LEFT JOIN master_kelas mk
							      ON FIND_IN_SET(
							        mk.id_master_kelas,
							        REPLACE(ob.list_kelas, '~', ',')
							      ) > 0
							    LEFT JOIN approve_cetificate ac
							      ON ac.id_master_kelas = mk.id_master_kelas
							      AND ob.id_user = ac.id_user
							      AND FIND_IN_SET(
							        ac.id_master_kelas,
							        REPLACE(ob.list_kelas, '~', ',')
							      ) > 0
							  GROUP BY ob.id_order_booking,
							    ob.time_history,
							    ob.id_user,
							    ob.metode_bayar,
							    ob.status_order,
							    ob.status_certificate,
							    ob.list_kelas
							  ) AS temp,
							  (SELECT * FROM user us) AS us,
							  (SELECT * FROM order_payment op) AS op
							WHERE
								us.id_user = temp.id_user
								AND op.id_order_booking = temp.id_order_booking
							  AND us.id_user IS NOT NULL
							  AND op.id_order_booking IS NOT NULL";

		if($nama_peserta != ""){
			$query = $query . " AND us.nama_lengkap LIKE '%$nama_peserta%'";
		}

		if($reference != ""){
			$query = $query . " AND us.reference LIKE '%$reference%'";
		}

		if($pic != ""){
			$query = $query . " AND us.pic LIKE '%$pic%'";
		}

		if($angkatan != ""){
			$query = $query . " AND us.angkatan LIKE '%$angkatan%'";
		}

		if($time_history != ""){
			$query = $query . " AND temp.time_history >= '$time_history'";
		}

		if($id_master_kelas != ""){
			$query = $query . " AND FIND_IN_SET(
        $id_master_kelas,
        REPLACE(temp.list_kelas, '~', ',')
      ) > 0";
		}
		if($status_lunas != ""){
			$query = $query . " AND temp.status_order = '$status_lunas'";
		}

		if($status_sertifikat != ""){
			$query = $query . " AND temp.status_certificate = '$status_sertifikat'";
		}
		$query = $query . " ORDER BY temp.id_user ASC, temp.id_order_booking ASC";

		return $this->db->query($query)->result_array();
	}

	function get_report_kta($nama_peserta, $pic, $angkatan, $jenis_kta)
	{
			$query = "SELECT
								  us.nik,
								  us.email,
								  us.nama_lengkap,
								  us.handphone,
								  us.usia,
								  us.asal_kampus,
								  us.pic,
								  us.angkatan,
								  us.foto_ktp,
								  ac.number_certificate
								  
								FROM
								  (SELECT
								    id_user, number_certificate
								  FROM
								    approve_cetificate
								  WHERE id_master_kelas = '$jenis_kta') AS ac,
								  (SELECT
								    *
								  FROM
								    user) us
								WHERE ac.id_user = us.id_user AND us.user_level > 3
								";

			if($nama_peserta != ""){
				$query = $query . " AND us.nama_lengkap LIKE '%$nama_peserta%'";
			}

			if($pic != ""){
				$query = $query . " AND us.pic LIKE '%$pic%'";
			}

			if($angkatan != ""){
				$query = $query . " AND us.angkatan LIKE '%$angkatan%'";
			}

			$query = $query . " ORDER BY CAST(ac.number_certificate AS UNSIGNED) DESC";

			return $this->db->query($query)->result_array();
		}

	function show_cart($id_user)
	{
		$query = "SELECT
				  c.*,
				  m.nama_kelas
				FROM
				  (SELECT
				    *
				  FROM
				    cart) c,
				  (SELECT
				    id_master_kelas,
				    nama_kelas
				  FROM
				    master_kelas) m
				WHERE c.id_master_kelas = m.id_master_kelas
				  AND c.id_user = '$id_user'";
		return $this->db->query($query)->result_array();
	}

	function get_name_kelas_list($list_id)
	{
		$array = explode("~", $list_id);
		$array = array_filter($array, function($value) {
		    return $value !== '';
		});
		$inClause = implode(",", $array);
		$query = "SELECT GROUP_CONCAT(nama_kelas)AS nama_kelas , GROUP_CONCAT(id_master_kelas)AS id_master_kelas , foto_kelas, GROUP_CONCAT(is_sumpah) AS is_sumpah  FROM master_kelas WHERE id_master_kelas IN ($inClause)";
		return $this->db->query($query)->row_array();
	}

	function getDetailQRCode($idUser, $idOrder)
	{
			$query= "SELECT
							  ob.id_order_booking,
							  ob.time_history,
							  ob.id_order_booking,
							  ob.status_order,
							  ob.status_certificate,
							  us.email,
							  us.nama_lengkap,
							  us.handphone,
							  ac.number_certificate
							FROM
							  (SELECT
							    *
							  FROM
							    order_booking) ob,
							  (SELECT
							    *
							  FROM
							    approve_cetificate) ac,
							  (SELECT
							    *
							  FROM
							    user) us
							WHERE ob.id_user = us.id_user
							  AND ob.id_order_booking = ac.id_order_booking
				  AND ob.id_order_booking = '$idOrder'
				  AND ob.id_user = '$idUser' GROUP BY ac.number_certificate";
			return $this->db->query($query)->row_array();
	}

	function getColumnTableAll($column_name)
	{
			$database = $this->db->database;
			$query= "SELECT 
				    TABLE_NAME AS table_name, 
				    COLUMN_NAME AS column_name 
				FROM 
				    information_schema.columns 
				WHERE 
				    TABLE_SCHEMA = '$database' AND COLUMN_NAME = '$column_name'
				ORDER BY 
				    TABLE_NAME, 
				    ORDINAL_POSITION;
				";
			return $this->db->query($query)->result_array();
	}

	function getListHistoryCall($where = null, $valuewhere = null, $id_user = null)
	{
		 $queryWhere = '';
		 if($valuewhere === "showSampah"){
		 		$queryWhere = "WHERE hc.is_deleted='Y'";
		 }else if($valuewhere === ""){
		 		$queryWhere = "WHERE hc.is_deleted='N'";
		 }else if($where == "query" && $valuewhere !== "showSampah"){
		 		$queryWhere = "WHERE (hc.is_deleted='Y' OR hc.is_deleted='N') ";
		 }
		 $query = "SELECT 
								    hc.*, 
								    op.id_virtual_account 
								FROM 
								    (SELECT 
								         hc.*,
								         TIMESTAMPDIFF(SECOND, hc.last_call, NOW()) AS seconds_since_last_call,
								         TIMESTAMPDIFF(MINUTE, hc.last_call, NOW()) AS minutes_since_last_call,
								         TIMESTAMPDIFF(HOUR, hc.last_call, NOW()) AS hours_since_last_call,
								         us.nama_lengkap,
								         us.foto_ktp
								     FROM 
								         history_call_center AS hc
								     INNER JOIN 
								         user AS us 
								         ON hc.id_user = us.id_user
								    ) AS hc
								LEFT JOIN 
								    (SELECT 
								         us.id_user,
								         us.handphone,
								         MAX(ap.id_virtual_account) AS id_virtual_account
								     FROM 
								         user AS us
								     INNER JOIN 
								         order_booking AS ob 
								         ON us.id_user = ob.id_user
								     INNER JOIN 
								         order_payment AS ap 
								         ON ob.id_order_booking = ap.id_order_booking
								     GROUP BY 
								         us.id_user, us.handphone
								    ) AS op 
								ON 
								    hc.customer_phone COLLATE utf8mb4_general_ci = op.handphone
								    OR hc.customer_phone COLLATE utf8mb4_general_ci = CONCAT('62', SUBSTRING(op.handphone, 2))
							  $queryWhere ";

		 if($where == "id"){
	   		$query = $query . " WHERE hc.id_history_call_center='$valuewhere'";
	   }
		 if($id_user != null){
		 			$query = $query . " AND hc.id_user='$id_user'";
		 }
	   if($where == "query" && $valuewhere !== "showSampah"){
	   		$query = $query . " AND (hc.nama_lengkap LIKE '%$valuewhere%'
									  OR hc.customer_name LIKE '%$valuewhere%'
									  OR hc.customer_phone LIKE '%$valuewhere%')";
	   }
	  
	   $query = $query . " ORDER BY hc.priority DESC, hc.time_history DESC";
		 return $this->db->query($query)->result_array();

	}

	function getListHistoryCallFirst($where = null, $valuewhere = null, $id_user = null)
	{
		 $queryWhere = '';
		 if($valuewhere === "showSampah"){
		 		$queryWhere = "WHERE hc.is_deleted='Y'";
		 }else if($valuewhere === ""){
		 		$queryWhere = "WHERE hc.is_deleted='N'";
		 }else if($where == "query" && $valuewhere !== "showSampah"){
		 		$queryWhere = "WHERE (hc.is_deleted='Y' OR hc.is_deleted='N') ";
		 }
		 $query = "SELECT 
								    hc.*, 
								    op.id_virtual_account 
								FROM 
								    (SELECT 
								         hc.*,
								         TIMESTAMPDIFF(SECOND, hc.last_call, NOW()) AS seconds_since_last_call,
								         TIMESTAMPDIFF(MINUTE, hc.last_call, NOW()) AS minutes_since_last_call,
								         TIMESTAMPDIFF(HOUR, hc.last_call, NOW()) AS hours_since_last_call,
								         us.nama_lengkap,
								         us.foto_ktp
								     FROM 
								         history_call_center AS hc
								     INNER JOIN 
								         user AS us 
								         ON hc.id_user = us.id_user
								    ) AS hc
								LEFT JOIN 
								    (SELECT 
								         us.id_user,
								         us.handphone,
								         MAX(ap.id_virtual_account) AS id_virtual_account
								     FROM 
								         user AS us
								     INNER JOIN 
								         order_booking AS ob 
								         ON us.id_user = ob.id_user
								     INNER JOIN 
								         order_payment AS ap 
								         ON ob.id_order_booking = ap.id_order_booking
								     GROUP BY 
								         us.id_user, us.handphone
								    ) AS op 
								ON 
								    hc.customer_phone COLLATE utf8mb4_general_ci = op.handphone
								    OR hc.customer_phone COLLATE utf8mb4_general_ci = CONCAT('62', SUBSTRING(op.handphone, 2))
							  $queryWhere ";

		 if($where == "id"){
	   		$query = $query . " WHERE hc.id_history_call_center='$valuewhere'";
	   }
		 if($id_user != null){
		 			$query = $query . " AND hc.id_user='$id_user'";
		 }
	   if($where == "query" && $valuewhere !== "showSampah"){
	   		$query = $query . " AND (hc.nama_lengkap LIKE '%$valuewhere%'
									  OR hc.customer_name LIKE '%$valuewhere%'
									  OR hc.customer_phone LIKE '%$valuewhere%')";
	   }
	  
	   $query = $query . " ORDER BY hc.priority DESC, hc.time_history DESC LIMIT 50";
		 return $this->db->query($query)->result_array();

	}

	function getChatWhatsappOfficial($dateToday = null)
	{	
			$whereDate = "";
			if($dateToday != null){
					$whereDate = " WHERE
					      DATE(time_history) = '$dateToday' ";
			}
			$query= "SELECT
					  cw.id_chat_whatsapp,
					  cw.time_history,
					  cw.sender,
					  COALESCE(NULLIF(cw.name, ''), 'Wa Customer') AS name,
					  hc.customer_phone,
					  hc.nama_lengkap
					FROM
					  (
					    SELECT
					      id_chat_whatsapp,
					      sender,
					      name,time_history
					    FROM
					      chat_whatsapp
					    $whereDate
					    GROUP BY sender
					  ) cw
					LEFT JOIN
					  (
					    SELECT
					      hc.customer_phone,
					      hc.last_call,
					      us.nama_lengkap
					    FROM
					      history_call_center hc
					    INNER JOIN user us ON hc.id_user = us.id_user
					  ) hc
					ON cw.sender = 
					  CASE 
					    WHEN SUBSTRING(hc.customer_phone, 1, 1) = '0' 
					    THEN CONCAT('62', SUBSTRING(hc.customer_phone, 2))
					    ELSE hc.customer_phone
					  END
					ORDER BY cw.time_history DESC";
			return $this->db->query($query)->result_array();
	}

	function getAllMarketing($id_user = null)
	{	
			$query= 'SELECT id_user, nama_lengkap FROM user WHERE is_marketing = "Y"';
			if($id_user != null){
		 			$query = $query . " AND id_user='$id_user'";
		 	}
			return $this->db->query($query)->result_array();
	}

	function getGroupMarketingCall($id_user = null, $type_group = null, $searchDate = null)
	{
		 $query = "SELECT
							  hc.*,
							  op.id_virtual_account
							FROM
							  (SELECT
							    hc.*,
							    TIMESTAMPDIFF(SECOND, hc.last_call, NOW()) AS seconds_since_last_call,
							    TIMESTAMPDIFF(MINUTE, hc.last_call, NOW()) AS minutes_since_last_call,
							    TIMESTAMPDIFF(HOUR, hc.last_call, NOW()) AS hours_since_last_call,
							    us.nama_lengkap,
							    us.foto_ktp
							  FROM
							    history_call_center AS hc
							    INNER JOIN user AS us
							      ON hc.id_user = us.id_user) AS hc
							  LEFT JOIN
							    (SELECT
							      us.id_user,
							      us.handphone,
							      ap.id_virtual_account
							    FROM
							      user AS us
							      INNER JOIN order_booking AS ob
							        ON us.id_user = ob.id_user
							      INNER JOIN order_payment AS ap
							        ON ob.id_order_booking = ap.id_order_booking GROUP BY ob.id_order_booking) AS op
							    ON (hc.customer_phone COLLATE utf8mb4_general_ci = op.handphone
    								OR hc.customer_phone COLLATE utf8mb4_general_ci = CONCAT('62', SUBSTRING(op.handphone, 2))) ";
		 if($id_user != null && $type_group == null){
		 			$query = $query . " WHERE hc.id_user='$id_user'";
		 }else if($id_user == null && $type_group != null){
		 			$query = $query . " WHERE hc.type_group='$type_group'";
		 }else if($id_user != null && $type_group != null){
		 			$query = $query . " WHERE hc.id_user='$id_user' AND hc.type_group='$type_group'";
		 }
	   
	   if($searchDate != null){
		 			$query = $query . " AND DATE(hc.time_history) = '$searchDate'";
		 }
		  // Add GROUP BY clause to group by id_history_call_center
    	$query = $query . " GROUP BY hc.id_history_call_center"; 

    	// Add ORDER BY clause to order by priority and time
    	$query = $query . " ORDER BY hc.priority DESC, hc.time_history DESC";

		 return $this->db->query($query)->result_array();

	}

	function getLogicCSDB($dateToday)
	{	
			$query = "SELECT * FROM logic_cs WHERE DATE(time_history) = '$dateToday' ORDER BY time_history DESC";
			return $this->db->query($query)->result_array();
	}

	function getAllPaymentSendNotif()
	{	
			$query= "SELECT 
							    op.*,
							    ob.list_kelas,
							    us.nama_lengkap,
							    us.handphone,
								us.email,
							    GROUP_CONCAT(DISTINCT mk.nama_kelas ORDER BY mk.nama_kelas SEPARATOR ', ') AS nama_kelas,
							    ob.metode_bayar
							FROM 
							    order_payment op
							INNER JOIN 
							    order_booking ob ON op.id_order_booking = ob.id_order_booking
							INNER JOIN 
							    user us ON ob.id_user = us.id_user
							LEFT JOIN 
							    master_kelas mk ON FIND_IN_SET(mk.id_master_kelas, REPLACE(ob.list_kelas, '~', ',')) > 0
							WHERE 
							    op.status_payment = 'P' 
							    AND (
							        op.date_payment BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 3 DAY)
							        OR op.date_payment <= CURDATE()
							    )
							GROUP BY 
							    op.id_order_payment  -- Assuming each payment has a unique ID
							ORDER BY 
							    op.date_payment DESC;
							";
			return $this->db->query($query)->result_array();
	}

	function clearPaymentExpiredAfterGenerated($interval)
	{
			return $this->db->query("DELETE FROM order_payment
			WHERE status_payment = 'G' 
			  AND time_history < DATE_SUB(NOW(), INTERVAL $interval DAY)
			");
	}

	function clearWhatsappTemp($interval)
	{
			return $this->db->query("DELETE
			FROM
			  chat_whatsapp_temp
			WHERE time_history < DATE_SUB(NOW(),
			  INTERVAL $interval DAY) ORDER BY time_history DESC");
	}

	function get_report_payment_order($datefrom, $datethru,$name_peserta, $status)
	{
		$query = "SELECT 
						ob.id_order_booking, 
						ob.id_user, 
						ob.id_master_kelas, 
						ob.time_history, 
						ob.metode_bayar, 
						ob.status_order, 
						ob.status_certificate, 
						ob.is_paid, 
						us.nama_lengkap, 
						us.handphone, 
						us.reference, 
						us.pic, 
						REPLACE(REPLACE(ob.angkatan_kelas, 'angkatan', 'Angkatan'), '~', ',') AS angkatan_kelas,
						ob.list_kelas, 
						GROUP_CONCAT(DISTINCT mk.nama_kelas ORDER BY mk.nama_kelas SEPARATOR ', ') AS nama_kelas
					FROM 
						order_booking ob
					LEFT JOIN 
						master_kelas mk ON FIND_IN_SET(mk.id_master_kelas, REPLACE(ob.list_kelas, '~', ',')) > 0
					JOIN 
						user us ON ob.id_user = us.id_user
					WHERE ob.time_history >= '$datefrom' 
    						AND ob.time_history <= '$datethru'";

					if($name_peserta != null){
						$query = $query . " AND us.nama_lengkap LIKE '%$name_peserta%'";
					}

					if($status != null){
						$query = $query . " AND ob.is_paid = '$status'";
					}

					$query = $query. " GROUP BY 
						ob.id_order_booking, ob.id_user, ob.id_master_kelas, ob.time_history, ob.metode_bayar, 
						ob.status_order, ob.status_certificate, ob.is_paid, us.nama_lengkap, us.handphone, 
						us.reference, us.pic";
		return $this->db->query($query)->result_array();
	}

	function get_report_process_exam($datefrom, $datethru,$name_peserta, $id_master_kelas, $id_user = null)
	{
		$query = "SELECT 
						ob.id_order_booking, 
						ob.id_user, 
						ob.id_master_kelas, 
						ob.time_history, 
						ob.metode_bayar, 
						ob.status_order, 
						ob.status_certificate, 
						ob.is_paid, 
						us.nama_lengkap, 
						us.handphone, 
						us.reference, 
						us.pic, 
						REPLACE(REPLACE(ob.angkatan_kelas, 'angkatan', 'Angkatan'), '~', ',') AS angkatan_kelas,
						ob.list_kelas, 
						GROUP_CONCAT(DISTINCT mk.nama_kelas ORDER BY mk.nama_kelas SEPARATOR ', ') AS nama_kelas
					FROM 
						order_booking ob
					LEFT JOIN 
						master_kelas mk ON FIND_IN_SET(mk.id_master_kelas, REPLACE(ob.list_kelas, '~', ',')) > 0
					JOIN 
						user us ON ob.id_user = us.id_user";
					if($datefrom != null && $datethru != null){
						$query = $query . " WHERE ob.time_history >= '$datefrom' 
    						AND ob.time_history <= '$datethru'";
					}

					if($name_peserta != null){
						$query = $query . " AND us.nama_lengkap LIKE '%$name_peserta%'";
					}

					if($id_master_kelas != null){
						$query = $query . " AND ob.list_kelas LIKE '%~$id_master_kelas~%'";
					}

					if($id_user != null){
						$query = $query . " WHERE ob.id_user = '$id_user'";
					}

					$query = $query. " GROUP BY 
						ob.id_order_booking, ob.id_user, ob.id_master_kelas, ob.time_history, ob.metode_bayar, 
						ob.status_order, ob.status_certificate, ob.is_paid, us.nama_lengkap, us.handphone, 
						us.reference, us.pic";
		return $this->db->query($query)->result_array();
	}

	function getAllDataMateriKelas($id_master_kelas = null, $angkatan = null){
		$query= "SELECT * FROM `materi_kelas` mk INNER JOIN master_kelas ms ON mk.id_master_kelas = ms.id_master_kelas";
		if($id_master_kelas != null){
			$query = $query . " AND mk.id_master_kelas = '$id_master_kelas'";
		}
		if($angkatan != null){
			$query = $query . " AND mk.angkatan = '$angkatan'";
		}
		$query = $query . " ORDER BY date_field ASC, waktu ASC";
		return $this->db->query($query)->result_array();
	}

}