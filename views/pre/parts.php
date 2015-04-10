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

    <!--form req-->
    <div class="am-g">
      <div class="am-u-lg-8 am-u-sm-centered">
      <?php
      if (isset($error)) {
        switch ($error) {
            case 1:{
                $color = ' am-alert-success';
                $prompt = '数据提交成功';
                break;
            }
            case 2:
                $color = ' am-alert-danger';
                $prompt = '数据提交失败';
                break;
            default:
                $prompt = 'error!';
                break;
        }
        echo '<div class="am-alert'.$color.'" data-am-alert>
                <button type="button" class="am-close">&times;</button>
                <p>'.$prompt.'</p>
              </div>';
      }
      ?>
      </div>
    </div>
    <!--form req end-->

    <!--form-->
    <form class="am-form" action="/pre/parts" method="post">

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
          <!--partA name-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">单位名称</div>
            <div class="am-u-sm-8 am-u-md-10">
              <?php
                if (isset($partA['name']) && $partA['name'] != null) {
                    echo '<input id="aName" name="aName" type="text" class="am-form-field" value="'.$partA['name'].'">';
                }
                else {
                    echo '<input id="aName" name="aName" type="text" class="am-form-field">';
                }
              ?>
            </div>
          </div>
          <!--partA name end-->
          <!--partA address-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">单位地址</div>
            <div class="am-u-sm-8 am-u-md-10">
              <?php
                if (isset($partA['address']) && $partA['address'] != null) {
                    echo '<input id="aAddress" name="aAddress" type="text" class="am-form-field" value="'.$partA['address'].'">';
                }
                else {
                    echo '<input id="aAddress" name="aAddress" type="text" class="am-form-field">';
                }
              ?>
            </div>
          </div>
          <!--partA address end-->
          <!--partA leader-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">项目负责人</div>
            <div class="am-u-sm-8 am-u-md-10">
              <?php
                if (isset($partA['leader']) && $partA['leader'] != null) {
                    echo '<input id="aLeader" name="aLeader" type="text" class="am-form-field" value="'.$partA['leader'].'">';
                }
                else {
                    echo '<input id="aLeader" name="aLeader" type="text" class="am-form-field">';
                }
              ?>
            </div>
          </div>
          <!--partA leader end-->
          <!--partA phone-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">负责人电话</div>
            <div class="am-u-sm-8 am-u-md-10">
              <?php
                if (isset($partA['phone']) && $partA['phone'] != null) {
                    echo '<input id="aPhone" name="aPhone" type="text" class="am-form-field" value="'.$partA['phone'].'">';
                }
                else {
                    echo '<input id="aPhone" name="aPhone" type="text" class="am-form-field">';
                }
              ?>
            </div>
          </div>
          <!--partA phone end-->
          <!--partA mobile-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">负责人手机</div>
            <div class="am-u-sm-8 am-u-md-10">
              <?php
                if (isset($partA['mobile']) && $partA['mobile'] != null) {
                    echo '<input id="aMobile" name="aMobile" type="text" class="am-form-field" value="'.$partA['mobile'].'">';
                }
                else {
                    echo '<input id="aMobile" name="aMobile" type="text" class="am-form-field">';
                }
              ?>
            </div>
          </div>
          <!--partA mobile end-->
          <!--partA email-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">负责人邮箱</div>
            <div class="am-u-sm-8 am-u-md-10">
              <?php
                if (isset($partA['email']) && $partA['email'] != null) {
                    echo '<input id="aEmail" name="aEmail" type="text" class="am-form-field" value="'.$partA['email'].'">';
                }
                else {
                    echo '<input id="aEmail" name="aEmail" type="text" class="am-form-field">';
                }
              ?>
            </div>
          </div>
          <!--partA email end-->
          <!--partA remarks-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">备注</div>
            <div class="am-u-sm-8 am-u-md-10">
              <?php
                if (isset($partA['remarks']) && $partA['remarks'] != null) {
                    echo '<textarea name="aRemarks" rows="6" maxlength="255">'.$partA['remarks'].'</textarea>';
                }
                else {
                    echo '<textarea name="aRemarks" rows="6" maxlength="255"></textarea>';
                }
              ?>
            </div>
          </div>
          <!--partA remarks end-->
          <!--partA updatetime-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">更新时间</div>
            <div class="am-u-sm-8 am-u-md-10">
            <?php
                if (isset($partA['updatetime']) && $partA['updatetime'] != null) {
                    echo '<label>'.$partA['updatetime'].'</label>';
                }
                else {
                    echo '<label>XXXX-XX-XX XX:XX:XX</label>';
                }
            ?>
            </div>
          </div>
          <!--partA updatetime end-->
        </div>
        <!--tab1 end-->

        <!--tab2-->
        <div class="am-tab-panel am-fade" id="tab2">
          <!--partB name-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">单位名称</div>
            <div class="am-u-sm-8 am-u-md-10">
              <?php
                if (isset($partB['name']) && $partB['name'] != null) {
                    echo '<input id="bName" name="bName" type="text" class="am-form-field" value="'.$partB['name'].'">';
                }
                else {
                    echo '<input id="bName" name="bName" type="text" class="am-form-field">';
                }
              ?>
            </div>
          </div>
          <!--partB name end-->
          <!--partB address-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">单位地址</div>
            <div class="am-u-sm-8 am-u-md-10">
              <?php
                if (isset($partB['address']) && $partB['address'] != null) {
                    echo '<input id="bAddress" name="bAddress" type="text" class="am-form-field" value="'.$partB['address'].'">';
                }
                else {
                    echo '<input id="bAddress" name="bAddress" type="text" class="am-form-field">';
                }
              ?>
            </div>
          </div>
          <!--partB address end-->
          <!--partB leader-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">项目负责人</div>
            <div class="am-u-sm-8 am-u-md-10">
              <?php
                if (isset($partB['leader']) && $partB['leader'] != null) {
                    echo '<input id="bLeader" name="bLeader" type="text" class="am-form-field" value="'.$partB['leader'].'">';
                }
                else {
                    echo '<input id="bLeader" name="bLeader" type="text" class="am-form-field">';
                }
              ?>
            </div>
          </div>
          <!--partB leader end-->
          <!--partB phone-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">负责人电话</div>
            <div class="am-u-sm-8 am-u-md-10">
              <?php
                if (isset($partB['phone']) && $partB['phone'] != null) {
                    echo '<input id="bPhone" name="bPhone" type="text" class="am-form-field" value="'.$partB['phone'].'">';
                }
                else {
                    echo '<input id="bPhone" name="bPhone" type="text" class="am-form-field">';
                }
              ?>
            </div>
          </div>
          <!--partB phone end-->
          <!--partB mobile-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">负责人手机</div>
            <div class="am-u-sm-8 am-u-md-10">
              <?php
                if (isset($partB['mobile']) && $partB['mobile'] != null) {
                    echo '<input id="bMobile" name="bMobile" type="text" class="am-form-field" value="'.$partB['mobile'].'">';
                }
                else {
                    echo '<input id="bMobile" name="bMobile" type="text" class="am-form-field">';
                }
              ?>
            </div>
          </div>
          <!--partB mobile end-->
          <!--partB email-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">负责人邮箱</div>
            <div class="am-u-sm-8 am-u-md-10">
              <?php
                if (isset($partB['email']) && $partB['email'] != null) {
                    echo '<input id="bEmail" name="bEmail" type="text" class="am-form-field" value="'.$partB['email'].'">';
                }
                else {
                    echo '<input id="bEmail" name="bEmail" type="text" class="am-form-field">';
                }
              ?>
            </div>
          </div>
          <!--partB email end-->
          <!--partB remarks-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">备注</div>
            <div class="am-u-sm-8 am-u-md-10">
              <?php
                if (isset($partB['remarks']) && $partB['remarks'] != null) {
                    echo '<textarea name="bRemarks" rows="6" maxlength="255">'.$partB['remarks'].'</textarea>';
                }
                else {
                    echo '<textarea name="bRemarks" rows="6" maxlength="255"></textarea>';
                }
              ?>
            </div>
          </div>
          <!--partB remarks end-->
          <!--partB updatetime-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">更新时间</div>
            <div class="am-u-sm-8 am-u-md-10">
            <?php
                if (isset($partB['updatetime']) && $partB['updatetime'] != null) {
                    echo '<label>'.$partB['updatetime'].'</label>';
                }
                else {
                    echo '<label>XXXX-XX-XX XX:XX:XX</label>';
                }
            ?>
            </div>
          </div>
          <!--partB updatetime end-->
        </div>
        <!--tab2 end-->
      </div>
      <!--tab content end-->
    </div>
    <!--tab end-->

    <!--submit-->
    <div class="am-margin">
      <button id="test" type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
      <button type="reset" class="am-btn am-btn-primary am-btn-xs">重 置</button>
    </div>
    <!--submit-->

    </form>
    <!--form end-->

  </div>

  </div>

</div>


<?php include_once VIEW_PATH.'static/footer.php'; ?>

<script type="text/javascript">
  
</script>
</body>
</html>