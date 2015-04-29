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
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">项目人员</strong> / <small>members</small></div>
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

    <!--add member-->
    <div class="am-g">
      <div class="am-u-sm-12 am-u-md-6">
        <div class="am-btn-toolbar">
          <button type="button" class="am-btn am-btn-primary" id="add-member" onclick="add()"><span class="am-icon-plus"></span> 新增</button>
        </div>
      </div>
    </div>
    <br/>
    <!--add member end-->

    <div class="am-g">
      <div class="am-u-sm-12">
          <!--table-->
          <table id="member-table" class="am-table am-table-striped am-table-hover table-main">
            <thead>
              <tr>
                <th>ID</th>
                <th>姓名</th>
                <th class="am-hide-sm-only">性别</th>
                <th class="am-hide-sm-only">电话</th>
                <th class="am-hide-sm-only">手机</th>
                <th class="am-hide-sm-only">邮箱</th>
                <th>岗位</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    if (isset($members) && !empty($members)) {
                        $i = ($pageNo - 1) * 10 + 1;
                        foreach ($members as $m) {
                            echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$m['name'].'</td>';
                            $sex  = ($m['sex'] == '1') ? '男' : '女';
                            echo '<td class="am-hide-sm-only">'.$sex.'</td>';
                            echo '<td class="am-hide-sm-only">'.$m['phone'].'</td>';
                            echo '<td class="am-hide-sm-only">'.$m['mobile'].'</td>';
                            echo '<td class="am-hide-sm-only">'.$m['email'].'</td>';
                            $part = ($m['partid'] == '1') ? '评估方' : '被评估方';
                            echo '<td>'.$m['position'].'('.$part.')</td>';
                            echo '<td><div class="am-btn-toolbar"><div class="am-btn-group am-btn-group-xs">';
                            echo '<button class="am-btn am-btn-default am-btn-xs am-text-secondary" onclick="edit('.$m['id'].')"><span class="am-icon-pencil-square-o"></span> 编辑</button>';
                            echo '<button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onclick="del('.$m['id'].')"><span class="am-icon-trash-o"></span> 删除</button>';
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
                        echo '<li><a href="/pre/member?pageNo=1">&laquo;</a></li>';
                    }
                    else {
                        echo '<li class="am-disabled"><a href="/pre/member?pageNo=1">&laquo;</a></li>';
                    }
                    $startNo = ($pageNo - 2) >= 1 ? ($pageNo - 2) : 1;
                    $endNo = ($pageNo + 2) <= $allPage ? ($pageNo + 2) : $allPage;
                    for ($i = $startNo; $i <= $endNo; $i++) {
                        if ($i == $pageNo) {
                            echo '<li class="am-active"><a href="/pre/member?pageNo='.$i.'">'.$i.'</a></li>';
                        }
                        else {
                            echo '<li><a href="/pre/member?pageNo='.$i.'">'.$i.'</a></li>';
                        }
                    }
                    if ($pageNo != $allPage) {
                        echo '<li><a href="/pre/member?pageNo='.$allPage.'">&raquo;</a></li>';
                    }
                    else {
                        echo '<li class="am-disabled"><a href="/pre/member?pageNo='.$allPage.'">&raquo;</a></li>';
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

<!--member modal-->
<div class="am-modal am-modal-prompt" tabindex="-1" id="member-modal">
  <div class="am-modal-dialog">
    <div id="modal-title" class="am-modal-hd"></div>
    <div class="am-modal-bd">
      <div class="am-btn-group doc-js-btn-1" data-am-button>
        <label class="am-btn am-btn-default am-active">
          <input type="radio" name="part" value="1" id="partA" checked="checked">&nbsp;&nbsp;评估方&nbsp;&nbsp;
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

<!--delete member modal-->
<div class="am-modal am-modal-prompt" id="del-member-modal">
  <div class="am-modal-dialog">
    <div id="modal-title" class="am-modal-hd">删除人员</div>
      <div class="am-modal-bd">
        是否确定删除该人员所有信息？
      </div>
      <div class="am-modal-footer">
        <span class="am-modal-btn" data-am-modal-confirm>确定</span>
        <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<!--delete member modal end-->

<?php include_once 'app/views/static/footer.php'; ?>

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

function submit_form (url, method, params) {
    var myForm = $('<form></form>');
    myForm.attr('action', url); 
    myForm.attr('method', method);
    myForm.attr('target', '_self');

    var theInput = $('<input type="text"/>');
    for (x in params) {
        var myInput = theInput.clone();
        myInput.attr('name', x);
        myInput.attr('value', params[x]);
        myForm.append(myInput);
    }

    myForm.submit();
}

function add () {
    $('#modal-title').text('新增人员');
    set_member_data();
    $('#member-modal').modal({
        relatedTarget: this,
        onConfirm: function() {
            return add_member();
        },
        onCancel: function() {}
    });
}

function del (id) {
    $('#del-member-modal').modal({
        relatedTarget:this,
        onConfirm: function () {
            return delete_member(id);
        },
        onCancel:function () {}
    });
}

function edit (id) {
    $('#modal-title').text('人员信息');
    var mydata = {};
    mydata['memberid'] = id;
    my_ajax('/pre/member/get', 'get', mydata, function (member) {
        set_member_data(member.partid, member.name, member.sex, member.phone, member.mobile, member.email, member.posid);
    });

    $('#member-modal').modal({
        relatedTarget: this,
        onConfirm: function() {
            return edit_member(id);
        },
        onCancel: function() {
        }
    });
}

function change_sex (sexid) {
    if (sexid == 1) {
        $('#sex').text("男");
    }
    else if (sexid == 0) {
        $('#sex').text("女");
    }
}

function edit_member (id) {
    var params = get_member_data();
    params['editType'] = 'edit';
    params['memberid'] = id;
    return submit_form('/pre/member', 'post', params);
}

function delete_member (id) {
    var params = {};
    params['editType'] = 'del';
    params['memberid'] = id;
    return submit_form('/pre/member', 'post', params);
}

function add_member () {
    var params = get_member_data();
    params['editType'] = 'add';
    return submit_form('/pre/member', 'post', params);
}

function set_member_data (partid, name, sex, phone, mobile, email, posid) {
    var partid = partid || 1;

    var name = name || '';
    $('#name').val(name);

    var sex = sex || 1;
    if (sex == 0) {
        $('#sex').text('女');
    }
    else {
        $('#sex').text('男');
    }

    var phone = phone || '';
    $('#phone').val(phone);

    var mobile = mobile || '';
    $('#mobile').val(mobile);

    var email = email || '';
    $('#email').val(email);

    var posid = posid || '1';
    $("#position").val(posid);
    //$("#position").find('option[value="'+posid+'""]').attr("selected",true);
}

function get_member_data () {
    var res = {};
    res['partid'] = $("input[name='part']:checked").val();
    res['name'] = $('#name').val();
    var sexText = $('#sex').text();
    if (sexText == '男') {
        res['sex'] = 1;
    }
    else if (sexText == '女') {
        res['sex'] = 0;
    }
    res['phone'] = $('#phone').val();
    res['mobile'] = $('#mobile').val();
    res['email'] = $('#email').val();
    res['posid'] = $('#position').val();
    return res;
}

</script>
</body>
</html>