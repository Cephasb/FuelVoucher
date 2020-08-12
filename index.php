<?php include 'base.php';?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
  <title>PUMA ENERGY | Admin Sign In </title>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width">        
  <link rel="stylesheet" href="admin/css/templatemo_main.css">
</head>
<body>
  <div id="main-wrapper">
    <div class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <div class="logo">
		<a class="logo" title="" href="index.php">
		<img src="admin/images/logo.jpg" alt="" style="width:100%; max-width:260px">
		</a>
		</div>
      </div>   
    </div>
    <div class="template-page-wrapper">
      <form class="form-horizontal templatemo-signin-form" role="form" action="" method="POST">
        <div class="form-group">
          <div class="col-md-12">
            <label for="username" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-8">
              <input required type="email" class="form-control" name="email" placeholder="Admin E-mail">
            </div>
          </div>              
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-8">
              <input required type="password" class="form-control" name="password" placeholder="Password">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Remember me
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" value="Sign in" name='admin-login' class="btn btn-default">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
</html>