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
                                                <td>TPU</td>
                                                <td>TPA</td>
                                                <td>TKP</td>
                                                <td>TOTAL</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ps as $p):?>
                                            <?php 
                                                $tpu = $p['tpu1']+$p['tpu2']+$p['tpu3']+$p['tpu4']+$p['tpu5']+$p['tpu6']+$p['tpu7']+$p['tpu8']+$p['tpu9']+$p['tpu10']+$p['tpu11']+$p['tpu12']+$p['tpu13']+$p['tpu14']+$p['tpu15']+$p['tpu16']+$p['tpu17']+$p['tpu18']+$p['tpu19']+$p['tpu20']+$p['tpu21']+$p['tpu22']+$p['tpu23']+$p['tpu24']+$p['tpu25']+$p['tpu26']+$p['tpu27']+$p['tpu28']+$p['tpu29']+$p['tpu30']+$p['tpu31']+$p['tpu32']+$p['tpu33']+$p['tpu34']+$p['tpu35']+$p['tpu36']+$p['tpu37']+$p['tpu38']+$p['tpu39']+$p['tpu40']+$p['tpu41']+$p['tpu42']+$p['tpu43']+$p['tpu44']+$p['tpu45']+$p['tpu46']+$p['tpu47']+$p['tpu48']+$p['tpu49']+$p['tpu50']+$p['tpu51']+$p['tpu52']+$p['tpu53']+$p['tpu54']+$p['tpu55']+$p['tpu56']+$p['tpu57']+$p['tpu58']+$p['tpu59']+$p['tpu60']+$p['tpu61']+$p['tpu62']+$p['tpu63']+$p['tpu64']+$p['tpu65']+$p['tpu66']+$p['tpu67']+$p['tpu68']+$p['tpu69']+$p['tpu70']+$p['tpu71']+$p['tpu72']+$p['tpu73']+$p['tpu74']+$p['tpu75']+$p['tpu76']+$p['tpu77']+$p['tpu78']+$p['tpu79']+$p['tpu80']+$p['tpu81']+$p['tpu82']+$p['tpu83']+$p['tpu84']+$p['tpu85']+$p['tpu86']+$p['tpu87']+$p['tpu88']+$p['tpu89']+$p['tpu90']+$p['tpu91']+$p['tpu92']+$p['tpu93']+$p['tpu94']+$p['tpu95']+$p['tpu96']+$p['tpu97']+$p['tpu98']+$p['tpu99']+$p['tpu100'];

                                                $tpa = $p['tpa1']+$p['tpa2']+$p['tpa3']+$p['tpa4']+$p['tpa5']+$p['tpa6']+$p['tpa7']+$p['tpa8']+$p['tpa9']+$p['tpa10']+$p['tpa11']+$p['tpa12']+$p['tpa13']+$p['tpa14']+$p['tpa15']+$p['tpa16']+$p['tpa17']+$p['tpa18']+$p['tpa19']+$p['tpa20']+$p['tpa21']+$p['tpa22']+$p['tpa23']+$p['tpa34']+$p['tpa25']+$p['tpa26']+$p['tpa27']+$p['tpa28']+$p['tpa29']+$p['tpa30']+$p['tpa31']+$p['tpa32']+$p['tpa33']+$p['tpa34']+$p['tpa35']+$p['tpa36']+$p['tpa37']+$p['tpa38']+$p['tpa39']+$p['tpa40']+$p['tpa41']+$p['tpa42']+$p['tpa43']+$p['tpa44']+$p['tpa45']+$p['tpa46']+$p['tpa47']+$p['tpa48']+$p['tpa49']+$p['tpa50']+$p['tpa51']+$p['tpa52']+$p['tpa53']+$p['tpa54']+$p['tpa55']+$p['tpa56']+$p['tpa57']+$p['tpa58']+$p['tpa59']+$p['tpa60'];

                                                $tkp = $p['tkp1']+$p['tkp2']+$p['tkp3']+$p['tkp4']+$p['tkp5']+$p['tkp6']+$p['tkp7']+$p['tkp8']+$p['tkp9']+$p['tkp10']+$p['tkp11']+$p['tkp12']+$p['tkp13']+$p['tkp14']+$p['tkp15']+$p['tkp16']+$p['tkp17']+$p['tkp18']+$p['tkp19']+$p['tkp20']+$p['tkp21']+$p['tkp22']+$p['tkp23']+$p['tkp34']+$p['tkp25']+$p['tkp26']+$p['tkp27']+$p['tkp28']+$p['tkp29']+$p['tkp30']+$p['tkp31']+$p['tkp32']+$p['tkp33']+$p['tkp34']+$p['tkp35']+$p['tkp36']+$p['tkp37']+$p['tkp38']+$p['tkp39']+$p['tkp40']+$p['tkp41']+$p['tkp42']+$p['tkp43']+$p['tkp44']+$p['tkp45']+$p['tkp46']+$p['tkp47']+$p['tkp48']+$p['tkp49']+$p['tkp50']
                                                 ?>
                                            <tr>
                                                <td><?= $p['_nm_p'];?></td>
                                                <td><p class="badge badge-success big"><?= $tpu;?></p></td>
                                                <td><p class="badge badge-success big"><?= $tpa;?></p></td>
                                                <td><p class="badge badge-success big"><?= $tkp; ?></p></td>
                                                <td><p class="badge badge-danger big"><?= $tpu+$tpa+$tkp;?></p></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    