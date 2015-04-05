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
  <link rel="alternate icon" type="image/png" href="assets/i/favicon.png">
  <?php
    echo '<link rel="alternate icon" type="image/png" href="'.URL_ROOT.'assets/i/favicon.png">';
    echo '<link rel="stylesheet" href="'.URL_ROOT.'assets/css/amazeui.min.css"/>';
    echo '<link rel="stylesheet" href="'.URL_ROOT.'assets/css/admin.css">';
  ?>
</head>
<body>

<?php include_once 'static/header.php' ?>

<div class="am-g">
  <div class="am-u-lg-8 am-u-md-8 am-u-sm-centered">
  <br />
    <div class="am-fl am-cf">
      <?php
        if ($_SESSION['said'] == 'admin') {
            echo '<strong class="am-text-primary am-text-lg">项目列表</strong> / <small>list of all projects</small></div>';
        }
        else {
            echo '<strong class="am-text-primary am-text-lg">我的项目</strong> / <small>my projects</small></div>';
        }
      ?>
    <br />
    <hr />

    <table class="am-table am-table-bordered am-table-striped am-table-hover">
      <thead>
        <tr>
          <th>项目号</th>
          <th>项目名称</th>
          <th>项目状态</th>
          <th>启动时间</th>
          <th>关闭时间</th>
          <th>更新时间</th>
          <th>负责人</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if ($count == 0) {
              echo '<tr>
              <td>X</td>
              <td>尚无项目</td>
              <td>X</td>
              <td>X</td>
              <td>X</td>
              <td>X</td>
              <td>X<td>
              </tr>';
          }
          else {
              foreach ($project as $p) {
                  echo '<tr onclick="project('.$p['id'].')">
                  <td>'.$p['id'].'</td>
                  <td><a href="pre/introduction/?pid='.$p['id'].'">'.$p['name'].'</a></td>
                  <td>'.$p['status'].'</td>
                  <td>'.$p['starttime'].'</td>
                  <td>'.$p['endtime'].'</td>
                  <td>'.$p['updatetime'].'</td>
                  <td>'.$p['uid'].'</td>
                  </tr>';
              }
          }
        ?>
      </tbody>
    </table>

    <ul class="am-pagination">
      <?php
        $pNo = isset($pageNo) ? $pageNo : 1;
        $allPage = ($count - 1) / 10 + 1;
        if ($pNo != 1) {
            echo '<li><a href="project?pageNo=1">&laquo;</li>';
        }
        else {
            echo '<li class="am-disabled"><a href="project?pageNo=1">&laquo;</li>';
        }
        $startNo = ($pNo - 2) >= 1 ? ($pNo - 2) : 1;
        $endNo = ($pNo + 2) <= $allPage ? ($pNo + 2) : $allPage;
        for ($i = $startNo; $i <= $endNo; $i++) {
            if ($i == $pNo) {
                echo '<li class="am-active"><a href="project?pageNo='.$i.'">'.$i.'</li>';
            }
            else {
                echo '<li><a href="project?pageNo='.$i.'">'.$i.'</li>';
            }
        }
        if ($endNo != $allPage) {
            echo '<li><a href="project?pageNo='.$allPage.'">&raquo;</li>';
        }
        else {
            echo '<li class="am-disabled"><a href="project?pageNo='.$allPage.'">&raquo;</li>';
        }
      ?>
    </ul>

  </div>
</div>

<?php include_once 'static/footer.php' ?>

<script type="text/javascript">

function page (pageNo = 0) {
  // body...
}

function project (pid = 0) {
    
}

</script>
</body>
</html>