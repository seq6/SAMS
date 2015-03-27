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
    echo '<link rel="stylesheet" href="'.URL_ROOT.'assets/css/admin.css">';
  ?>
</head>
<body>

  <?php include_once '../static/header.php'; ?>

  <div class="am-cf admin-main">

  <?php include_once '../static/sidebar.php'; ?>

    <div class="admin-content">
      <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">硬件资源</strong> / <small>hardware</small></div>
      </div>
      <hr/>
    </div>

  </div>

  <a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

  <?php include_once '../static/footer.php'; ?>
</body>
</html>