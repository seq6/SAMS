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
        if ($_SESSION['login']['said'] == 'admin') {
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
          <th>ID</th>
          <th>项目</th>
          <th>状态</th>
          <th>启动时间</th>
          <th>关闭时间</th>
          <th>更新时间</th>
          <th>负责人</th>
        </tr>
      </thead>
      <tbody>
        <?php
            if (isset($project) && !empty($project)) {
                foreach ($project as $p) {
                    $dom = '<tr onclick="project('.$p['id'].')">';
                    $dom .= '<td>'.$p['id'].'</td>';
                    $dom .= '<td><a href="pre/information/?pid='.$p['id'].'">'.$p['name'].'</a></td>';
                    switch ($p['status']) {
                        case '0':
                            $dom .= '<td>未启动</td>';
                            break;
                        case '1':
                            $dom .= '<td>进行中</td>';
                            break;
                        case '2':
                            $dom .= '<td>已关闭</td>';
                            break;
                        default:
                            $dom .= '<td>error</td>';
                            break;
                    }
                    $dom .= '<td>'.$p['starttime'].'</td>';
                    $dom .= '<td>'.$p['endtime'].'</td>';
                    $dom .= '<td>'.$p['updatetime'].'</td>';
                    $dom .= '<td>'.$p['uid'].'</td>';
                    $dom .= '</tr>';
                    echo $dom;
                }
            }
        ?>
      </tbody>
    </table>

    <ul class="am-pagination">
      <?php
        if (!isset($pageNo)) {
            $pageNo = 1;
        }
        if (!isset($count)) {
            $count = 0;
        }
        $allPage = ($count - 1) / 10 + 1;
        if ($pageNo != 1) {
            echo '<li><a href="project?pageNo=1">&laquo;</a></li>';
        }
        else {
            echo '<li class="am-disabled"><a href="project?pageNo=1">&laquo;</a></li>';
        }
        $startNo = ($pageNo - 2) >= 1 ? ($pageNo - 2) : 1;
        $endNo = ($pageNo + 2) <= $allPage ? ($pageNo + 2) : $allPage;
        for ($i = $startNo; $i <= $endNo; $i++) {
            if ($i == $pageNo) {
                echo '<li class="am-active"><a href="project?pageNo='.$i.'">'.$i.'</a></li>';
            }
            else {
                echo '<li><a href="project?pageNo='.$i.'">'.$i.'</a></li>';
            }
        }
        if ($endNo != $allPage) {
            echo '<li><a href="project?pageNo='.$allPage.'">&raquo;</a></li>';
        }
        else {
            echo '<li class="am-disabled"><a href="project?pageNo='.$allPage.'">&raquo;</a></li>';
        }
      ?>
    </ul>

  </div>
</div>

<?php include_once 'static/footer.php' ?>

<script type="text/javascript">

</script>
</body>
</html>