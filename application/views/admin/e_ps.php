<?php 

 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=$title.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");

?>
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        
                                        <thead>
                                            <tr style="background-color: blue">
                                                <td>Nama Lengkap</td>
                                                <td>Jurusan</td>
                                                <td>Semester (Kelas)</td>
                                                <td>IPK</td>
                                                <td>TTL</td>
                                                <td>HP</td>
                                                <td>Email</td>
                                                <td>Alamat</td>
                                                <td>Pengalaman Organisasi</td>
                                                <td>Keahlian & Prestasi</td>
                                                <td>Motivasi</td>
                                                <td>Status Bayar</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ps as $p):?>
                                            <tr>
                                                <td><?= $p['_nm_p'];?></td>
                                                <td><?= $p['nm_jur']; ?></td>
                                                <td><?= $p['_s_p'];?></td>
                                                <td><?= $p['_ipk'];?></td>
                                                <td><?= $p['_ttl'];?></td>
                                                <td><?= $p['_hp'];?></td>
                                                <td><?= $p['_email'];?></td>
                                                <td><?= $p['_al_p'];?></td>
                                                <td><?= $p['_po_p'];?></td>
                                                <td><?= $p['_kp_p'];?></td>
                                                <td><?= $p['_mt_p'];?></td>
                                                <td>
                                                    <?php 
                                                        $b = $p['id_p'];
                                                        $a = $this->db->get_where('tbl_byr',['id_pb'=>$b])->row_array();
                                                        if($a){?>
                                                            <p class="badge badge-success">Telah Bayar</p>
                                                    <?php }else{ ?>
                                                        <p class="badge badge-warning">Belum Bayar</p>
                                                    <?php  } ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    