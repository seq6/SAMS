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
  <link rel="alternate icon" type="image/png" href="assets/i/favicon.png">
  <link rel="stylesheet" href="assets/css/amazeui.min.css"/>
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
      <a id="theAdmin" href="#" class="am-btn am-btn-success am-btn-sm" onclick="is_who()"><i class="am-icon-user am-icon-sm"></i> Admin 管理员</a>
      <a id="theUser" href="#" class="am-btn am-btn-warning am-btn-sm" onclick="is_who()"><i class="am-icon-users am-icon-sm"></i> User 用户</a>
      <a href="https://github.com/zhangSTC/SAMS" class="am-btn am-btn-secondary am-btn-sm"><i class="am-icon-github am-icon-sm"></i> Github 查看源代码</a>
    </div>
    <br>
    <br>

    <form method="post" action="els_help" class="am-form">
      <label id="laber_email" for="email">邮箱:</label>
      <input type="email" name="email" id="email" maxlength="20">
      <br>
      <label id="laber_pwd" for="password">密码:</label>
      <input type="password" name="password" id="password" maxlength="20">
      <br>
      <label for="remember-me">
        <input id="remember-me" type="checkbox" disabled="disabled">
        记住密码
      </label>
      <br />
      <div class="am-cf">
        <input type="submit" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl">
        <input type="submit" value="忘记密码? " class="am-btn am-btn-default am-btn-sm am-fr" disabled="disabled">
      </div>
    </form>

  </div>
</div>

<?php include_once 'static/footer.php' ?>

<script type="text/javascript">
    var who = 1;
    $('#theUser').hide();
    $('#theAdmin').show();

    function is_who () {
        if (who == 0) {
            $('#theUser').hide();
            $('#theAdmin').show();
            $('#email').removeAttr('disabled');
            who = 1;
        } else {
            $('#theUser').show();
            $('#theAdmin').hide();
            $('#email').attr('disabled','disabled');
            who = 0;
        }
    }

    function check () {
        var email = $('#email').value();
        var pwd = $('#pwd').value();
        if (email === '' || pwd === '') {
            alert("请填写正确的邮箱和密码");
        };
    }
</script>
</body>
</html>
