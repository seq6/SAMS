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
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">项目人员</strong> / <small>members</small></div>
    </div>
    <hr/>
    <!--title end-->

    <!--edit-->
    <div class="am-g">
      <div class="am-u-sm-12 am-u-md-6">
        <div class="am-btn-toolbar">
          <div class="am-btn-group am-btn-group-xs">
            <button type="button" class="am-btn am-btn-default"><span class="am-icon-plus"></span> 新增</button>
            <button type="button" class="am-btn am-btn-default"><span class="am-icon-save"></span> 保存</button>
            <button type="button" class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button>
          </div>
        </div>
      </div>
    </div>
    <!--edit end-->

    <div class="am-g">
      <div class="am-u-sm-12">
        <form class="am-form">
          <!--table-->
          <table class="am-table am-table-striped am-table-hover table-main">
            <thead>
              <tr>
                <th class="table-check"><input type="checkbox" /></th>
                <th>ID</th>
                <th>姓名</th>
                <th>性别</th>
                <th>电话</th>
                <th>手机</th>
                <th>岗位</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php
                    $dom = '';
                    $tool = '<div class="am-btn-toolbar">
                              <div class="am-btn-group am-btn-group-xs">
                                <button class="am-btn am-btn-default am-btn-xs am-text-secondary">
                                    <span class="am-icon-pencil-square-o"></span> 编辑
                                </button>
                                <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only">
                                    <span class="am-icon-copy"></span> 复制
                                </button>
                                <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only">
                                    <span class="am-icon-trash-o"></span> 删除
                                </button>
                              </div>
                            </div>';
                    if (isset($members) && !empty($members)) {
                        $i = ($pageNo - 1) * 10 + 1;
                        foreach ($members as $key => $m) {
                            $dom .= '<td><input id="'.$m['id'].'" type="checkbox" /></td>';
                            $dom .= '<td>'.$i.'</td>';
                            $dom .= '<td>'.$m['name'].'</td>';
                            $sex = ($m['sex'] == 1) ? '男' : '女';
                            $dom .= '<td class="am-hide-sm-only>'.$sex.'</td>';
                            $dom .= '<td class="am-hide-sm-only>'.$m['phone'].'</td>';
                            $dom .= '<td class="am-hide-sm-only>'.$m['mobile'].'</td>';
                            $dom .= '<td>'.$m['position'].'</td>';
                            $dom .= '<td>'.$tool.'</td>';
                            $i++;
                        }
                    }
                ?>
              </tr>
            </tbody>
          </table>
          <!--table end-->

          <!--pagination-->
          <div class="am-cf">
            <?php
              echo '共'.$count.'条记录';
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
          <!--pagination end-->
          <hr />

          <!--submit-->
          <div class="am-margin">
            <button type="button" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
            <button type="reset" class="am-btn am-btn-primary am-btn-xs">重 置</button>
          </div>
          <!--submit end-->
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once VIEW_PATH.'static/footer.php'; ?>

<script type="text/javascript">

</script>
</body>
</html>