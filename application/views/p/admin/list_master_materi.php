<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
            <h6 class="m-0 font-weight-bold text-primary">Master Data Kelas</h6>
            <a href="<?= $previous_url;?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
        
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
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
                                <td><?= $value['date_field'].' '.$value['waktu']; ?></td>
                                <td><?= $value['nama_kelas'].'-'.$value['angkatan']; ?></td>
                                
                                <?php if (date('Y-m-d') >= $value['date_field']) { ?>
                                    <!-- For future classes or events -->
                                    <td><a href="<?= base_url('assets/p/file/'.$value['dokument_materi']); ?>">Download</a></td>
                                    <td><a target="_blank" href="<?= $value['link_zoom']; ?>">Masuk Zoom</a></td>
                                    <td><a target="_blank" href="<?= $value['dokument_video']; ?>">Buka Video</a></td>
                                    <td><button class="badge badge-info"><?= $value['status_materi_kelas'] == 'A' ? 'Aktif' : 'Tidak Aktif'; ?></button></td>
                                <?php } else { ?>
                                    <!-- For past or upcoming classes/events -->
                                    <td><button class="badge badge-warning" disabled>Soon</button></td>
                                    <td><button class="badge badge-warning" disabled>Soon</button></td>
                                    <td><button class="badge badge-warning" disabled>Soon</button></td>
                                    <td><button class="badge badge-warning" disabled>Soon</button></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
