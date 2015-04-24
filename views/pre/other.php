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
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">其他任务</strong> / <small>others</small></div>
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
                $prompt = '文件提交成功';
                break;
            }
            case 2: {
                $color = ' am-alert-danger';
                $prompt = '文件提交失败';
                break;
            }
            default: {
                $color = ' am-alert-danger';
                $prompt = 'error!';
                break;
            }
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

    <!--edit-->
    <div class="am-g">
      <div class="am-u-sm-12 am-u-md-6">
        <div class="am-btn-toolbar">
          <button type="button" class="am-btn am-btn-primary" id="add-member" onclick="add()"><span class="am-icon-plus"></span> 新增</button>
        </div>
      </div>
    </div>
    <br/>
    <!--edit end-->

    <div class="am-g">
      <div class="am-u-sm-12">
          <!--table-->
          <table id="member-table" class="am-table am-table-striped am-table-hover table-main">
            <thead>
              <tr>
                <th>ID</th>
                <th>电子文档</th>
                <th class="am-hide-sm-only">涉及人员</th>
                <th class="am-hide-sm-only">地点</th>
                <th class="am-hide-sm-only">开始时间</th>
                <th class="am-hide-sm-only">结束时间</th>
                <th class="am-hide-sm-only">更新时间</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>《委托书》</td>
                <th class="am-hide-sm-only">qwe,qwe,qwe</th>
                <th class="am-hide-sm-only">dongsanjie</th>
                <th class="am-hide-sm-only">2013-12-13</th>
                <th class="am-hide-sm-only">2014-03-14</th>
                <th class="am-hide-sm-only">2014-03-12</th>
                <th>
                  <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                      <button class="am-btn am-btn-default am-btn-xs am-text-warning">
                        <span class="am-icon-download"></span> 下载
                      </button>
                      <button class="am-btn am-btn-default am-btn-xs am-text-secondary">
                        <span class="am-icon-pencil-square-o"></span> 编辑
                      </button>
                      <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only">
                        <span class="am-icon-trash-o"></span> 删除
                      </button>
                    </div>
                  </div>
                </th>
              </tr>
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
                        echo '<li><a href="/pre/other?pageNo=1">&laquo;</a></li>';
                    }
                    else {
                        echo '<li class="am-disabled"><a href="/pre/other?pageNo=1">&laquo;</a></li>';
                    }
                    $startNo = ($pageNo - 2) >= 1 ? ($pageNo - 2) : 1;
                    $endNo = ($pageNo + 2) <= $allPage ? ($pageNo + 2) : $allPage;
                    for ($i = $startNo; $i <= $endNo; $i++) {
                        if ($i == $pageNo) {
                            echo '<li class="am-active"><a href="/pre/other?pageNo='.$i.'">'.$i.'</a></li>';
                        }
                        else {
                            echo '<li><a href="/pre/other?pageNo='.$i.'">'.$i.'</a></li>';
                        }
                    }
                    if ($pageNo != $allPage) {
                        echo '<li><a href="/pre/other?pageNo='.$allPage.'">&raquo;</a></li>';
                    }
                    else {
                        echo '<li class="am-disabled"><a href="/pre/other?pageNo='.$allPage.'">&raquo;</a></li>';
                    }
                ?>
              </ul>
            </div>
          </div>
          <!--pagination end-->
      </div>
    </div>
  </div>
</div>

<!--upload file modal-->
<div class="am-modal am-modal-prompt" id="del-member-modal">
  <div class="am-modal-dialog">
    <div id="modal-title" class="am-modal-hd">上传文档</div>
      <div class="am-modal-bd">
        <!--file name-->
        <div class="am-g am-margin-top">
          <div class="am-u-sm-1 am-u-md-1"></div>
          <div class="am-u-sm-10 am-u-md-10 am-u-sm-centered">
            <div class="am-input-group">
              <span class="am-input-group-label"><i class="am-icon-file"></i></span>
              <input type="text" id="file-name" name="file-name" class="am-form-field" placeholder="请输入文档名..." maxlength="20">
            </div>
          </div>
          <div class="am-u-sm-1 am-u-md-1"></div>
        </div>
        <!--file name end-->
        <!--file members-->
        <div class="am-g am-margin-top">
          <div class="am-u-sm-1 am-u-md-1"></div>
          <div class="am-u-sm-10 am-u-md-10 am-u-sm-centered">
            <div class="am-input-group">
              <span class="am-input-group-label"><i class="am-icon-group"></i></span>
              <input type="text" id="file-members" name="file-members" class="am-form-field" placeholder="请输入涉及人员姓名..." maxlength="20">
            </div>
          </div>
          <div class="am-u-sm-1 am-u-md-1"></div>
        </div>
        <!--file members end-->
        <!--file place-->
        <div class="am-g am-margin-top">
          <div class="am-u-sm-1 am-u-md-1"></div>
          <div class="am-u-sm-10 am-u-md-10 am-u-sm-centered">
            <div class="am-input-group">
              <span class="am-input-group-label"><i class="am-icon-map-marker"></i></span>
              <input type="text" id="file-place" name="file-place" class="am-form-field" placeholder="请输入任务的工作地点..." maxlength="20">
            </div>
          </div>
          <div class="am-u-sm-1 am-u-md-1"></div>
        </div>
        <!--file place end-->
        <!--starttime-->
        <div class="am-g am-margin-top">
          <div class="am-u-sm-1 am-u-md-1"></div>
          <div class="am-u-sm-10 am-u-md-10 am-u-sm-centered">
            <div class="am-input-group">
              <span class="am-input-group-label"><i class="am-icon-square-o"></i></span>
              <input type="date" id="starttime" name="starttime" class="am-form-field">
            </div>
          </div>
          <div class="am-u-sm-1 am-u-md-1"></div>
        </div>
        <!--starttime end-->
        <!--endtime-->
        <div class="am-g am-margin-top">
          <div class="am-u-sm-1 am-u-md-1"></div>
          <div class="am-u-sm-10 am-u-md-10 am-u-sm-centered">
            <div class="am-input-group">
              <span class="am-input-group-label"><i class="am-icon-square"></i></span>
              <input type="date" id="endtime" name="endtime" class="am-form-field">
            </div>
          </div>
          <div class="am-u-sm-1 am-u-md-1"></div>
        </div>
        <!--endtime end-->
        <!--file upload-->
        <div class="am-g am-margin-top">
          <div class="am-u-sm-1 am-u-md-1"></div>
          <div class="am-u-sm-10 am-u-md-10 am-u-sm-centered">
            <div class="am-input-group">
              <span class="am-input-group-label"><i class="am-icon-upload"></i></span>
              <input type="file" id="upload-file" name="upload-file" class="am-form-field">
            </div>
          </div>
          <div class="am-u-sm-1 am-u-md-1"></div>
        </div>
        <!--file upload end-->
      </div>
      <div class="am-modal-footer">
        <span class="am-modal-btn" data-am-modal-confirm>确定</span>
        <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<!--upload file modal end-->

<?php include_once VIEW_PATH.'static/footer.php'; ?>

<script type="text/javascript">
function my_ajax (theUrl, theMethod, theData, callback) {
    $.ajax({
        type:theMethod,
        url:theUrl,
        async:false,
        data:theData,
        dataType:'json',
        success:callback
    });
}

function add () {
    $('#del-member-modal').modal({
        relatedTarget: this,
        onConfirm: function() {
          alert('asd');
        },
        onCancel: function() {}
    });
}
</script>
</body>
</html>