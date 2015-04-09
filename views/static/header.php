<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，请升级浏览器以获得更好的体验！</p>
<![endif]-->

<!--header-->
<header class="am-topbar admin-header">
  <!--app name-->
  <div class="am-topbar-brand">
    <h1>
      <a href="/project"><small>安全风险评估管理系统</small></a>
      <span class="am-badge am-badge-danger">v0.16</span>
    </h1>
  </div>
  <!--app name end-->

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}">
    <span class="am-sr-only"> 导航切换</span>
    <span class="am-icon-bars"></span>
  </button>

  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

  <!--user-->
  <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
    <li><a href="/help"><span class="am-icon-puzzle-piece"></span> 帮助</a></li>
    <?php
      if (isset($_SESSION['login']['said']) && $_SESSION['login']['said'] == 'admin') {
          echo '<li><a href="/signup"><span class="am-icon-user-plus"></span> 注册</a></li>';
      }
    ?>
    <li><a href="/signout"><span class="am-icon-sign-out"></span> 注销</a></li>
  </ul>
  <!--user end-->
</header>
<!--head end-->
