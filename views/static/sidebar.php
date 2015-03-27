<div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
  <div class="am-offcanvas-bar admin-offcanvas-bar">
    <ul class="am-list admin-sidebar-list">
      <li>
        <a href="admin-index.html">
          <span class="am-icon-home"></span>
          <?php
            if (isset($_SESSION['pName']) && $_SESSION['pName'] != '') {
                echo $_SESSION['pName'];
            }
          ?>
        </a>
      </li>
      <li class="admin-parent">
        <a class="am-cf" data-am-collapse="{target: '#collapse-pre-nav'}"> 前期准备<span class="am-icon-angle-right am-fr am-margin-right"></span></a>
        <ul class="am-list am-collapse admin-sidebar-sub" id="collapse-pre-nav">
          <li><a href="pre/introduction">项目简介</a></li>
          <li><a href="pre/information">项目信息</a></li>
          <li><a href="pre/member">项目人员</a></li>
          <li><a href="pre/parts">评估双方</a></li>
          <li><a href="pre/other">其他任务</a></li>
          <li><a href="pre/start">项目启动</a></li>
        </ul>
      </li>
      <li class="admin-parent">
        <a class="am-cf" data-am-collapse="{target: '#collapse-sur-nav'}"> 系统调查<span class="am-icon-angle-right am-fr am-margin-right"></span></a>
        <ul class="am-list am-collapse admin-sidebar-sub" id="collapse-sur-nav">
          <li><a href="sur/hardware">硬件资源</a></li>
          <li><a href="sur/software">软件资源</a></li>
          <li><a href="sur/person">人员资源</a></li>
          <li><a href="sur/environment">物理环境</a></li>
          <li><a href="sur/business">业务系统</a></li>
          <li><a href="sur/net">网络系统</a></li>
        </ul>
      </li>
      <li class="admin-parent">
        <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"> 脆弱性调查</a>
      </li>
      <li class="admin-parent">
        <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"> 威胁分析</a>
      </li>
      <li class="admin-parent">
        <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"> 风险分析</a>
      </li>
    </ul>

    <div class="am-panel am-panel-default admin-sidebar-panel">
      <div class="am-panel-bd">
        <?php 
          if (isset($tag['title']) && $tag['title'] != '') {
            echo '<p><span class="am-icon-tag"></span>'.$tag['title'].'</p>';
          }
          if (isset($tag['content']) && $tag['content'] != '') {
            echo $tag['content'];
          }
        ?>
      </div>
    </div>
  </div>
</div>
