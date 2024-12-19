</div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Peradi Nusantara <?= date("Y"); ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('P/Auth/process_logout');?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div id="loading">
        <span class="loader"></span>
        <div class="textLoader">
            <center>
            <b><h1>Please Wait ... </h1></b>
            <h5>Do Not Refresh Page</h5>
            </center>
        </div>
    </div>

        <!-- Page level plugins -->

    <!-- Page level custom scripts -->

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/p/sistem/');?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/p/sistem/');?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/p/sistem/');?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/p/sistem/');?>js/sb-admin-2.min.js"></script>


    <!-- Page level plugins -->
    <script src="<?= base_url('assets/p/sistem/');?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/p/sistem/');?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url('assets/p/sistem/');?>js/demo/datatables-demo.js"></script>

    <script type="text/javascript">
         // $("#accordionSidebar").addClass("toggled");
         $("#loading").hide();
         $(".loader").hide();
         
         $(document).ready(function() {
            $('#fileInput').on('change', function() {
                var file = this.files[0];
                if (file) {
                    // Update the label text
                    $('#fileLabel').text(file.name);

                    // Create a new FileReader instance
                    var reader = new FileReader();

                    // Define the onload event
                    reader.onload = function(e) {
                        // Set the src attribute of the image to the result from FileReader
                        $('#imagePreview').attr('src', e.target.result).show();
                    };

                    // Read the file as a Data URL (base64 encoded string)
                    reader.readAsDataURL(file);
                } else {
                    // Reset the label text and hide the image preview
                    $('#fileLabel').text('Select a file...');
                    $('#imagePreview').hide();
                }
            });
        });

         $(document).ready(function() {
            $('#fileInput1').on('change', function() {
                var file = this.files[0];
                if (file) {
                    // Update the label text
                    $('#fileLabel').text(file.name);

                    // Create a new FileReader instance
                    var reader = new FileReader();

                    // Define the onload event
                    reader.onload = function(e) {
                        // Set the src attribute of the image to the result from FileReader
                        $('#imagePreview1').attr('src', e.target.result).show();
                    };

                    // Read the file as a Data URL (base64 encoded string)
                    reader.readAsDataURL(file);
                } else {
                    // Reset the label text and hide the image preview
                    $('#fileLabel').text('Select a file...');
                    $('#imagePreview1').hide();
                }
            });
        });

        $('#dataTable').DataTable({
            // Set the default number of rows shown
            pageLength: 10, // Default rows shown
            lengthMenu: [5, 10, 25, 50, 100, 200, 500, 1000], // Dropdown options for rows per page
        });

         function confirmDeleteData(url) {
            // Show a SweetAlert confirmation dialog
            console.log(url);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    window.location.href = url; 
                } else {
                    console.log("Deletion canceled.");
                }
            });
        }
    </script>
    <?php  if($this->session->flashdata('pesan')): ?> 
        <script type="text/javascript">
            $(document).ready(function(){
              Swal.fire({
                title: "<?php echo $this->session->flashdata('pesan'); ?>",
              });
            });
          </script>
      <?php  endif; ?>
</body>

</html>