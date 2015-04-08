<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，请升级浏览器以获得更好的体验！</p>
<![endif]-->

<header class="am-topbar admin-header">
  <div class="am-topbar-brand">
    <h1>
      <?php
        echo '<a href="'.URL_ROOT.'project"><small>安全风险评估管理系统</small></a>';
      ?>
      <span class="am-badge am-badge-danger">v0.16</span>
    </h1>
  </div>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}">
    <span class="am-sr-only"> 导航切换</span>
    <span class="am-icon-bars"></span>
  </button>

  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

  <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
    <?php
      echo '<li><a href="'.URL_ROOT.'help"><span class="am-icon-puzzle-piece"></span> 帮助</a></li>';
      if (isset($_SESSION['login']['said']) && $_SESSION['login']['said'] == 'admin') {
        echo '<li><a href="'.URL_ROOT.'signup"><span class="am-icon-user-plus"></span> 注册</a></li>';
      }
      echo '<li><a href="'.URL_ROOT.'signout"><span class="am-icon-sign-out"></span> 注销</a></li> ';
    ?>
  </ul>
</header>
