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

<!--		<footer id="colophon" class="site-footer" role="contentinfo">

			<?php //get_sidebar( 'footer' ); ?>

			<div class="site-info">
				<?php //do_action( 'twentyfourteen_credits' ); ?>
				<a href="<?php //echo esc_url( __( 'https://wordpress.org/', 'twentyfourteen' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentyfourteen' ), 'WordPress' ); ?></a>
			</div> .site-info 
		</footer> #colophon 
	</div> #page -->

	<?php wp_footer(); ?>


<div class="modal fade bs-example-modal-sm login-form" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel">Đăng nhập</h4>
	      </div>
	      <div class="modal-body">
	        <form>
	          	<form id="login-form" method="post" enctype="multipart/form-data">
                <div class="login-error"><p class="error" id="login-error"></p></div>
					<div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" id="username" name="username" value="" placeholder="Tên đăng nhập">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" value="" placeholder="Mật khẩu">
                    </div>
                </div>
                <div class="form-group">
					<button type="button" id="login-submit" class="btn btn-primary">Đăng nhập</button>
                    <a href="#" class="forgot-password control-label">Quên mật khẩu?</a>
                </div>
                <div class="login-line"></div>
                <p>
                	<span>Bạn chưa có tài khoản</span>
                	<a href="#" id="sign-up-here">Đăng ký tại đây</a>
                </p>
				</form>
	        </form>
	      </div>
	    </div>
	  </div>
	</div><!--end login-->



	<div class="modal fade login-form" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel">Đăng ký</h4>
	      </div>
	      <div class="modal-body">
	        <form id="register-form" class="form-horizontal" method="post" enctype="multipart/form-data">
			   <div class="form-group">
			      <label for="sponsor-id" class="col-sm-4 control-label">Họ & Tên:<span class="validation">*</span> </label>
			      <div class="col-sm-8">
			         <input type="text" class="form-control" name="fullname" id="fullname">
			         <p class="error" id="fullname-error"></p>
			      </div>
			   </div>
			   
			   <div class="form-group">
			      <label for="email" class="col-sm-4 control-label">Email:<span class="validation">*</span> </label>
			      <div class="col-sm-8">
			         <input type="email" class="form-control" name="email" id="email">
			         <p class="error" id="email-error"></p>
			      </div>
			   </div>
			   <div class="form-group">
			      <label for="member-name" class="col-sm-4 control-label">Tên đăng nhập:<span class="validation">*</span> </label>
			      <div class="col-sm-8">
			         <input type="text" class="form-control" name="username" id="username">
			         <p class="error" id="username-error"></p>
			      </div>
			   </div>
			   <div class="form-group">
			      <label for="member-name" class="col-sm-4 control-label">Mật khẩu:<span class="validation">*</span> </label>
			      <div class="col-sm-8">
			         <input type="password" class="form-control" name="password" id="password">
			         <p class="error" id="password-error"></p>
			      </div>
			   </div>
			   <div class="form-group">
			      <label for="member-name" class="col-sm-4 control-label">Xác nhận lại mật khẩu:<span class="validation">*</span> </label>
			      <div class="col-sm-8">
			         <input type="password" class="form-control" name="confirm-password" id="confirm-password">
			         <p class="error" id="confirm-password-error"></p>
			      </div>
			   </div>
			   
			   <div class="form-group">
			      <label for="security" class="col-sm-4 control-label"></label>
			      <div class="col-sm-8">
			         <div class="row">
			            <div class="col-sm-3">
			               <button type="button" id="register-submit" class="btn btn-primary">Đăng ký</button>
			            </div>
			            <div class="col-sm-9">
			               <p>
			               	<span>Bạn đã có tài khoản rồi?</span> 
			               	<a href="#" id="login-here">Đăng nhập</a>
			               </p>
			            </div>
			         </div>
			      </div>
			   </div>
			</form>
	      </div>
	    </div>
	  </div>
	</div><!--end register-->
  
</body>
</html>