<div id="footer"><div class="container">
  <div class="widget-box"><?php dynamic_sidebar('footer-1'); ?></div>
  <div class="widget-box author-avatar-list"><?php dynamic_sidebar('footer-2'); ?></div>
  <div class="widget-box friend-link-list" style="margin-right:0;"><?php dynamic_sidebar('footer-3');if(is_home() && !is_paged())dynamic_sidebar('footer-4'); ?></div>
  <div class="clear"></div>
  <div id="copyright"><?php global $admin_options;$copyright = do_shortcode(stripslashes($admin_options['copyright']));echo apply_filters('the_content',$copyright); ?></div>
  <div class="clear"></div>
</div></div>

<script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
<script id="load-page-scripts" src="<?php bloginfo('template_url'); ?>/js/javascript.js"></script>

<?php if(!is_user_logged_in() && $admin_options['mode'] > 0) : ?>
<?php get_template_part('templates/tpl-dialog-register'); ?>
<?php get_template_part('templates/tpl-dialog-login'); ?>
<script>
// 打开弹窗（暂时没有用到，如需通用，移到script中间去）
function open_dialog(dialog_id) {
  var $dialog = $(dialog_id),
      $dialog_bg = $dialog.children('.dialog-bg'),
      $dialog_content = $dialog.children('.dialog-content'),
      content_height = $dialog_content.outerHeight();
  $dialog_bg.fadeIn(500);
  $dialog_content.show().animate({top:'50%',marginTop:-(content_height/2),'opacity':1,'-moz-opacity':1},1000);
}
// 关闭弹出窗口（如需通用，移到$()中间去）
$('.dialog').on('click','.dialog-bg,.close',function(){
  var $dialog = $('.dialog:visible'),
      $dialog_bg = $dialog.children('.dialog-bg'),
      $dialog_content = $dialog.children('.dialog-content');
  $dialog_content.animate({top:0,marginTop:0,'opacity':0,'-moz-opacity':0},500,function(){
    $(this).hide();
  });
  $dialog_bg.fadeOut(500);
});
// 用户注册
$('#user-area').on('click','.register',function(e){
  e.preventDefault();
  var $dialog = $('#user-register-dialog'),
      $dialog_bg = $dialog.children('.dialog-bg'),
      $dialog_content = $dialog.children('.dialog-content'),
      content_height = $dialog_content.outerHeight();
  $dialog_bg.fadeIn(500);
  $dialog_content.show().animate({top:'50%',marginTop:-(content_height/2),'opacity':1,'-moz-opacity':1},1000);
});
$('#user-register-dialog form').on('submit',function(e){
  e.preventDefault();
  var $this = $(this),
      action = $this.attr('action'),
      $data = $this.serialize(),
      $warning = $this.find('.dialog-warning'),
      $text = $this.find('.dialog-text'),
      $btns = $this.find('.dialog-btns');
  $warning.html('正在注册...');
  $.ajax({
    url : action,
    data : $data,
    dataType : 'json',
    type : 'POST',
    timeout : 8000,
    success : function(result) {
      if(result == -1) {
        $warning.html('权限超时了，请刷新页面再注册。');
      }
      else if(result.error == 0) {
        var html = '<p class="dialog-success register-success">注册成功！现在用你的邮箱 ' + result.msg + ' 去<a href="javascript:void(0)" onclick="setTimeout(function(){$(\'#user-area .login\').trigger(\'click\');},1000);$(\'#user-register-dialog .dialog-close\').trigger(\'click\');">登录</a>吧。</p>';
        $btns.hide();
        $text.html(html);
      }
      else {
        $warning.html(result.msg);
      }
    },
    error : function(xhr,textStatus){
      if(textStatus == 'timeout'){
        $warning.html('连接超时，检查你是否使用代理等不稳定的网络。');
      }
      else{
        $warning.html('网络异常，请检查你的网络是否有问题。');
      }
    }
  });
});
// 用户登录
$('#user-area').on('click','.login',function(e){
  e.preventDefault();
  var $dialog = $('#user-login-dialog'),
      $dialog_bg = $dialog.children('.dialog-bg'),
      $dialog_content = $dialog.children('.dialog-content'),
      content_height = $dialog_content.outerHeight();
  $dialog_bg.fadeIn(500);
  $dialog_content.show().animate({top:'50%',marginTop:-(content_height/2),'opacity':1,'-moz-opacity':1},1000);
});
$('#user-login-dialog form').on('submit',function(e){
  e.preventDefault();
  var $this = $(this),
      action = $this.attr('action'),
      $data = $this.serialize(),
      $warning = $this.find('.dialog-warning');
  $warning.html('正在登录...');
  $.ajax({
    url : action,
    data : $data,
    dataType : 'json',
    type : 'POST',
    timeout : 8000,
    success : function(result) {
      if(result == -1) {
        $warning.html('权限超时了，请刷新页面再登录。');
      }
      else if(result.error == 0) {
        $warning.css('color','#219A44').html(result.msg);
        window.location.reload(true);
      }
      else {
        $warning.html(result.msg);
      }
    },
    error : function(xhr,textStatus){
      if(textStatus == 'timeout'){
        $warning.html('连接超时，检查你是否使用代理等不稳定的网络。');
      }
      else{
        $warning.html('网络异常，请检查你的网络是否有问题。');
      }
    }
  });
});
</script>
<?php endif; ?>

