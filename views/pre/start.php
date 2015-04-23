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
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">项目启动</strong> / <small>start</small></div>
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

    <!--project type-->
    <div class="am-g am-margin-top">
      <div class="am-u-sm-4 am-u-md-2 am-text-right">项目类型</div>
      <div class="am-u-sm-8 am-u-md-10">
        <?php
          if (isset($project['type']) && $project['type'] !== null) {
            echo '<label>'.$project['type'].'</label>';
          }
        ?>
      </div>
    </div>
    <!--project type end-->

    <!--project range-->
    <div class="am-g am-margin-top">
      <div class="am-u-sm-4 am-u-md-2 am-text-right">项目范围</div>
      <div class="am-u-sm-8 am-u-md-10">
        <?php
            echo '<label>';
            if (isset($project['range']) && !empty($project['range'])) {
                $rData = '';
                foreach ($project['range'] as $r) {
                    $rData .= ($rData == '') ? $r : '、'.$r;
                }
                echo $rData;
            }
            echo '</label>'
        ?>
      </div>
    </div>
    <!--project range end-->

    <!--partA-->
    <div class="am-g am-margin-top">
      <div class="am-u-sm-4 am-u-md-2 am-text-right">评估方</div>
      <div class="am-u-sm-8 am-u-md-10">
        <?php
            echo '<label>'.$project['partA']['name'].'</label>';
            echo '<br/>';
            echo '<small><i>负责人：'.$project['partA']['leader'].'&nbsp;&nbsp;&nbsp;&nbsp;'.$project['partA']['mobile'].'&nbsp;&nbsp;&nbsp;&nbsp;'.$project['partA']['email'].'</i></small>';
            echo '<br/>';
            echo '<small><i>'.$project['partA']['desc'].'</i></small>';
        ?>
      </div>
    </div>
    <!--partA end-->

    <!--partB-->
    <div class="am-g am-margin-top">
      <div class="am-u-sm-4 am-u-md-2 am-text-right">被评估方</div>
      <div class="am-u-sm-8 am-u-md-10">
        <?php
            echo '<label>'.$project['partB']['name'].'</label>';
            echo '<br/>';
            echo '<small><i>负责人：'.$project['partB']['leader'].'&nbsp;&nbsp;&nbsp;&nbsp;'.$project['partB']['mobile'].'&nbsp;&nbsp;&nbsp;&nbsp;'.$project['partB']['email'].'</i></small>';
            echo '<br/>';
            echo '<small><i>'.$project['partB']['desc'].'</i></small>';
        ?>
      </div>
    </div>
    <!--partB end-->

    <!--member-->
    <div class="am-g am-margin-top">
      <div class="am-u-sm-4 am-u-md-2 am-text-right">项目人员</div>
      <div class="am-u-sm-8 am-u-md-10">
      <?php
        
      ?>
      </div>
    </div>
    <!--member end-->

    <!--project information-->
    <div class="am-g am-margin-top">
      <div class="am-u-sm-4 am-u-md-2 am-text-right">项目信息</div>
      <div class="am-u-sm-8 am-u-md-10">
      <?php
        echo '<small><i>'.$project['goal'].'</i></small>';
        echo '<br/>';
        echo '<small><i>'.$project['desc'].'</i></small>';
      ?>
      </div>
    </div>
    <!--project information end-->

    <!--project start-->
    <div class="am-g am-margin-top">
      <div class="am-u-sm-4 am-u-md-2 am-text-right">
        <button id="project-start" type="button" class="am-btn am-btn-primary">启动</button>
      </div>
    </div>
    <!--project start end-->

    </div>
  </div>

<?php include_once VIEW_PATH.'static/footer.php'; ?>
<script type="text/javascript">
$('#project-start').on('click',function (argument) {
  alert('asdasda');
});
</script>
</body>
</html>