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
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">项目信息</strong> / <small>information</small></div>
    </div>
    <hr/>
    <!--title end-->

    <!--form-->
    <form class="am-form" action="/pre/information" method="post">

    <!--tab-->
    <div class="am-tabs am-margin" data-am-tabs>
      <!--tab nav-->
      <ul class="am-tabs-nav am-nav am-nav-tabs">
        <li class="am-active"><a href="#tab1">基本信息</a></li>
        <li><a href="#tab2">详细信息</a></li>
      </ul>
      <!--tab nav end-->
      <!--tab content-->
      <div class="am-tabs-bd">
        <!--tab1-->
        <div class="am-tab-panel am-fade am-in am-active" id="tab1">
          <!--pj name-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">项目名称</div>
            <div class="am-u-sm-8 am-u-md-10">
              <?php
                echo '<input id="pjName" name="pjName" type="text" class="am-form-field" value="'.$project['name'].'">';
              ?>
            </div>
          </div>
          <!--pj name end-->
          <!--pj status-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">项目状态</div>
            <div class="am-u-sm-8 am-u-md-10">
            <?php
                switch ($project['status']) {
                    case '0':{
                        $status = '未启动';
                        break;
                    }
                    case '1':{
                        $status = '进行中';
                        break;
                    }
                    case '2':{
                        $status = '已关闭';
                        break;
                    }
                    default:{
                        $status = 'error';
                        break;
                    }
                }
                echo '<label>'.$status.'</label>';
            ?>
            </div>
          </div>
          <!--pj status end-->
          <!--pj type-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">项目类型</div>
            <div class="am-u-sm-8 am-u-md-10">
              <select id="pjType" name="pjType" onclick="type_desc()" data-am-selected="{btnSize: 'sm'}">
              <?php
                $i = 1;
                foreach ($pjType as $t) {
                    echo '<option value="'.$t['id'].'">'.$t['name'].'</option>';
                    $i++;
                }
              ?>
              </select>
              <br/>
              <small><i id="typeDesc"></i></small>
            </div>
          </div>
          <!--pj type end-->
          <!--pj range-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">项目范围</div>
            <div class="am-u-sm-8 am-u-md-10">
              <div class="am-btn-group" data-am-button>
              <?php
                foreach ($pjRange as $r) {
                    if (in_array((int)$r['id'], $project['range'])) {
                        echo '<label class="am-btn am-btn-default am-btn-xs am-active"><input type="checkbox" checked="checked" name="pjRange[]" value="'.$r['id'].'"> '.$r['name'].'</label>';
                    }
                    else {
                        echo '<label class="am-btn am-btn-default am-btn-xs"><input type="checkbox" name="pjRange[]" value="'.$r['id'].'"> '.$r['name'].'</label>';
                    } 
                }
              ?>
              </div>
              <br/>
              <small><i id="rangeDesc"></i></small>
            </div>
          </div>
          <!--pj range end-->
          <!--pj update-->
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">更新时间</div>
            <div class="am-u-sm-8 am-u-md-10">
            <?php
                echo '<label >'.$project['updatetime'].'</label>';
            ?>
            </div>
          </div>
          <!--pj update end-->
        </div>
        <!--tab1 end-->

        <!--tab2-->
        <div class="am-tab-panel am-fade" id="tab2">
        <!--pj goal-->
        <div class="am-g am-margin-top">
          <div class="am-u-sm-4 am-u-md-2 am-text-right">项目目标</div>
          <div class="am-u-sm-8 am-u-md-10">
            <?php
                echo '<textarea name="pjGoal" rows="6" maxlength="255" placeholder="必填...">'.$project['goal'].'</textarea>'
            ?>
          </div>
        </div>
        <!--pj goal end-->
        <!--pj desc-->
        <div class="am-g am-margin-top">
          <div class="am-u-sm-4 am-u-md-2 am-text-right">项目描述</div>
          <div class="am-u-sm-8 am-u-md-10">
            <?php
                echo '<textarea name="pjDesc" rows="6" maxlength="255" placeholder="必填...">'.$project['theDesc'].'</textarea>'
            ?>
            <small><i>用户可在此处添加项目目标、项目描述信息或自定义的项目信息，这些项目信息将在风险报告中展现</i></small>
          </div>
        </div>
        <!--pj desc end-->
        </div>
        <!--tab2 end-->
      </div>
      <!--tab content end-->
    </div>
    <!--tab end-->

    <!--submit-->
    <div class="am-margin">
      <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
      <button type="reset" class="am-btn am-btn-primary am-btn-xs">重 置</button>
    </div>
    <!--submit-->

    </form>
    <!--form end-->

  </div>

</div>

<?php include_once VIEW_PATH.'static/footer.php'; ?>

<script type="text/javascript">
    $('#pjType').change(function (id) {
        $('#desc1').text('ads');
    });
    function check_type (argument) {
        
    }
    function check_range (argument) {
        
    }
    function function_name (argument) {
        // body...
    }
    function type_desc () {
        alert('youyonga');
        $('#disc').val('ads');
    }
    function range_desc (argument) {
        // body...
    }
</script>
</body>
</html>