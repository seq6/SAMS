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

  <!--content-->
  <div class="admin-content">
    <!--title-->
    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">数据文档</strong> / <small>document</small></div>
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

    <!--add document-->
    <div class="am-g">
      <div class="am-u-sm-12 am-u-md-6">
        <div class="am-btn-toolbar">
          <button type="button" class="am-btn am-btn-primary" id="add-document" onclick="add()"><span class="am-icon-plus"></span> 新增</button>
        </div>
      </div>
    </div>
    <br/>
    <!--add document end-->
    <div class="am-g">
      <div class="am-u-sm-12">
          <!--table-->
          <table id="member-table" class="am-table am-table-striped am-table-hover table-main">
            <thead>
              <tr>
                <th>ID</th>
                <th>资产编号</th>
                <th class="am-hide-sm-only">文档类别</th>
                <th class="am-hide-sm-only">文档名称</th>
                <th class="am-hide-sm-only">文档描述</th>
                <th class="am-hide-sm-only">更新时间</th>
                <th>重要程度</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    if (isset($document) && !empty($document)) {
                        $i = ($pageNo - 1) * 10 + 1;
                        foreach ($document as $d) {
                            echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$d['name'].'</td>';
                            $sex  = ($d['sex'] == '1') ? '男' : '女';
                            echo '<td class="am-hide-sm-only">'.$sex.'</td>';
                            echo '<td class="am-hide-sm-only">'.$d['phone'].'</td>';
                            echo '<td class="am-hide-sm-only">'.$d['mobile'].'</td>';
                            echo '<td class="am-hide-sm-only">'.$d['email'].'</td>';
                            $part = ($d['partid'] == '1') ? '评估方' : '被评估方';
                            echo '<td>'.$d['position'].'('.$part.')</td>';
                            echo '<td><div class="am-btn-toolbar"><div class="am-btn-group am-btn-group-xs">';
                            echo '<button class="am-btn am-btn-default am-btn-xs am-text-secondary" onclick="edit('.$d['id'].')"><span class="am-icon-pencil-square-o"></span> 编辑</button>';
                            echo '<button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onclick="del('.$d['id'].')"><span class="am-icon-trash-o"></span> 删除</button>';
                            echo '</div></div></td>';
                            echo '</tr>';
                            $i++;
                        }
                    }
                ?>
            </tbody>
          </table>
          <!--table end-->

          <!--pagination-->
          <div class="am-cf">
            <?php
              $theCount = isset($count) ? $count : 0;
              echo '共'.$theCount.'条记录';
            ?>
            <div class="am-fr">
              <ul class="am-pagination">
                <?php
                    if (!isset($pageNo)) {
                        $pageNo = 1;
                    }
                    if (!isset($count)) {
                        $count = 0;
                    }
                    $allPage = ($count != 0) ? (int)(($count - 1) / 10 + 1) : 1;
                    if ($pageNo != 1) {
                        echo '<li><a href="/sur/document?pageNo=1">&laquo;</a></li>';
                    }
                    else {
                        echo '<li class="am-disabled"><a href="/sur/document?pageNo=1">&laquo;</a></li>';
                    }
                    $startNo = ($pageNo - 2) >= 1 ? ($pageNo - 2) : 1;
                    $endNo = ($pageNo + 2) <= $allPage ? ($pageNo + 2) : $allPage;
                    for ($i = $startNo; $i <= $endNo; $i++) {
                        if ($i == $pageNo) {
                            echo '<li class="am-active"><a href="/sur/document?pageNo='.$i.'">'.$i.'</a></li>';
                        }
                        else {
                            echo '<li><a href="/sur/document?pageNo='.$i.'">'.$i.'</a></li>';
                        }
                    }
                    if ($pageNo != $allPage) {
                        echo '<li><a href="/sur/document?pageNo='.$allPage.'">&raquo;</a></li>';
                    }
                    else {
                        echo '<li class="am-disabled"><a href="/sur/document?pageNo='.$allPage.'">&raquo;</a></li>';
                    }
                ?>
              </ul>
            </div>
          </div>
          <!--pagination end-->
      </div>
    </div>
  </div>
  <!--content end-->
</div>

<?php include_once 'app/views/static/footer.php'; ?>

<script type="text/javascript">

</script>
</body>
</html>