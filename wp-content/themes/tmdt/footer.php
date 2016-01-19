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
?>
<footer id="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="linkweb title-footer">
          <h3>Liên kết website</h3>
          <ul>
            <li><a href=""><span class="fa fa-link"></span>Liên kết website 1</a></li>
            <li><a href=""><span class="fa fa-link"></span>Liên kết website 2</a></li>
            <li><a href=""><span class="fa fa-link"></span>Liên kết website 3</a></li>
          </ul>
        </div>
      </div>

      <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="about-footer title-footer">
          <h3>Địa chỉ</h3>
          <div class="sub-about">
            <h5>Công ty TNHH UNIMEDIA</h5>
            <p>Tầng 11, Bảo Minh Tower <br>217 Nam Kỳ Khởi Nghĩa, P.7, Q.3</p>
            <p>Tel: (08) 3932 9777</p>
            <p>Fax: (08) 3932 9333</p>
            <div class="plugin-social">
              <a href="">
                <img src="<?php echo get_template_directory_uri(); ?>/images/share-facebook.png" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="infomation title-footer">
          <h3>Thông tin</h3>
					<?php
						wp_nav_menu( array(
								'theme_location' => 'primary',
								'menu'=> 'top_menu',
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
          <h3>Hỗ trợ</h3>
          <div class="wrap-chat">
            <p>
              <span class="fa fa-envelope"></span>
              <a href="">nhansu@unimedia.vn</a>	
            </p>
            <p>
              <span class="fa fa-mobile"></span>
              <span class="phone-number">090 474 0278 (Ms. Lan)</span>	
            </p>

            <p>
              <span class="fa fa-skype"></span> 
              <a href="">Skype chat 2</a>		
            </p>
            <p>
              <span class="fa fa-skype"></span> 
              <a href="">Skype chat 2</a>	
            </p>
            <p>
              <span class="fa fa-skype"></span> 
              <a href="">Skype chat 2</a>		
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="row coppyright">
      <div class="col-md-8 col-sm-8 col-xs-6 text-left">
        <p>Copyright © 2015 UNIMEDIA. All rigths reserved.</p>
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
	        <h4 class="modal-title" id="exampleModalLabel">Đăng nhập</h4>
	      </div>
	      <div class="modal-body">
					<form id="login" class="ajax-auth" action="login" method="post" enctype="multipart/form-data">
            <p class="status"></p>  
            <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
            
            <div class="form-group">
                  <label for="username">Tên đăng nhập</label>
                  <input id="username" type="text" class="form-control required" name="username">
            </div>
            
            <div class="form-group">
                  <label for="password">Mật khẩu</label>
                  <input id="password" type="password" class="form-control required" name="password">
            </div>
            
            <div class="form-group">
              <input class="btn btn-primary submit_button" type="submit" value="Đăng nhập">
                <a class="forgot-password control-label">Quên mật khẩu?</a>
            </div>
            <div class="login-line"></div>
            <p>
              <span>Bạn chưa có tài khoản</span>
              <a id="sign-up-here">Đăng ký tại đây</a>
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
	        <h4 class="modal-title" id="exampleModalLabel">Đăng ký</h4>
	      </div>
	      <div class="modal-body">
          <form id="register" class="ajax-auth form-horizontal" action="register" method="post">
            <p class="status"></p>
              <?php wp_nonce_field('ajax-register-nonce', 'signonsecurity'); ?>
            
            <div class="form-group">
              <label for="signonname" class="col-sm-3 control-label">Tên đăng nhập:<span class="validation">*</span> </label>
              <div class="col-sm-9">
                 <input id="signonname" type="text" name="signonname" class="form-control required">
              </div>
            </div>
            
            <div class="form-group">
              <label for="email" class="col-sm-3 control-label">Email:<span class="validation">*</span> </label>
              <div class="col-sm-9">
                 <input id="email" type="text" class="form-control required email" name="email">
              </div>
            </div>
            
            <div class="form-group">
              <label for="signonpassword" class="col-sm-3 control-label">Mật khẩu:<span class="validation">*</span> </label>
              <div class="col-sm-9">
                 <input id="signonpassword" type="password" class="form-control required" name="signonpassword" >
              </div>
            </div>
            
            <div class="form-group">
              <label for="password2" class="col-sm-3 control-label">Nhập lại mật khẩu:<span class="validation">*</span> </label>
              <div class="col-sm-9">
                 <input type="password" id="password2" class="form-control required" name="password2" equalTo ="#signonpassword" maxlength="40">
              </div>
            </div>
            
            <div class="form-group">
              <label for="security" class="col-sm-3 control-label"></label>
              <div class="col-sm-9">
                 <div class="row">
                    <div class="col-sm-3">
                       <input class="btn btn-primary submit_button " type="submit" value="Đăng ký">
                    </div>
                    <div class="col-sm-9">
                       <p>
                        <span>Bạn đã có tài khoản rồi?</span> 
                        <a id="login-here">Đăng nhập</a>
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
                <h4 class="modal-title">Quên mật khẩu?</h4>
            </div>
            <div class="modal-body">
              <form id="forgot_password" class="ajax-auth" action="forgot_password" method="post">
                <p class="status"></p>
                <?php wp_nonce_field('ajax-forgot-nonce', 'forgotsecurity'); ?>  
                <div class="form-group">
                  <label for="user_login">Username or E-mail</label>
                  <input id="user_login" type="text" class="form-control required" name="user_login">
                </div>
                 <input id="forgotpassword-submit" class="btn btn-primary submit_button" type="submit" value="Gửi">
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
</body>
</html>