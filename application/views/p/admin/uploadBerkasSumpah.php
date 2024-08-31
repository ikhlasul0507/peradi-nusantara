
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="<?= base_url('P/Admin/open_class/'.$value['id_user'].'/'.$value['id_order_booking']);?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card shadow border-left-primary mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><button class="btn btn-danger" disabled><?= $list_kelas_data['nama_kelas'];?></button></h6>
                </div>
                <div class="card-body">
                    <p>
                        Waktu Order :  <?= $value['time_history'];?><br>
                        Nama :  <?= $value['nama_lengkap'];?><br>
                        Handphone :  <?= $value['handphone'];?><br>
                        Metode Pembayaran : <button class="badge badge-primary" disabled><?= $value['metode_bayar'];?></button>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-8 mb-4">
            <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
                <h6 class="m-0 font-weight-bold text-primary">Data Berkas</h6>
            </div>
             <div class="table-responsive">
               <!--  <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Jenis Dokumen</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><small>Fotocopy Kartu Tanda Penduduk (KTP)/Surat Izin Mengemudi (SIM)</small></small></td>
                            <td>Belum Diunggah</td>
                            <td>
                                <div class="file-upload-wrapper">
                                    <button class="btn btn-success mb-2" disabled>Lihat</button>
                                    <input type="file" id="file-upload-ktp" name="userfile" onchange="uploadFile('file-upload-ktp','userfile','ktp')" class="file-upload" />
                                </div>  
                            </td>
                        </tr>
                        <tr>
                            <td><small>Surat Keterangan Magang Minimal 2 tahun berturut-turut</small></td>
                            <td>Belum Diunggah</td>
                            <td>
                                <div class="file-upload-wrapper">
                                    <button class="btn btn-success mb-2" disabled>Lihat</button>
                                    <input type="file" id="file-upload-magang" name="userfile" onchange="uploadFile('file-upload-magang','userfile','magang')" class="file-upload" />
                                </div>  
                            </td>
                        </tr>
                        <tr>
                            <td><small>Surat Keterangan tidak pernah pidana atau diancam hukuman pidana 5 tahun dari Pengadilan Negeri Domisi setempat</small></td>
                            <td>Belum Diunggah</td>
                            <td>
                                <div class="file-upload-wrapper">
                                    <button class="btn btn-success mb-2" disabled>Lihat</button>
                                    <input type="file" id="file-upload-skpidana" name="userfile" onchange="uploadFile('file-upload-skpidana','userfile','skpidana')" class="file-upload" />
                                </div>  
                            </td>
                        </tr>
                        <tr>
                            <td><small>Surat pernyataan tidak berstatus Aparat Sipil Negara (ASN) (PNS, TNI, POLRI, Notaris, Pejabat Negara)</small></td>
                            <td>Belum Diunggah</td>
                            <td>
                                <div class="file-upload-wrapper">
                                    <button class="btn btn-success mb-2" disabled>Lihat</button>
                                    <input type="file" id="file-upload-sppns" name="userfile" onchange="uploadFile('file-upload-sppns','userfile','sppns')" class="file-upload" />
                                </div>  
                            </td>
                        </tr>
                        <tr>
                            <td><small>Fotocopy Ijazah Sekolah Tinggi Hukum dilegalisir Basah</small></td>
                            <td>Belum Diunggah</td>
                            <td>
                                <div class="file-upload-wrapper">
                                    <button class="btn btn-success mb-2" disabled>Lihat</button>
                                    <input type="file" id="file-upload-ijazah" name="userfile" onchange="uploadFile('file-upload-ijazah','userfile','ijazah')" class="file-upload" />
                                </div>  
                            </td>
                        </tr>
                        <tr>
                            <td><small>Fotocopy Pendidikan Khusus Profesi Advokat (PKPA)</small></td>
                            <td>Belum Diunggah</td>
                            <td>
                                <div class="file-upload-wrapper">
                                    <button class="btn btn-success mb-2" disabled>Lihat</button>
                                    <input type="file" id="file-upload-fcpkpa" name="userfile" onchange="uploadFile('file-upload-fcpkpa','userfile','fcpkpa')" class="file-upload" />
                                </div>  
                            </td>
                        </tr>
                        <tr>
                            <td><small>Fotocopy Sertifikat Pelatihan Advokat dan Lulus Ujian Profesi Advokat</small></td>
                            <td>Belum Diunggah</td>
                            <td>
                                <div class="file-upload-wrapper">
                                    <button class="btn btn-success mb-2" disabled>Lihat</button>
                                    <input type="file" id="file-upload-fcupa" name="userfile" onchange="uploadFile('file-upload-fcupa','userfile','fcupa')" class="file-upload" />
                                </div>  
                            </td>
                        </tr>
                        <tr>
                            <td><small>Fotocopy SK Pengangkatan Advokat</small></td>
                            <td>Belum Diunggah</td>
                            <td>
                                <div class="file-upload-wrapper">
                                    <button class="btn btn-success mb-2" disabled>Lihat</button>
                                    <input type="file" id="file-upload-skadvokat" name="userfile" onchange="uploadFile('file-upload-skadvokat','userfile','skadvokat')" class="file-upload" />
                                </div>  
                            </td>
                        </tr>
                        <tr>
                            <td><small>Surat Keterangan Berprilaku Baik, Jujur, Bertanggung Jawab, adil dan mempunyai Integritas yang tinggi</small></td>
                            <td>Belum Diunggah</td>
                            <td>
                                <div class="file-upload-wrapper">
                                    <button class="btn btn-success mb-2" disabled>Lihat</button>
                                    <input type="file" id="file-upload-skck" name="userfile" onchange="uploadFile('file-upload-skck','userfile','skck')" class="file-upload" />
                                </div>  
                            </td>
                        </tr>
                    </tbody>
                </table> -->
            <?php 
                // echo json_encode($list_berkas_sumpah[0]['jenis_dokument']);

             ?>
            <form action="<?php echo site_url('P/Admin/do_upload_document/'.$this->uri->segment(5)); ?>" method="post" enctype="multipart/form-data">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Document</th>
                        <th>Status</th>
                        <th>Upload</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $files = ['ktp', 'magang', 'skpidana', 'sppns', 'ijazah', 'fcpkpa', 'fcupa', 'skadvokat', 'skck'];
                    $files =  [
                        [
                            'file' => 'ktp',
                            'desc' => 'Fotocopy Kartu Tanda Penduduk (KTP)/Surat Izin Mengemudi (SIM)'
                        ],
                        [
                            'file' => 'magang',
                            'desc' => 'Surat Keterangan Magang Minimal 2 tahun berturut-turut'
                        ],
                        [
                            'file' => 'skpidana',
                            'desc' => 'Surat Keterangan tidak pernah pidana atau diancam hukuman pidana 5 tahun dari Pengadilan Negeri Domisi setempat'
                        ],
                        [
                            'file' => 'sppns',
                            'desc' => 'Surat pernyataan tidak berstatus Aparat Sipil Negara (ASN) (PNS, TNI, POLRI, Notaris, Pejabat Negara)'
                        ],
                        [
                            'file' => 'ijazah',
                            'desc' => 'Fotocopy Ijazah Sekolah Tinggi Hukum dilegalisir Basah'
                        ],
                        [
                            'file' => 'fcpkpa',
                            'desc' => 'Fotocopy Pendidikan Khusus Profesi Advokat (PKPA)'
                        ],
                        [
                            'file' => 'fcupa',
                            'desc' => 'Fotocopy Sertifikat Pelatihan Advokat dan Lulus Ujian Profesi Advokat'
                        ],
                        [
                            'file' => 'skadvokat',
                            'desc' => 'Fotocopy SK Pengangkatan Advokat'
                        ],
                        [
                            'file' => 'skck',
                            'desc' => 'Surat Keterangan Berprilaku Baik, Jujur, Bertanggung Jawab, adil dan mempunyai Integritas yang tinggi'
                        ],
                    ];
                    $count = 0;
                    foreach ($files as $file): 
                    ?>
                    <tr>
                        <td><small><?php echo ucfirst($file['desc']); ?></small></td>
                        <td>
                            <?php if($list_berkas_sumpah != null){
                                echo "Sudah diunggah";
                            }else{
                                echo "Belum di unggah";
                            } ?></td>
                        <td>
                            <div class="file-upload-wrapper">
                                <?php 

                                if($list_berkas_sumpah != null){
                                if($list_berkas_sumpah[$count]['jenis_dokument'] != $file['file']){ ?>
                                    <button class="btn btn-success mb-2" disabled>Lihat</button>
                                <?php }else{ ?>
                                    <a class="btn btn-success mb-2" target="blank" href="<?= base_url('assets/p/document/'.$list_berkas_sumpah[$count]['document_name'])?>">Lihat</a>
                                <?php }} ?>
                                <input type="file" accept="image/*" required id="file-upload-<?php echo $file['file']; ?>" name="file-upload-<?php echo $file['file']; ?>" class="file-upload" />
                            </div>  
                        </td>
                    </tr>
                    <?php $count++; endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Upload</button>
             <?php if($list_berkas_sumpah != null){?>
                    <a class="btn btn-warning" target="blank" href="<?= base_url('P/Admin/generateFormSumpah/'.$this->uri->segment(4))?>">Download Formulir Sumpah</a>
             <?php } ?>
        </form>
            </div>
        </div>
    </div>

</div>

<style type="text/css">
    /* Hide the file input */
    /*.file-upload {
        display: none;
    }*/

    /* Style the label to look like a button */
    /*.file-upload-label {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        text-align: center;
        transition: background-color 0.3s;
    }

    .file-upload-label:hover {
        background-color: #0056b3;
    }

    .file-upload-label:active {
        background-color: #003f7f;
    }*/

    /* Optional: Center the file upload button */
   /* .file-upload-wrapper {
        text-align: center;
        margin: 0px 0;

    }*/

</style>

<script type="text/javascript">
    function uploadFile($idInput,$nameInput, $jenisFile) {
        var formData = new FormData();
        var fileInput = document.getElementById($idInput);
        var file = fileInput.files[0];

        if (file) {
            formData.append($nameInput, file);
            formData.append('jenisFile', $jenisFile);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?= site_url('P/Admin/do_upload_document') ?>', true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    // File uploaded successfully
                    console.log(xhr.responseText);
                    alert('File uploaded successfully');
                } else {
                    // Error occurred
                    alert('An error occurred while uploading the file.');
                }
            };

            xhr.send(formData);
        }
    }
</script>

            