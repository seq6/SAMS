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
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">软件资源</strong> / <small>software</small></div>
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

    <!--add and chioce-->
    <div class="am-g">
      <div class="am-u-sm-6 am-u-md-6">
        <div class="am-btn-toolbar">
          <button type="button" class="am-btn am-btn-primary" id="add-person" onclick="add()">
            <span class="am-icon-plus"></span> 新增
          </button>
        </div>
      </div>
      <div class="am-u-sm-6 am-u-md-6 am-text-right">
        <?php
        if ($st == 0) {
            echo '<label>全部</label>';
        }
        else {
            echo '<a href="/sur/software">全部</a>';
        }

        if (isset($softtype) && !empty($softtype)) {
            foreach ($softtype as $s) {
                echo '<small> | </small>';
                if ($s['id'] == $st) {
                    echo '<label>'.$s['name'].'</label>';
                }
                else {
                    echo '<a href="/sur/software?st='.$s['id'].'">'.$s['name'].'</a>';
                }
            }    
        }
        ?>
      </div>
    </div>
    <br/>
    <!--add and chioce end-->

    <div class="am-g">
      <div class="am-u-sm-12">
          <!--table-->
          <table id="member-table" class="am-table am-table-striped am-table-hover table-main">
            <thead>
              <tr>
                <th></th>
                <th>资产编号</th>
                <th>软件种类</th>
                <th>软件名称</th>
                <th class="am-hide-sm-only">开发商</th>
                <th class="am-hide-sm-only">硬件平台</th>
                <th class="am-hide-sm-only">机密性</th>
                <th class="am-hide-sm-only">完整性</th>
                <th class="am-hide-sm-only">可用性</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    if (isset($software) && !empty($software)) {
                        $i = isset($pageNo) ? ($pageNo - 1) * 10 : 0;
                        foreach ($software as $s) {
                            $i++;
                            echo '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.$s['assetid'].'</td>
                                    <td>'.$s['softtype'].'</td>
                                    <td>'.$s['name'].'</td>
                                    <td class="am-hide-sm-only">'.$s['developer'].'</td>
                                    <td class="am-hide-sm-only">'.$s['hard'].'</td>
                                    <td class="am-hide-sm-only">'.$s['Cgrade'].'</td>
                                    <td class="am-hide-sm-only">'.$s['Igrade'].'</td>
                                    <td class="am-hide-sm-only">'.$s['Agrade'].'</td>
                                    <td>
                                      <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                          <button class="am-btn am-btn-default am-btn-xs am-text-warning" onclick="detail('.$s['id'].')">
                                            <span class="am-icon-file-text-o"></span> 详情
                                          </button>
                                          <button class="am-btn am-btn-default am-btn-xs am-text-secondary" onclick="edit('.$s['id'].')">
                                            <span class="am-icon-pencil-square-o"></span> 编辑
                                          </button>
                                          <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onclick="del('.$s['id'].')">
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
                        echo '<li><a href="/sur/software?pageNo=1&st='.$st.'">&laquo;</a></li>';
                    }
                    else {
                        echo '<li class="am-disabled"><a href="/sur/software?pageNo=1&st='.$st.'">&laquo;</a></li>';
                    }
                    $startNo = ($pageNo - 2) >= 1 ? ($pageNo - 2) : 1;
                    $endNo = ($pageNo + 2) <= $allPage ? ($pageNo + 2) : $allPage;
                    for ($i = $startNo; $i <= $endNo; $i++) {
                        if ($i == $pageNo) {
                            echo '<li class="am-active"><a href="/sur/software?pageNo='.$i.'&st='.$st.'">'.$i.'</a></li>';
                        }
                        else {
                            echo '<li><a href="/sur/software?pageNo='.$i.'&st='.$st.'">'.$i.'</a></li>';
                        }
                    }
                    if ($pageNo != $allPage) {
                        echo '<li><a href="/sur/software?pageNo='.$allPage.'&st='.$st.'">&raquo;</a></li>';
                    }
                    else {
                        echo '<li class="am-disabled"><a href="/sur/software?pageNo='.$allPage.'&st='.$st.'">&raquo;</a></li>';
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

<!--soft modal-->
<div class="am-modal am-modal-prompt" id="soft-modal">
  <div class="am-modal-dialog">
    <div id="modal-title" class="am-modal-hd"></div>
    <div class="am-modal-bd">
      <!--softtype-->
      <div class="am-btn-group doc-js-btn-1" data-am-button>
        <label class="am-btn am-btn-default am-active">
          <input type="radio" name="softtype" value="1" id="softtype1" checked="checked">系统软件
        </label>
        <label class="am-btn am-btn-default">
          <input type="radio" name="softtype" value="2" id="softtype2">应用软件
        </label>
      </div>
      <!--softtype end-->
      <!--assetid-->
      <div class="am-g am-margin-top">
        <div class="am-u-sm-12 am-u-md-12 am-u-sm-centered">
          <input id="assetid" name="assetid" type="text" maxlength="20" class="am-form-field am-modal-prompt-input" placeholder="请输入编号...">
          <input id="name" name="name" type="text" maxlength="20" class="am-form-field am-modal-prompt-input" placeholder="请输入名称...">
          <input id="version" name="version" type="text" maxlength="20" class="am-form-field am-modal-prompt-input" placeholder="请输入版本...">
          <input id="developer" name="developer" type="text" maxlength="20" class="am-form-field am-modal-prompt-input" placeholder="请输入开发商...">
          <input id="app" name="app" type="text" maxlength="20" class="am-form-field am-modal-prompt-input" placeholder="请输入涉及应用系统...">
          <input id="hard" name="hard" type="text" maxlength="20" class="am-form-field am-modal-prompt-input" placeholder="请输入涉及硬件平台...">
          <input id="soft" name="soft" type="text" maxlength="20" class="am-form-field am-modal-prompt-input" placeholder="请输入涉及软件平台...">
          <input id="datas" name="datas" type="text" maxlength="20" class="am-form-field am-modal-prompt-input" placeholder="请输入涉及数据...">
          <input id="userNum" name="userNum" type="text" maxlength="20" class="am-form-field am-modal-prompt-input" placeholder="请输入现用用户数量...">
          <input id="userRole" name="userRole" type="text" maxlength="20" class="am-form-field am-modal-prompt-input" placeholder="请输入主要用户角色...">
        </div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-4 am-text-centered">模式：</div>
        <div class="am-u-sm-2 am-u-md-2 am-text-left">
          <label id="model">B/S</label>
        </div>
        <div class="am-u-sm-6 am-u-md-6 am-text-left">
          <div class="am-btn-group am-btn-group-xs">
            <button type="button" onclick="change_model(1)" class="am-btn am-btn-primary am-round">&nbsp;&nbsp;B/S模式&nbsp;&nbsp;</button>
            <button type="button" onclick="change_model(2)" class="am-btn am-btn-danger am-round">&nbsp;&nbsp;C/S模式&nbsp;&nbsp;</button>
          </div>
        </div>
      </div>
      <!--assetid end default-->
      <div class="am-btn-group doc-js-btn-1" data-am-button>
        <select id="Cgrade" name="Cgrade" data-am-selected="{btnWidth: 150, btnSize: 'sm', dropUp: 1}">
            <option value="1">机密性:1</option>
            <option value="2">机密性:2</option>
            <option value="3">机密性:3</option>
            <option value="4">机密性:4</option>
            <option value="5">机密性:5</option>
          </select>
          <select id="Igrade" name="Igrade" data-am-selected="{btnWidth: 150, btnSize: 'sm', dropUp: 1}">
            <option value="1">完整性:1</option>
            <option value="2">完整性:2</option>
            <option value="3">完整性:3</option>
            <option value="4">完整性:4</option>
            <option value="5">完整性:5</option>
          </select>
          <select id="Agrade" name="Agrade" data-am-selected="{btnWidth: 150, btnSize: 'sm', dropUp: 1}">
            <option value="1">可用性:1</option>
            <option value="2">可用性:2</option>
            <option value="3">可用性:3</option>
            <option value="4">可用性:4</option>
            <option value="5">可用性:5</option>
          </select>
      </div>
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>提交</span>
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<!--soft modal end-->

<!--delete soft modal-->
<div class="am-modal am-modal-prompt" id="del-soft-modal">
  <div class="am-modal-dialog">
    <div id="del-modal-title" class="am-modal-hd">删除资产</div>
      <div class="am-modal-bd">
        是否确定删除该软件资产所有信息？
      </div>
      <div class="am-modal-footer">
        <span class="am-modal-btn" data-am-modal-confirm>确定</span>
        <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<!--delete soft modal end-->

<!--detail modal-->
<div class="am-modal am-modal-prompt" id="detail-modal">
  <div class="am-modal-dialog">
    <div id="del-modal-title" class="am-modal-hd">软件详细信息</div>
    <div class="am-modal-bd">
      <div class="am-g am-margin-top">
        <div class="am-u-sm-5 am-u-md-5 am-text-right">
          <strong>资产编号</strong>
          <br/>
          <strong>软件种类</strong>
          <br/>
          <strong>软件名称</strong>
          <br/>
          <strong>版本</strong>
          <br/>
          <strong>开发商</strong>
          <br/>
          <strong>硬件平台</strong>
          <br/>
          <strong>软件平台</strong>
          <br/>
          <strong>涉及应用系统</strong>
          <br/>
          <strong>模式</strong>
          <br/>
          <strong>涉及数据</strong>
          <br/>
          <strong>现用用户数量</strong>
          <br/>
          <strong>主要用户角色</strong>
          <br/>
          <strong>机密性</strong>
          <br/>
          <strong>完整性</strong>
          <br/>
          <strong>可用性</strong>
          <br/>
        </div>
        <div class="am-u-sm-5 am-u-md-5 am-text-left">
          <div id="detail-assetid">资产编号</div>
          <div id="detail-softtype">软件种类</div>
          <div id="detail-name">软件名称</div>
          <div id="detail-version">版本</div>
          <div id="detail-developer">开发商</div>
          <div id="detail-hard">硬件平台</div>
          <div id="detail-soft">软件平台</div>
          <div id="detail-app">涉及应用系统</div>
          <div id="detail-model">模式</div>
          <div id="detail-datas">涉及数据</div>
          <div id="detail-userNum">现用用户数量</div>
          <div id="detail-userRole">主要用户角色</div>
          <div id="detail-Cgrade">机密性</div>
          <div id="detail-Igrade">完整性</div>
          <div id="detail-Agrade">可用性</div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--detail modal end-->

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
    $('#modal-title').text('新增资产');
    set_soft_data();
    $('#soft-modal').modal({
        relatedTarget: this,
        onConfirm: function() {
            return add_soft();
        },
        onCancel: function() {}
    });
}

function del (id) {
    $('#del-soft-modal').modal({
        relatedTarget: this,
        onConfirm: function() {
            return del_soft(id);
        },
        onCancel: function() {}
    });
}

function edit (id) {
    $('#modal-title').text('编辑资产');
    var mydata = {};
    mydata['softid'] = id;
    my_ajax('/sur/software/get', 'get', mydata, function (soft) {
        return set_soft_data(soft.assetid, soft.name, soft.version, soft.developer, soft.hard, soft.soft, soft.app, soft.datas, soft.userNum, soft.userRole, soft.model, soft.Cgrade, soft.Igrade, soft.Agrade);
    });

    $('#soft-modal').modal({
        relatedTarget: this,
        onConfirm: function () {
            return edit_soft(id);
        },
        onCancel: function () {
        }
    });
}

function detail (id) {
    var mydata = {};
    mydata['softid'] = id;
    my_ajax('/sur/software/get', 'get', mydata, function (soft) {
        return set_detail_data(soft.assetid, soft.softtype, soft.name, soft.version, soft.developer, soft.hard, soft.soft, soft.app, soft.datas, soft.userNum, soft.userRole, soft.model, soft.Cgrade, soft.Igrade, soft.Agrade);
    });
    $('#detail-modal').modal({
        relatedTarget: this
    })
}

function add_soft () {
    var params = get_soft_data();
    params['editType'] = 'add';
    return submit_form('/sur/software', 'post', params);
}

function edit_soft (id) {
    var params = get_soft_data();
    params['editType'] = 'edit';
    params['softid'] = id;
    return submit_form('/sur/software', 'post', params);
}

function del_soft (id) {
    var params = {};
    params['editType'] = 'del';
    params['softid'] = id;
    return submit_form('/sur/software', 'post', params);
}

function get_soft_data () {
    var res = {};
    res['softtype'] = $("input[name='softtype']:checked").val();
    res['assetid'] = $('#assetid').val();
    res['name'] = $('#name').val();
    res['version'] = $('#version').val();
    res['developer'] = $('#developer').val();
    res['hard'] = $('#hard').val();
    res['soft'] = $('#soft').val();
    res['app'] = $('#app').val();
    res['datas'] = $('#datas').val();
    res['userNum'] = $('#userNum').val();
    res['userRole'] = $('#userRole').val();
    if ($('#model').text() == 'B/S') {
        res['model'] = 1;
    }
    else {
        res['model'] = 2;
    }
    res['Cgrade'] = $('#Cgrade').val();
    res['Igrade'] = $('#Igrade').val();
    res['Agrade'] = $('#Agrade').val();
    return res;
}

function set_soft_data (assetid, name, version, developer, hard, soft, app, datas, userNum, userRole, model, Cgrade, Igrade, Agrade) {
    var assetid = assetid || '';
    $('#assetid').val(assetid);

    var name = name || '';
    $('#name').val(name);

    var version = version || '';
    $('#version').val(version);

    var developer = developer || '';
    $('#developer').val(developer);

    var hard = hard || '';
    $('#hard').val(hard);

    var soft = soft || '';
    $('#soft').val(soft);

    var app = app || '';
    $('#app').val(app);

    var datas = datas || '';
    $('#datas').val(datas);

    var userNum = userNum || '';
    $('#userNum').val(userNum);

    var userRole = userRole || '';
    $('#userRole').val(userRole);

    var model = model || 1;
    change_model(model);
}

function set_detail_data (assetid, softtype, name, version, developer, hard, soft, app, datas, userNum, userRole, modelid, Cgrade, Igrade, Agrade) {
    var assetid = assetid || '';
    $('#detail-assetid').text(assetid);

    var softtype = softtype || 'error!';
    $('#detail-softtype').text(softtype);

    var name = name || '';
    $('#detail-name').text(name);

    var version = version || '';
    $('#detail-version').text(version);

    var developer = developer || '';
    $('#detail-developer').text(developer);

    var hard = hard || '';
    $('#detail-hard').text(hard);

    var soft = soft || '';
    $('#detail-soft').text(soft);

    var app = app || '';
    $('#detail-app').text(app);

    var datas = datas || '';
    $('#detail-datas').text(datas);

    var userNum = userNum || '';
    $('#detail-userNum').text(userNum);

    var userRole = userRole || '';
    $('#detail-userRole').text(userRole);

    var model = 'error!';
    if (modelid == '1') {
        model = 'B/S';
    }
    else {
        model = 'C/S';
    }
    $('#detail-model').text(model);

    var Cgrade = Cgrade || '';
    $('#detail-Cgrade').text(Cgrade);

    var Igrade = Igrade || '';
    $('#detail-Igrade').text(Igrade);

    var Agrade = Agrade || '';
    $('#detail-Agrade').text(Agrade);
}

function change_model (modelid) {
    modelid = parseInt(modelid);
    switch (modelid) {
        case 1: {
            $('#model').text('B/S');
            break;
        }
        case 2: {
            $('#model').text('C/S');
            break;
        }
        default: {
            alert(typeof(modelid));
        }
    }
}
</script>
</body>
</html>