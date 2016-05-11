<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
global $language;
?>
<div class="list-icon">
  <div class="container">
    <ul class="row">
      <li class="col-md-1 col-sm-2 col-xs-3">
        <a href="http://www.google.com" target="_blank">
          <p class="img"><img src="<?php echo get_template_directory_uri() ;?>/images/google-12.png"></p>
          <p>Google</p>
        </a>
      </li>
      <li class="col-md-1 col-sm-2 col-xs-3">
        <a href="http://www.facebook.com" target="_blank">
          <p class="img"><img src="<?php echo get_template_directory_uri() ;?>/images/facebook.com-1381205514.png"></p>
          <p>facebook</p>
        </a>
      </li>
      <li class="col-md-1 col-sm-2 col-xs-3">
        <a href="http://www.youtube.com" target="_blank">
          <p class="img"><img src="<?php echo get_template_directory_uri() ;?>/images/youtube.com-1381205141.png"></p>
          <p>Youtube</p>
        </a>
      </li>
      <li class="col-md-1 col-sm-2 col-xs-3">
        <a href="http://www.vnexpress.net" target="_blank">
          <p class="img"><img src="<?php echo get_template_directory_uri() ;?>/images/vnexpress.net-1381205280.png"></p>
          <p>Vnexpress</p>
        </a>
      </li>
      <li class="col-md-1 col-sm-2 col-xs-3">
        <a href="http://www.news.zing.vn" target="_blank">
          <p class="img"><img src="<?php echo get_template_directory_uri() ;?>/images/news.zing.vn-1381205130.png"></p>
          <p>Zing news</p>
        </a>
      </li>
      <li class="col-md-1 col-sm-2 col-xs-3">
        <a href="http://www.dantri.com.vn" target="_blank">
          <p class="img"><img src="<?php echo get_template_directory_uri() ;?>/images/dantri.com.vn-1381205614.png"></p>
          <p>Dân trí</p>
        </a>
      </li>
      <li class="col-md-1 col-sm-2 col-xs-3">
        <a href="http://www.kenh14.vn" target="_blank">
          <p class="img"><img src="<?php echo get_template_directory_uri() ;?>/images/kenh14.vn-1354607660.png"></p>
          <p>Kenh14</p>
        </a>
      </li>
      <li class="col-md-1 col-sm-2 col-xs-3">
        <a href="http://www.dict.laban.vn" target="_blank">
          <p class="img"><img src="<?php echo get_template_directory_uri() ;?>/images/dict.laban.vn-1431338802.jpg"></p>
          <p>Từ điển</p>
        </a>
      </li>
      <li class="col-md-1 col-sm-2 col-xs-3">
        <a href="http://www.baomoi.com" target="_blank">
          <p class="img"><img src="<?php echo get_template_directory_uri() ;?>/images/baomoi.com-1441858497.jpg"></p>
          <p>Báo mới</p>
        </a>
      </li>
      
      <li class="col-md-1 col-sm-2 col-xs-3">
        <a href="http://www.lazada.vn" target="_blank">
          <p class="img"><img src="<?php echo get_template_directory_uri() ;?>/images/www.lazada.vn-1407750861.png"></p>
          <p>Lazada</p>
        </a>
      </li>
      <li class="col-md-1 col-sm-2 col-xs-3">
        <a href="http://www.bongda.com.vn" target="_blank">
          <p class="img"><img src="<?php echo get_template_directory_uri() ;?>/images/www.bongda.com.vn-1354611194.png"></p>
          <p>Bóng đá</p>
        </a>
      </li>
      <li class="col-md-1 col-sm-2 col-xs-3">
        <a href="http://www.24h.com.vn" target="_blank">
          <p class="img"><img src="<?php echo get_template_directory_uri() ;?>/images/24h.com.vn-1381204839.png"></p>
          <p>24h</p>
        </a>
      </li>
    </ul>
  </div>
