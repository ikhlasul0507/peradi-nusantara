         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Pendaftaran Peserta</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Data Pendaftaran || <a href="<?= base_url('Admin/dp')?>">Kembali</a></div>
                            <div class="card-body">
                                <!-- kontek -->
                                <?php foreach ($ps as $p): ?>
                            <div class="card-header bg-info"><i class="fas fa-table mr-1"></i><h3>Kartu Peserta  #NomorPendaftaran: BGP<?= $p['id_p'];?>2021</h3></div>
                            <div class="card-body">
                                <!-- kontek -->
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        
                                        <tbody>
                                            <tr>
                                                <td>Nama Lengkap</td>
                                                <td><?= $p['_nm_p'];?></td>
                                            </tr>
                                             <tr>
                                                <td>Jurusan/ Prodi</td>
                                                <td><?= $p['nm_jur']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Semester, Kelas (Pagi/Siang)</td>
                                                <td><?= $p['_s_p'];?></td>
                                            </tr>
                                            <tr>
                                                <td>IPK Terakhir</td>
                                                <td><?= $p['_ipk'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Lahir</td>
                                                <td><?= $p['_ttl'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Handphone</td>
                                                <td><?= $p['_hp'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td><?= $p['_email'];?></td>
                                            </tr>
                                             <tr>
                                                <td>Pengalaman Organisasi</td>
                                                <td><?= $p['_po_p'];?></td>
                                            </tr>
                                             <tr>
                                                <td>Keahlian & Prestasi</td>
                                                <td><?= $p['_kp_p'];?></td>
                                            </tr>
                                             <tr>
                                                <td>Motivasi</td>
                                                <td><?= $p['_mt_p'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Status Berkas</td>
                                                <td><b>Upload Berhasil</b><br>Waktu Konfirmasi : <?= $p['waktu'];?>
                                                    <embed type="application/pdf" src="<?= base_url('assets/pdf/berkas/'.$p['ft_bukti']); ?>" width="600" height="400"></embed>
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php if($p['_st_p']==0){ ?>
                                                <td>
                                                    <a class="btn btn-warning" href="<?= base_url('Admin/ver/'.$p['id_p']);?>" >Verifikasi</a>
                                                </td>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                            </tr>
                                            <?php if($hasilps != null){ ?>
                                            <tr>
                                                <td>Hasil Tes</td>
                                                <td style="font-size: 40px">
                                                    TPU :
                                                    <p class="badge badge-success big">
                                                    <?php
                                                        $tpu = $hasilps['tpu1']+$hasilps['tpu2']+$hasilps['tpu3']+$hasilps['tpu4']+$hasilps['tpu5']+$hasilps['tpu6']+$hasilps['tpu7']+$hasilps['tpu8']+$hasilps['tpu9']+$hasilps['tpu10']+$hasilps['tpu11']+$hasilps['tpu12']+$hasilps['tpu13']+$hasilps['tpu14']+$hasilps['tpu15']+$hasilps['tpu16']+$hasilps['tpu17']+$hasilps['tpu18']+$hasilps['tpu19']+$hasilps['tpu20']+$hasilps['tpu21']+$hasilps['tpu22']+$hasilps['tpu23']+$hasilps['tpu24']+$hasilps['tpu25']+$hasilps['tpu26']+$hasilps['tpu27']+$hasilps['tpu28']+$hasilps['tpu29']+$hasilps['tpu30']+$hasilps['tpu31']+$hasilps['tpu32']+$hasilps['tpu33']+$hasilps['tpu34']+$hasilps['tpu35']+$hasilps['tpu36']+$hasilps['tpu37']+$hasilps['tpu38']+$hasilps['tpu39']+$hasilps['tpu40']+$hasilps['tpu41']+$hasilps['tpu42']+$hasilps['tpu43']+$hasilps['tpu44']+$hasilps['tpu45']+$hasilps['tpu46']+$hasilps['tpu47']+$hasilps['tpu48']+$hasilps['tpu49']+$hasilps['tpu50']+$hasilps['tpu51']+$hasilps['tpu52']+$hasilps['tpu53']+$hasilps['tpu54']+$hasilps['tpu55']+$hasilps['tpu56']+$hasilps['tpu57']+$hasilps['tpu58']+$hasilps['tpu59']+$hasilps['tpu60']+$hasilps['tpu61']+$hasilps['tpu62']+$hasilps['tpu63']+$hasilps['tpu64']+$hasilps['tpu65']+$hasilps['tpu66']+$hasilps['tpu67']+$hasilps['tpu68']+$hasilps['tpu69']+$hasilps['tpu70']+$hasilps['tpu71']+$hasilps['tpu72']+$hasilps['tpu73']+$hasilps['tpu74']+$hasilps['tpu75']+$hasilps['tpu76']+$hasilps['tpu77']+$hasilps['tpu78']+$hasilps['tpu79']+$hasilps['tpu80']+$hasilps['tpu81']+$hasilps['tpu82']+$hasilps['tpu83']+$hasilps['tpu84']+$hasilps['tpu85']+$hasilps['tpu86']+$hasilps['tpu87']+$hasilps['tpu88']+$hasilps['tpu89']+$hasilps['tpu90']+$hasilps['tpu91']+$hasilps['tpu92']+$hasilps['tpu93']+$hasilps['tpu94']+$hasilps['tpu95']+$hasilps['tpu96']+$hasilps['tpu97']+$hasilps['tpu98']+$hasilps['tpu99']+$hasilps['tpu100'];
                                                        echo $tpu;
                                                        ?>
                                                    </p>
                                                    <br>
                                                    TPA : 
                                                    <p class="badge badge-success big">
                                                    <?php  $tpa = $hasilps['tpa1']+$hasilps['tpa2']+$hasilps['tpa3']+$hasilps['tpa4']+$hasilps['tpa5']+$hasilps['tpa6']+$hasilps['tpa7']+$hasilps['tpa8']+$hasilps['tpa9']+$hasilps['tpa10']+$hasilps['tpa11']+$hasilps['tpa12']+$hasilps['tpa13']+$hasilps['tpa14']+$hasilps['tpa15']+$hasilps['tpa16']+$hasilps['tpa17']+$hasilps['tpa18']+$hasilps['tpa19']+$hasilps['tpa20']+$hasilps['tpa21']+$hasilps['tpa22']+$hasilps['tpa23']+$hasilps['tpa34']+$hasilps['tpa25']+$hasilps['tpa26']+$hasilps['tpa27']+$hasilps['tpa28']+$hasilps['tpa29']+$hasilps['tpa30']+$hasilps['tpa31']+$hasilps['tpa32']+$hasilps['tpa33']+$hasilps['tpa34']+$hasilps['tpa35']+$hasilps['tpa36']+$hasilps['tpa37']+$hasilps['tpa38']+$hasilps['tpa39']+$hasilps['tpa40']+$hasilps['tpa41']+$hasilps['tpa42']+$hasilps['tpa43']+$hasilps['tpa44']+$hasilps['tpa45']+$hasilps['tpa46']+$hasilps['tpa47']+$hasilps['tpa48']+$hasilps['tpa49']+$hasilps['tpa50']+$hasilps['tpa51']+$hasilps['tpa52']+$hasilps['tpa53']+$hasilps['tpa54']+$hasilps['tpa55']+$hasilps['tpa56']+$hasilps['tpa57']+$hasilps['tpa58']+$hasilps['tpa59']+$hasilps['tpa60']; 
                                                    echo $tpa;
                                                     ?>
                                                     </p>
                                                    <br>
                                                    TKP : 
                                                    <p class="badge badge-success big">
                                                    <?php $tkp =  $hasilps['tkp1']+$hasilps['tkp2']+$hasilps['tkp3']+$hasilps['tkp4']+$hasilps['tkp5']+$hasilps['tkp6']+$hasilps['tkp7']+$hasilps['tkp8']+$hasilps['tkp9']+$hasilps['tkp10']+$hasilps['tkp11']+$hasilps['tkp12']+$hasilps['tkp13']+$hasilps['tkp14']+$hasilps['tkp15']+$hasilps['tkp16']+$hasilps['tkp17']+$hasilps['tkp18']+$hasilps['tkp19']+$hasilps['tkp20']+$hasilps['tkp21']+$hasilps['tkp22']+$hasilps['tkp23']+$hasilps['tkp34']+$hasilps['tkp25']+$hasilps['tkp26']+$hasilps['tkp27']+$hasilps['tkp28']+$hasilps['tkp29']+$hasilps['tkp30']+$hasilps['tkp31']+$hasilps['tkp32']+$hasilps['tkp33']+$hasilps['tkp34']+$hasilps['tkp35']+$hasilps['tkp36']+$hasilps['tkp37']+$hasilps['tkp38']+$hasilps['tkp39']+$hasilps['tkp40']+$hasilps['tkp41']+$hasilps['tkp42']+$hasilps['tkp43']+$hasilps['tkp44']+$hasilps['tkp45']+$hasilps['tkp46']+$hasilps['tkp47']+$hasilps['tkp48']+$hasilps['tkp49']+$hasilps['tkp50'];
                                                    echo $tkp;
                                                     ?>
                                                     </p>
                                                     <br>
                                                     Nilai Akhir : 
                                                      <p class="badge badge-success big">
                                                        <?php echo ceil(($tpa + $tpu + $tkp)/3) ?>
                                                    </p>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </main>