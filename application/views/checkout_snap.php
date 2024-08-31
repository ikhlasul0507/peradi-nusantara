<html>
<title>Checkout</title>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  <script type="text/javascript"
  src="<?= $urlMitrans; ?>" data-client-key="<?= $dataclientkey; ?>"></script>
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

  .penghalang2 {
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
    <nav class="navbar bg-primary mt-3 ">
      <div class="container-fluid">
        <a class="navbar-brand text-light" href="<?= base_url($urlRedirect);?>"><button class="btn btn-dark mr-2">Kembali Vote</button> Voucher Virtual Automatic Online</a>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" id="valueSearch" type="search" placeholder="Masukan nama/hp..." aria-label="Search">
          <button class="btn btn-dark" id="tombolku" type="button">Cek Voucher</button>
        </form>
      </div>
    </nav>

    <form id="payment-form" class="mt-4" method="post" action="<?=site_url()?>/snap/finish">
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
      <input type="number" class="form form-control" id="jumlah" placeholder="Masukan Jumlah" autocomplete>
    </div>
    <button id="add-button" type="button" class="btn btn-primary">Tambah Item</button>
    <button id="pay-button" class="btn btn-danger">Bayar</button>
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
     <div class="card-header" style="background-color: white"><h3>Status : Done</h3><small>Created : 222-222-222</small></div>
     <div class="card-body">
      <!-- kontek -->
      <div class="table-responsive">
        <table border="1px" cellpadding="5px" id="dataTableCari" width="100%" cellspacing="0">
          <tbody>
            <tr>
              <td style="background-color: black;color: white">Nama Lengkap</td>
              <td></td>
            </tr>
            <tr>
              <td style="background-color: black;color: white">Handphone</td>
              <td></td>
            </tr>
            <tr>
              <td style="background-color: black;color: white">Email</td>
              <td></td>
            </tr>
            <tr>
              <td style="background-color: black;color: white">Total Voucher</td>
              <td></td>
            </tr>
            <tr>
              <td style="background-color: black;color: white">Total Bayar</td>
              <td></td>
            </tr>
            <tr>
              <td style="background-color: black;color: white">Type Transfer</td>
              <td></td>
            </tr>
            <tr>
              <td style="background-color: black;color: white">Virtual Account</td>
              <td></td>
            </tr>
            <tr>
              <td style="background-color: black;color: white"></td>
              <td>
                <table border="1px" cellpadding="5px" id="dataTable" width="100%" cellspacing="0">
                  <tr style="background-color: black;color: white">
                    <td>Kode Voucher</td>
                    <td>Nominal</td>
                    <td>Status</td>
                    <td>Date Created</td>
                  </tr>
                  <tr >
                    <td>Kode Voucher</td>
                    <td>Nominal</td>
                    <td>Status</td>
                    <td>Date Created</td>
                  </tr>
                  <tr >
                    <td>Kode Voucher</td>
                    <td>Nominal</td>
                    <td>Status</td>
                    <td>Date Created</td>
                  </tr>
                </table>
              </td>
            </tr>
          </tbody>

        </table>
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
<div class="card-header bg-primary text-light">
  Kontak
</div>
<div class="card-body">
  <blockquote class="blockquote mb-0">
    <footer class="blockquote-footer"><?= $valueNameRekening; ?> -<cite title="Source Title"><?= $valueOfHandphoneAdmin; ?></cite></footer>
  </blockquote>
</div>
</div>
</div>


<!-- Button trigger modal -->
<div id="myModal2" class="penghalang2">
  <div class="modal-content">
    <div id="dataTableCari">
      <div class="card-header" style="background-color: white"><h3>Cara Pembelian Voucher</h3></div>
     <div class="card-body">
      <!-- kontek -->
      <div class="col-lg-12">
        <div class="right-content">
          <div class="h-100">
            <ol class="list-group list-group-numbered mb-3">
              <li class="list-group-item">
                <b>Lakukan Pengisian Data Dan Tekan Tombol Bayar</b>
                <img src="<?= base_url("asset/img/1.png") ?>" style="width: 100%">
              </li>
               <li class="list-group-item">
                <b>Pilih Transfer BANK</b>
                <img src="<?= base_url("asset/img/2.png") ?>" style="width: 100%">
              </li>
               <li class="list-group-item">
                <b>Pilih Salah Satu BANK Untuk Pembayaran</b>
                <img src="<?= base_url("asset/img/3.png") ?>" style="width: 100%">
              </li>
               <li class="list-group-item">
                <b>Catat Virtual Account Atau Bisa Tekan Tombol Salin</b>
                <img src="<?= base_url("asset/img/4.png") ?>" style="width: 100%">
              </li>
               <li class="list-group-item">
                <b>Tekan Tombol Merchant</b>
                <img src="<?= base_url("asset/img/5.png") ?>" style="width: 100%">
              </li>
              <li class="list-group-item">
                <h1><b>Lakukan Pembayaran Dengan Berhasil Melalui Bank Yang telah di pilih dengan virtual account yang telah di dapatkan</b></h1>
              </li>
               <li class="list-group-item">
                <b>Masuk Kembali Ke Website Kemudian Cek Kembali Status Pembelian Voucher</b>
                <img src="<?= base_url("asset/img/6.png") ?>" style="width: 100%">
              </li>

              <li class="list-group-item">
                <b>Jika Pembayaran Berhasil Maka Voucher akan terbit dan pembelian telah di lakukan</b>
                <img src="<?= base_url("asset/img/7.png") ?>" style="width: 100%">
              </li>
             
            </ol>
            <input type="checkbox" id="cekmemahami" value="">
           <label for="vehicle3"> Saya telah memahami petunjuk pembelian voucher</label><br><br>

    <span id="tutup2"><button class="btn btn-danger mb-3" style="width: 100%">Lanjut Pembelian</button></span>
          </div>
        </div>
      </div>
      <hr>
    </div>
  </div> 

</div> 
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">

  document.getElementById('pay-button').style.display='none';
  var modal2 = document.getElementById('myModal2');
  var btn = document.getElementById("tombolku");
  var span2 = document.getElementById("tutup2");
  var checkboxcek = document.getElementById("cekmemahami");

  modal2.style.display = "block";
  let dataItem = [];
  let number = 1;

  span2.onclick = function() {
    if (!checkboxcek.checked) {
      alert("Silahkan Check Jika Telah memahami petunjuk pembelian voucher")
    }else{
      modal2.style.display = "none";
      document.getElementById("valueSearch").value = "";
    }
  }

  $('#add-button').click(function (event) {
    var nama = document.getElementById('nama').value;
    var handphone = document.getElementById('handphone').value;
    var email = document.getElementById('email').value;
    var voucher = document.getElementById('voucher').value;
    var jumlah = document.getElementById('jumlah').value;
    if (jumlah > 10) {
      alert("Maaf Maksimal Pembelian Hanya 10 Voucher")
    }else{
      if (nama !== "" && handphone !== "" && email !== "" && voucher !=="" && jumlah !== ""){
        let item = {
          'no' : number,
          'nama' : document.getElementById('nama').value,
          'handphone' : document.getElementById('handphone').value,
          'email' : document.getElementById('email').value,
          'voucher' : parseInt(document.getElementById('voucher').value),
          'jumlah' : parseInt(document.getElementById('jumlah').value),
        }
        if(cekNilaiVc(document.getElementById('voucher').value)){
          alert("voucher sudah di input")
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
      let totalVc = 0;
      let totalJml = 0;
      for(var key in dataItem){
        let obj = dataItem[key]
        dataTab += "<tr><td>"+obj.no+"</td><td>"+obj.nama+"</td><td>"+obj.handphone+"</td><td>"+obj.email+"</td><td>"+obj.voucher+"</td><td>"+obj.jumlah+"</td><td><button class='btn btn-warning' onclick='hapus("+obj.no+")'>hapus</button></td></tr>"
        totalVc += obj.voucher * obj.jumlah
        totalJml += obj.jumlah
      }
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

  

  $('#pay-button').click(function (event) {
    event.preventDefault();
      // $(this).attr("disabled", "disabled");
      if(dataItem !=""){
        $.ajax({
          url: '<?=site_url()?>/snap/token',
          cache: false,
          data:  {
            data : dataItem
          },
          dataType: "JSON",
          method : "GET",
          success: function(data) {
              //location = data;
              console.log('token = '+data);
              if (data.status === '200'){
                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type,data){
                    // $("#result-type").val(type);
                    $("#hasilKeluar").val(JSON.stringify(data));

                    console.log(type);
                    console.log(data.token);
                    //resultType.innerHTML = type;
                    //resultData.innerHTML = JSON.stringify(data);

                    if (type === 'success') {

                      alert(data)
                      // desain html success
                    }else if (type === 'pending'){
                      // desain html pending
                    }else{
                      //desain html error
                    }
                  }

                  snap.pay(data.token, {

                    onSuccess: function(result){
                      changeResult('success', result.status_message);
                      console.log(result.status_message);
                      console.log(result);
                      // $("#payment-form").submit();
                      dataItem = [];
                      // alert(result.status_message)

                      // location.reload();
                      if(result.payment_type === 'bank_transfer'){
                        updateTransferDone(result.order_id,result.va_numbers[0].bank,result.va_numbers[0].va_number, result.transaction_id)
                      }
                      if(result.biller_code === '70012'){
                        updateTransferDone(result.order_id,'mandiri',result.bill_key, result.transaction_id);
                      }
                      if(result.payment_type === 'qris'){
                        updateTransferDone(result.order_id,result.payment_type,'000000000', result.transaction_id);
                      }
                      location.reload();
                    },
                    onPending: function(result){
                      changeResult('pending', result);
                      console.log(result);
                      // $("#payment-form").submit();
                      // location.reload();
                      dataItem = [];
                      alert(result.status_message)
                      if(result.payment_type === 'bank_transfer'){
                        updateVirtualAccount(result.order_id,result.va_numbers[0].bank,result.va_numbers[0].va_number, result.transaction_id)
                      }
                      if(result.biller_code === '70012'){
                        updateVirtualAccount(result.order_id,'mandiri',result.bill_key, result.transaction_id);
                      }
                      if(result.payment_type === 'qris'){
                        updateVirtualAccount(result.order_id,result.payment_type,'000000000', result.transaction_id);
                      }
                      location.reload();
                    },
                    onError: function(result){
                      changeResult('error', result);
                      console.log(result);
                      // $("#payment-form").submit();
                      // location.reload();
                      dataItem = [];
                      alert(result.status_message)
                      location.reload();
                    }
                  });

                }else {
                  alert(data.value);
                }
              }
            });
      }else{
        alert("Masukan Item Voucher")
      } 

    });

  function updateVirtualAccount(idVal, typeval, vaval, idtransaction){
    console.log(vaval);
    $.ajax({
      type: "GET", 
      url: "<?php echo base_url('snap/updateVirtualAccount')?>",
      cache: false,
      data:  {
        id :idVal,
        type : typeval,
        va : vaval,
        idt : idtransaction,
      },
      dataType: "JSON",
      success: function(data){
        console.log(data);
      }             
    });
  }

  function updateTransferDone(idVal, typeval, vaval, idtransaction){
    console.log(vaval);
    $.ajax({
      type: "GET", 
      url: "<?php echo base_url('snap/updateTransferDone')?>",
      cache: false,
      data:  {
        id :idVal,
        type : typeval,
        va : vaval,
        idt : idtransaction,
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

  var modal = document.getElementById('myModal');
  var btn = document.getElementById("tombolku");
  var span = document.getElementById("tutup");

  btn.onclick = function() {
    var valueSearch = document.getElementById("valueSearch").value;
    if(valueSearch !== ""){
     if(valueSearch.length < 10){
      alert("Masukan nama/handphone lebih dari 10 karakter")
    }else{
      $.ajax({
        type: "GET", 
        url: "<?php echo base_url('snap/searchDataSellingVoucher')?>",
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
  location.reload();
}

window.onclick = function(e) {
  if (e.target == modal) {
    modal.style.display = "none";
    location.reload();
  }
}
function addToTableModal(data){

  var html = "";

  for (var i = 0; i < data.length; i++) {
    var vc = data[i].voucherauto;
    var nama = vc.nama;
    var handphone = vc.handphone;
    var email = vc.email;
    var totalVoucher = vc.totalVoucher;
    var totalBayar = vc.totalBayar;
    var typetransfer = vc.typetransfer;
    var virtualAccount = "";
    var dateCreatedAdd = vc.dateCreatedAdd;
    var statusVoucher = vc.statusBayar;
    var idtransaction = vc.transaction_id;
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
    
      virtualAccount = vc.virtualAccount;
      buttonCPVA = '<button style="background-color: blue;" onclick="myFunctionCopy(\''+virtualAccount+'\')">Copy</button>';
     html += '<tr><td style="background-color: black;color: white">Virtual Account</td><td>'+buttonCPVA+virtualAccount+'</td></tr>';
    if (typetransfer === 'qris' && statusVoucher !== 'E') {
       html += '<tr><td style="background-color: black;color: white">Scan QR</td><td><img src="https://api.midtrans.com/v2/qris/'+idtransaction+'/qr-code" style="width:30%"></td></tr>';
    }

    var vcitem = data[i].voucherautoitem;
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
