<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')?>">
  <style>
    body {
      background: linear-gradient(120deg, #6a11cb 0%, #2575fc 100%);
      min-height: 100vh;
      font-family: 'Segoe UI', Arial, sans-serif;
    }
    .login-box {
      width: 400px;
      margin: 60px auto;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
      padding: 30px 30px 20px 30px;
    }
    .login-logo a {
      color: #2575fc;
      font-size: 28px;
      font-weight: bold;
      letter-spacing: 1px;
      text-shadow: 1px 1px 2px #eee;
    }
    .login-box-body {
      padding: 0;
    }
    .login-box-msg {
      font-size: 18px;
      color: #333;
      margin-bottom: 25px;
      text-align: center;
    }
    .form-control {
      border-radius: 20px;
      box-shadow: none;
      border-color: #2575fc;
    }
    .btn-primary {
      background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
      border: none;
      border-radius: 20px;
      font-weight: 600;
      letter-spacing: 1px;
      transition: background 0.3s;
    }
    .btn-primary:hover {
      background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
    }
    .alert {
      border-radius: 10px;
      margin-bottom: 18px;
      font-size: 15px;
    }
    .text-center a {
      color: #2575fc;
      font-weight: 500;
      text-decoration: none;
      transition: color 0.2s;
    }
    .text-center a:hover {
      color: #6a11cb;
      text-decoration: underline;
    }
    @media (max-width: 500px) {
      .login-box {
        width: 95%;
        padding: 20px 5px 10px 5px;
      }
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>NMC Inventory Management System</b></a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Enter your email to reset your password</p>

    <?php if(isset($success)): ?>
      <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    <?php if(isset($errors)): ?>
      <div class="alert alert-danger"><?php echo $errors; ?></div>
    <?php endif; ?>

    <form action="<?php echo base_url('auth/forgot_password') ?>" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8"></div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Send</button>
        </div>
      </div>
    </form>
    <div class="text-center" style="margin-top:18px;">
      <a href="<?php echo base_url('auth/login'); ?>">&#8592; Back to Login</a>
    </div>
  </div>
</div>
</body>
</html>