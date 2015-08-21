<?php
global $admin_options;
$flash_list = $admin_options['flash'];
$img_list = '';
if(!empty($flash_list) && is_home() && !is_paged()) : ?>
<div id="slider">
<?php foreach($flash_list as $flash){
  $img_src = trim($flash[0]);
  if($img_src == '')continue;
  $flash_link = trim($flash[1]);
  $flash_code = stripslashes($flash[2]);
  echo '<div class="slider" data-lazy-background="'.$img_src.'">';
  echo $flash_code;
  if($flash_link)echo '<a href="'.$flash_link.'"></a>';
  echo '</div>';
  $img_list .= '<img src="'.$img_src.'" style="position:absolute;top:-999999px;">';
}
?>
</div>
<?php endif;
echo $img_list.'<!--也是为了让幻灯更早加载-->';