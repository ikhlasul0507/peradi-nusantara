         <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <ol class="breadcrumb mb-4 mt-2">
                        <li class="breadcrumb-item active">Data Report Selling Voucher </li>
                    </ol>
                    <?php  if($this->session->flashdata('pesan')): ?>   
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong><?= $this->session->flashdata('pesan');?></strong> 
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php  endif; ?>
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Data Report Selling Voucher</div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tbody>
                               <tr style="background-color: silver">
                                <td>Selling Voucher</td>
                                <td>Total Nominal</td>
                            </tr>
                             <tr style="background-color: green;color: white">
                                <td ><b>Selling Voucher</b></td>

                                <td>
                                    <?php 
                                    $tsf = $this->db->query("SELECT SUM(nominalVoucher) as Totals FROM tbl_sellingvoucher WHERE statusVoucher=2")->row_array();
                                    $tPeny = $tsf['Totals']; 
                                    $totalNilai = $tPeny;
                                    echo "Rp. ". number_format($totalNilai, 0, ',', '.');?>

                                </td>
                            </tr>
                        <tr style="background-color: red; color: white">
                            <td>Total Keseluruhan</td>
                            <td><b><?php echo "Rp. ". number_format($totalNilai, 0, ',', '.');?></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>