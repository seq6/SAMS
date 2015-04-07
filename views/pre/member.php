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
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">项目人员</strong> / <small>members</small></div>
      </div>
      <hr/>

      <table class="am-table am-table-bordered am-table-striped am-table-hover">
      <thead>
        <tr>
          <th>姓名</th>
          <th>性别</th>
          <th>电话</th>
          <th>手机</th>
          <th>电子邮箱</th>
          <th>岗位</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        <?php
            if (isset($members) && !empty($m)) {
                foreach ($project as $p) {
                    $dom = '<tr onclick="project('.$p['id'].')">';
                    $dom .= '<td>'.$p['id'].'</td>';
                    $dom .= '<td><a href="pre/information/?pid='.$p['id'].'">'.$p['name'].'</a></td>';
                    $dom .= '<td>'.$p['status'].'</td>';
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
        $pNo = isset($pageNo) ? $pageNo : 1;
        $count = 1;
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

  <a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

  <?php include_once VIEW_PATH.'static/footer.php'; ?>
</body>
</html>