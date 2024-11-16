
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Terbitkan Sertifikat</h1>
        <?php if($allowButtonApprove == "Y"){ ?>
        <button class="btn btn-danger" data-toggle="modal" data-target="#modalJadwal" >Approve</button>
        <?php } ?>
    </div>

    <!-- Content Row -->
     <div class="card-body">
            <div class="table-responsive">
                <div id="selectedItems"></div>
                <input type="hidden" id="list_id" value="">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="color: black">
                    <thead>
                        <tr style="background-color: silver">
                            <th>Aksi</th>
                            <th>Detail Orderan</th>
                            <th>Data</th>
                            <th>Status Orderan</th>
                            <th><input type="checkbox" id="selectAll" style="width:20px; height:20px" onclick="toggleCheckboxes(this)"> Select All</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_data as $value) { 
                            $array = explode("~", $value['list_kelas']);
                            $array = array_filter($array, function($value) {
                                return $value !== '';
                            });
                            $inClause = implode(",", $array);
                            $query = "SELECT GROUP_CONCAT(nama_kelas)AS nama_kelas , foto_kelas  FROM master_kelas WHERE id_master_kelas IN ($inClause)";
                            $getListKelas = $this->db->query($query)->row_array();

                            ?>
                        <tr>
                            <td>
                                <a href="<?= base_url('P/Admin/valid_order/'.$value['id_user'].'/'.$value['id_order_booking']);?>" class="btn btn-success btn-circle">
                                    <i class="fas fa-info"></i>
                                </a> Lihat Detail
                                <?php if($value['status_order'] != 'D'){ ?>
                                <a class="btn btn-danger btn-circle" onclick="confirmDeleteData('<?= base_url('P/Admin/delete_order_class/').$value['id_order_booking'];?>')">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <?php } ?>
                            </td>
                            <td>
                               
                                Waktu Order :  <?= $value['time_history'];?><br>
                                Nama :  <?= $value['nama_lengkap'];?><br>
                                Handphone :  <?= $value['handphone'];?><br>
                            </td>
                            <td>
                                Referensi : <?= $value['reference'];?><br>
                                PIC : <?= $value['pic'];?><br>
                                Angkatan : <?= $value['angkatan'];?><br>
                            </td>
                            <td>
                                <?php if($value['status_order'] == 'D'){?>
                                    <button class="badge badge-success" href="#" disabled>Selesai Belajar</button>
                                <?php } ?>
                                <button class="badge badge-danger" disabled><?= $getListKelas['nama_kelas'];?></button>
                                <button class="badge badge-primary" disabled><?= $value['metode_bayar'];?></button>
                            </td>
                            <td>
                                <input type="checkbox" class="item" name="item" value="<?= $value['id_order_booking'];?>" style="width:20px; height:20px" onclick="toggleCheckboxesOnly(this)">
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
                    <h5 class="modal-title" id="totalApprove">Total Approve : 0 </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="col-sm-12 mb-3 mt-2 mb-sm-0">
                            <label>PKPA</label>
                            <input type="text" class="form-control" required id="jadwal_pkpa"
                                placeholder="Jadwal PKPA">
                        </div>
                        <div class="col-sm-12 mb-3 mt-2 mb-sm-0">
                            <label>PARALEGAL</label>
                            <input type="text" class="form-control" required id="jadwal_paralegal"
                                placeholder="Jadwal PARALEGAL">
                        </div>
                        <div class="col-sm-12 mb-3 mt-2 mb-sm-0">
                            <label>UPA</label>
                            <input type="text" class="form-control" required id="jadwal_upa"
                                placeholder="Jadwal UPA">
                        </div>
                        <div class="col-sm-12 mb-3 mt-2 mb-sm-0">
                            <label>BREVET A & B</label>
                            <input type="text" class="form-control" required id="jadwal_brevet"
                                placeholder="Jadwal BREVET A & B">
                        </div>
                        <div class="col-sm-12 mb-3 mt-2 mb-sm-0">
                            <label>CPT</label>
                            <input type="text" class="form-control" required id="jadwal_cpt"
                                placeholder="Jadwal CPT">
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
        var jadwal_pkpa = document.getElementById('jadwal_pkpa').value;
        var jadwal_paralegal = document.getElementById('jadwal_paralegal').value;
        var jadwal_upa = document.getElementById('jadwal_upa').value;
        var jadwal_brevet = document.getElementById('jadwal_brevet').value;
        var jadwal_cpt = document.getElementById('jadwal_cpt').value;
        console.log(jadwal_pkpa)
        if(jadwal_pkpa !== "" && jadwal_paralegal !== "" && jadwal_upa !== "" &&
            jadwal_brevet !== "" && jadwal_cpt !== ""){
            var selected = [];
            var checkboxes = document.querySelectorAll('.item:checked');
            for (var i = 0; i < checkboxes.length; i++) {
                selected.push(checkboxes[i].value);
            }
            var dataJadwal = {
                data : {
                    jadwal_pkpa,
                    jadwal_paralegal,
                    jadwal_upa,
                    jadwal_brevet,
                    jadwal_cpt
                }
            }
            console.log(dataJadwal);
            if(selected.length > 0){
                //approve data
                $("#loading").show();
                $(".loader").show();
                requestToDB(selected.join(', '), dataJadwal);

                console.log(selected.join(', '));
                console.log(selected.length);
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
                title: "Silahkan lengkapi jadwal Pelatihan",
              });
            });
        }
        // document.getElementById('list_id').value = selected.join(', ');
    }

    function requestToDB(id_order, dataJadwal)
    {
        $.ajax({
          type: "GET", 
          url: "<?php echo base_url('P/Admin/approve_certificate')?>",
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
                        title: "Approve berhasil",
                        text: "Total Customer: " + data.totalCustomer + ", Total Sertifikat: " + data.totalSertifikat,
                     }).then(() => {
                        // Reload the page after the alert is closed
                        window.location.href = '<?php echo base_url('P/Admin/DoneSertifikat')?>';
                     });
                });
            }
          }             
        });
    }
</script>

            