<div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
  <div class="am-offcanvas-bar admin-offcanvas-bar">
    <!-- <ul class="am-nav"> -->
    <ul class="am-list admin-sidebar-list">
      <li class="am-nav-header">前期准备</li>
      <li><a href="pre_intro">项目简介</a></li>
      <li><a href="pre_info">项目信息</a></li>
      <li><a href="pre_menber">项目人员</a></li>
      <li><a href="pre_parts">评估双方</a></li>
      <li><a href="pre_other">其他任务</a></li>
      <li><a href="pre_start">项目启动</a></li>
      <li class="am-nav-header">系统调查</li>
      <li><a href="sur_hard">硬件资源</a></li>
      <li><a href="sur_soft">软件资源</a></li>
      <li><a href="sur_person">人员资源</a></li>
      <li><a href="sur_envir">物理环境</a></li>
      <li><a href="sur_busin">业务系统</a></li>
      <li><a href="sur_net">网络系统</a></li>
      <li class="am-nav-header">脆弱性调查</li>
      <li class="am-nav-header">威胁分析</li>
      <li class="am-nav-header">风险分析</li>
    </ul>

    <div class="am-panel am-panel-default admin-sidebar-panel">
      <div class="am-panel-bd">
        <p><span class="am-icon-tag"></span> <?php echo $data['tag']['title']; ?></p>
        <p><?php echo $data['tag']['content']; ?></p>
      </div>
    </div>
  </div>
</div>