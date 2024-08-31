<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migrate extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->writeLine();
		echo "<b>..............Time Migrate " . date("d-m-Y h:m:s") . "</b></br>";
		$this->writeLine();
		$this->addnewtable();
		$this->writeLine();
		$this->insertDataTable();
		$this->writeLine();
		$this->alterTable();
		$this->writeLine();
		echo "<h4>Congratulations your migrate successfully 100%</h4>";
		$this->writeLine();
		// redirect("L_a");
	}

	public function writeLine()
	{
		echo ".....................................................................................................................................</br>";
	}

	public function addnewtable()
	{
		//=================================================================================================
		$title = "Table structure for table `history_voucher`";
		$query = "CREATE TABLE IF NOT EXISTS `history_voucher` (
				  `id_hv` int(11) NOT NULL AUTO_INCREMENT,
				  `id_peserta` int(11) NOT NULL,
				  `voucher` varchar(50) NOT NULL,
				  `nominal` int(50) NOT NULL,
				  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				  PRIMARY KEY (id_hv)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `calsaw`";
		$query = "CREATE TABLE IF NOT EXISTS `calsaw` (
				  `ipk` double NOT NULL,
				  `penghasilan` int(5) NOT NULL,
				  `tanggungan` int(5) NOT NULL,
				  `prestasi` int(5) NOT NULL,
				  `lokasi` int(11) NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_admin`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_admin` (
				  `id_a` int(11) NOT NULL AUTO_INCREMENT,
				  `email` varchar(50) NOT NULL,
				  `password` varchar(128) NOT NULL,
				  `type` int(11) NOT NULL,
				  PRIMARY KEY (id_a)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_alternatif`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_alternatif` (
				  `idAlternatif` int(5) NOT NULL AUTO_INCREMENT,
				  `idPeserta` int(5) DEFAULT NULL,
				  `idKriteria` int(5) DEFAULT NULL,
				  `nilai` int(5) DEFAULT NULL,
				  PRIMARY KEY (idAlternatif)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_byr`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_byr` (
				  `id_byr` int(11) NOT NULL AUTO_INCREMENT,
				  `ft_bukti` varchar(256) NOT NULL,
				  `waktu` varchar(30) NOT NULL,
				  `id_pb` int(5) NOT NULL,
				  PRIMARY KEY (id_byr)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_dpv`";
		$query = "CREATE TABLE  IF NOT EXISTS `tbl_dpv` (
				  `id_dpv` int(11) NOT NULL AUTO_INCREMENT,
				  `nm_v` varchar(128) NOT NULL,
				  `jr_v` varchar(128) NOT NULL,
				  `ph_v` varchar(256) NOT NULL,
				  `np_v` int(15) NOT NULL,
				  `jk_v` int(1) NOT NULL,
				  PRIMARY KEY (id_dpv)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_eticket`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_eticket` (
				  `idETicket` int(11) NOT NULL AUTO_INCREMENT,
				  `kodeTicket` varchar(30) NOT NULL,
				  `nik` int(20) NOT NULL,
				  `nama` varchar(128) NOT NULL,
				  `handphone` varchar(50) NOT NULL,
				  `noKursi` int(30) NOT NULL DEFAULT '0',
				  `buktiTransfer` varchar(128) NOT NULL,
				  `st_eticket` int(11) NOT NULL DEFAULT '0',
				  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				  PRIMARY KEY (idETicket)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_hasil_alternatif`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_hasil_alternatif` (
				  `idHasilAlternatif` int(5) NOT NULL AUTO_INCREMENT,
				  `idPeserta` int(5) DEFAULT NULL,
				  `totalNilai` double DEFAULT NULL,
				  `dateCreatedHasil` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				  `ranking` int(5) DEFAULT NULL,
				  PRIMARY KEY (idHasilAlternatif)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_history`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_history` (
				  `idHistory` int(11) NOT NULL AUTO_INCREMENT,
				  `timeHistory` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				  `username` varchar(50) NOT NULL,
				  `ipaddress` varchar(20) NOT NULL,
				  `macaddress` varchar(20) NOT NULL,
				  `browser` varchar(100) NOT NULL,
				  `action` int(11) NOT NULL,
				   PRIMARY KEY (idHistory)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_jenis_kriteria`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_jenis_kriteria` (
					  `idJenis` int(5) NOT NULL AUTO_INCREMENT,
					  `namaJenis` varchar(30) DEFAULT NULL,
					  PRIMARY KEY (idJenis)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_jenis_menu`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_jenis_menu` (
					  `idJenisMenu` int(5) NOT NULL AUTO_INCREMENT,
					  `namaJenisMenu` varchar(128) DEFAULT NULL,
					   PRIMARY KEY (idJenisMenu)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_jtkp`";
		$query = "CREATE TABLE  IF NOT EXISTS `tbl_jtkp` (
					  `id_jtkp` int(5) NOT NULL AUTO_INCREMENT,
					  `id_p` int(5) DEFAULT NULL,
					  `no_p` varchar(20) NOT NULL,
					  `tkp1` int(1) DEFAULT NULL,
					  `tkp2` int(1) DEFAULT NULL,
					  `tkp3` int(1) DEFAULT NULL,
					  `tkp4` int(1) DEFAULT NULL,
					  `tkp5` int(1) DEFAULT NULL,
					  `tkp6` int(1) DEFAULT NULL,
					  `tkp7` int(1) DEFAULT NULL,
					  `tkp8` int(1) DEFAULT NULL,
					  `tkp9` int(1) DEFAULT NULL,
					  `tkp10` int(1) DEFAULT NULL,
					  `tkp11` int(1) DEFAULT NULL,
					  `tkp12` int(1) DEFAULT NULL,
					  `tkp13` int(1) DEFAULT NULL,
					  `tkp14` int(1) DEFAULT NULL,
					  `tkp15` int(1) DEFAULT NULL,
					  `tkp16` int(1) DEFAULT NULL,
					  `tkp17` int(1) DEFAULT NULL,
					  `tkp18` int(1) DEFAULT NULL,
					  `tkp19` int(1) DEFAULT NULL,
					  `tkp20` int(1) DEFAULT NULL,
					  `tkp21` int(1) DEFAULT NULL,
					  `tkp22` int(1) DEFAULT NULL,
					  `tkp23` int(1) DEFAULT NULL,
					  `tkp24` int(1) DEFAULT NULL,
					  `tkp25` int(1) DEFAULT NULL,
					  `tkp26` int(1) DEFAULT NULL,
					  `tkp27` int(1) DEFAULT NULL,
					  `tkp28` int(1) DEFAULT NULL,
					  `tkp29` int(1) DEFAULT NULL,
					  `tkp30` int(1) DEFAULT NULL,
					  `tkp31` int(1) DEFAULT NULL,
					  `tkp32` int(1) DEFAULT NULL,
					  `tkp33` int(1) DEFAULT NULL,
					  `tkp34` int(1) DEFAULT NULL,
					  `tkp35` int(1) DEFAULT NULL,
					  `tkp36` int(1) DEFAULT NULL,
					  `tkp37` int(1) DEFAULT NULL,
					  `tkp38` int(1) DEFAULT NULL,
					  `tkp39` int(1) DEFAULT NULL,
					  `tkp40` int(1) DEFAULT NULL,
					  `tkp41` int(1) DEFAULT NULL,
					  `tkp42` int(1) DEFAULT NULL,
					  `tkp43` int(1) DEFAULT NULL,
					  `tkp44` int(1) DEFAULT NULL,
					  `tkp45` int(1) DEFAULT NULL,
					  `tkp46` int(1) DEFAULT NULL,
					  `tkp47` int(1) DEFAULT NULL,
					  `tkp48` int(1) DEFAULT NULL,
					  `tkp49` int(1) DEFAULT NULL,
					  `tkp50` int(1) DEFAULT NULL,
					   PRIMARY KEY (id_jtkp)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_jtpa`";
		$query = "CREATE TABLE  IF NOT EXISTS `tbl_jtpa` (
					  `id_jtpa` int(5) NOT NULL AUTO_INCREMENT,
					  `id_p` int(5) DEFAULT NULL,
					  `tpa1` int(1) DEFAULT NULL,
					  `tpa2` int(1) DEFAULT NULL,
					  `tpa3` int(1) DEFAULT NULL,
					  `tpa4` int(1) DEFAULT NULL,
					  `tpa5` int(1) DEFAULT NULL,
					  `tpa6` int(1) DEFAULT NULL,
					  `tpa7` int(1) DEFAULT NULL,
					  `tpa8` int(1) DEFAULT NULL,
					  `tpa9` int(1) DEFAULT NULL,
					  `tpa10` int(1) DEFAULT NULL,
					  `tpa11` int(1) DEFAULT NULL,
					  `tpa12` int(1) DEFAULT NULL,
					  `tpa13` int(1) DEFAULT NULL,
					  `tpa14` int(1) DEFAULT NULL,
					  `tpa15` int(1) DEFAULT NULL,
					  `tpa16` int(1) DEFAULT NULL,
					  `tpa17` int(1) DEFAULT NULL,
					  `tpa18` int(1) DEFAULT NULL,
					  `tpa19` int(1) DEFAULT NULL,
					  `tpa20` int(1) DEFAULT NULL,
					  `tpa21` int(1) DEFAULT NULL,
					  `tpa22` int(1) DEFAULT NULL,
					  `tpa23` int(1) DEFAULT NULL,
					  `tpa24` int(1) DEFAULT NULL,
					  `tpa25` int(1) DEFAULT NULL,
					  `tpa26` int(1) DEFAULT NULL,
					  `tpa27` int(1) DEFAULT NULL,
					  `tpa28` int(1) DEFAULT NULL,
					  `tpa29` int(1) DEFAULT NULL,
					  `tpa30` int(1) DEFAULT NULL,
					  `tpa31` int(1) DEFAULT NULL,
					  `tpa32` int(1) DEFAULT NULL,
					  `tpa33` int(1) DEFAULT NULL,
					  `tpa34` int(1) DEFAULT NULL,
					  `tpa35` int(1) DEFAULT NULL,
					  `tpa36` int(1) DEFAULT NULL,
					  `tpa37` int(1) DEFAULT NULL,
					  `tpa38` int(1) DEFAULT NULL,
					  `tpa39` int(1) DEFAULT NULL,
					  `tpa40` int(1) DEFAULT NULL,
					  `tpa41` int(1) DEFAULT NULL,
					  `tpa42` int(1) DEFAULT NULL,
					  `tpa43` int(1) DEFAULT NULL,
					  `tpa44` int(1) DEFAULT NULL,
					  `tpa45` int(1) DEFAULT NULL,
					  `tpa46` int(1) DEFAULT NULL,
					  `tpa47` int(1) DEFAULT NULL,
					  `tpa48` int(1) DEFAULT NULL,
					  `tpa49` int(1) DEFAULT NULL,
					  `tpa50` int(1) DEFAULT NULL,
					  `tpa51` int(1) DEFAULT NULL,
					  `tpa52` int(1) DEFAULT NULL,
					  `tpa53` int(1) DEFAULT NULL,
					  `tpa54` int(1) DEFAULT NULL,
					  `tpa55` int(1) DEFAULT NULL,
					  `tpa56` int(1) DEFAULT NULL,
					  `tpa57` int(1) DEFAULT NULL,
					  `tpa58` int(1) DEFAULT NULL,
					  `tpa59` int(1) DEFAULT NULL,
					  `tpa60` int(1) DEFAULT NULL,
					  PRIMARY KEY (id_jtpa)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_jtpu`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_jtpu` (
					  `id_jtpu` int(50) NOT NULL AUTO_INCREMENT,
					  `id_p` int(5) DEFAULT NULL,
					  `tpu1` int(1) DEFAULT NULL,
					  `tpu2` int(1) DEFAULT NULL,
					  `tpu3` int(1) DEFAULT NULL,
					  `tpu4` int(1) DEFAULT NULL,
					  `tpu5` int(1) DEFAULT NULL,
					  `tpu6` int(1) DEFAULT NULL,
					  `tpu7` int(1) DEFAULT NULL,
					  `tpu8` int(1) DEFAULT NULL,
					  `tpu9` int(1) DEFAULT NULL,
					  `tpu10` int(1) DEFAULT NULL,
					  `tpu11` int(1) DEFAULT NULL,
					  `tpu12` int(1) DEFAULT NULL,
					  `tpu13` int(1) DEFAULT NULL,
					  `tpu14` int(1) DEFAULT NULL,
					  `tpu15` int(1) DEFAULT NULL,
					  `tpu16` int(1) DEFAULT NULL,
					  `tpu17` int(1) DEFAULT NULL,
					  `tpu18` int(1) DEFAULT NULL,
					  `tpu19` int(1) DEFAULT NULL,
					  `tpu20` int(1) DEFAULT NULL,
					  `tpu21` int(1) DEFAULT NULL,
					  `tpu22` int(1) DEFAULT NULL,
					  `tpu23` int(1) DEFAULT NULL,
					  `tpu24` int(1) DEFAULT NULL,
					  `tpu25` int(1) DEFAULT NULL,
					  `tpu26` int(1) DEFAULT NULL,
					  `tpu27` int(1) DEFAULT NULL,
					  `tpu28` int(1) DEFAULT NULL,
					  `tpu29` int(1) DEFAULT NULL,
					  `tpu30` int(1) DEFAULT NULL,
					  `tpu31` int(1) DEFAULT NULL,
					  `tpu32` int(1) DEFAULT NULL,
					  `tpu33` int(1) DEFAULT NULL,
					  `tpu34` int(1) DEFAULT NULL,
					  `tpu35` int(1) DEFAULT NULL,
					  `tpu36` int(1) DEFAULT NULL,
					  `tpu37` int(1) DEFAULT NULL,
					  `tpu38` int(1) DEFAULT NULL,
					  `tpu39` int(1) DEFAULT NULL,
					  `tpu40` int(1) DEFAULT NULL,
					  `tpu41` int(1) DEFAULT NULL,
					  `tpu42` int(1) DEFAULT NULL,
					  `tpu43` int(1) DEFAULT NULL,
					  `tpu44` int(1) DEFAULT NULL,
					  `tpu45` int(1) DEFAULT NULL,
					  `tpu46` int(1) DEFAULT NULL,
					  `tpu47` int(1) DEFAULT NULL,
					  `tpu48` int(1) DEFAULT NULL,
					  `tpu49` int(1) DEFAULT NULL,
					  `tpu50` int(1) DEFAULT NULL,
					  `tpu51` int(1) DEFAULT NULL,
					  `tpu52` int(1) DEFAULT NULL,
					  `tpu53` int(1) DEFAULT NULL,
					  `tpu54` int(1) DEFAULT NULL,
					  `tpu55` int(1) DEFAULT NULL,
					  `tpu56` int(1) DEFAULT NULL,
					  `tpu57` int(1) DEFAULT NULL,
					  `tpu58` int(1) DEFAULT NULL,
					  `tpu59` int(1) DEFAULT NULL,
					  `tpu60` int(1) DEFAULT NULL,
					  `tpu61` int(1) DEFAULT NULL,
					  `tpu62` int(1) DEFAULT NULL,
					  `tpu63` int(1) DEFAULT NULL,
					  `tpu64` int(1) DEFAULT NULL,
					  `tpu65` int(1) DEFAULT NULL,
					  `tpu66` int(1) DEFAULT NULL,
					  `tpu67` int(1) DEFAULT NULL,
					  `tpu68` int(1) DEFAULT NULL,
					  `tpu69` int(1) DEFAULT NULL,
					  `tpu70` int(1) DEFAULT NULL,
					  `tpu71` int(1) DEFAULT NULL,
					  `tpu72` int(1) DEFAULT NULL,
					  `tpu73` int(1) DEFAULT NULL,
					  `tpu74` int(1) DEFAULT NULL,
					  `tpu75` int(1) DEFAULT NULL,
					  `tpu76` int(1) DEFAULT NULL,
					  `tpu77` int(1) DEFAULT NULL,
					  `tpu78` int(1) DEFAULT NULL,
					  `tpu79` int(1) DEFAULT NULL,
					  `tpu80` int(1) DEFAULT NULL,
					  `tpu81` int(1) DEFAULT NULL,
					  `tpu82` int(1) DEFAULT NULL,
					  `tpu83` int(1) DEFAULT NULL,
					  `tpu84` int(1) DEFAULT NULL,
					  `tpu85` int(1) DEFAULT NULL,
					  `tpu86` int(1) DEFAULT NULL,
					  `tpu87` int(1) DEFAULT NULL,
					  `tpu88` int(1) DEFAULT NULL,
					  `tpu89` int(1) DEFAULT NULL,
					  `tpu90` int(1) DEFAULT NULL,
					  `tpu91` int(1) DEFAULT NULL,
					  `tpu92` int(1) DEFAULT NULL,
					  `tpu93` int(1) DEFAULT NULL,
					  `tpu94` int(1) DEFAULT NULL,
					  `tpu95` int(1) DEFAULT NULL,
					  `tpu96` int(1) DEFAULT NULL,
					  `tpu97` int(1) DEFAULT NULL,
					  `tpu98` int(1) DEFAULT NULL,
					  `tpu99` int(1) DEFAULT NULL,
					  `tpu100` int(1) DEFAULT NULL,
					  PRIMARY KEY (id_jtpu)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_jur`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_jur` (
					  `id_jur` int(11) NOT NULL AUTO_INCREMENT,
					  `nm_jur` varchar(50) NOT NULL,
					  PRIMARY KEY (id_jur)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_kriteria`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_kriteria` (
					  `idKriteria` int(11) NOT NULL AUTO_INCREMENT,
					  `namaKriteria` varchar(30) DEFAULT NULL,
					  `bobot` double DEFAULT NULL,
					  `idJenis` int(1) DEFAULT NULL,
					  PRIMARY KEY (idKriteria)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_kursi`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_kursi` (
					  `idKursi` int(11) NOT NULL AUTO_INCREMENT,
					  `noKursi` int(11) NOT NULL,
					  `st_kursi` int(11) NOT NULL DEFAULT '0',
					  PRIMARY KEY (idKursi)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_menu`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_menu` (
					  `idMenu` int(11) NOT NULL AUTO_INCREMENT,
					  `namaMenu` varchar(255) NOT NULL,
					  `urlMenu` varchar(255) NOT NULL,
					  `isActive` int(1) NOT NULL,
					  `namaTabel` varchar(50) NOT NULL,
					  `jenisMenu` int(11) NOT NULL DEFAULT '0',
					  `jm` int(11) NOT NULL DEFAULT '0',
					  PRIMARY KEY (idMenu)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_parameter`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_parameter` (
					  `idParameter` int(11) NOT NULL AUTO_INCREMENT,
					  `namaParameter` varchar(128) NOT NULL,
					  `valueParameter` varchar(128) NOT NULL,
					  `typeParameter` char(1) DEFAULT NULL,
					   PRIMARY KEY (idParameter)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_peserta`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_peserta` (
					  `id_p` int(11) NOT NULL AUTO_INCREMENT,
					  `_nm_p` varchar(50) NOT NULL,
					  `_jr_p` varchar(2) NOT NULL,
					  `_s_p` varchar(30) NOT NULL,
					  `_ipk` varchar(20) NOT NULL,
					  `_ttl` varchar(20) NOT NULL,
					  `_hp` varchar(20) NOT NULL,
					  `_email` varchar(50) NOT NULL,
					  `_al_p` varchar(500) NOT NULL,
					  `_po_p` varchar(500) NOT NULL,
					  `_kp_p` varchar(500) NOT NULL,
					  `_mt_p` varchar(500) NOT NULL,
					  `_st_byr` int(1) NOT NULL COMMENT '0 = belum bayar,\r\n1 = sdh bayr',
					  `_st_soal` int(1) NOT NULL COMMENT '1 = open soal\r\n2 = selesai submit \r\n3 = expired soal',
					  `_st_p` int(1) NOT NULL COMMENT '0 = pending\r\n1 = berhasil',
					  PRIMARY KEY (id_p)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_sellingvoucher`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_sellingvoucher` (
					  `idSellingVoucher` int(11) NOT NULL AUTO_INCREMENT,
					  `nominalVoucher` int(50) NOT NULL,
					  `nama` varchar(100) NOT NULL,
					  `handphone` varchar(50) NOT NULL,
					  `buktitransfer` text NOT NULL,
					  `kodeVoucher` varchar(20) NOT NULL,
					  `statusVoucher` int(1) NOT NULL DEFAULT '0',
					  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
					   PRIMARY KEY (idSellingVoucher)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_set`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_set` (
					  `set_daftar` int(1) NOT NULL,
					  `set_soal` int(1) NOT NULL,
					  `set_voting` int(1) NOT NULL,
					  `set_web` int(1) NOT NULL,
					  `id_set` int(1) NOT NULL
					) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_vc`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_vc` (
					  `id_vc` int(5) NOT NULL AUTO_INCREMENT,
					  `kv` varchar(10) NOT NULL,
					  `nmv` varchar(20) NOT NULL,
					  `st_vc` int(11) NOT NULL DEFAULT '0',
					  PRIMARY KEY (id_vc)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_vt1`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_vt1` (
					  `id_vt` int(11) NOT NULL AUTO_INCREMENT,
					  `id_pvt` int(5) NOT NULL,
					  `nvt` varchar(30) NOT NULL,
					  `jr_vt` varchar(128) NOT NULL,
					  `jk_v` varchar(1) NOT NULL,
					  `kdvt` varchar(128) NOT NULL,
					  `nmvt` varchar(14) NOT NULL,
					  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
					  PRIMARY KEY (id_vt)
					) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_vt2`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_vt2` (
					  `id_vt` int(11) NOT NULL AUTO_INCREMENT,
					  `id_pvt` int(5) NOT NULL,
					  `nvt` varchar(30) NOT NULL,
					  `jr_vt` varchar(128) NOT NULL,
					  `jk_v` varchar(1) NOT NULL,
					  `kdvt` varchar(128) NOT NULL,
					  `nmvt` varchar(14) NOT NULL,
					  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
					  PRIMARY KEY (id_vt)
					) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_vt3`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_vt3` (
					  `id_vt` int(11) NOT NULL AUTO_INCREMENT,
					  `id_pvt` int(5) NOT NULL,
					  `nvt` varchar(30) NOT NULL,
					  `jr_vt` varchar(128) NOT NULL,
					  `jk_v` varchar(1) NOT NULL,
					  `kdvt` varchar(128) NOT NULL,
					  `nmvt` varchar(14) NOT NULL,
					  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
					  PRIMARY KEY (id_vt)
					) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_vt4`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_vt4` (
					  `id_vt` int(11) NOT NULL AUTO_INCREMENT,
					  `id_pvt` int(5) NOT NULL,
					  `nvt` varchar(30) NOT NULL,
					  `jr_vt` varchar(128) NOT NULL,
					  `jk_v` varchar(1) NOT NULL,
					  `kdvt` varchar(128) NOT NULL,
					  `nmvt` varchar(14) NOT NULL,
					  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
					  PRIMARY KEY (id_vt)
					) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `tbl_vt5`";
		$query = "CREATE TABLE IF NOT EXISTS `tbl_vt5` (
					  `id_vt` int(11) NOT NULL AUTO_INCREMENT,
					  `id_pvt` int(5) NOT NULL,
					  `nvt` varchar(30) NOT NULL,
					  `jr_vt` varchar(128) NOT NULL,
					  `jk_v` varchar(1) NOT NULL,
					  `kdvt` varchar(128) NOT NULL,
					  `nmvt` varchar(14) NOT NULL,
					  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
					   PRIMARY KEY (id_vt)
					) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `voucherauto`";
		$query = "CREATE TABLE IF NOT EXISTS `voucherauto` (
					  `idVoucherAuto` int(15) NOT NULL AUTO_INCREMENT,
					  `nama` varchar(128) NOT NULL,
					  `handphone` varchar(20) NOT NULL,
					  `email` varchar(64) NOT NULL,
					  `totalVoucher` double NOT NULL,
					  `totalBayar` double NOT NULL,
					  `typetransfer` varchar(30) NOT NULL,
					  `virtualAccount` varchar(50) NOT NULL,
					  `statusBayar` char(1) NOT NULL,
					  `dateCreatedAdd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
					  `transaction_id` varchar(250) DEFAULT NULL,
					  PRIMARY KEY (idVoucherAuto)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `voucherautoitem`";
		$query = "CREATE TABLE IF NOT EXISTS `voucherautoitem` (
					  `idVoucherAutoItem` int(5) NOT NULL AUTO_INCREMENT,
					  `idVoucherAuto` int(30) NOT NULL,
					  `nominalVoucher` double NOT NULL,
					  `kodeVoucher` varchar(15) NOT NULL,
					  `statusVoucher` char(1) NOT NULL,
					  `dateCreatedVoucher` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
					   PRIMARY KEY (idVoucherAutoItem)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `vouchermanual`";
		$query = "CREATE TABLE IF NOT EXISTS `vouchermanual` (
					  `idVoucherManual` int(15) NOT NULL AUTO_INCREMENT,
					  `nama` varchar(128) NOT NULL,
					  `handphone` varchar(20) NOT NULL,
					  `email` varchar(64) NOT NULL,
					  `totalVoucher` double NOT NULL,
					  `totalBayar` double NOT NULL,
					  `typetransfer` varchar(30) NOT NULL,
					  `uploadBuktiBayar` varchar(500) NOT NULL,
					  `statusBayar` char(1) NOT NULL,
					  `dateCreatedAdd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
					   PRIMARY KEY (idVoucherManual)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `vouchermanualitem`";
		$query = "CREATE TABLE IF NOT EXISTS `vouchermanualitem` (
					  `idVoucherManualItem` int(5) NOT NULL AUTO_INCREMENT,
					  `idVoucherManual` int(30) NOT NULL,
					  `nominalVoucher` double NOT NULL,
					  `kodeVoucher` varchar(15) NOT NULL,
					  `statusVoucher` char(1) NOT NULL,
					  `dateCreatedVoucher` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
					  PRIMARY KEY (idVoucherManualItem)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `photo_voucher`";
		$query = "CREATE TABLE IF NOT EXISTS `photo_voucher` (
					  `idPhotoVoucher` int(5) NOT NULL AUTO_INCREMENT,
					  `photoVoucher` varchar(150) NOT NULL,
					  `nominalVoucher` double NOT NULL,
					  `dateCreatedPhotoVoucher` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
					  PRIMARY KEY (idPhotoVoucher)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
	}


	public function insertDataTable()
	{
		//=================================================================================================
		$title = "Dumping data for table `calsaw`";
		$query = "INSERT IGNORE  INTO `calsaw` (`ipk`, `penghasilan`, `tanggungan`, `prestasi`, `lokasi`) VALUES
					(3.92, 2, 2, 4, 100),
					(3.95, 3, 2, 3, 89),
					(3.4, 4, 3, 2, 70),
					(4, 3, 4, 4, 120),
					(3.2, 1, 2, 1, 140)";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Dumping data for table `tbl_admin`";
		$query = "INSERT IGNORE INTO `tbl_admin` (`id_a`, `email`, `password`, `type`) VALUES
					(3, 'amal@gmail.com', '12345', 1)";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Dumping data for table `tbl_jenis_kriteria`";
		$query = "INSERT IGNORE INTO `tbl_jenis_kriteria` (`idJenis`, `namaJenis`) VALUES
					(1, 'Benefit'),
					(2, 'Cost')";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Dumping data for table `tbl_jenis_menu`";
		$query = "INSERT IGNORE INTO `tbl_jenis_menu` (`idJenisMenu`, `namaJenisMenu`) VALUES
					(1, 'SPK'),
					(2, 'Data Voting'),
					(3, 'Setting')";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Dumping data for table `tbl_kriteria`";
		$query = "INSERT IGNORE INTO `tbl_kriteria` (`idKriteria`, `namaKriteria`, `bobot`, `idJenis`) VALUES
					(1, 'Pengetahuan Umum', 0.15, 1),
					(2, 'Bahasa Inggris', 0.1, 1),
					(3, 'Public Speaking', 0.15, 1),
					(4, 'Wawasan dan Budaya', 0.25, 1),
					(5, 'Modelling', 0.15, 1),
					(6, 'Kepariwisataan', 0.2, 1)";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Dumping data for table `tbl_menu`";
		$query = "INSERT IGNORE INTO `tbl_menu` (`idMenu`, `namaMenu`, `urlMenu`, `isActive`, `namaTabel`, `jenisMenu`, `jm`) VALUES
					(1, 'Report Vote 1', 'hvf1', 1, 'tbl_vt1', 3, 0),
					(2, 'Report Vote 2', 'hvf2', 1, 'tbl_vt2', 3, 0),
					(3, 'Report Vote 3', 'hvf3', 1, 'tbl_vt3', 3, 0),
					(4, 'Report Vote 4', 'hvf4', 1, 'tbl_vt4', 3, 0),
					(5, 'Report Vote 5', 'hvf5', 1, 'tbl_vt5', 3, 0),
					(6, 'Data Peserta', 'dpv', 1, '', 3, 0),
					(7, 'Report All', 'rekapHasil', 1, '', 3, 0),
					(8, 'Voucher Code', 'kv', 1, '', 2, 0),
					(9, 'Selling Voucher', 'sellingVoucher', 1, '', 2, 0),
					(10, 'Selling E-Ticket', 'SellingETicket', 1, '', 2, 0),
					(11, 'Data Chairs', 'chairs', 1, '', 2, 0),
					(12, 'Report Selling Voucher', 'reportSellingVoucher', 1, '', 2, 0),
					(13, 'Verify Voucher', 'verifyBuyingVoucher', 1, '', 2, 0),
					(15, 'Data Peserta', 'ps', 1, '', 1, 0),
					(20, 'Data Peserta Verifikasi', 'dp', 1, '', 1, 0),
					(21, 'Data Alternatif', 'dataAlternatif', 1, '', 1, 0),
					(22, 'Data Kriteria', 'dataKriteria', 1, '', 1, 0),
					(23, 'Data Jenis Kriteria', 'dataJenisKriteria', 1, '', 1, 0),
					(24, 'Data Hasil Alternatif', 'dataHasilAlternatif', 1, '', 1, 0),
					(25, 'Voucher Virtual', 'voucherVirtual', 1, '', 2, 0),
					(26, 'History Voucher Expired', 'historyVoucherExpired', 1, '', 2, 0),
					(27, 'Set Print Voucher', 'setPrintVoucher', 1, '', 2, 0)";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Dumping data for table `tbl_parameter`";
		$query = "INSERT IGNORE INTO `tbl_parameter` (`idParameter`, `namaParameter`, `valueParameter`, `typeParameter`) VALUES
					(1, '@saveVoteToTable', 'tbl_vt1', 'T'),
					(2, '@statusVoteInPublic', '1', 'O'),
					(3, '@activeGenerateVoucher', '1', 'O'),
					(4, '@valueCostMinusPercen', '20', 'T'),
					(5, '@activeGenerateChairs', '1', 'O'),
					(6, '@activePrintVoucher', '1', 'O'),
					(7, '@activeScanE-Ticket', '1', 'O'),
					(8, '@valueOfHandphoneAdmin', '+62 823-2371-6030', 'T'),
					(9, '@valueOfEmailAdmin', 'amal@gmail.com', 'T'),
					(10, '@activeFromBuyingE-Voucher', '1', 'O'),
					(12, '@driveFolderNameExportJson', 'D://', 'T'),
					(13, '@valueNoRekening', '1234567', 'T'),
					(14, '@valueNameRekening', 'Edison', 'T'),
					(15, '@valueBankRekening', 'BRI', 'T'),
					(16, '@usingDataWithAPI', '0', 'O'),
					(17, '@data-client-key', 'SB-Mid-client-PwxtVC_cSfBUs6kI', 'T'),
					(18, '@server_key', 'SB-Mid-server-lTemQorAAVdcIfNydIqypwhc', 'T'),
					(19, '@isProduction', '0', 'O'),
					(20, '@durationExpiredMinutesMitrans', '30', 'T'),
					(21, '@optionsNominalVoucher', '10000,20000,50000,100000', 'T'),
					(22, '@urlSandboxMitrans', 'https://app.sandbox.midtrans.com/snap/snap.js', 'O'),
					(23, '@urlProductionMitrans', 'https://app.midtrans.com/snap/snap.js', 'O'),
					(24, '@valueChargeFreeMitrans', '6402', 'T'),
					(25, '@isVoucherMultipleVirtualAccount', '1', 'O'),
					(26, '@urlRedirectBuyingVoucher', 'bgpali', 'T'),
					(27, '@valueLinkYoutube', 'https://www.youtube.com/watch?v=fLCjQJCekTs', 'T'),
					(28, '@labelVote', 'Semi Finalis', 'T'),
					(29, '@cssImageDesainPrintVoucher', 'position: relative; z-index: 1; top: 0px; margin-bottom: 2px; width: 300px; height: 160px', 'T'),
					(30, '@cssCodeDesainPrintVoucher', 'position: absolute; top: 102px; left: 194px; z-index: 2; color: black; font-size: 13px', 'T'),
					(31, '@showVoucherPerPage', '20', 'T'),
					(31, '@linkWhatsapp', 'http://wa', 'T')";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
	}


	public function alterTable()
	{
		//=================================================================================================
		// $title = "Indexes for table `tbl_admin`";
		// $this->db->query("ALTER TABLE `tbl_admin`
		// 		  DROP PRIMARY KEY");
		// $query = "ALTER TABLE `tbl_admin`
		// 		  ADD PRIMARY KEY (`id_a`),
		// 		  ADD UNIQUE KEY `email` (`email`)";
		// if($this->db->query($query)){
		// 	echo "||............[Migrate successfully ".$title."]</br>";
		// }else{
		// 	echo "||............[Migrate failed ".$title."]</br>";
		// }

		//=================================================================================================
		$column = "name_vote";
		$table_name = "tbl_vt1";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column varchar(255);";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		//=================================================================================================
		$column = "name_vote";
		$table_name = "tbl_vt2";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column varchar(255);";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		//=================================================================================================
		$column = "name_vote";
		$table_name = "tbl_vt3";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column varchar(255);";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		//=================================================================================================
		$column = "name_vote";
		$table_name = "tbl_vt4";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column varchar(255);";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		//=================================================================================================
		$column = "name_vote";
		$table_name = "tbl_vt5";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column varchar(255);";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		//=================================================================================================
		$column = "name_vote";
		$table_name = "history_voucher";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column varchar(255);";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
	}
}
