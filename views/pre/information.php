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
  <?php
    echo '<link rel="alternate icon" type="image/png" href="'.URL_ROOT.'assets/i/favicon.png">';
    echo '<link rel="stylesheet" href="'.URL_ROOT.'assets/css/amazeui.min.css"/>';
    echo '<link rel="stylesheet" href="'.URL_ROOT.'assets/css/admin.css">';
  ?>
</head>
<body>

<?php include_once VIEW_PATH.'static/header.php'; ?>

<div class="am-cf admin-main">

<?php include_once VIEW_PATH.'static/sidebar.php'; ?>

<div class="admin-content">
  <div class="am-cf am-padding">
    <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">项目信息</strong> / <small>information</small></div>
    </div>
    <hr/>

  <div class="am-tabs am-margin" data-am-tabs>
    <ul class="am-tabs-nav am-nav am-nav-tabs">
      <li class="am-active"><a href="#tab1">基本信息</a></li>
      <li><a href="#tab2">详细信息</a></li>
    </ul>

    <div class="am-tabs-bd">
      <div class="am-tab-panel am-fade am-in am-active" id="tab1">
        <div class="am-g am-margin-top">
          <div class="am-u-sm-4 am-u-md-2 am-text-right">项目名称</div>
          <div class="am-u-sm-8 am-u-md-10">
            <input type="text" value="">
          </div>
        </div>
        <div class="am-g am-margin-top">
          <div class="am-u-sm-4 am-u-md-2 am-text-right">项目类型</div>
          <div class="am-u-sm-8 am-u-md-10">
            <select data-am-selected="{btnSize: 'sm'}">
              <option value="option1">内部评估</option>
              <option value="option2">外部评估</option>
            </select>
          </div>
        </div>
        <div class="am-g am-margin-top">
          <div class="am-u-sm-4 am-u-md-2 am-text-right">项目范围</div>
          <div class="am-u-sm-8 am-u-md-10">
            <div class="am-btn-group" data-am-button>
              <label class="am-btn am-btn-default am-btn-xs">
                <input type="checkbox"> 硬件资源
              </label>
              <label class="am-btn am-btn-default am-btn-xs">
                <input type="checkbox"> 软件资源
              </label>
              <label class="am-btn am-btn-default am-btn-xs">
                <input type="checkbox"> 人员资源
              </label>
              <label class="am-btn am-btn-default am-btn-xs">
                <input type="checkbox"> 物理环境
              </label>
              <label class="am-btn am-btn-default am-btn-xs">
                <input type="checkbox"> 网络环境
              </label>
              <label class="am-btn am-btn-default am-btn-xs">
                <input type="checkbox"> 业务系统
              </label>
              <label class="am-btn am-btn-default am-btn-xs">
                <input type="checkbox"> 安全管理
              </label>
            </div>
          </div>
        </div>
        <div class="am-g am-margin-top">
          <div class="am-u-sm-4 am-u-md-2 am-text-right">更新时间</div>
          <div class="am-u-sm-8 am-u-md-10">
            <input type="text" disabled="">
          </div>
        </div>
      </div>
      <div class="am-tab-panel am-fade" id="tab2">
        <div class="am-g am-margin-top">
          <div class="am-u-sm-4 am-u-md-2 am-text-right">项目目标</div>
          <div class="am-u-sm-8 am-u-md-10">
            <textarea rows="4"></textarea>
          </div>
        </div>
        <div class="am-g am-margin-top">
          <div class="am-u-sm-4 am-u-md-2 am-text-right">项目描述</div>
          <div class="am-u-sm-8 am-u-md-10">
            <textarea rows="4"></textarea>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="am-margin">
    <button type="button" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
    <button type="reset" class="am-btn am-btn-primary am-btn-xs">重 置</button>
  </div>
  </div>
</div>

<a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

<?php include_once VIEW_PATH.'static/footer.php'; ?>

<script type="text/javascript">

</script>
</body>
</html>