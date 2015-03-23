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
  <link rel="stylesheet" href="assets/css/amazeui.min.css"/>
  <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
  <?php include_once 'header.php' ?>

  <table class="am-table am-table-striped am-table-hover">
    <thead>
      <tr>
        <th>项目号</th>
        <th>项目名称</th>
        <th>项目状态</th>
        <th>启动时间</th>
        <th>关闭时间</th>
        <th>更新时间</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if ($count == 0) {
            echo '<tr>
            <td>0</td>
            <td>尚无项目</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            </tr>';
        }
        else {
            foreach ($project as $p) {
                echo '<tr onclick="project('.$p['id'].')">
                <td>'.$p['id'].'</td>
                <td>'.$p['name'].'</td>
                <td>'.$p['status'].'</td>
                <td>'.$p['starttime'].'</td>
                <td>'.$p['endtime'].'</td>
                <td>'.$p['updatetime'].'</td>
                </tr>';
            }
        }
      ?>
    </tbody>
  </table>

  <ul class="am-pagination">
    <li></li>
  </ul>

  <?php include_once 'footer.php' ?>

  <script type="text/javascript">
  function project (pid = 0) {
      // body...
  }
  </script>
</body>
</html>