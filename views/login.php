<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="UTF-8">
  <title>安全风险评估管理系统</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <?php
    echo '<link rel="alternate icon" type="image/png" href="'.URL_ROOT.'assets/i/favicon.png">';
    echo '<link rel="stylesheet" href="'.URL_ROOT.'assets/css/amazeui.min.css"/>';
  ?>
  <style>
    .header {
      text-align: center;
    }
    .header h1 {
      font-size: 200%;
      color: #333;
      margin-top: 30px;
    }
    .header p {
      font-size: 14px;
    }
  </style>
</head>
<body>
<div class="header">
  <div class="am-g">
    <h1>安全风险评估管理系统</h1>
    <p>security risk assessment management system</p>
  </div>
  <hr />
</div>
<div class="am-g">
  <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
    <div class="am-btn-group">
      <a id="theAdmin" class="am-btn am-btn-success am-btn-sm" onclick="is_who()"><i class="am-icon-user am-icon-sm"></i> Admin 管理员</a>
      <a id="theUser" class="am-btn am-btn-warning am-btn-sm" onclick="is_who()"><i class="am-icon-users am-icon-sm"></i> User 用户</a>
      <a href="https://github.com/zhangSTC/SAMS" class="am-btn am-btn-secondary am-btn-sm"><i class="am-icon-github am-icon-sm"></i> Github 查看源代码</a>
    </div>
    <br>
    <br>

    <form method="post" action="login" class="am-form" onsubmit="return check()" >
      <input type="hidden" id="said" name="said" value="user">
      <label id="laber_email" for="email">邮箱:</label>
      <input type="email" name="email" id="email" maxlength="20" placeholder="请输入邮箱...">
      <br>
      <label id="laber_pwd" for="password">密码:</label>
      <input type="password" name="password" id="password" maxlength="20" placeholder="请输入密码...">

      <?php if (isset($pwdError) && $pwdError == 1) {
        echo '<div class="am-alert am-alert-danger" data-am-alert>
                <button type="button" class="am-close">&times;</button>
                <p>请输入正确的邮箱及密码</p>
              </div>';
      } ?>

      <br>
      <label for="remember-me">
        <input id="remember-me" type="checkbox" disabled="disabled">
        记住密码
      </label>
      <br />
      <div class="am-cf">
        <input type="submit" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl">
        <input type="button" value="忘记密码? " class="am-btn am-btn-default am-btn-sm am-fr" onclick="forget_pwd()">
      </div>
    </form>

  </div>
</div>

<?php include_once 'static/footer.php' ?>

<script type="text/javascript">
    <?php 
        if (isset($said) && $said == 'admin') {
            echo 'var who = 1;is_who();';
        }
        else {
            echo 'var who = 0;is_who();';
        }
    ?>

    function is_who () {
        if (who == 0) {
            $('#theUser').hide();
            $('#theAdmin').show();
            $('#said').attr('value', 'user');
            $('#email').val('');
            $('#password').val('');
            $('#email').removeAttr('disabled');
            $('#email').attr('placeholder', '请输入邮箱...');
            $('#password').attr('placeholder', '请输入密码...');
            who = 1;
        }
        else {
            $('#theUser').show();
            $('#theAdmin').hide();
            $('#said').attr('value', 'admin');
            $('#email').val('');
            $('#password').val('');
            $('#email').attr('disabled','disabled');
            $('#email').attr('placeholder', '');
            $('#password').attr('placeholder', '请输入管理员密码...');
            who = 0;
        }
    }

    function check () {
        var email = $('#email').val();
        var pwd   = $('#password').val();
        switch (who) {
            case 0: {
                if (pwd == null || pwd == '') {
                    alert('请填写密码');
                    return false;
                }
                else {
                    return true;
                }
            }
            case 1: {
                if ((email == null || email == '') || (pwd == null || pwd == '')) {
                    alert('请填写邮箱及密码');
                    return false;
                }
                else {
                    return true;
                }
            }
            default:
                return true;
        }
    }

    function forget_pwd () {
        alert('忘了就忘了吧');
    }
</script>
</body>
</html>
