<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
            <h6 class="m-0 font-weight-bold text-primary">Master Data Kelas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>Jadwal</th>
                            <th>Nama Kelas/Angkatan</th>
                            <th>Materi</th>
                            <th>Zoom</th>
                            <th>Youtube</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_data as $value) { ?>
                        <tr>
                            <td>
                                <a href="<?= base_url('P/Lms/edit_materi_kelas/'.$value['id_materi_kelas']);?>" class="btn btn-success btn-circle">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="btn btn-danger btn-circle" onclick="confirmDeleteData('<?= base_url('P/Lms/delete_materi_kelas/').$value['id_materi_kelas'];?>')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            <td><?= $value['date_field'].' '.$value['waktu'];?></td>
                            <td><?= $value['nama_kelas'].'-'.$value['angkatan'];?></td>
                            <td><a href="<?= base_url('assets/p/file/'.$value['dokument_materi']);?>">Download</a></td>
                            <td><a target="blank" href="<?= $value['link_zoom'];?>">Masuk Zoom</a></td>
                            <td><a target="blank" href="<?= $value['dokument_video'];?>">Buka Video</a></td>
                            <td><button class="badge badge-info"><?= $value['status_materi_kelas'] == 'A' ? 'Aktif' : 'Tidak Aktif';?></button></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
