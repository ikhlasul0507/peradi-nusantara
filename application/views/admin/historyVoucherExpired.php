         <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                   
                    <?php  if($this->session->flashdata('pesan')): ?>   
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong><?= $this->session->flashdata('pesan');?></strong> 
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php  endif; ?>
                <div class="card mb-3 mt-3">
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Data History Expired Voucher</div>
                </div>
                <div class="table-responsive">

                    <table border="1" style="width: 100%;font-size: 11px">
                        <tr style="background-color: black;color: white"><b>
                            <td>ID History</td>
                            <td>Nama Peserta</td>
                            <td>Kode Voucher</td>
                            <td>Nominal Voucher</td>
                            <td>Waktu Vote</td>
                            <td>Name Vote</td>
                            <td>Status</td>
                            </b>
                        </tr>
                         <?php 
                        $usersData = $this->db->query("SELECT * FROM history_voucher LEFT JOIN tbl_dpv ON history_voucher.id_peserta = tbl_dpv.id_dpv")->result_array();
                        foreach ($usersData as $key) :
                           ?>
                        <tr>
                            <td><?= $key['id_hv'];?></td>
                            <td><?= $key['nm_v'];?></td>
                            <td><?= $key['voucher'];?></td>
                            <td><?="Rp. ". number_format($key['nominal'], 0, ',', '.');?></td>
                            <td><?= $key['dateCreated'];?></td>
                            <td><?= $key['name_vote'];?></td>
                            <td style="background-color: red">Expired</td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>