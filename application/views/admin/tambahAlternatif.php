         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Tambah Data Alternatif</li>
                        </ol>
                       
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Data Alternatif</div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <form action="<?= base_url('Admin/p_Alternatif'); ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                        <div class="col-6">
                                            <label>Nama Peserta</label>
                                            <select class="form-control" onchange="cariNilaiPeserta()"  name="idPeserta" id="idPeserta" required>
                                                <option value="">--Pilih--</option>
                                                <?php foreach ($dumPeserta as $key) { ?>
                                                <option value="<?= $key['id_p'];?>"><?= $key['_nm_p'];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-6 mt-3">
                                            <table border="1px" id="tableKriteria" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr style="background-color: black;color: white">
                                                        <td>Nama Kriteria</td>
                                                        <td>Nilai</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    foreach ($dumpKriteria as $p):?>
                                                        <tr>
                                                            <td><?= $p['namaKriteria'];?></td>    
                                                            <td><input type="number" name="<?= $p['idKriteria'];?>" id="<?= $p['namaKriteria'];?>"></td>    
                                                        </tr>
                                                    <?php 
                                                    endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                            <button type="reset" class="btn btn-danger mt-3 ml-2">Reset</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

<script type="text/javascript">

    var tableKriteria = document.getElementById('tableKriteria');
    tableKriteria.style.display="none";
    function cariNilaiPeserta() {
        var idPeserta = document.getElementById("idPeserta").value;
        if(idPeserta != ""){
            $.ajax({
                type: "GET", 
                url: "<?php echo base_url('Admin/getValueHasilTestPeserta')?>",
                data:  {
                    idPeserta :idPeserta
                },
                dataType: "JSON",
                success: function(data){
                  console.log(data);
                  document.getElementById("Pengetahuan Umum").value = data;
                }             
              });
            tableKriteria.style.display="inline";
        }else{
            tableKriteria.style.display="none";
            alert("Harap Pilih Peserta !");
        }
    }
</script>