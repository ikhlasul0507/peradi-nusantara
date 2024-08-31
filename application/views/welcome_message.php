<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>CEK STATUS KODE VOUCHER</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<body class="bd">
	<style type="text/css">
		.bd{
			background-color: white;
		}
		h1{
			margin-top: 100px;
			color: red;
			font-size:30px;
		}
		h2{
			color: red;
		}
		p{
			font-size: 100px;
			color: red;
		}
	</style>
	<div class="container">
		<center>
		<h1>CEK STATUS KODE VOUCHER</h1>
		<hr>
		<a href="<?= base_url('Cbcapalembang'); ?>" class=" btn btn-dark">Kembali Ke Menu Utama</a>
		  <div class="form-group">
		    <label for="exampleFormControlInput1">Masukan Kode Voucher</label>
		    <input type="text" class="form-control" id="kodeVoucher" placeholder="Kode Voucher">
		    <button  class="form-control mt-3 btn-danger" onclick="cekVoucher()">Cek</button>
		  </div>

		<div class="card" id="dataHasil">
		  	<h5>Hasil Cek Kode Voucher</h5>
		  <div class="card-body">
		    <table class="table">
			  <tbody>
			    <tr>
			      <th scope="row">Kode Voucher</th>
			      <td id="kdVC"></td>
			    </tr>
			    <tr>
			      <th scope="row">Status Voucher</th>
			      <td id="stVC"></td>
			    </tr>
			    <tr>
			      <th scope="row">Peserta</th>
			      <td id="nmP"></td>
			    </tr>
			    <tr>
			      <th scope="row">Nominal</th>
			      <td id="nomi"></td>
			    </tr>
			    <tr>
			      <th scope="row">Waktu Vote</th>
			      <td id="wkt"></td>
			    </tr>
			  </tbody>
			</table>
		  </div>
		  <button  class="form-control mt-3 btn-danger" onclick="cekVoucherKembali()">Cek Kembali</button>
		</div>
	</div>

</body>
<footer>
	<center>Copyright@SriwijayaGoDeveloper</center>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="<?= base_url('assets/sweetalert/');?>js/sweetalert2.all.min.js"></script>
<script type="text/javascript">

	document.getElementById('dataHasil').style.display="none";
	function cekVoucher() {
		var nilai = document.getElementById("kodeVoucher").value;
		if (nilai === ""){
			alert("Harap Diisi kode voucher !");
		}else{
			cekStatusVoucher(nilai);
		}
	}

	function cekVoucherKembali(){
		document.getElementById("kodeVoucher").value = "";
		document.getElementById('dataHasil').style.display="none";
	}
	function cekStatusVoucher(nilai){
		console.log(nilai)
		$.ajax({
			'url': "<?= base_url('cek/cekData/') ?>"+nilai,
			'type': 'GET',
			success: function(e) {
				var data_obj = JSON.parse(e);
				console.log(data_obj);
				if (data_obj !== null){
					document.getElementById('dataHasil').style.display="inline-block";
					document.getElementById('kdVC').innerHTML = data_obj.kdvt;
					document.getElementById('stVC').innerHTML = "Done";
					document.getElementById('nmP').innerHTML = data_obj.nvt;
					document.getElementById('nomi').innerHTML = data_obj.nmvt;
					document.getElementById('wkt').innerHTML = data_obj.dateCreated;
				}else{
					alert("Kode Tidak Di Temukan !");
					document.getElementById("kodeVoucher").value = "";
				}
			}

		});
	}
</script>
</html>