</div>
<footer id="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="linkweb title-footer">
          <h3><?php echo ($language == 'vi'? 'Tìm chúng tôi trên': 'Link'); ?></h3>
          <ul>
            <li><a href="www.facebook.com/unimediavietnam"><img src="<?php echo get_template_directory_uri() ;?>/images/facebook-logo-button.png"></a></li>
            <li><a href="http://www.unimedia.vn"><img src="<?php echo get_template_directory_uri() ;?>/images/googleplus-logo.png"></a></li>
            <li><a href="http://www.unimedia.vn"><img src="<?php echo get_template_directory_uri() ;?>/images/youtube-logotype.png"></a></li>
            <li><a href="http://www.unimedia.vn"><img src="<?php echo get_template_directory_uri() ;?>/images/twitter-logo-button.png"></a></li>
            <li><a href="http://www.unimedia.vn"><img src="<?php echo get_template_directory_uri() ;?>/images/pinterest.png"></a></li>
          </ul>
          
        </div>
      </div>

      <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="about-footer title-footer">
          <h3><?php echo ($language == 'vi'? 'Địa chỉ': 'Address'); ?></h3>
          <div class="sub-about">
            <h5><?php echo ($language == 'vi'? 'Công ty TNHH UNIMEDIA': 'UNIMEDIA Co., Ltd'); ?></h5>
            <p><?php echo ($language == 'vi'? 'Tầng 11, Bảo Minh Tower <br>217 Nam Kỳ Khởi Nghĩa, P.7, Q.3': 'Floor 11, Bao Minh Tower<br>217 Nam Ky Khoi Nghia Street, Ward 7, District 3'); ?></p>
            <p>Tel: (08) 3932 9777 - (08) 3932 9333</p>
            <p>Fax: (08) 3932 9222</p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="infomation title-footer">
          <h3><?php echo ($language == 'vi'? 'Thông tin': 'Information'); ?></h3>
					<?php
						wp_nav_menu( array(
								'theme_location' => 'primary',
								'menu'=> 'menu_footer',
								'menu_class' => '',
								'container_class' => '',
                'before' => '',
              'link_before' => '<span class="fa fa-angle-right"></span>'
						) );
					?>
        </div>
      </div>

      <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="support title-footer">
          <h3><?php echo ($language == 'vi'? 'Hỗ trợ': 'Help'); ?></h3>
          <div class="wrap-chat">
            <p>
              <span class="fa fa-envelope"></span>
              <a href="mailto:contact@unimedia.vn">contact@unimedia.vn</a>	
            </p>
            <p>
              <span class="fa fa-mobile"></span>
              <span class="phone-number">090 474 0278 (Ms. Lan)</span>	
            </p>

            <p>
              <span class="fa fa-skype"></span> 
              <a href="skype:sale.unimedia?chat">Sale Unimedia</a>		
            </p>
            <p>
              <span class="fa fa-skype"></span> 
              <a href="skype:sale.vinarealtor?chat">Sale Vina Realtor</a>	
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="row coppyright">
      <div class="col-md-8 col-sm-8 col-xs-6 text-left">
        <p>Copyright © 2015 UNIMEDIA. All rights reserved.</p>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-6 text-right">
        <a class="backtop" href="#top">
          <span class="fa fa-arrow-up"></span>
        </a>
      </div>
    </div>
  </div>
</footer>

		</div><!-- #main -->

	<?php wp_footer(); ?>

    
