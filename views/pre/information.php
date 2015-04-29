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

<?php include_once 'app/views/static/header.php'; ?>

<div class="am-cf admin-main">

  <?php include_once 'app/views/static/sidebar.php'; ?>

  <div class="admin-content">
    <!--title-->
    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">项目信息</strong> / <small>information</small></div>
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
              <select id="pjType" name="pjType" data-am-selected="{btnSize: 'sm'}">
              <?php
                $i = 1;
                foreach ($pjType as $t) {
                    if ($t['id'] == $project['theType']) {
                        echo '<option value="'.$t['id'].'" selected="selected">'.$t['name'].'</option>';
                    }
                    else {
                        echo '<option value="'.$t['id'].'">'.$t['name'].'</option>';
                    }
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
                    $active = '';
                    $checked = '';
                    if (in_array((int)$r['id'], $project['range'])) {
                        $active = ' am-active';
                        $checked = ' checked="checked"';
                    }
                    echo '<label id="pjRange'.$r['id'].'" class="am-btn am-btn-default am-btn-xs'.$active.'" value="'.$r['id'].'">
                            <input type="checkbox"'.$checked.' name="pjRange[]" value="'.$r['id'].'"> '.$r['name'].'
                          </label>';
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
                echo '<textarea name="pjGoal" rows="6" maxlength="255" placeholder="必填...">'.$project['goal'].'</textarea>';
            ?>
          </div>
        </div>
        <!--pj goal end-->
        <!--pj desc-->
        <div class="am-g am-margin-top">
          <div class="am-u-sm-4 am-u-md-2 am-text-right">项目描述</div>
          <div class="am-u-sm-8 am-u-md-10">
            <?php
              echo '<textarea name="pjDesc" rows="6" maxlength="255" placeholder="必填...">'.$project['theDesc'].'</textarea>';
            ?>
            <small>
              <i>用户可在此处添加项目目标、项目描述信息或自定义的项目信息，这些项目信息将在风险报告中展现</i>
            </small>
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
      <button id="test" type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
      <button type="reset" class="am-btn am-btn-primary am-btn-xs">重 置</button>
    </div>
    <!--submit-->

    </form>
    <!--form end-->

  </div>

</div>

<?php include_once 'app/views/static/footer.php'; ?>

<script type="text/javascript">
    //
    var desc = {};
    desc['type'] = {};
    desc['range'] = {};
    <?php
        foreach ($pjType as $t) {
            echo 'desc["type"]['.$t['id'].'] = "'.$t['theDesc'].'";';
        }
        foreach ($pjRange as $r) {
            if ($r['isreq'] == 1) {
                echo 'desc["range"]['.$r['id'].'] = "***(必选)***  '.$r['theDesc'].'";';
            }
            else {
                echo 'desc["range"]['.$r['id'].'] = "'.$r['theDesc'].'";';
            }
        }
    ?>

    //
    $('#pjType').change(function () {
        var id = $('#pjType').val();
        $('#typeDesc').text(desc['type'][id]);
    });

    //
    <?php
        foreach ($pjRange as $r) {
            echo '$("#pjRange'.$r['id'].'").mouseover(function () {$("#rangeDesc").text(desc["range"]['.$r['id'].']);});'."\n";
        }
    ?>

    function check_range (argument) {
      // body...
    }
</script>
</body>
</html>