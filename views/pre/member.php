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
            <button type="button" class="am-btn am-btn-default" id="add-member"><span class="am-icon-plus"></span> 新增</button>
            <button type="button" class="am-btn am-btn-default" id="del-member"><span class="am-icon-trash-o"></span> 删除</button>
            <button type="button" class="am-btn am-btn-default" id="save-member"><span class="am-icon-save"></span> 保存</button>
            <button type="button" class="am-btn am-btn-default" id="repeat-member"><span class="am-icon-repeat"></span> 还原</button>
          </div>
        </div>
      </div>
    </div>
    <!--edit end-->

    <div class="am-g">
      <div class="am-u-sm-12">
          <!--table-->
          <table id="member-table" class="am-table am-table-striped am-table-hover table-main">
            <thead>
              <tr>
                <th class="table-check"><input type="checkbox" /></th>
                <th>ID</th>
                <th>姓名</th>
                <th>性别</th>
                <th>电话</th>
                <th>手机</th>
                <th>邮箱</th>
                <th>岗位</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php
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
                            $dom  = '<tr>';
                            $dom .= '<td><input id="'.$m['id'].'" type="checkbox" /></td>';
                            $dom .= '<td>'.$i.'</td>';
                            $dom .= '<td>'.$m['name'].'</td>';
                            $sex  = ($m['sex'] == 1) ? '男' : '女';
                            $dom .= '<td class="am-hide-sm-only>'.$sex.'</td>';
                            $dom .= '<td class="am-hide-sm-only>'.$m['phone'].'</td>';
                            $dom .= '<td class="am-hide-sm-only>'.$m['mobile'].'</td>';
                            $dom .= '<td>'.$m['position'].'</td>';
                            $dom .= '<td>'.$tool.'</td>';
                            $dom .= '</tr>';
                            echo $dom;
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

      </div>
    </div>
  </div>
</div>

<!--member modal-->
<div class="am-modal am-modal-prompt" tabindex="-1" id="member-modal">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">新增人员</div>
    <div class="am-modal-bd">
      <div class="am-btn-group doc-js-btn-1" data-am-button>
        <label class="am-btn am-btn-default">
          <input type="radio" name="part" value="1" id="partA">&nbsp;&nbsp;评估方&nbsp;&nbsp;
        </label>
        <label class="am-btn am-btn-default">
          <input type="radio" name="part" value="2" id="partB">被评估方
        </label>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-2 am-text-right">姓名</div>
        <div class="am-u-sm-8 am-u-md-10">
          <input id="name" name="name" type="text" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-2 am-text-right">性别</div>
        <div class="am-u-sm-2 am-u-md-4">
            <label id="sex" value="1">男</label>
        </div>
        <div class="am-u-sm-6 am-u-md-6">
          <div class="am-btn-group am-btn-group-xs">
            <button type="button" onclick="change_sex(1)" class="am-btn am-btn-primary am-round">&nbsp;&nbsp;<i class="am-icon-mars"></i>&nbsp;&nbsp;</button>
            <button type="button" onclick="change_sex(0)" class="am-btn am-btn-danger am-round">&nbsp;&nbsp;<i class="am-icon-venus"></i>&nbsp;&nbsp;</button>
          </div>
        </div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-2 am-text-right">电话</div>
        <div class="am-u-sm-8 am-u-md-10">
          <input id="phone" name="phone" type="text" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-2 am-text-right">手机</div>
        <div class="am-u-sm-8 am-u-md-10">
          <input id="mobile" name="mobile" type="text" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-2 am-text-right">邮箱</div>
        <div class="am-u-sm-8 am-u-md-10">
          <input id="email" name="email" type="email" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-2 am-text-right">岗位</div>
        <div class="am-u-sm-8 am-u-md-10">
          <select id="position" name="position" data-am-selected="{btnSize: 'sm'}">
            <?php
              foreach ($position as $p) {
                echo '<option value="'.$p['id'].'">'.$p['name'].'</option>';
              }
            ?>
          </select>
        </div>
      </div>
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>提交</span>
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<!--member modal end-->

<?php include_once VIEW_PATH.'static/footer.php'; ?>

<script type="text/javascript">
var tool = '<div class="am-btn-toolbar"><div class="am-btn-group am-btn-group-xs"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button></div></div>';

$(function() {
    $('#add-member').on('click', function() {
        $('#member-modal').modal({
            relatedTarget: this,
            onConfirm: function(e) {
                add_member();
            },
            onCancel: function(e) {
                //alert('!');
            }
        });
    });
});

function change_sex (sexid) {
    var sex = $('#sex').attr('id',sex);
    if (sexid == 1) {
        sex.text("男");
    }
    else if (sexid == 0) {
        sex.text("女");
    }
}

function add_member () {
    var name = $('#name').val();
    var sex = $('#sex').val();
    var phone = $('#phone').val();
    var mobile = $('#mobile').val();
    var email = $('#email').val();
    var position = $('#position').val();

    var newRow = $('<tr></tr>');
    var newTd = $('<td></td>');
    

    var table = $('#member-table');
}
</script>
</body>
</html>