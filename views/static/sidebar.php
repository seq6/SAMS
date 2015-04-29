<!--sidebar-->
<div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
  <div class="am-offcanvas-bar admin-offcanvas-bar">
    <!--list-->
    <ul class="am-list admin-sidebar-list">
      <!--project name-->
      <li>
        <a>
          <span class="am-icon-home"></span>
          <?php
            if (isset($_SESSION['project']['name']) && $_SESSION['project']['name'] != '') {
                echo $_SESSION['project']['name'];
            }
          ?>
        </a>
      </li>
      <!--project name end-->

      <!--project stage-->
      <li class="admin-parent">
        <a class="am-cf" data-am-collapse="{target: '#collapse-pre-nav'}"> 前期准备<span class="am-icon-angle-right am-fr am-margin-right"></span></a>
        <ul class="am-list am-collapse admin-sidebar-sub" id="collapse-pre-nav">
          <li>
            <a href="/pre/information">
              <?php
                $light = (isset($_SESSION['project']['info']) && $_SESSION['project']['info'] == 1) ? ' admin-icon-yellow' : '';
                echo '<span class="am-icon-check-circle'.$light.'"></span> 项目信息';
              ?>
            </a>
          </li>
          <li>
            <a href="/pre/member">
              <?php
                $light = (isset($_SESSION['project']['memberNum']) && $_SESSION['project']['memberNum'] != 0) ? ' admin-icon-yellow' : '';
                echo '<span class="am-icon-check-circle'.$light.'"></span> 项目人员';
              ?>
            </a>
          </li>
          <li>
            <a href="/pre/parts">
              <?php
                $light = (isset($_SESSION['project']['part']) && $_SESSION['project']['part'] == 1) ? ' admin-icon-yellow' : '';
                echo '<span class="am-icon-check-circle'.$light.'"></span> 评估双方';
              ?>
            </a>
          </li>
          <li>
            <a href="/pre/other">
              <span class="am-icon-check-circle admin-icon-yellow"></span> 其他任务
            </a>
          </li>
          <li>
            <a href="/pre/start">
              <?php
                $light = (isset($_SESSION['project']['status']) && $_SESSION['project']['status'] != 0) ? ' admin-icon-yellow' : '';
                echo '<span class="am-icon-check-circle'.$light.'"></span> 项目启动';
              ?>
            </a>
          </li>
        </ul>
      </li>
      <li class="admin-parent">
        <a class="am-cf" data-am-collapse="{target: '#collapse-sur-nav'}"> 系统调查<span class="am-icon-angle-right am-fr am-margin-right"></span></a>
        <ul class="am-list am-collapse admin-sidebar-sub" id="collapse-sur-nav">
          <li>
            <a href="/sur/hardware">
              <span class="am-icon-check-circle"></span> 硬件资源
            </a>
          </li>
          <li>
            <a href="/sur/software">
              <span class="am-icon-check-circle"></span> 软件资源
            </a>
          </li>
          <li>
            <a href="/sur/person">
              <span class="am-icon-check-circle"></span> 人员资源
            </a>
          </li>
          <li>
            <a href="/sur/document">
              <span class="am-icon-check-circle"></span> 数据文档
            </a>
          </li>
          <li>
            <a href="/sur/sever">
              <span class="am-icon-check-circle"></span> 服务资产
            </a>
          </li>
          <li>
            <a href="/sur/elses">
              <span class="am-icon-check-circle"></span> 其他资产
            </a>
          </li>
        </ul>
      </li>
      <li class="admin-parent">
        <a class="am-cf"> 脆弱性调查</a>
      </li>
      <li class="admin-parent">
        <a class="am-cf"> 威胁分析</a>
      </li>
      <li class="admin-parent">
        <a class="am-cf"> 风险分析</a>
      </li>
      <!--project stage end-->
    </ul>
    <!--list end-->

    <!--tag-->
    <div class="am-panel am-panel-default admin-sidebar-panel">
      <?php
        if (isset($tag) && !empty($tag)) {
            echo '<div class="am-panel-bd"><p><span class="am-icon-tag"></span> '.$tag['title'].'</p>'.$tag['content'].'</div>';
        }
      ?>
    </div>
    <!--tag end-->
  </div>
</div>
<!--sidebar end-->

<a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>
