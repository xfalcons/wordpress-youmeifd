<?php
global $admin_options;$style = $admin_options['style'] ? $admin_options['style'] : 'green';
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php wp_title('',true); ?></title>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/<?php echo $style; ?>-style.css">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">
<?php wp_head(); ?>
<script>
var _options_ = {
  'template_url' : '<?php echo get_template_directory_uri(); ?>', // 模板文件夹的访问路径
  'real_current_page' : <?php echo (get_query_var("paged") ? get_query_var("paged") : 1); ?>, // 当前的页码，用在翻页中
  'pagenavi_num' : <?php echo (int)$admin_options['pagenavi']; ?>, // 翻页的加载数量
  'response_screen_width' : <?php echo (int)$admin_options['response_screen_width']; ?>, // 有些屏幕比较窄，适当调整
  'response_pad_width' : <?php echo (int)$admin_options['response_pad_width']; ?>, // 响应式平板屏幕宽度
  'response_phone_width' : <?php echo (int)$admin_options['response_phone_width']; ?>, // 响应式手机屏幕宽度
  'img_lazyload' : <?php echo (int)$admin_options['img_lazyload']; ?>, // 图片延时加载
  'style_color' : '<?php echo $style; ?>' // 基调颜色
};
var window_width = window.innerWidth || document.documentElement.clientWidth || document.body.offsetWidth;
// 响应式样式
document.write('<link id="response-style-link" rel="stylesheet"');
if(window_width <= _options_.response_screen_width)document.write(' href="<?php echo get_template_directory_uri(); ?>/css/' + _options_.style_color + '-');
if(window_width <= _options_.response_phone_width)document.write('phone.css"');
else if(window_width <= _options_.response_pad_width)document.write('pad.css"');
else if(window_width <= _options_.response_screen_width)document.write('screen.css"');
document.write('>');
</script>
</head>

<body <?php body_class($admin_options['mode'] < 2 ? 'admin-options-mode-signle' : ''); ?>>
<div id="top-area"><div class="container">
  <<?php if(is_home())echo 'h1';else echo 'div'; ?> id="logo">
    <?php
    $logo = $admin_options['logo'];
    $blog_name = get_bloginfo('name');
    $blog_url = get_bloginfo('url');
    if($logo)echo '<a href="'.$blog_url.'" class="img" title="'.$blog_name.' HOME"><img src="'.$logo.'" alt="'.$blog_name.'"></a>';
    else echo '<a href="'.$blog_url.'" class="text">'.$blog_name.'</a>';
    ?>
  </<?php if(is_home())echo 'h1';else echo 'div'; ?>>
  <div id="menu">
    <?php 
    $defaults = array(
      'theme_location'  => 'primary',
      'depth'           => 2,
      'container'       => false,
      'items_wrap'      => '%3$s',
      'echo'            => 0
    );
    $menu = wp_nav_menu($defaults);
    $menu = str_replace('<li','<span',$menu);
    $menu = str_replace('</li>','</span>',$menu);
    $menu = str_replace('<ul','<div',$menu);
    $menu = str_replace('</ul>','</div>',$menu);
    echo $menu;
    ?>
  </div>
  <?php if($admin_options['mode'] >= 2) { ?>
  <div id="user-area">
    <?php if(is_user_logged_in()):global $current_user;get_currentuserinfo(); ?>
    <ul class="current-user-area">
      <li class="user-name" title="<?php echo $current_user->display_name; ?>"><?php echo get_avatar($current_user->ID,'16'); ?><?php echo $current_user->display_name; ?></li>
      <li class="drop-menu admin-btn"><a href="<?php echo get_permalink($admin_options['page_for_usercenter']); ?>">个人管理</a></li>
      <li class="drop-menu logout-btn"><a href="<?php echo wp_logout_url($_SERVER["REQUEST_URI"]); ?>">退出</a></li>
    </ul>
    <?php else : ?>
    <span class="register"><a href="<?php echo wp_login_url(); ?>?action=register">注册</a></span>
    <span>|</span>
    <span class="login"><a href="<?php echo wp_login_url($_SERVER["REQUEST_URI"]); ?>">登录</a></span>
    <?php endif; ?>
  </div>
  <?php } ?>
  <div id="search-area">
    <form action="<?php bloginfo('url'); ?>" method="get">
      <input type="text" name="s" value="输入关键字..." onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">
      <button type="submit">&nbsp;</button>
      <div class="clear"></div>
    </form>
  </div>
  <div id="social-btns">
    <?php
    $socials = function_exists('array_admin_options') ? array_admin_options($admin_options['social']) : '';
    if(@$socials['微博'])echo '<a href="javascript:void(0)" onclick="window.open(\''.$socials['微博'].'\');" target="_blank" class="weibo"></a>';
    if(@$socials['微信'])echo '<a href="javascript:void(0)" onclick="window.open(\''.$socials['微信'].'\');" target="_blank" class="weixin"></a>';
    if(@$socials['facebook'])echo '<a href="javascript:void(0)" onclick="window.open(\''.$socials['facebook'].'\');" target="_blank" class="facebook"></a>';
    if(@$socials['twitter'])echo '<a href="javascript:void(0)" onclick="window.open(\''.$socials['twitter'].'\');" target="_blank" class="twitter"></a>';
    ?>
  </div>
  <div class="clear"></div>
</div></div>
<img src="<?php echo get_template_directory_uri(); ?>/images/icons.png" style="position:absolute;top:-1000px;height:1px;width:1px;"><!-- 为了让各类icon早一点加载 -->
