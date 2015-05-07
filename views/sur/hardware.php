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
    <!--titile-->
    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">硬件资源</strong> / <small>hardware</small></div>
    </div>
    <hr/>
    <!--titile end-->

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
        if ($ht == 0) {
            echo '<label>全部</label>';
        }
        else {
            echo '<a href="/sur/hardware">全部</a>';
        }

        if (isset($hardtype) && !empty($hardtype)) {
            foreach ($hardtype as $h) {
                echo '<small> | </small>';
                if ($h['id'] == $ht) {
                    echo '<label>'.$h['name'].'</label>';
                }
                else {
                    echo '<a href="/sur/hardware?ht='.$h['id'].'">'.$h['name'].'</a>';
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
                <th>硬件种类</th>
                <th>设备名称</th>
                <th class="am-hide-sm-only">型号</th>
                <th class="am-hide-sm-only">物理位置</th>
                <th class="am-hide-sm-only">机密性</th>
                <th class="am-hide-sm-only">完整性</th>
                <th class="am-hide-sm-only">可用性</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    if (isset($hardware) && !empty($hardware)) {
                        $i = isset($pageNo) ? ($pageNo - 1) * 10 : 0;
                        foreach ($hardware as $h) {
                            $i++;
                            echo '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.$h['assetid'].'</td>
                                    <td>'.$h['hardtype'].'</td>
                                    <td>'.$h['name'].'</td>
                                    <td class="am-hide-sm-only">'.$h['model'].'</td>
                                    <td class="am-hide-sm-only">'.$h['place'].'</td>
                                    <td class="am-hide-sm-only">'.$h['Cgrade'].'</td>
                                    <td class="am-hide-sm-only">'.$h['Igrade'].'</td>
                                    <td class="am-hide-sm-only">'.$h['Agrade'].'</td>
                                    <td>
                                      <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                          <button class="am-btn am-btn-default am-btn-xs am-text-warning" onclick="detail('.$h['id'].')">
                                            <span class="am-icon-file-text-o"></span> 详情
                                          </button>
                                          <button class="am-btn am-btn-default am-btn-xs am-text-secondary" onclick="edit('.$h['id'].')">
                                            <span class="am-icon-pencil-square-o"></span> 编辑
                                          </button>
                                          <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onclick="del('.$h['id'].')">
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
                        echo '<li><a href="/sur/hardware?pageNo=1&st='.$st.'">&laquo;</a></li>';
                    }
                    else {
                        echo '<li class="am-disabled"><a href="/sur/hardware?pageNo=1&st='.$st.'">&laquo;</a></li>';
                    }
                    $startNo = ($pageNo - 2) >= 1 ? ($pageNo - 2) : 1;
                    $endNo = ($pageNo + 2) <= $allPage ? ($pageNo + 2) : $allPage;
                    for ($i = $startNo; $i <= $endNo; $i++) {
                        if ($i == $pageNo) {
                            echo '<li class="am-active"><a href="/sur/hardware?pageNo='.$i.'&st='.$st.'">'.$i.'</a></li>';
                        }
                        else {
                            echo '<li><a href="/sur/hardware?pageNo='.$i.'&st='.$st.'">'.$i.'</a></li>';
                        }
                    }
                    if ($pageNo != $allPage) {
                        echo '<li><a href="/sur/hardware?pageNo='.$allPage.'&st='.$st.'">&raquo;</a></li>';
                    }
                    else {
                        echo '<li class="am-disabled"><a href="/sur/hardware?pageNo='.$allPage.'&st='.$st.'">&raquo;</a></li>';
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

<!--hard modal-->
<div class="am-modal am-modal-prompt" id="hard-modal">
  <div class="am-modal-dialog">
    <div id="modal-title" class="am-modal-hd"></div>
    <div class="am-modal-bd">
      <!--hardtype-->
      <div class="am-btn-group doc-js-btn-1" data-am-button>
      <?php
        if (isset($hardtype) && !empty($hardtype)) {
            $i = 1;
            foreach ($hardtype as $h) {
                if ($i == 1) {
                    echo '<label class="am-btn am-btn-default am-active">
                            <input type="radio" name="hardtype" value="'.$h['id'].'" checked="checked">'.$h['name'].'
                          </label>';
                }
                else {
                    echo '<label class="am-btn am-btn-default">
                            <input type="radio" name="hardtype" value="'.$h['id'].'">'.$h['name'].'
                          </label>';
                }
                $i++;
            }
        }
      ?>
      </div>
      <!--hardtype end-->
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
        是否确定删除该硬件资产所有信息？
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
    <div id="del-modal-title" class="am-modal-hd">硬件详细信息</div>
    <div class="am-modal-bd">
      <div class="am-g am-margin-top">
        <div class="am-u-sm-5 am-u-md-5 am-text-right">
          <strong>资产编号</strong>
          <br/>
          <strong>硬件种类</strong>
          <br/>
          <strong>硬件名称</strong>
          <br/>
          <strong>型号</strong>
          <br/>
          <strong>物理位置</strong>
          <br/>
          <strong>所属网络</strong>
          <br/>
          <strong>IP地址/掩码/网关</strong>
          <br/>
          <strong>系统</strong>
          <br/>
          <strong>系统软件</strong>
          <br/>
          <strong>端口类型/数量</strong>
          <br/>
          <strong>主要用途</strong>
          <br/>
          <strong>涉及数据</strong>
          <br/>
          <strong>是否热备</strong>
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
          <div id="detail-hardtype">硬件种类</div>
          <div id="detail-name">硬件名称</div>
          <div id="detail-model">型号</div>
          <div id="detail-place">物理位置</div>
          <div id="detail-net">所属网络</div>
          <div id="detail-ipmagw">IP地址/掩码/网关</div>
          <div id="detail-os">系统</div>
          <div id="detail-osSoft">系统软件</div>
          <div id="detail-port">端口类型/数量</div>
          <div id="detail-main">主要用途</div>
          <div id="detail-datas">涉及数据</div>
          <div id="detail-ha">是否热备</div>
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
    set_hard_data();
    $('#hard-modal').modal({
        relatedTarget: this,
        onConfirm: function() {
            return add_hard();
        },
        onCancel: function() {}
    });
}

function del (id) {
    $('#del-hard-modal').modal({
        relatedTarget: this,
        onConfirm: function() {
            return del_hard(id);
        },
        onCancel: function() {}
    });
}

function edit (id) {
    $('#modal-title').text('编辑资产');
    var mydata = {};
    mydata['hardid'] = id;
    my_ajax('/sur/hardware/get', 'get', mydata, function (hard) {
        return set_hard_data();
    });

    $('#hard-modal').modal({
        relatedTarget: this,
        onConfirm: function () {
            return edit_hard(id);
        },
        onCancel: function () {
        }
    });
}

function detail (id) {
    var mydata = {};
    mydata['hardid'] = id;
    my_ajax('/sur/hardware/get', 'get', mydata, function (hard) {
        return set_detail_data();
    });
    $('#detail-modal').modal({
        relatedTarget: this
    })
}

function add_hard () {
    var params = get_hard_data();
    params['editType'] = 'add';
    return submit_form('/sur/hardware', 'post', params);
}

function edit_hard (id) {
    var params = get_hard_data();
    params['editType'] = 'edit';
    params['hardid'] = id;
    return submit_form('/sur/hardware', 'post', params);
}

function del_hard (id) {
    var params = {};
    params['editType'] = 'del';
    params['hardid'] = id;
    return submit_form('/sur/hardware', 'post', params);
}

function get_soft_data () {
    var res = {};
    res['hardtype'] = $("input[name='hardtype']:checked").val();
    res['assetid'] = $('#assetid').val();
    res['name'] = $('#name').val();
    return res;
}

function set_hard_data (assetid, name, Cgrade, Igrade, Agrade) {
    var assetid = assetid || '';
    $('#assetid').val(assetid);

    var name = name || '';
    $('#name').val(name);
}

function set_detail_data (assetid, hardtype, name, Cgrade, Igrade, Agrade) {
    var assetid = assetid || '';
    $('#detail-assetid').text(assetid);

    var hardtype = hardtype || 'error!';
    $('#detail-hardtype').text(hardtype);

    var name = name || '';
    $('#detail-name').text(name);

    var Cgrade = Cgrade || '';
    $('#detail-Cgrade').text(Cgrade);

    var Igrade = Igrade || '';
    $('#detail-Igrade').text(Igrade);

    var Agrade = Agrade || '';
    $('#detail-Agrade').text(Agrade);
}

</script>
</body>
</html>