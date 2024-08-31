         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Pendaftaran Peserta</li>
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
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Data Pendaftaran</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Nama Lengkap</th>
                                                <th>Jurusan</th>
                                                <th>Semester (Kelas)</th>
                                                <th>HP</th>
                                                <th>Email</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Nama Lengkap</th>
                                                <th>Jurusan</th>
                                                <th>Semester (Kelas)</th>
                                                <th>HP</th>
                                                <th>Email</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                <script type="text/javascript">

                    $('#example').DataTable({
                        processing: false,
                        serverSide: false,
                        ajax: {
                            url: '<?= getAPI();?>SPK/Peserta/listPeserta?statusPeserta=0',
                            type: 'GET',
                        },
                        columns: [
                            { data: '_nm_p' },
                            { data: 'nm_jur' },
                            { data: '_s_p' },
                            { data: '_hp' },
                            { data: '_email' },
                            {
                              targets: 1,
                              render: function ( data, type, row ) {
                                    console.log(row.id_p)
                                 if (row.id_byr === null) {
                                     return "<button onclick='buttonHapus("+row.id_p+")'>Hapus</button>"+
                                            "<b>|Belum Upload Berkas|</b>";
                                 }
                                 else
                                     return "<button onclick='return confirm('Yakin Hapus ?')'>Hapus</button>"+
                                            "<button>Verifikasi</button>"+
                                            "|Telah Upload Berkas|";
                              }
                            }
                        ],
                    }); 

                    function buttonHapus(id){
                        if(confirm('Yakin Hapus ?') == true){
                            fetch('<?= getAPI();?>/SPK/Peserta/deletePeserta?idPeserta=' + id, {
                              method: 'DELETE',
                            })
                            .then(res => res.text()) // or res.json()
                            .then(res => {
                                $('#example').DataTable().ajax.reload();
                            })
                        }
                    }
                    // var dataSet = [];
                    // const api_url = "http://localhost/MASTER-VOTE-API/API/SPK/Peserta/listPeserta";
                    // getapi(api_url);
                    // async function getapi(url) {
                    //     const response = await fetch(url);
                    //     var data = await response.json();
                    //     addrow2(data);
                    // }
                    // function addrow2(data) {
                    //     var table = document.getElementById('tabledetail2');
                    //     var status = data.status;
                    //     var total = data.total;
                    //     var listData = data.listData;
                    //     if(listData.length > 0){
                    //         listData.forEach(list => {
                    //             var dataAction;

                    //             var dataList = [list._nm_p,list._jr_p,list._s_p,list._hp,list._email,'<a href="" class="btn btn-danger" onclick="">Hapus</a>'];
                    //             dataSet.push(dataList);
                    //         })

                    //     }
                    //     $('#example').DataTable({
                    //         data: dataSet,
                    //         columns: [
                    //             { title: 'Nama Lengkap' },
                    //             { title: 'Jurusan' },
                    //             { title: 'Semester (Kelas)' },
                    //             { title: 'HP' },
                    //             { title: 'Email' },
                    //             { title: 'Aksi' },
                    //         ],
                    //     });
                    // }
                    // console.log(dataSet)
                    

                    

                    


                        // var dispstat;
                        // if (document.getElementById("btnCancel").style.display == "inline-block") {
                        //     dispstat = 'inline-block'
                        // } else {
                        //     dispstat = 'none'
                        // }
                        // var sp = arr.split("|");
                        // document.form.dataproduct2.value = sp[1];
                        // var val = sp[0].split("~");
                        // var table = document.getElementById('tabledetail2');
                        // var row = table.insertRow(-1);
                        // row.id = "detailrow2";
                        // var cell1 = row.insertCell(0);
                        // var cell2 = row.insertCell(1);
                        // var cell3 = row.insertCell(2);
                        // var cell4 = row.insertCell(3);
                        // var cell5 = row.insertCell(4);
                        // var cell6 = row.insertCell(5);
                        // var cell7 = row.insertCell(6);
                        // var cell8 = row.insertCell(7);
                        // var cell9 = row.insertCell(8);
                        // var code = val[0];
                        // cell1.innerHTML = val[0];
                        // cell2.innerHTML = val[7];
                        // cell3.innerHTML = val[1];
                        // cell4.innerHTML = val[2];
                        // cell5.innerHTML = val[3];
                        // cell6.innerHTML = accounting.formatNumber(val[4], 2);
                        // cell7.innerHTML = accounting.formatNumber(val[5], 2);
                        // cell8.innerHTML = accounting.formatNumber(val[6], 2);
                        // cell9.innerHTML = '<input  type="button" id="bdelete2" name="bdelete2" class="removeitem"  ondblclick="funcdeleterow2(\'' + code + '\')" style="display:' + dispstat + ';" ><input  type="button" id="bedit2" name="bedit2" class="edititem"  onclick="fucneditrow2(\'' + code + '\')" style="display:' + dispstat + ';" >';
                        // cell6.className = "kanan";
                        // cell7.className = "kanan";
                        // cell8.className = "kanan";
                </script>