<div class="modal fade bs-example-modal-sm login-form" id="login-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel"><?php echo ($language == 'en')?'Login':'Đăng nhập'; ?></h4>
	      </div>
	      <div class="modal-body">
					<form id="login" class="ajax-auth" action="login" method="post" enctype="multipart/form-data">
            <p class="status"></p>  
            <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
            
            <div class="form-group">
                  <label for="username"><?php echo ($language == 'en')?'Username':'Tên đăng nhập'; ?></label>
                  <input id="username" type="text" class="form-control required" name="username">
            </div>
            
            <div class="form-group">
                  <label for="password"><?php echo ($language == 'en')?'Password':'Mật khẩu'; ?></label>
                  <input id="password" type="password" class="form-control required" name="password">
            </div>
            
            <div class="form-group">
              <input class="btn btn-primary submit_button" type="submit" value="<?php echo ($language == 'en')?'Login':'Đăng nhập'; ?>">
                <a class="forgot-password control-label"><?php echo ($language == 'en')?'Forgot password':'Quên mật khẩu?'; ?></a>
            </div>
            <div class="login-line"></div>
            <p>
              <span><?php echo ($language == 'en')?'have an account':'Bạn chưa có tài khoản'; ?></span>
              <a id="sign-up-here"><?php echo ($language == 'en')?'Register':'Đăng ký tại đây'; ?></a>
            </p>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
    
    <!--end login-->



	<div class="modal fade login-form" id="register-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel"><?php echo ($language == 'en')?'Register':'Đăng ký'; ?></h4>
	      </div>
	      <div class="modal-body">
          <form id="register" class="ajax-auth form-horizontal" action="register" method="post">
            <p class="status"></p>
              <?php wp_nonce_field('ajax-register-nonce', 'signonsecurity'); ?>
            
            <div class="form-group">
              <label for="signonname" class="col-sm-3 control-label"><?php echo ($language == 'en')?'Username':'Tên đăng nhập:'; ?><span class="validation">*</span> </label>
              <div class="col-sm-9">
                 <input id="signonname" type="text" name="signonname" class="form-control required">
              </div>
            </div>
            
            <div class="form-group">
              <label for="email" class="col-sm-3 control-label"><?php echo ($language == 'en')?'Email':'Email:'; ?><span class="validation">*</span> </label>
              <div class="col-sm-9">
                 <input id="email" type="text" class="form-control required email" name="email">
              </div>
            </div>
            
            <div class="form-group">
              <label for="signonpassword" class="col-sm-3 control-label"><?php echo ($language == 'en')?'Password':'Mật khẩu:'; ?><span class="validation">*</span> </label>
              <div class="col-sm-9">
                 <input id="signonpassword" type="password" class="form-control required" name="signonpassword" >
              </div>
            </div>
            
            <div class="form-group">
              <label for="password2" class="col-sm-3 control-label"><?php echo ($language == 'en')?'Re-password':'Nhập lại mật khẩu:'; ?><span class="validation">*</span> </label>
              <div class="col-sm-9">
                 <input type="password" id="password2" class="form-control required" name="password2" equalTo ="#signonpassword" maxlength="40">
              </div>
            </div>
            
            <div class="form-group">
              <label for="security" class="col-sm-3 control-label"></label>
              <div class="col-sm-9">
                 <div class="row">
                    <div class="col-sm-3">
                       <input class="btn btn-primary submit_button " type="submit" value="<?php echo ($language == 'en')?'Register':'Đăng ký'; ?>">
                    </div>
                    <div class="col-sm-9">
                       <p>
                        <span><?php echo ($language == 'en')?'have an account?':'Bạn đã có tài khoản rồi?'; ?></span> 
                        <a id="login-here"><?php echo ($language == 'en')?'Login':'Đăng nhập'; ?></a>
                       </p>
                    </div>
                 </div>
              </div>
           </div>
          </form>
	      </div>
	    </div>
	  </div>
	</div>
  <!--end register-->
  <!-- forgot password -->
    <div id="forgot" class="modal fade deposit-form" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo ($language == 'en')?'Forgot password?':'Quên mật khẩu?'; ?></h4>
            </div>
            <div class="modal-body">
              <form id="forgot_password" class="ajax-auth" action="forgot_password" method="post">
                <p class="status"></p>
                <?php wp_nonce_field('ajax-forgot-nonce', 'forgotsecurity'); ?>  
                <div class="form-group">
                  <label for="user_login">Username or E-mail</label>
                  <input id="user_login" type="text" class="form-control required" name="user_login">
                </div>
                 <input id="forgotpassword-submit" class="btn btn-primary submit_button" type="submit" value="<?php echo ($language == 'en')?'Send':'Gửi'; ?>">
            </form>
            </div>
        </div>
      </div>
    </div>
	<script type="text/javascript">
    jQuery(document).ready(function($){
      // user login
        $("#sign-up-here").on('click', function(){
            $(".close").trigger('click');
            setTimeout(function(){ 
                 $("#register-form").modal('show'); 
             }, 500);
        });
        $("#login-here").on('click', function(){
            $(".close").trigger('click');
            setTimeout(function(){ 
                 $("#login-form").modal('show');
             }, 500);
        });
        $(".forgot-password.control-label").on('click', function(){
            $(".close").trigger('click');
            setTimeout(function(){ 
                 $("#forgot").modal('show'); 
             }, 500);
        });
    });
    
		$(function () {
			var sources = [];
			$('#searchAjax span').each(function(i,ele){
				sources.push({'label': $(ele).text(), 'value': $(ele).text(), 'key' : $(ele).attr('data-key')});
			});
    $("#keyword").autocomplete({
        source: sources,
        minLength: 0,
				select: function (event, ui){
					$(this).val(ui.item.value);
					$('#searchform').submit();
				}
    }).focus(function(event){ 
       $(this).autocomplete('search', $(this).val());
			 
     });
});
		</script>
		
		<script type="text/javascript">
        	var summaries = $('#sidebar');
        	summaries.each(function(i) {
            var summary = $(summaries[i]);
            var next = summaries[i + 1];

            summary.scrollToFixed({
                marginTop: 10,
                limit: function() {
                    var limit = 0;
                    if (next) {
                        limit = $(next).offset().top - $(this).outerHeight(true) - 10;
                    } else {
                        limit = $('footer').offset().top - $(this).outerHeight(true) - 10;
                    }
                    return limit;
                },
                zIndex: 999,

            });
        });
        </script>
        
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-36019448-5', 'auto');
  ga('send', 'pageview');

</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-36019448-6', 'auto');
  ga('send', 'pageview');

</script>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '205628806487988',
      xfbml      : true,
      version    : 'v2.6'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>