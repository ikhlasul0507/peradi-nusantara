<html>
<title>Checkout</title>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  <script type="text/javascript"
  src="<?= $urlMitrans; ?>"
  data-client-key="<?= $dataclientkey; ?>"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<style type="text/css">
  body {
    background-color:white;
    background-size: cover;
    display: grid;
    /*align-items: center;*/
    /*justify-content: center;*/
    /*height: 100vh;*/
  }

  .container {
    /*width: 30rem;*/
    /*height: 20rem;*/
    box-shadow: 0 0 1rem 0 rgba(0, 0, 0, .2); 
    border-radius: 5px;
    background-color: white;

    backdrop-filter: blur(5px);
  }
  .penghalang {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
  }

  /*Modal */
  .modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 10px;
    border: 1px solid #888;
    width: 80%;
  }

  /*Tombol X*/
  #tutup {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  #tutup:hover,
  #tutup:focus {
    color: black;
    cursor: pointer;
  }
  @media screen and (max-width: 960px) {
    .container {
      width: 100%
    }
  }
  @media screen and (max-width: 460px) {
    .container {
      width: 100%
    }
  }
</style>
<body>
  <div class="container"> 

    <!-- navbar -->
    <nav class="navbar bg-danger mt-3 ">
      <div class="container-fluid">
        <a class="navbar-brand text-light" href="<?= base_url($urlRedirect);?>"><button class="btn btn-dark mr-2">Kembali Vote</button> Voucher Online</a>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" id="valueSearch" type="search" placeholder="Masukan nama/hp..." aria-label="Search">
          <button class="btn btn-dark" id="tombolku" type="button">Cek</button>
        </form>
      </div>
    </nav>
    <!-- end --> 

    <form class="mt-4" >
      <div class="mb-3">
        <input type="text" class="form-control" id="nama" placeholder="Masukan Nama" autocomplete autofocus>
      </div>
      <div class="mb-3">
        <input type="number" class="form-control" id="handphone" placeholder="Masukan Handphone" autocomplete>
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" id="email" placeholder="Masukan Email" autocomplete>
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" id="totalBayar" placeholder="Total Sudah di Transfer Contoh ( 20000 )" autocomplete>
      </div>
      <div class="mb-3">
        <input type="file" class="form-control" id="uploadBuktiBayar" placeholder="Upload Bukti Bayar">
      </div>
      <div class="mb-3">
       <select id="voucher" class="form-select">
        <option value="">--Pilih Voucher---</option>
        <?php
        $a = $this->db->query("SELECT * FROM tbl_parameter where namaParameter='@optionsNominalVoucher'")->row_array();
        $val = $a['valueParameter'];
        $arrayString= explode(",", $val);
        for ($i=0; $i <  count($arrayString); $i++) {?>
          <option value="<?= $arrayString[$i];?>"><?="Rp. ". number_format($arrayString[$i], 0, ',', '.');?></option>
        <?php } ?>
      </select>
    </div>
    <div class="mb-3">
      <input type="number" class="form form-control" id="jumlah" placeholder="Masukan Jumlah Voucher" autocomplete>
    </div>
    <button id="add-button" type="button" class="btn btn-danger">Tambah Item</button>
    <button id="pay-button" type="button" class="btn btn-primary">Beli Voucher</button>
  </form>
  <!-- result -->
  <table id="dataTable" class="table" style="display: none;width: 100%">
  </tbody>
</table>


