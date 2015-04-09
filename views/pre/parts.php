<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>安全风险评估管理系统</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="alternate icon" type="image/png" href="/assets/i/favicon.png">
  <link rel="stylesheet" href="/assets/css/amazeui.min.css"/>
  <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body>

<?php include_once VIEW_PATH.'static/header.php'; ?>

<div class="am-cf admin-main">

<?php include_once VIEW_PATH.'static/sidebar.php'; ?>

  <div class="admin-content">
    <!--title-->
    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">评估双方</strong> / <small>partA & partB</small></div>
    </div>
    <hr/>
    <!--title end-->

    <!--tab-->
    <div class="am-tabs am-margin" data-am-tabs>
      <!--tab nav-->
      <ul class="am-tabs-nav am-nav am-nav-tabs">
        <li class="am-active"><a href="#tab1">评估方</a></li>
        <li><a href="#tab2">被评估方</a></li>
      </ul>
      <!--tab nav end-->

      <!--tab content-->
      <div class="am-tabs-bd">
        <!--tab1-->
        <div class="am-tab-panel am-fade am-in am-active" id="tab1">
          <div class="am-g am-margin-top">

          </div>
        </div>
        <!--tab1 end-->
        <!--tab2-->
        <div class="am-tab-panel am-fade" id="tab2">
          <div class="am-g am-margin-top">
            
          </div>
        </div>
        <!--tab2 end-->
      </div>
      <!--tab content end-->
    </div>
    <!--tab-->
  </div>

  </div>

</div>


<?php include_once VIEW_PATH.'static/footer.php'; ?>

<script type="text/javascript">
  
</script>
</body>
</html>