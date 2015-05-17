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
                <th></th>
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
                        $i = ($pageNo - 1) * 10;
                        foreach ($document as $d) {
                            $i++;
                            echo '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.$d['assetid'].'</td>
                                    <td class="am-hide-sm-only">'.$d['dType'].'</td>
                                    <td class="am-hide-sm-only">'.$d['name'].'</td>
                                    <td class="am-hide-sm-only">'.$d['theDesc'].'</td>
                                    <td class="am-hide-sm-only">'.$d['updatetime'].'</td>
                                    <td>'.$d['import'].'</td>
                                    <td>
                                      <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                          <button class="am-btn am-btn-default am-btn-xs am-text-secondary" onclick="edit('.$d['id'].')">
                                            <span class="am-icon-pencil-square-o"></span> 编辑
                                          </button>
                                          <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onclick="del('.$d['id'].')">
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

<!--document modal-->
<div class="am-modal am-modal-prompt" tabindex="-1" id="document-modal">
  <div class="am-modal-dialog">
    <div id="modal-title" class="am-modal-hd"></div>
    <div class="am-modal-bd">
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">资产编号</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="assetid" name="assetid" type="text" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">文档类别</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="dType" name="dType" type="text" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">文档名称</div>
        <div class="am-u-sm-8 am-u-md-9">
          <input id="name" name="name" type="text" class="am-form-field am-modal-prompt-input">
        </div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">文档描述</div>
        <div class="am-u-sm-8 am-u-md-9">
          <textarea id="theDesc" name="theDesc" rows="4" maxlength="255" class="am-form-field am-modal-prompt-input"></textarea>
        </div>
      </div>
      <div class="am-g am-margin-top">
        <div class="am-u-sm-4 am-u-md-3 am-text-right">重要程度</div>
        <div class="am-u-sm-8 am-u-md-9">
          <select id="import" name="import" data-am-selected="{btnSize: 'sm'}">
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
<!--document modal end-->

<!--delete document modal-->
<div class="am-modal am-modal-prompt" id="del-document-modal">
  <div class="am-modal-dialog">
    <div id="del-modal-title" class="am-modal-hd">删除文档</div>
      <div class="am-modal-bd">
        是否确定删除该文档所有信息？
      </div>
      <div class="am-modal-footer">
        <span class="am-modal-btn" data-am-modal-confirm>确定</span>
        <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<!--delete document modal end-->

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
    $('#modal-title').text('新增文档');
    set_document_data();
    $('#document-modal').modal({
        relatedTarget: this,
        onConfirm: function() {
            return add_document();
        },
        onCancel: function() {}
    });
}

function del (id) {
    $('#del-document-modal').modal({
        relatedTarget: this,
        onConfirm: function() {
            return del_document(id);
        },
        onCancel: function() {}
    });
}

function edit (id) {
    $('#modal-title').text('编辑文档');
    var mydata = {};
    mydata['domid'] = id;
    my_ajax('/sur/document/get', 'get', mydata, function (dom) {
        return set_document_data(dom.assetid, dom.dType, dom.name, dom.theDesc, dom.import);
    });

    $('#document-modal').modal({
        relatedTarget: this,
        onConfirm: function() {
            return edit_document(id);
        },
        onCancel: function() {
        }
    });
}

function add_document () {
    var params = get_document_data();
    if (params['assetid'] == '' || params['name'] == '') {
        return alert('资产编号与资产名称不能为空');
    }
    params['editType'] = 'add';
    return submit_form('/sur/document', 'post', params);
}

function edit_document (id) {
    var params = get_document_data();
    if (params['assetid'] == '' || params['name'] == '') {
        return alert('资产编号与资产名称不能为空');
    }
    params['editType'] = 'edit';
    params['domid'] = id;
    return submit_form('/sur/document', 'post', params);
}

function del_document (id) {
    var params = {};
    params['editType'] = 'del';
    params['domid'] = id;
    return submit_form('/sur/document', 'post', params);
}

function get_document_data () {
    var res = {};
    res['assetid'] = $('#assetid').val();
    res['dType'] = $('#dType').val();
    res['name'] = $('#name').val();
    res['theDesc'] = $('#theDesc').val();
    res['import'] = $('#import').val();
    return res;
}

function set_document_data (id, type, name, desc, dimport) {
    var did = id || '';
    $('#assetid').val(did);

    var dtype = type || '';
    $('#dType').val(dtype);

    var dname = name || '';
    $('#name').val(dname);

    var ddesc = desc || '';
    $('#theDesc').val(ddesc);

    var theImport = dimport || 1;
    $('#import').val(theImport);
}
</script>
</body>
</html>