<!-- result car -->
<hr>
<!-- Button trigger modal -->
<div id="myModal" class="penghalang">
  <div class="modal-content">
    <span id="tutup"><button class="btn btn-danger mb-3">TUTUP</button></span>
    <div id="dataTableCari">
     <div class="card-header" style="background-color: white"><h3>Cara Melakukan Pembelian Voucher</h3></div>
     <div class="card-body">
      <!-- kontek -->
      <div class="col-lg-12">
          <div class="right-content">
            <div class="h-100">
              <ol class="list-group list-group-numbered mb-3">
                <li class="list-group-item"><b>Tranfer melalui ATM/Bank (No Rek Bank Sumsel Babel   :  14209018306) a.n Yayasan Bujang Gadis Lahat</b></li>
                <li class="list-group-item">Buka website https://bglahat.org/ lalu pilih menu "Beli Voucher"</li>
                <li class="list-group-item">Masukan data diri seperti nama lengkap,nomor whatsapp,email,total transfer, bukti transfer, pilih voucher, dan jumlah voucher</li>
                <li class="list-group-item">Masukan nominal voucher yang akan kalian beli</li>
                <li class="list-group-item">Upload Bukti pembayaran sesuai dengan nominal voucher yang kalian beli,
                  pembayaran dapat melalui ATM/Bank (No Rek Bank Sumsel Babel   :  14209018306) a.n Yayasan Bujang Gadis Lahat</li>
                  <li class="list-group-item">Bukti tranfer hanya berlaku di hari yang sama dengan pengisian data pembelian voucher,</li>
                <li class="list-group-item">Setelah pembayaran selesai kode Voucher akan dikirimkan melalui whatsapp atau
                  bisa dicek di halaman menu E-Voucher (pada bagian "Lakukan Pengecekan E-Voucher Anda")</li>
                <li class="list-group-item">Setelah mendapatkan VOUCHER masuk ke halaman VOTE kemudian cari Finalis
                  Favorit kalian dan lakukan Voting dengan cara memasukan kode voucher yang sudah dibeli.</li>
                <li class="list-group-item">Voting Berhasil!</li>
                <li class="list-group-item">Grafik hasil e-voting otomatis langsung terupdate</li>
              </ol>
             
            </div>
          </div>
        </div>
      <hr>
    </div>
  </div> 

</div> 
</div>
<div class="card" style="position: relative;
  bottom:0;
  left: 0;
  width: 100%;">
  <div class="card-header bg-danger text-light">
    Kontak
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <footer class="blockquote-footer">Lidia Resti -<cite title="Source Title">0851-5660-4427</cite></footer>
    </blockquote>
  </div>
</div>
</div>




