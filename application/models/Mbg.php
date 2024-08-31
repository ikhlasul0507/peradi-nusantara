<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mbg extends CI_Model {

	function add_to_db($table, $data)
	{
	    return $this->db->insert($table,$data);		
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
	function checkUserExist($nik, $handphone)
	{
		return $this->db->query("SELECT * FROM USER WHERE (nik='$nik' OR handphone = '$handphone')")->num_rows();
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

	function add_log_history($data)
	{
		$localIP = getHostByName(getHostName());
   		ob_start();  
   		system('ipconfig /all');  
   		$configdata=ob_get_contents();  
   		ob_clean(); 
	    $mac = "Physical";  
	    $pmac = strpos($configdata, $mac);
   		$macaddr=substr($configdata,($pmac+36),17);  
	    $browserName =  $_SERVER['HTTP_USER_AGENT'];
	    
		$data = [
			'nik' => $data['nik'],
			'ipaddress' => $localIP,
			'macaddress' => $macaddr,
			'browser' => $browserName,
			'action' => $data['action']
		];
		return $this->db->insert('log_history',$data);		
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
					    handphone
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
					  us.nama_lengkap,
  					us.handphone,
  					us.reference,
					  us.pic,
					  us.angkatan
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
						  angkatan
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
					   (SELECT * FROM USER) us,
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
					    GROUP_CONCAT(
					      mk.nama_kelas
					      ORDER BY mk.nama_kelas SEPARATOR ', '
					    ) AS nama_kelas,
					    GROUP_CONCAT(
					      mk.deskripsi_kelas
					      ORDER BY mk.deskripsi_kelas SEPARATOR ', '
					    ) AS deskripsi_kelas,
					    GROUP_CONCAT(
					      mk.link_group_wa
					      ORDER BY mk.link_group_wa SEPARATOR ', '
					    ) AS link_group_wa
					  FROM
					    order_booking ob
					    LEFT JOIN master_kelas mk
					      ON FIND_IN_SET(
					        mk.id_master_kelas,
					        REPLACE(ob.list_kelas, '~', ',')
					      ) > 0
					  GROUP BY ob.id_order_booking,
					    ob.time_history,
					    ob.id_user,
					    ob.metode_bayar,
					    ob.status_order,
					    ob.status_certificate,
					    ob.list_kelas) AS temp,
					  (SELECT
					    *
					  FROM
					    USER) us,
					  (SELECT
					    *
					  FROM
					    order_payment) AS op
					WHERE temp.id_user = us.id_user
					  AND temp.id_order_booking = op.id_order_booking";

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

		echo $query;die;
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
		$query = "SELECT GROUP_CONCAT(nama_kelas)AS nama_kelas , foto_kelas, GROUP_CONCAT(is_sumpah) AS is_sumpah  FROM master_kelas WHERE id_master_kelas IN ($inClause)";
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
				  us.handphone
				FROM
				  (SELECT
				    *
				  FROM
				    order_booking) ob,
				  (SELECT
				    *
				  FROM
				    USER) us
				WHERE ob.id_user = us.id_user
				  AND ob.id_order_booking = '$idOrder'
				  AND ob.id_user = '$idUser'";
			return $this->db->query($query)->row_array();
	}
}