<center><h3>Data Peserta BGPOL</h3>
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1" cellpadding="2" cellspacing="0">
                                        
                                        <thead>
                                            <tr>
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
                                    <script type="text/javascript">
                                        window.print();
                                    </script>