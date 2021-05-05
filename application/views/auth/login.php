<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php print $title; ?></title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
  <!-- Custom fonts for this template -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" />
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template -->
</head>
 <!-- container --> 
  <section class="showcase">
    <div class="container">
      <div class="pb-2 mt-4 mb-2 border-bottom">
      </div> 
      <form action="<?php print site_url('Auth/doLogin');?>" class="remember-login-frm" id="remember-login-frm" method="post" accept-charset="utf-8" enctype="multipart/form-data">

      <div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6 pb-5">
    <div class="row"><?php echo validation_errors('<div class="col-12 col-md-12 col-lg-12"><div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div></div>'); ?></div>
        <!--Form with header-->
            <div class="card border-info rounded-0">
                <div class="card-header p-0">
                    <div class="bg-login-page text-center py-2">
                        <h3><i class="fa fa-user"></i> Login</h3>
                    </div>
                </div>
                <div class="card-body p-3">                
                    <!--Body-->
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                            </div>
                            <input type="text" class="form-control" id="remail" name="user_name" placeholder="Email *" value="<?php if(isset($_COOKIE["loginId"])) { echo $_COOKIE["loginId"]; } ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-key text-info" aria-hidden="true"></i></div>
                            </div>
                            <input type="password" class="form-control" id="rpassword" name="password" placeholder="Password *" value="<?php if(isset($_COOKIE["loginPass"])) { echo $_COOKIE["loginPass"]; } ?>">
                        </div>
                    </div>                                                    
                    
                    <div class="text-center">
                        <button type="submit" id="contact-send-a" class="btn btn-info btn-block rounded-0 py-2">Login</button>
                    </div>
                </div>
            </div> 
          </div>
        </div>
    </form>
    </div>
  </section>

  <?php 
   if($this->session->flashdata('err')){
  ?>
    <div class="alert alert-success"> 
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <strong>Error!</strong> <?php echo $this->session->flashdata('err'); $this->session->unset_userdata('err');?>
    </div>
  <?php    
    } ?>