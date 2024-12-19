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
            <form class="user" method="post" action="<?= base_url('P/Admin/report_payment_order')?>">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                <div class="form-group row">
              
                    <div class="col-sm-3 mb-3 mb-sm-0">
                            <small>Dari Tanggal Berapa</small>
                            <input type="date" class="form-control" name="datefrom"
                            placeholder="Dari Tanggal Berapa" value="<?= $datefrom;?>" required>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                            <small>Sampai Tanggal Berapa</small>
                            <input type="date" class="form-control" name="datethru"
                            placeholder="Dari Tanggal Berapa" value="<?= $datethru;?>" required>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <small>Nama Peserta</small>
                        <input type="text" class="form-control" name="nama_lengkap"
                            placeholder="Nama Peserta" value="<?= $nama_lengkap;?>">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <small>Ubah Status</small>
                        <select name="statusOB" id="statusOB" class="form-control" value="<?= $status;?>">
                            <option value="">--Pilih--</option>
                            <option value="Y">Paid</option>
                            <option value="N">Unpaid</option>
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
            <?php if($datefrom != ''){?>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalJadwal" >Ubah Status</button>
            <?php }?>
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
            <div class="table-responsive" style="font-size: 10px;
            color: black ; 
            max-height: calc(80vh - 120px);
            overflow-y: auto;">
                <table class="" border="1px" id="tableData" cellpadding="0px" cellspacing="0">
                    <thead>
                        <tr style="background-color: silver">
                            <th>Waktu Order</th>
                            <th>Status Paid</th>
                            <th>Nama</th>
                            <th>Handphone</th>
                            <th>Reference</th>
                            <th>PIC</th>
                            <th>Angkatan</th>
                            <th>Nama Kelas</th>
                            <th style="text-align: center;">
                                <input type="checkbox" id="selectAll" style="width:20px; height:20px; vertical-align: middle;" onclick="toggleCheckboxes(this)">
                                Select All
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 
                        foreach ($list_report as $lr) { 
                        ?>
                        <tr>
                            <td><?= $lr['time_history'];?></td>
                            <td><b><?= $lr['is_paid'] == 'N' ? 'Unpaid' : 'Paid' ;?></b></td>
                            <td><?= $lr['nama_lengkap'];?></td>  
                            <td><?= $lr['handphone'];?></td>
                            <td><?= $lr['reference'];?></td>
                            <td><?= $lr['pic'];?></td>
                            <td><?= $lr['angkatan_kelas'];?></td>
                            <td><?= $lr['nama_kelas'];?></td>
                            <td>
                                <input type="checkbox" class="item" name="item" value="<?= $lr['id_order_booking'];?>" style="width:20px; height:20px" onclick="toggleCheckboxesOnly(this)">
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<div class="modal fade" id="modalJadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="user" method="post">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="exampleModalLabel">Jadwal Pelatihan</h5> -->
                    <h5 class="modal-title" id="totalApprove">Total Data : 0 </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="col-sm-12 mb-3 mt-2 mb-sm-0">
                            <label>Ubah Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">--Pilih--</option>
                                <option value="Y">Paid</option>
                                <option value="N">Unpaid</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="button"  onclick="getSelectedItems()" class="btn btn-primary">Lakukan Approve</button>
                </div>
            </form>
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
      filename = filename ? filename + '.xls' : '_excel_data.xls';

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

    // Function to check or uncheck all checkboxes
    function toggleCheckboxes(source) {
        var checkboxes = document.querySelectorAll('.item');
        var totalApprove = 0;

        for (var i = 0; i < checkboxes.length; i++) {
            // Toggle the checkbox state
            checkboxes[i].checked = source.checked;

            // Increment the count if the checkbox is checked
            if (checkboxes[i].checked) {
                totalApprove++;
            }
        }
        // Update the totalApprove count in the element with the correct syntax
        document.getElementById('totalApprove').innerHTML = 'Total Approve: ' + totalApprove;
    }
    function toggleCheckboxesOnly(source) {
        document.getElementById("selectAll").checked = false;
        var checkboxes = document.querySelectorAll('.item');
        var totalApprove = 0;
        for (var i = 0; i < checkboxes.length; i++) {
             // Increment the count if the checkbox is checked
            if (checkboxes[i].checked) {
                totalApprove++;
            }
        }
        // Update the totalApprove count in the element with the correct syntax
        document.getElementById('totalApprove').innerHTML = 'Total Approve: ' + totalApprove;
    }

    // Function to get all selected checkboxes
    function getSelectedItems() {
        var status = document.getElementById('status').value;
        if(status !== ""){
            var selected = [];
            var checkboxes = document.querySelectorAll('.item:checked');
            for (var i = 0; i < checkboxes.length; i++) {
                selected.push(checkboxes[i].value);
            }
            var dataJadwal = {
                data : {
                    status,
                }
            }
            if(selected.length > 0){
                //approve data
                $("#loading").show();
                $(".loader").show();
                requestToDB(selected.join(', '), dataJadwal);

                console.log(selected.join(', '));
                console.log(dataJadwal);
            }else{
                $(document).ready(function(){
                  Swal.fire({
                    title: "Silahkan checklist data approve sertifikat",
                  });
                });
            }
        }else{
             $(document).ready(function(){
              Swal.fire({
                title: "Silahkan Pilih Status",
              });
            });
        }
        // document.getElementById('list_id').value = selected.join(', ');
    }

    function requestToDB(id_order, dataJadwal)
    {
        $.ajax({
          type: "GET", 
          url: "<?php echo base_url('P/Admin/changes_payment_order')?>",
          cache: false,
          data:  {
            list_id_order : id_order,
            dataJadwal : dataJadwal
          },
          dataType: "JSON",
          success: function(data){
            console.log(data);
            if(data.status_code == 200){
                $("#loading").hide();
                $(".loader").hide();
                $(document).ready(function(){
                     Swal.fire({
                        title: "Perubahan berhasil",
                        text: "Total Data: " + data.totalCustomer,
                     }).then(() => {
                        // Reload the page after the alert is closed
                        window.location.href = '<?php echo base_url('P/Admin/report_payment_order')?>';
                     });
                });
            }
          }             
        });
    }
</script>