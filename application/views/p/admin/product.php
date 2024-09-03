
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelas Belajar</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <?php foreach ($list_data as $value) { ?>
        <div class="col-lg-3 mb-4">
            <div class="card shadow border-left-primary mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $value['nama_kelas'];?></h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem; height: 4rem"
                            src="<?= base_url('assets/p/img/'.$value['foto_kelas']);?>" alt="...">
                    </div>
                    <a  class="btn btn-sm btn-danger" href="<?= base_url('P/Admin/add_order_cart/'.$value['id_master_kelas'])?>"><i class="fas fa-plus"></i> Tambah ke keranjang</a>
                    <!-- <a  data-toggle="modal" data-target="#modal<?=$value['id_master_kelas']?>" class="btn btn-sm btn-primary" href="#">Gabung Kelas</a> -->
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

</div>
<!-- /.container-fluid -->
    <?php foreach ($list_data as $value) { 

        $tahapBayar = explode(",", $value['metode_bayar']);

    ?>
    <div class="modal fade" id="modal<?=$value['id_master_kelas']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="user" action="<?= base_url('P/Admin/process_order_product')?>" method="post">
                 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?= $value['nama_kelas'];?></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <input type="hidden" name="nama_kelas" value="<?=$value['nama_kelas']?>">
                        <input type="hidden" name="id_master_kelas" value="<?=$value['id_master_kelas']?>">
                        <input type="hidden" name="id_user" value="<?=$this->session->userdata('id_user');?>">
                        <select class="form-control" name="metode_bayar" required>
                            <option value="" disabled selected class="placeholder">--Pilih Metode Pembayaran--</option>
                            <?php foreach ($tahapBayar as $t) { ?>
                            <option value="<?= $t; ?>"><?= $t; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php } ?>

            