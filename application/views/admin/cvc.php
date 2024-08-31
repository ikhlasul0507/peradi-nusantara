
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Cetak Voucher</title>

  </head>
  <body>
  	<?php 
        $queryCssCode = $this->db->query("SELECT * FROM tbl_parameter where namaParameter='@cssCodeDesainPrintVoucher'")->row_array();
        $valueQueryCssCode = $queryCssCode['valueParameter'];

        $queryCssImage = $this->db->query("SELECT * FROM tbl_parameter where namaParameter='@cssImageDesainPrintVoucher'")->row_array();
        $valueQueryCssImage = $queryCssImage['valueParameter'];


  	 ?>
	<style type="text/css">
					img{
						<?= $valueQueryCssImage; ?>
					}
					h6{
						<?= $valueQueryCssCode; ?>
					}
					.col{
						margin-top: 10px
					}
					</style>

  		<div class="row">
  			<?php foreach ($kv as $p):?>
  			<div class="col">
  				<b><h6><?= $p['kv'];?></h6></b>
  					<?php foreach ($dv as $dp):?>
  					<?php if($p['nmv'] == $dp['nominalVoucher']){ ?>
						<img src="<?= base_url('assets/img/photoVoucher/').$dp['photoVoucher']?>" >
					<?php }endforeach; ?>
  			</div>
  			<?php endforeach; ?>
  		</div>
			
					
<script type="text/javascript">
	window.print();
</script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

