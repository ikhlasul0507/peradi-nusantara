<!-- Begin Page Content -->
<style type="text/css">
    th, td {
      padding: 1px 10px;
      border: 1px solid #ddd;
      text-align: left;
      white-space: nowrap; /* Prevents text from wrapping */
      text-overflow: ellipsis; /* Adds ellipsis (...) to truncated text */
    }
</style>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div id="filterData" class="collapse mt-4 container-fluid" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <form class="user" method="post" action="<?= base_url('P/Admin/report_peserta')?>">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <input type="text" class="form-control" name="nama_lengkap"
                            placeholder="Nama Peserta" value="<?= $nama_lengkap;?>">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <input type="text" class="form-control" name="reference"
                            placeholder="Referensi" value="<?= $reference;?>">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <input type="text" class="form-control" name="pic"
                            placeholder="PIC" value="<?= $pic;?>">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <select class="form-control" required name="angkatan">
                                <option value="<?= $angkatan; ?>" disabled selected>--Pilih Angkatan--</option>
                                <?php for ($i= $startAngkatan; $i <= $endAngkatan; $i++) {?>
                                    <option value="Angkatan Ke - <?=$i;?>">Angkatan Ke - <?=$i;?></option>
                                <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <input type="date" class="form-control" name="time_history"
                            placeholder="Waktu Order" value="<?= $time_history;?>">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <select class="form-control" name="id_master_kelas" value="<?= $id_master_kelas;?>">
                            <option value="" selected class="placeholder">--Pilih Kelas--</option>
                            <?php foreach ($list_master_kelas as $lms) { ?>
                            <?php if($id_master_kelas == $lms['id_master_kelas']){ ?>
                                <option selected value="<?= $lms['id_master_kelas'];?>"><?= $lms['nama_kelas'];?></option>
                            <?php }else{ ?>
                                <option value="<?= $lms['id_master_kelas'];?>"><?= $lms['nama_kelas'];?></option>
                            <?php }} ?>
                        </select>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <select class="form-control" name="status_sertifikat" value="<?= $status_sertifikat;?>">
                            <option value="" selected class="placeholder">--Status Sertifikat--</option>
                            <option value="A" <?=$status_sertifikat=='A'?'selected':''?>>Telah Terbit</option>
                            <option value="P" <?=$status_sertifikat=='P'?'selected':''?>>Belum Terbit</option>
                        </select>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <select class="form-control" name="status_lunas" value="<?= $status_lunas;?>">
                            <option value="" selected class="placeholder">--Status Pembayaran--</option>
                            <option value="D" <?=$status_lunas=='D'?'selected':''?>>Lunas</option>
                            <option value="L" <?=$status_lunas=='L'?'selected':''?>>Belum Lunas</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Cari Data</button>
            </form>
        </div>
        <div id="importData" class="collapse mt-4 container-fluid" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <form class="user" method="post" enctype="multipart/form-data" action="<?= base_url('P/Admin/importDataPeserta')?>">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <input type="file" class="form-control" name="file_excel"
                            placeholder="Nama Peserta" value="">
                        <p class="mt-2">Download Template <a href="<?= base_url('assets/p/format_file/Format_Import_Data_Peserta.xlsx')?>">Download</a></p>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Proses Import</button>
            </form>
        </div>
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <a class="btn btn-danger" href="#" data-toggle="collapse" data-target="#filterData"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-search"></i>
                <span>Filter Data</span>
            </a>
            <?php if ($allowImportDataPeserta == "Y"): ?>
            <a class="btn btn-dark" href="#" data-toggle="collapse" data-target="#importData"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-download fa-sm text-white-50"></i>
                <span>Import Data</span>
            </a>
            <?php endif ?>

            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Export Data:</div>
                    <button class="dropdown-item" onclick="exportTableToExcel('tableData', 'Report_detail_perserta')">Excel</button>
                    <button class="dropdown-item" onclick="exportTableToCSV('report_data.csv')">CSV</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="font-size: 10px;color: black">
                <table class="" border="1px" id="tableData" cellpadding="0px" cellspacing="0">
                    <thead>
                        <tr style="background-color: silver">
                            <th>Waktu Order</th>
                            <th>ID Order</th>
                            <th>NIK</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Handphone</th>
                            <th>Usia</th>
                            <th>Asal Kampus</th>
                            <th>Referensi - PIC</th>
                            <th>Angkatan</th>
                            <th>Nama Kelas</th>
                            <!-- <th style="white-space: nowrap; ">Deskrispsi Kelas</th> -->
                            <th>Metode Bayar</th>
                            <!-- <th>Link WA</th> -->
                            <th>ID Virtual Account</th>
                            <th>Tanggal Bayar</th>
                            <th>Urutan Bayar</th>
                            <th>Jumlah Bayar</th>
                            <th>Status Bayar</th>
                            <th>Status Sertifikat</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 
                        $arrayNIK = [];
                        $arrayEmail = [];
                        $arrayNama = [];
                        $arrayHP = [];
                        $arrayUsia = [];
                        $arrayAsalKampus = [];
                        $arrayAngkatan = [];
                        $arrayIDOrder = [];
                        $arrayNamaKelas = [];
                        $arrayReferensi = [];
                        $arrayPIC = [];

                        $tempNik = "";
                        $tempEmail = "";
                        $tempNama = "";
                        $tempHP = "";
                        $tempUsia = "";  
                        $tempAsalKampus = "";
                        $tempAngkatan = "";
                        $tempIDOrder = "";
                        $tempNamaKelas = "";
                        $tempReferensi = "";
                        $tempPIC = "";
                        $totalPeserta = 0;
                        $totalNominalPayment = 0;
                        foreach ($list_report as $lr) { 
                            $totalNominalPayment = $totalNominalPayment + $lr['nominal_payment'];
                            if(in_array($lr['id_user'].$lr['reference'], $arrayReferensi)){
                                $tempReferensi = "-";
                            }else{
                                $tempReferensi = $lr['id_user'].$lr['reference'];
                                $totalPeserta++;
                                array_push($arrayReferensi, $lr['id_user'].$lr['reference']);
                            }

                            if(in_array($lr['id_user'].$lr['pic'], $arrayPIC)){
                                $tempPIC = "-";
                            }else{
                                $tempPIC = $lr['id_user'].$lr['pic'];

                                array_push($arrayPIC, $lr['id_user'].$lr['pic']);
                            }


                            if(in_array($lr['id_user'].'-'.$lr['nama_kelas'], $arrayNamaKelas)){
                                $tempNamaKelas = "-";
                            }else{
                                $tempNamaKelas = $lr['id_user'].'-'.$lr['nama_kelas'];

                                array_push($arrayNamaKelas, $lr['id_user'].'-'.$lr['nama_kelas']);
                            }


                            if(in_array('OB-'.$lr['id_order_booking'], $arrayIDOrder)){
                                $tempIDOrder = "-";
                            }else{
                                $tempIDOrder = 'OB-'.$lr['id_order_booking'];

                                array_push($arrayIDOrder, 'OB-'.$lr['id_order_booking']);
                            }

                            if(in_array($lr['nik'], $arrayNIK)){
                                $tempNik = "-";
                            }else{
                                $tempNik = $lr['nik'];

                                array_push($arrayNIK, $lr['nik']);
                            }

                            if(in_array($lr['email'], $arrayEmail)){
                                $tempEmail = "-";
                            }else{
                                $tempEmail = $lr['email'];

                                array_push($arrayEmail, $lr['email']);
                            }

                            if(in_array($lr['nama_lengkap'], $arrayNama)){
                                $tempNama = "-";
                            }else{
                                $tempNama = $lr['nama_lengkap'];

                                array_push($arrayNama, $lr['nama_lengkap']);
                            }


                            if(in_array($lr['handphone'], $arrayHP)){
                                $tempHP = "-";
                            }else{
                                $tempHP = $lr['handphone'];

                                array_push($arrayHP, $lr['handphone']);
                            }

                            if(in_array($lr['usia'], $arrayUsia)){
                                $tempUsia = "-";
                            }else{
                                $tempUsia = $lr['usia'];

                                array_push($arrayUsia, $lr['usia']);
                            }
                            $lr['semester'] = $lr['semester'] == 1 ? "Sudah Lulus Dari - ".$lr['asal_kampus'] : "Belum Lulus Dari - ".$lr['asal_kampus'];
                            if(in_array($lr['semester'], $arrayAsalKampus)){
                                $tempAsalKampus = "-";
                            }else{
                                $tempAsalKampus = $lr['semester'];

                                array_push($arrayAsalKampus, $lr['semester']);
                            }

                            if(in_array($lr['id_user'].'-'.$lr['angkatan'], $arrayAngkatan)){
                                $tempAngkatan = "-";
                            }else{
                                $tempAngkatan = $lr['id_user'].'-'.$lr['angkatan'];

                                array_push($arrayAngkatan, $lr['id_user'].'-'.$lr['angkatan']);
                            }
                        ?>
                        <tr>
                            <td><?= $lr['time_history'];?></td>
                            <td><?= $tempIDOrder;?></td>
                            <td><?= $tempNik;?></td>
                            <td><?= $tempEmail;?></td>
                            <td><?= $tempNama;?></td>
                            <td><?= $tempHP;?></td>
                            <td><?= $tempUsia;?></td>
                            <td><?= $tempAsalKampus;?></td>
                            <td><?= $tempReferensi.'-'.$tempPIC;?></td>
                            <td><?= $tempAngkatan;?></td>
                            <td><?= $tempNamaKelas;?></td>
                            <!-- <td><?= $tempReferensi;?></td> -->
                            <td><?= $lr['metode_bayar'];?></td>
                            <!-- <td><?= $tempPIC;?></td> -->
                            <td><?= $lr['id_virtual_account'];?></td>
                            <td><?= $lr['date_payment'];?></td>
                            <td><?= $lr['sequence_payment'];?></td>
                            <td><?= 'Rp. '.number_format($lr['nominal_payment'], 2);?></td>
                            <td><?= $lr['status_payment'] == "D" ? "Lunas" : "Belum Lunas";?></td>
                            <td><?= $lr['status_certificate'] == "P" ? "Belum Terbit" : "Telah Terbit";?></td>
                        </tr>
                        <?php } ?>
                        <tfoot>
                            <tr style="background-color: silver">
                                <th colspan="2">Total Data</th>
                                <!-- <th></th> -->
                                <th><?= $totalPeserta; ?></th>
                                <th></th>
                                <th><?= $totalPeserta; ?></th>
                                <th><?= $totalPeserta; ?></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <!-- <th><?= $tempReferensi;?></th> -->
                                <th></th>
                                <!-- <th><?= $tempPIC;?></th> -->
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><?= 'Rp. '.number_format($totalNominalPayment, 2);?></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
  function exportTableToExcel(tableID, filename = ''){
      var downloadLink;
      var dataType = 'application/vnd.ms-excel';
      var tableSelect = document.getElementById(tableID);
      var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

      // Specify file name
      filename = filename ? filename + '.xlsx' : '_excel_data.xlsx';

      // Create download link element
      downloadLink = document.createElement("a");

      document.body.appendChild(downloadLink);

      if(navigator.msSaveOrOpenBlob){
          var blob = new Blob(['\ufeff', tableHTML], {
              type: dataType
          });
          navigator.msSaveOrOpenBlob( blob, filename);
      } else {
          // Create a link to the file
          downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

          // Setting the file name
          downloadLink.download = filename;

          //triggering the function
          downloadLink.click();
      }
  }

  function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // Create a CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Create a download link
    downloadLink = document.createElement("a");

    // Set the file name
    downloadLink.download = filename;

    // Link the file to the download link
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide the link
    downloadLink.style.display = "none";

    // Append the link to the document
    document.body.appendChild(downloadLink);

    // Trigger a click event to download the file
    downloadLink.click();
  }

  function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("#tableData tr");

    // Loop through each row
    for (var i = 0; i < rows.length; i++) {
      var row = [], cols = rows[i].querySelectorAll("td, th");

      // Loop through each cell (td or th)
      for (var j = 0; j < cols.length; j++) {
        row.push(cols[j].innerText);
      }

      // Join each row with a comma and push it to the CSV array
      csv.push(row.join(";"));
    }

    // Join the rows with new lines to create the CSV content
    downloadCSV(csv.join("\n"), filename);
  }
</script>
