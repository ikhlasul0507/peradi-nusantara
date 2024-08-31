
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - Admin</title>
        <link href="<?= base_url('assets/') ?>styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login Admin</h3></div>
                                    <?php  if($this->session->flashdata('pesan')): ?>   
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                      <strong><?= $this->session->flashdata('pesan');?></strong> 
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <?php  endif; ?>
                                    <form action="<?= base_url('L_a/plog')?>" method="post">
                                    <div class="card-body">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                            <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Email</label><input class="form-control py-4" id="inputEmailAddress" type="email" placeholder="Enter email address"  name="email" /></div>
                                            <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label><input class="form-control py-4" id="inputPassword" type="password" name="password" placeholder="Enter password" />
                                            </div>
                                            <div class="g-recaptcha  mb-3" data-sitekey="6Le5ctkZAAAAANJ_rSzM42eypnAZjqfpGGTVE3LP"></div>
                                            <button type="submit" class="btn btn-primary">Login</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2019</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('assets/') ?>scripts.js"></script>
        <script language="JavaScript">
        /**
          * Disable mouse right-click on page
          * By Arthur Gareginyan (arthurgareginyan@gmail.com)
          * For full source code, visit http://www.mycyberuniverse.com
          */
        document.addEventListener("contextmenu", function(e){
            e.preventDefault();
        }, false);
        </script>

        <script language="JavaScript">
        /**
          * Disable mouse right-click on page
          * By Arthur Gareginyan (arthurgareginyan@gmail.com)
          * For full source code, visit http://www.mycyberuniverse.com
          */
        document.addEventListener("contextmenu", function(e){
            e.preventDefault();
        }, false);
        </script>
    </body>
</html>
