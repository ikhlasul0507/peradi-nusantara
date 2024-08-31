         <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <ol class="breadcrumb mb-4 mt-2">
                        <li class="breadcrumb-item active">Data Hasil Alternatif</li>
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
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Data Hasil Alternatif</div>
                    <div class="card-body">
                        <!-- kontek -->
                         <a href="<?= base_url('Admin/hitungAlternatif');?>" class="btn btn-primary mb-4">Hitung Alternatif</a>
                         <a  onclick="exportTableToExcel('tableHasil','Hasil Alternatif')" class="btn btn-warning mb-4">Export Excel</a>
                        <div class="dropdown">
                </div>

                <div class="table-responsive">
                    <form action="<?= base_url('Peserta/p_upload'); ?>" method="post" enctype="multipart/form-data">
                        <table border="1px" width="100%" cellspacing="0" id="tableHasil">

                            <thead>
                                <tr style="background-color: black;color: white">
                                    <td>Nama Peserta</td>
                                    <td>Total Nilai</td>
                                    <td>Rangking</td>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dumphasilAlternatif as $p):?>
                                    <tr>
                                        <td><b>
                                               <?php  echo  '('.$p['id_p'] .') - '. $p['_nm_p'];  ?>
                                            </b>
                                        </td>    
                                        <td><?= $p['totalNilai'];?></td>      
                                        <td align="center"><b style="background-color: green;color: white;font-size: 30px;"><?= $p['ranking'];?></b></td>
                                    </tr>
                                <?php 
                            endforeach; ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script type="text/javascript">
    function exportTableToExcel(tableID, filename = ''){
      var downloadLink;
      var dataType = 'application/vnd.ms-excel';
      var tableSelect = document.getElementById(tableID);
      var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        // Specify file name
        filename = filename?filename+'.xls':'excel_data.xls';
        
        // Create download link element
        downloadLink = document.createElement("a");
        
        document.body.appendChild(downloadLink);
        
        if(navigator.msSaveOrOpenBlob){
          var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
          });
          navigator.msSaveOrOpenBlob( blob, filename);
        }else{
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            // Setting the file name
            downloadLink.download = filename;
            
            //triggering the function
            downloadLink.click();
          }
        }
</script>