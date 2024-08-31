<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
</body>
<style type="text/css">
	body{
		background-image: url("<?= base_url('asset/');?>img/bgvote.jpg")
	}
</style>
 <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/sweetalert/');?>js/sweetalert2.all.min.js"></script>
<?php 
	var_dump($hasil)

 ?>
<?php if($hasil == 1){?>
<script type="text/javascript">
	$(document).ready(function(){
		Swal.fire({
		  icon: 'success',
		  title: "Vote Berhasil",
		  type: 'success'
		}).then(function() {
    		window.location = "<?= base_url($urlRedirect);?>";
		});
	});
</script>
<?php }else if($hasil == 0){?>
<script type="text/javascript">
	$(document).ready(function(){
		Swal.fire({
		  icon: 'error',
		  title: "Maaf Voucher Salah, \nSilahkan Hubungi Panitia",
		  type: 'error'
		}).then(function() {
    		window.location = "<?= base_url($urlRedirect);?>";
		});
	});
</script>
<?php }else if($hasil == 2){
       
        ?>
	<script type="text/javascript">
	$(document).ready(function(){
		Swal.fire({
			icon: 'error',
			title: "Maaf Voucher Telah Di Gunakan\nPada <?= $date; ?>",
			type: 'error'
		}).then(function() {
			window.location = "<?= base_url($urlRedirect);?>";
		});
	});
</script>
<?php }else if($hasil == 3){?>
	<script type="text/javascript">
	$(document).ready(function(){
		Swal.fire({
			icon: 'error',
			title: "Maaf Voucher Salah, Silahkan Hubungi Panitia",
			type: 'error'
		}).then(function() {
			window.location = "<?= base_url($urlRedirect);?>";
		});
	});
</script>
<?php }?>
</html>