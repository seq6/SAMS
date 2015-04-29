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
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">人员资源</strong> / <small>persons</small></div>
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

    <!--add elses-->
    <div class="am-g">
      <div class="am-u-sm-12 am-u-md-6">
        <div class="am-btn-toolbar">
          <button type="button" class="am-btn am-btn-primary" id="add-person" onclick="add()">
            <span class="am-icon-plus"></span> 新增
          </button>
        </div>
      </div>
    </div>
    <br/>
    <!--add elses end-->

    <div class="am-g">
      <div class="am-u-sm-12">
          <!--table-->
          <table id="member-table" class="am-table am-table-striped am-table-hover table-main">
            <thead>
              <tr>
                <th></th>
                <th>资产编号</th>
                <th>人员姓名</th>
                <th class="am-hide-sm-only">性别</th>
                <th class="am-hide-sm-only">职务</th>
                <th class="am-hide-sm-only">部门</th>
                <th class="am-hide-sm-only">联系电话</th>
                <th>重要程度</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    if (isset($person) && !empty($person)) {
                        $i = ($pageNo - 1) * 10;
                        foreach ($person as $p) {
                            $i++;
                            echo '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.$p['assetid'].'</td>
                                    <td>'.$p['name'].'</td>
                                    <td class="am-hide-sm-only">'.$p['sex'].'</td>
                                    <td class="am-hide-sm-only">'.$p['post'].'</td>
                                    <td class="am-hide-sm-only">'.$p['depart'].'</td>
                                    <td>'.$p['mobile'].'</td>
                                    <td>'.$p['import'].'</td>
                                    <td>
                                      <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                          <button class="am-btn am-btn-default am-btn-xs am-text-warning" onclick="detail('.$p['id'].')">
                                            <span class="am-icon-file-text-o"></span> 详情
                                          </button>
                                          <button class="am-btn am-btn-default am-btn-xs am-text-secondary" onclick="edit('.$p['id'].')">
                                            <span class="am-icon-pencil-square-o"></span> 编辑
                                          </button>
                                          <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onclick="del('.$p['id'].')">
                                            <span class="am-icon-trash-o"></span> 删除
                                          </button>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>';
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
                        echo '<li><a href="/sur/person?pageNo=1">&laquo;</a></li>';
                    }
                    else {
                        echo '<li class="am-disabled"><a href="/sur/person?pageNo=1">&laquo;</a></li>';
                    }
                    $startNo = ($pageNo - 2) >= 1 ? ($pageNo - 2) : 1;
                    $endNo = ($pageNo + 2) <= $allPage ? ($pageNo + 2) : $allPage;
                    for ($i = $startNo; $i <= $endNo; $i++) {
                        if ($i == $pageNo) {
                            echo '<li class="am-active"><a href="/sur/person?pageNo='.$i.'">'.$i.'</a></li>';
                        }
                        else {
                            echo '<li><a href="/sur/person?pageNo='.$i.'">'.$i.'</a></li>';
                        }
                    }
                    if ($pageNo != $allPage) {
                        echo '<li><a href="/sur/person?pageNo='.$allPage.'">&raquo;</a></li>';
                    }
                    else {
                        echo '<li class="am-disabled"><a href="/sur/person?pageNo='.$allPage.'">&raquo;</a></li>';
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

<!--person modal-->
<div class="am-modal am-modal-prompt" tabindex="-1" id="person-modal">
  <div class="am-modal-dialog">
    <div id="modal-title" class="am-modal-hd"></div>
    <div class="am-modal-bd">
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">资产编号</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="assetid" name="assetid" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">人员姓名</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="name" name="name" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">性别</div>
        <div class="am-u-sm-2 am-u-md-3">
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
        <div class="am-u-sm-4 am-u-md-3 am-text-right">职务</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="post" name="post" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">部门</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="depart" name="depart" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">电话</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="phone" name="phone" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">手机</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="mobile" name="mobile" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">电子邮箱</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="email" name="email" type="email" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">重要程度</div>
        <div class="am-u-sm-8 am-u-md-9">
          <select id="import" name="import" data-am-selected="{btnSize: 'sm', dropUp: 1}">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
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
<!--person modal end-->

<!--delete person modal-->
<div class="am-modal am-modal-prompt" id="del-person-modal">
  <div class="am-modal-dialog">
    <div id="del-modal-title" class="am-modal-hd">删除人员</div>
      <div class="am-modal-bd">
        是否确定删除该人员所有信息？
      </div>
      <div class="am-modal-footer">
        <span class="am-modal-btn" data-am-modal-confirm>确定</span>
        <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<!--delete person modal end-->

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
    set_person_data();
    $('#person-modal').modal({
        relatedTarget: this,
        onConfirm: function() {
            return add_person();
        },
        onCancel: function() {}
    });
}

function del (id) {
    $('#del-person-modal').modal({
        relatedTarget: this,
        onConfirm: function() {
            return del_person(id);
        },
        onCancel: function() {}
    });
}

function edit (id) {
    $('#modal-title').text('编辑人员');
    var mydata = {};
    mydata['personid'] = id;
    my_ajax('/sur/person/get', 'get', mydata, function (person) {
        return set_person_data(person.assetid, person.name, person.sex, person.post, person.depart, person.phone, person.mobile, person.email, person.import);
    });

    $('#person-modal').modal({
        relatedTarget: this,
        onConfirm: function() {
            return edit_person(id);
        },
        onCancel: function() {
        }
    });
}

function add_person () {
    var params = get_person_data();
    params['editType'] = 'add';
    return submit_form('/sur/person', 'post', params);
}

function edit_person (id) {
    var params = get_person_data();
    params['editType'] = 'edit';
    params['personid'] = id;
    return submit_form('/sur/person', 'post', params);
}

function del_person (id) {
    var params = {};
    params['editType'] = 'del';
    params['personid'] = id;
    return submit_form('/sur/person', 'post', params);
}

function get_person_data () {
    var res = {};
    res['assetid'] = $('#assetid').val();
    res['name'] = $('#name').val();
    res['post'] = $('#post').val();
    res['depart'] = $('#depart').val();
    res['phone'] = $('#phone').val();
    res['mobile'] = $('#mobile').val();
    res['email'] = $('#email').val();
    res['import'] = $('#import').val();
    if ($('#sex').text() == '男') {
        res['sex'] = 1;
    }
    else if ($('#sex').text() == '女'){
        res['sex'] = 0;
    }
    return res;
}

function set_person_data (assetid, name, sex, post, depart, phone, mobile, email, pimport) {
    $('#assetid').val(assetid);
    $('#name').val(name);
    change_sex(sex);
    $('#post').val(post);
    $('#depart').val(depart);
    $('#phone').val(phone);
    $('#mobile').val(mobile);
    $('#email').val(email);
    $('#import').val(pimport);
}

function change_sex (sexid) {
    if (sexid == '1') {
        $('#sex').text('男');
    }
    else if (sexid == '0') {
        $('#sex').text('女');
    }
}

function detail (id) {
  // body...
}
</script>
</body>
</html>