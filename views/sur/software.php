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
                                    <td>'.$s['name'].'</td>
                                    <td class="am-hide-sm-only">'.$s['developer'].'</td>
                                    <td class="am-hide-sm-only">'.$s['hard'].'</td>
                                    <td class="am-hide-sm-only">'.$s['depart'].'</td>
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
        <div class="am-u-sm-4 am-u-md-3 am-text-right">资产编号</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="assetid" name="assetid" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <!--assetid end-->
      <!--name-->
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">软件名称</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="name" name="name" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <!--name end-->
      <!--version-->
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">版本</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="version" name="version" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <!--version end-->
      <!--developer-->
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">开发商</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="developer" name="developer" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <!--developer end-->
      <!--app-->
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">涉及应用系统</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="app" name="app" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <!--app end-->
      <!--soft-->
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">软件平台</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="soft" name="soft" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <!--soft end-->
      <!--model-->
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">模式</div>
        <div class="am-u-sm-2 am-u-md-3">
            <label id="model" value="1">B/S</label>
        </div>
        <div class="am-u-sm-6 am-u-md-6">
          <div class="am-btn-group am-btn-group-xs">
            <button type="button" onclick="change_model(1)" class="am-btn am-btn-primary am-round">B/S模式</button>
            <button type="button" onclick="change_model(2)" class="am-btn am-btn-danger am-round">C/S模式</button>
          </div>
        </div>
      </div>
      <!--model end-->
      <!--datas-->
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">涉及数据</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="datas" name="datas" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <!--datas end-->
      <!--userNum-->
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">现用用户数量</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="userNum" name="userNum" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <!--userNum end-->
      <!--userRole-->
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">主要用户角色</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="userRole" name="userRole" type="text" maxlength="20" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <!--userRole end-->
      <!--Cgrade-->
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">机密性</div>
        <div class="am-u-sm-8 am-u-md-9">
          <select id="Cgrade" name="Cgrade" data-am-selected="{btnSize: 'sm', dropUp: 1}">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </div>
      </div>
      <!--Cgrade end-->
      <!--Igrade-->
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">完整性</div>
        <div class="am-u-sm-8 am-u-md-9">
          <select id="Igrade" name="Igrade" data-am-selected="{btnSize: 'sm', dropUp: 1}">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </div>
      </div>
      <!--Igrade end-->
      <!--Agrade-->
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">可用性</div>
        <div class="am-u-sm-8 am-u-md-9">
          <select id="Agrade" name="Agrade" data-am-selected="{btnSize: 'sm', dropUp: 1}">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </div>
      </div>
      <!--Agrade end-->
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
    <div id="del-modal-title" class="am-modal-hd">人员详细信息</div>
    <div class="am-modal-bd">
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>资产编号</label></div>
        <div id="detail-assetid" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>软件种类</label></div>
        <div id="detail-name" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>软件名称</label></div>
        <div id="detail-sex" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>版本</label></div>
        <div id="detail-version" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>开发商</label></div>
        <div id="detail-developer" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>硬件平台</label></div>
        <div id="detail-hard" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>软件平台</label></div>
        <div id="detail-soft" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>涉及应用系统</label></div>
        <div id="detail-app" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>模式</label></div>
        <div id="detail-model" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>涉及数据</label></div>
        <div id="detail-datas" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>现用用户数量</label></div>
        <div id="detail-userNum" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>主要用户角色</label></div>
        <div id="detail-userRole" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>机密性</label></div>
        <div id="detail-Cgrade" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>完整性</label></div>
        <div id="detail-Igrade" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-6"><label>可用性</label></div>
        <div id="detail-Agrade" class="am-u-sm-8 am-u-md-6 am-text-left"></div>
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
    //set_soft_data();
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
    mydata['elseid'] = id;
    my_ajax('/sur/elses/get', 'get', mydata, function (elses) {
        return set_elses_data(elses.assetid, elses.name, elses.theDesc, elses.lib, elses.import);
    });

    $('#elses-modal').modal({
        relatedTarget: this,
        onConfirm: function() {
            return edit_elses(id);
        },
        onCancel: function() {
        }
    });
}

function add_soft () {
    var params = get_elses_data();
    params['editType'] = 'add';
    return submit_form('/sur/elses', 'post', params);
}

function edit_soft (id) {
    var params = get_elses_data();
    params['editType'] = 'edit';
    params['elseid'] = id;
    return submit_form('/sur/elses', 'post', params);
}

function del_soft (id) {
    var params = {};
    params['editType'] = 'del';
    params['elseid'] = id;
    return submit_form('/sur/elses', 'post', params);
}

function get_elses_data () {
    var res = {};
    res['assetid'] = $('#assetid').val();
    res['name'] = $('#name').val();
    res['theDesc'] = $('#theDesc').val();
    res['lib'] = $('#lib').val();
    res['import'] = $('#import').val();
    return res;
}

function set_elses_data (assetid, name, desc, lib, dimport) {
    var assetid = assetid || '';
    $('#assetid').val(assetid);

    var name = name || '';
    $('#name').val(name);

    var theDesc = desc || '';
    $('#theDesc').val(theDesc);

    var lib = lib || '';
    $('#lib').val(lib);

    var theImport = dimport || 1;
    $('#import').val(theImport);
}

</script>
</body>
</html>