<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">

    document.getElementById('pay-button').style.display='none';
    let dataItem = [];
    let number = 1;
    var totalSemuaBayar = 0;
    var modal = document.getElementById('myModal');
    var btn = document.getElementById("tombolku");
    var span = document.getElementById("tutup");

    modal.style.display = "block";

  $('#add-button').click(function (event) {
     var nama = document.getElementById('nama').value;
    var handphone = document.getElementById('handphone').value;
    var email = document.getElementById('email').value;
    var voucher = document.getElementById('voucher').value;
    var jumlah = document.getElementById('jumlah').value;
    var totalBayar = document.getElementById('totalBayar').value;
    var uploadBuktiBayar = document.getElementById('uploadBuktiBayar').value;
    if (nama !== "" && handphone !== "" && email !== "" && voucher !=="" && jumlah !== "" && totalBayar !== "" && uploadBuktiBayar !== "" ){
      let item = {
        'no' : number,
        'nama' : document.getElementById('nama').value,
        'handphone' : document.getElementById('handphone').value,
        'email' : document.getElementById('email').value,
        'voucher' : parseInt(document.getElementById('voucher').value),
        'jumlah' : parseInt(document.getElementById('jumlah').value),
        'uploadBuktiBayar' : $('#uploadBuktiBayar').prop('files')[0].name,
      }
      if(cekNilaiVc(document.getElementById('voucher').value)){
        alert("voucher sudah di input")
      }else if(totalBayar < (totalSemuaBayar + (voucher * jumlah))){
        alert("Total nominal voucher melebihi pembayaran")
      }else{
        document.getElementById("dataTable").style.display ='block'
        dataItem.push(item);
        number++;
        addtable();
        document.getElementById('pay-button').style.display='inline';
      }
    }else{
      alert("Harap Lengkap Data !");
    }
  });

  function cekNilaiVc(vc){
    let nilai = false;
    for(var key in dataItem){
      if(dataItem[key].voucher == vc){
        nilai = true;
      }
    }
    return nilai
  }
  function addtable(){
    if(dataItem.length > 0){
      let dataTab = "<thead><tr><th scope='col'>No</th><th scope='col'>Nama</th><th scope='col'>Handphone</th><th scope='col'>Email</th><th scope='col'>Voucher</th><th scope='col'>Jumlah</th><th scope='col'>Aksi</th></tr></thead><tbody>";
      let totalJml = 0;
      let totalVc = 0;
      for(var key in dataItem){
        let obj = dataItem[key]
        dataTab += "<tr><td>"+obj.no+"</td><td>"+obj.nama+"</td><td>"+obj.handphone+"</td><td>"+obj.email+"</td><td>"+obj.voucher+"</td><td>"+obj.jumlah+"</td><td><button class='btn btn-warning' onclick='hapus("+obj.no+")'>hapus</button></td></tr>"
        totalVc += (obj.voucher * obj.jumlah)
        totalJml += obj.jumlah
      }
      totalSemuaBayar = totalVc;
      dataTab += "<tr><td colspan='4'>Total</td><td>"+totalVc+"</td><td>"+totalJml+"</td></tr>"
      document.getElementById("dataTable").innerHTML = dataTab;
    }else{
      document.getElementById("dataTable").style.display ='none';
      document.getElementById('pay-button').style.display='none';
      location.reload();
    }
  }

  function hapus(id){
    console.log(id)
    for(var key in dataItem){
      if(dataItem[key].no == id){
        dataItem.splice(key,1)
      }
    }
    addtable();
  }

 function prosesUpload(id){
      var result = "";
      var photoPelayanan = $('#uploadBuktiBayar').val();
      if (photoPelayanan !== ''){
          var file_data = $('#uploadBuktiBayar').prop('files')[0];
          var form_data = new FormData();

          form_data.append('file', file_data);
          form_data.append('text', $('#email').val());

          $.ajax({
               url:'<?php echo base_url();?>Snap/uploadPhoto/'+id,
               type:"post",
               data:form_data,
               processData:false,
               contentType:false,
               cache:false,
               async:false,
                success: function(data){
                  if (data.status === 'success') {
                      result = data.status;
                  }else{
                     result = "error";
                  }
             }
           });
      }else{
          alert('Harap Pilih Photo','error');
      }
      return result;
  }
  

  $('#pay-button').click(function (event) {
      console.log('totalBayar = ' + totalBayar);
      console.log('totalSemuaBayar = ' + totalSemuaBayar);
      const d = new Date();
      var idFoto = d.getTime();
      var totalBayar = document.getElementById('totalBayar').value;

      if (totalBayar > totalSemuaBayar){
        alert("Harap Tambah Voucher Sesuai Total Pembayaran")
      }else{
        document.getElementById('pay-button').disabled=true;
        var cekUpload = prosesUpload(idFoto);
        console.log("SIMPAN DATA");
        console.log(cekUpload);
        if(cekUpload !== 'error'){
            if(dataItem !=""){
              $.ajax({
                url: '<?=site_url()?>/snap/tokenManual',
                cache: false,
                data:  {
                  data : dataItem,
                  idFoto : idFoto
                },
                dataType: "JSON",
                method : "GET",
                success: function(data) {
                    //location = data;
                    if (data.status === '200'){
                        alert(data.value);
                        location.reload();
                      }else {
                        alert(data.value);
                        location.reload();
                      }
                    }
                  });
            }else{
              alert("Masukan Item Voucher")
            } 
      }else{
        alert("Harap Masukan Format JPG|PNG")
        location.reload();
      }
    }
    });

  function updateVirtualAccount(idVal, typeval, vaval){
    console.log(vaval);
    $.ajax({
      type: "GET", 
      url: "<?php echo base_url('snap/updateVirtualAccount')?>",
      cache: false,
      data:  {
        id :idVal,
        type : typeval,
        va : vaval
      },
      dataType: "JSON",
      success: function(data){
        console.log(data);
      }             
    });
  }

  function updateTransferDone(idVal, typeval, vaval){
    console.log(vaval);
    $.ajax({
      type: "GET", 
      url: "<?php echo base_url('snap/updateTransferDone')?>",
      cache: false,
      data:  {
        id :idVal,
        type : typeval,
        va : vaval
      },
      dataType: "JSON",
      success: function(data){

        console.log(data);
      }             
    });
  }

  function myFunctionCopy(t){
    navigator.clipboard.writeText(t);
    alert("Copied the text: " + t);
  }
  //for modal

  

  btn.onclick = function() {
    var valueSearch = document.getElementById("valueSearch").value;
    if(valueSearch !== ""){
      if(valueSearch.length < 10){
        alert("Masukan nama/handphone lebih dari 10 karakter")
      }else{
          $.ajax({
            type: "GET", 
            url: "<?php echo base_url('snap/searchDataSellingVoucherManual')?>",
            cache: false,
            data:  {
              valueSearch :valueSearch
            },
            dataType: "JSON",
            success: function(data){
              if (data.length > 0){
                addToTableModal(data);
              }else{
                alert("Data tidak ditemukan !");
              }
            }             
          });
      }
    }else{
      alert("Masukan nama/handphone !")
    }
  }

  span.onclick = function() {
    modal.style.display = "none";
    document.getElementById("valueSearch").value = "";
  }

  window.onclick = function(e) {
    if (e.target == modal) {
      modal.style.display = "none";
      document.getElementById("valueSearch").value = "";
    }
  }
  function addToTableModal(data){

    var html = "";

    for (var i = 0; i < data.length; i++) {
      var vc = data[i].vouchermanual;
      var nama = vc.nama;
      var handphone = vc.handphone;
      var email = vc.email;
      var totalVoucher = vc.totalVoucher;
      var totalBayar = vc.totalBayar;
      var typetransfer = vc.typetransfer;
      var virtualAccount = vc.uploadBuktiBayar;
      var dateCreatedAdd = vc.dateCreatedAdd;
      var statusVoucher = vc.statusBayar;
      var bg = "";
      var text = "";

      if (statusVoucher === 'N'){
        bg = "red";
        text = "NEW";
      }else if (statusVoucher === 'H'){
        bg = "yellow";
        text = "HOLD, SEGERA LAKUKAN PEMBAYARAN";
      }else if (statusVoucher === 'D'){
        bg = "#20fc03";
        text = "DONE, VOUCHER TELAH TERBIT";
      }else if (statusVoucher === 'E'){
        bg = "black";
        text = "EXPIRED, SILAHKAN LAKUKAN PEMBELIAN";
      }
      var buttonCPVA = "";
      
      html += '<div class="card-header" style="background-color: '+bg+'"><h3>Status : '+text+'</h3><small>Tanggal Pembelian : '+dateCreatedAdd+'</small></div><div class="card-body"><div class="table-responsive"><table border="1px" cellpadding="5px" id="dataTableCari" width="100%" cellspacing="0">';
      html += '<tbody>';
      html += '<tr><td style="background-color: black;color: white">Nama Lengkap</td><td>'+nama+'</td></tr>';
      html += '<tr><td style="background-color: black;color: white">Handphone</td><td>'+handphone+'</td></tr>';
      html += '<tr><td style="background-color: black;color: white">Email</td><td>'+email+'</td></tr>';
      html += '<tr><td style="background-color: black;color: white">Total Voucher</td><td>'+totalVoucher+'</td></tr>';
      html += '<tr><td style="background-color: black;color: white">Total Bayar</td><td>'+totalBayar+'</td></tr>';
      html += '<tr><td style="background-color: black;color: white">Type Transfer</td><td>'+typetransfer+'</td></tr>';
      
      
      var vcitem = data[i].vouchermanualitem;
      if (statusVoucher === 'D'){
        html += '<tr ><td colspan="2"><table border="1px" cellpadding="5px" id="dataTable" width="100%" cellspacing="0">'
        html += '<tr style="background-color: black;color: white"><td>Kode Voucher</td><td>Nominal</td><td>Status</td><td>Date Created</td></tr>';
        for (var y = 0 ; y < vcitem.length; y++){

          var vcit = vcitem[y];
          var kodeVoucher = vcit.kodeVoucher;
          var nominalVoucher = vcit.nominalVoucher;
          var statusVoucher = vcit.statusVoucher;
          var dateCreatedVoucher = vcit.dateCreatedVoucher;
          var bgitem = "";
          var textitem = "";

          if (statusVoucher === 'D'){
            bgitem = "red";
            textitem = "NEW";
          }else if (statusVoucher === 'H'){
            bgitem = "yellow";
            textitem = "HOLD";
          }else if (statusVoucher === 'N'){
            bgitem = "#20fc03";
            textitem = "NEW";
          }else if (statusVoucher === 'E'){
            bgitem = "red";
            textitem = "EXPIRED";
          }
          html += '<tr><td><button style="background-color: blue;" onclick="myFunctionCopy(\''+kodeVoucher+'\')">Copy</button>'+kodeVoucher+'</td><td>'+nominalVoucher+'</td><td style="background-color: '+bgitem+'">'+textitem+'</td><td>'+dateCreatedVoucher+'</td></tr>';
        }
        html += '</table></td></tr>';
      }
      html += '<tbody></table></div><hr></div></div>';
    }
    modal.style.display = "block";
    document.getElementById("dataTableCari").innerHTML = html;
  }


</script>


</body>
</html>
