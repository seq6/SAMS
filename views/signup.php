<!DOCTYPE html>
<html>
<head lang="en">
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
    echo '<link rel="stylesheet" href="'.URL_ROOT.'assets/css/admin.css">';
  ?>
</head>
<body>

<?php include_once 'static/header.php' ?>

<div class="am-g">
  <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
    <form method="post" action="signup" onsubmit="return check()" class="am-form">
      <br />
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">新项目</strong> / <small>new project</small></div>
      <br />
      <hr />
      

      <div class="am-input-group">
        <span class="am-input-group-label"><i class="am-icon-cube"></i></span>
        <input id="pName" name="pName" type="text" class="am-form-field" placeholder="请输入新项目名称...">
      </div>
      <br />
      <br />

      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">项目负责人</strong> / <small>admin of the project</small></div>
      <br />
      <hr />

      <div class="am-radio">
        <label>
          <input type="radio" name="theUser" value="oldUser" onclick="choose_list()" checked="checked">
          从列表中选择
        </label>
      </div>

      <div class="am-form-group">
        <select id="theUserId" name="theUserId">
          <?php
            if (isset($user) && !empty($user)) {
                foreach ($user as $u) {
                    echo '<option value="'.$u['id'].'">'.$u['name'].'</option>';
                }
            }
            else {
                echo '<option value="0">暂无负责人</option>';
            }
          ?>
        </select>
        <span class="am-form-caret"></span>
      </div>

      <div class="am-radio">
        <label>
          <input type="radio" name="theUser" value="newUser" onclick="signup_newuser()">
          注册新负责人
        </label>
      </div>
      <div class="am-input-group">
        <span class="am-input-group-label"><i class="am-icon-user"></i></span>
        <input type="text" id="userName" name="userName" class="am-form-field" placeholder="请输入用户名..." maxlength="20" disabled="disabled">
      </div>
      <br />
      <div class="am-input-group">
        <span class="am-input-group-label"><i class="am-icon-envelope-square"></i></span>
        <input type="text" id="email" name="email" class="am-form-field" placeholder="请输入邮箱地址..." maxlength="20" disabled="disabled">
      </div>
      <br />
      <div class="am-input-group">
        <span class="am-input-group-label"><i class="am-icon-lock"></i></span>
        <input type="password" id="password" name="password" class="am-form-field" placeholder="请输入密码..." maxlength="20" disabled="disabled">
      </div>
      <br />

      <div class="am-cf">
        <input type="submit" value="注 册" class="am-btn am-btn-success am-btn-sm am-fl">
        <button type="reset" class="am-btn am-btn-default am-btn-sm" onclick="reset_form()">重 置</button>
      </div>
    </form>
  </div>
</div>

<?php include_once 'static/footer.php' ?>

<script type="text/javascript">

    var theUser = 'oldUser';

    function choose_list () {
        $('#theUserId').removeAttr('disabled');
        $('#userName').attr('disabled','disabled');
        $('#email').attr('disabled','disabled');
        $('#password').attr('disabled','disabled');
        theUser = 'oldUser';
    }

    function signup_newuser () {
        $('#theUserId').attr('disabled','disabled');
        $('#userName').removeAttr('disabled');
        $('#email').removeAttr('disabled');
        $('#password').removeAttr('disabled');
        theUser = 'newUser';
    }

    function reset_form () {
        choose_list();
    }

    function check () {
        var pName = $('#pName').val();
        var theUserId = $('#theUserId').val();
        var userName = $('#userName').val();
        var email = $('#email').val();
        var password = $('#password').val();

        if (pName == null || pName == '') {
            alert('请填写项目名');
            return false;
        }
        else {
            if (theUser == 'newUser') {
                if (userName == null || userName == '' || email == null 
                    || email == '' || password == null || password == '') {
                    alert('请将新用户信息填写完整');
                    return false;
                }
                else {
                    return true;
                }
            }
            else {
                if (theUserId == 0) {
                    alert('请注册新负责人');
                    return false;
                }
                else {
                    return true;
                }
            }
        }
    }
</script>
</body>
</html>