<?php if(is_singular() && comments_open() && get_option('thread_comments')) { ?>
<script src="<?php echo site_url('/wp-includes/js/comment-reply.js'); ?>"></script>
<script>
$('#comment').keypress(function(e){
  if(e.ctrlKey && e.which == 13 || e.which == 10) {
    $('#commentform').submit();
  }
});
$('#commentform').submit(function(e){
  e.preventDefault();
  var $this = $(this),
      $submit = $this.find('button.btn-submit'),
      submit = $submit.text(),
      $respond = $('#respond'),
      $comment = $('#comment'),
      comment_parent = $('#comment_parent').val();
  if($submit.attr('disabled')) return false;
  $.ajax({
    url : _options_.template_url + '/ajax/comment.php',
    data : $this.serialize(),
    dataType : 'html',
    type : 'POST',
    timeout : 80000,
    beforeSend : function(){
      $submit.text('正在提交').attr('disabled', true).fadeTo(500, 0.5);
    },
    success : function(data){
      var $comment_title = $('#comments-title'),
          $comment_list = $('#comments-lists'),
          title = '',
          html = '',
          amount = 0,
          wait = 15,
          $timer;
      if($comment_title.length <= 0) {
        $respond.before('<div id="comments-title"></div>');
      }
      if($comment_list.length <= 0){
        $respond.before('<ol id="comments-lists"></ol>');
      }
      else {
        amount = $comment_list.find('li').length;
      }
      amount ++;
      $('#comments-title').text('已有' + amount + '条评论');
      if(comment_parent == 0) {
        $(data).hide().appendTo('#comments-lists').fadeIn(500);
      }
      else {
        $(data).hide().insertBefore('#respond').fadeIn(500);
      }
      $comment.val('');
      $submit.text('回复成功');
      $submit.append('<span id="submit-stop" style="margin-left:10px;">(' + wait + ')</span>');
      $timer = setInterval(function(){
        wait --;
        if(wait <= 0){
          $('#submit-stop').remove();
          $submit.attr('disabled', false).fadeTo(500, 1).text(submit);
          clearInterval($timer);
        }
        else {
          $('#submit-stop').text('(' + wait + ')');
        }
      },1000);
    },
    error : function(xhr,textStatus){
      var error = '提交出错';
      if(textStatus == 'timeout')error = '连接超时';
      error += ' 稍后再试';
      $submit.text(error);
      setTimeout(function(){
        $submit.attr('disabled', false).fadeTo(500, 1).text(submit);
      },2000);
    }
  });
});
</script>
<?php } ?>

<?php wp_footer(); ?>

</body>
</html>