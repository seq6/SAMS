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
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">服务资产</strong> / <small>sever</small></div>
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
          <button type="button" class="am-btn am-btn-primary" id="add-sever" onclick="add()">
            <span class="am-icon-plus"></span> 新增
          </button>
        </div>
      </div>
      <div class="am-u-sm-6 am-u-md-6">
        <?php
        if ($st == 0) {
            echo '<label>全部</label>';
        }
        else {
            echo '<a href="/sur/sever">全部</a>';
        }

        if (isset($severtype) && !empty($severtype)) {
            foreach ($severtype as $s) {
                echo '<small> | <small>';
                if ($s['id'] == $st) {
                    echo '<label>'.$s['name'].'</label>';
                }
                else {
                    echo '<a href="/sur/sever?st='.$s['id'].'">'.$s['name'].'</a>';
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
                <th>服务种类</th>
                <th>服务名称</th>
                <th class="am-hide-sm-only">服务单位</th>
                <th class="am-hide-sm-only">机密性</th>
                <th class="am-hide-sm-only">完整性</th>
                <th class="am-hide-sm-only">可用性</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    if (isset($sever) && !empty($sever)) {
                        $i = isset($pageNo) ? ($pageNo - 1) * 10 : 0;
                        foreach ($sever as $s) {
                            $i++;
                            echo '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.$s['assetid'].'</td>
                                    <td>'.$severtype[$s['kid']].'</td>
                                    <td>'.$s['name'].'</td>
                                    <td class="am-hide-sm-only">'.$s['unit'].'</td>
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
                        echo '<li><a href="/sur/sever?pageNo=1&st='.$st.'">&laquo;</a></li>';
                    }
                    else {
                        echo '<li class="am-disabled"><a href="/sur/sever?pageNo=1&st='.$st.'">&laquo;</a></li>';
                    }
                    $startNo = ($pageNo - 2) >= 1 ? ($pageNo - 2) : 1;
                    $endNo = ($pageNo + 2) <= $allPage ? ($pageNo + 2) : $allPage;
                    for ($i = $startNo; $i <= $endNo; $i++) {
                        if ($i == $pageNo) {
                            echo '<li class="am-active"><a href="/sur/sever?pageNo='.$i.'&st='.$st.'">'.$i.'</a></li>';
                        }
                        else {
                            echo '<li><a href="/sur/sever?pageNo='.$i.'&st='.$st.'">'.$i.'</a></li>';
                        }
                    }
                    if ($pageNo != $allPage) {
                        echo '<li><a href="/sur/sever?pageNo='.$allPage.'&st='.$st.'">&raquo;</a></li>';
                    }
                    else {
                        echo '<li class="am-disabled"><a href="/sur/sever?pageNo='.$allPage.'&st='.$st.'">&raquo;</a></li>';
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

<!--sever modal-->
<div class="am-modal am-modal-prompt" id="sever-modal">
  <div class="am-modal-dialog">
    <div id="modal-title" class="am-modal-hd"></div>
    <div class="am-modal-bd">
      <!--severtype-->
      <div class="am-btn-group doc-js-btn-1" data-am-button>
        <label class="am-btn am-btn-default am-active">
          <input type="radio" name="severtype" value="1" id="severtype1" checked="checked" onclick="change_type(1)">信息服务
        </label>
        <label class="am-btn am-btn-default">
          <input type="radio" name="severtype" value="2" id="severtype2" onclick="change_type(2)">网络服务
        </label>
        <label class="am-btn am-btn-default">
          <input type="radio" name="severtype" value="3" id="severtype3" onclick="change_type(3)">办公服务
        </label>
      </div>
      <!--severtype end-->
      <!--assetid-->
      <div id="modal-1" class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">资产编号</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="assetid" name="assetid" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <!--assetid end-->
      <!--model-->
      <div id="modal-2" class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">服务类型</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="model" name="model" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <!--model end-->
      <!--name-->
      <div id="modal-3" class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">服务名称</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="name" name="name" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <!--name end-->
      <!--unit-->
      <div id="modal-4" class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">服务单位</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="unit" name="unit" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <!--unit end-->
      <!--content-->
      <div id="modal-5" class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">服务内容</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="content" name="content" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <!--content end-->
      <!--way-->
      <div id="modal-6" class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">服务方式</div>
        <div class="am-u-sm-2 am-u-md-3">
            <label id="way">现场</label>
        </div>
        <div class="am-u-sm-6 am-u-md-6">
          <div class="am-btn-group am-btn-group-xs">
            <button type="button" onclick="change_way(1)" class="am-btn am-btn-primary am-round">现场</button>
            <button type="button" onclick="change_way(2)" class="am-btn am-btn-danger am-round">非现场</button>
          </div>
        </div>
      </div>
      <!--way end-->
      <!--device-->
      <div  id="modal-7" class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">涉及设备</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="device" name="device" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <!--device end-->
      <!--remarks-->
      <div id="modal-8" class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">备注</div>
        <div class="am-u-sm-8 am-u-md-9">
          <textarea id="remarks" name="remarks" rows="4" maxlength="255" class="am-form-field am-modal-prompt-input"></textarea>
        </div>
      </div>
      <!--remarks end-->
      <!--import-->
      <div id="modal-9" class="am-g am-margin-top">
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
      <!--import end-->
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>提交</span>
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<!--sever modal end-->

<!--delete sever modal-->
<div class="am-modal am-modal-prompt" id="del-sever-modal">
  <div class="am-modal-dialog">
    <div id="del-modal-title" class="am-modal-hd">删除资产</div>
      <div class="am-modal-bd">
        是否确定删除该服务资产所有信息？
      </div>
      <div class="am-modal-footer">
        <span class="am-modal-btn" data-am-modal-confirm>确定</span>
        <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<!--delete sever modal end-->

<!--detail modal-->
<div class="am-modal am-modal-prompt" id="detail-modal">
  <div class="am-modal-dialog">
    <div id="del-modal-title" class="am-modal-hd">服务详细信息</div>
    <div class="am-modal-bd">
      <div id="detail-1" class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>资产编号</label></div>
        <div id="detail-assetid" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div id="detail-2" class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>服务种类</label></div>
        <div id="detail-type" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div id="detail-3" class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>服务名称</label></div>
        <div id="detail-name" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div id="detail-4" class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>服务单位</label></div>
        <div id="detail-unit" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div id="detail-5" class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>服务内容</label></div>
        <div id="detail-content" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div id="detail-6" class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>服务方式</label></div>
        <div id="detail-way" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div id="detail-7" class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>涉及设备</label></div>
        <div id="detail-device" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div id="detail-8" class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>备注</label></div>
        <div id="detail-remarks" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div id="detail-9" class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>重要程度</label></div>
        <div id="detail-import" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div id="detail-10" class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>更新时间</label></div>
        <div id="detail-updatetime" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
    </div>
  </div>
</div>
<!--detail modal end-->

<?php include_once 'app/views/static/footer.php'; ?>

<script type="text/javascript">

var st = <?php echo $st;?>;

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
    set_sever_data();
    $('#sever-modal').modal({
        relatedTarget: this,
        onConfirm: function() {
            return add_sever();
        },
        onCancel: function() {}
    });
}

function del (id) {
    $('#del-sever-modal').modal({
        relatedTarget: this,
        onConfirm: function() {
            return del_sever(id);
        },
        onCancel: function() {}
    });
}

function edit (id) {
    $('#modal-title').text('编辑资产');
    var mydata = {};
    mydata['severid'] = id;
    my_ajax('/sur/sever/get', 'get', mydata, function (sever) {
        return set_sever_data(sever.kid, sever.assetid, sever.name, sever.model, sever.unit, sever.content, sever.way, sever.device, sever.remarks, sever.import);
    });

    $('#sever-modal').modal({
        relatedTarget: this,
        onConfirm: function() {
            return edit_sever(id);
        },
        onCancel: function() {
        }
    });
}

function detail (id) {
    var mydata = {};
    mydata['severid'] = id;
    my_ajax('/sur/sever/get', 'get', mydata, function (sever) {
        $('#detail-assetid').text(sever.assetid);
        $('#detail-type').text(sever.kid);
        $('#detail-name').text(sever.name);
        $('#detail-unit').text(sever.unit);
        $('#detail-content').text(sever.content);
        $('#detail-way').text(sever.way);
        $('#detail-device').text(sever.device);
        $('#detail-remarks').text(sever.remarks);
        $('#detail-import').text(sever.import);
        $('#detail-updatetime').text(sever.updatetime);

        switch (sever.kid) {
            case 1: {
                $('#detail-6').show();
                $('#detail-7').hide();
                break;
            }
            case 2: {
                $('#detail-6').show();
                $('#detail-7').show();
                break;
            }
            case 3: {
                $('#detail-6').hide();
                $('#detail-7').hide();
                break;
            }
            default: {}
        }
    });

    $('#detail-modal').modal({
        relatedTarget: this,
    });
}

function add_sever () {
    var params = get_elses_data();
    params['editType'] = 'add';
    return submit_form('/sur/sever', 'post', params);
}

function edit_sever (id) {
    var params = get_sever_data();
    params['editType'] = 'edit';
    params['severid'] = id;
    return submit_form('/sur/sever', 'post', params);
}

function del_sever (id) {
    var params = {};
    params['editType'] = 'del';
    params['severid'] = id;
    return submit_form('/sur/sever', 'post', params);
}

function get_sever_data () {
    var res = {};
    res['severtype'] = $("input[name='severtype']:checked").val();
    res['assetid'] = $('#assetid').val();
    res['name'] = $('#name').val();
    res['model'] = $('#model').val();
    res['unit'] = $('#unit').val();
    res['content'] = $('#content').val();
    if ($('#way').text() == '现场') {
        res['way'] == 1;
    }
    else {
        res['way'] == 2;
    }
    res['device'] = $('#device').val();
    res['remarks'] = $('#remarks').val();
    res['import'] = $('#import').val();
    return res;
}

function set_sever_data (severtype, assetid, name, model, unit, content, way, device, remarks, import) {
    var assetid = assetid || '';
    $('#assetid').val(assetid);

    var name = name || '';
    $('#name').val(name);

    var model = model || '';
    $('#model').val(model);

    var unit = unit || '';
    $('#unit').val(unit);

    var content = content || '';
    $('#content').val(content);

    var way = way || 1;
    if (way == 1) {
        $('#way').text('现场');
    }
    else {
        $('#way').text('非现场');
    }

    var device = device || '';
    $('#device').val(device);

    var remarks = remarks || '';
    $('#remarks').val(remarks);
}

function change_type (id) {
    switch (id) {
        case 1: {
            $('#modal-6').show();
            $('#modal-7').hide();
            break;
        }
        case 2: {
            $('#modal-6').show();
            $('#modal-7').show();
            break;
        }
        case 3: {
            $('#modal-6').hide();
            $('#modal-7').hide();
            break;
        }
    }
}

function change_way (wayid) {
    if (wayid == 1) {
        $('#way').text('现场');
    }
    else if (wayid == 2) {
        $('#way').text('非现场');
    }
}
</script>
</body>
</html>