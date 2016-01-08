<?php
/**
 * Template Name: User post
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); 
if(!is_user_logged_in())
{
  wp_redirect( home_url());
}
?>

<section class="categories details user all-article">
				<div class="container">
					<div class="col-md-12">
						<div class="row">
							<ol class="breadcrumb">
								<li><a href="#">Trang chủ</a></li>
								<li class="active">Thông tin người dùng</li>
							</ol>	
						</div>	
					</div>

					<div class="row">
						<div class="col-md-9">
							<div class="all-content-user">
								<div class="title-form-user">
									<h2>
										<span class="fa fa-file-text-o"></span>
										Form đăng tin
									</h2>
								</div>
								<div class="content-user">
									<p>Chú ý: Những thông tin có dấu <span class="star">(*)</span> là bắt buộc nhập, không được bỏ trống</p>
									<?php
										// Start the Loop.
										while ( have_posts() ) : the_post();
											the_content();
										endwhile;
									?>
									
<!--									<form class="form-horizontal" method="post">
									   <div class="form-group">
									      <label for="title" class="col-sm-2 control-label">Tiêu đề:<span class="validation">*</span> </label>
									      <div class="col-sm-10">
									         <input type="text" class="form-control" name="title" id="title">
									      </div>
									   </div>

									   <div class="form-group">
									      <label for="address" class="col-sm-2 control-label">Địa chỉ:<span class="validation">*</span> </label>
									      <div class="col-sm-10">
									         <input type="text" class="form-control" name="address" id="address">
									      </div>
									   </div>

									   <div class="form-group">
									      <label for="phone" class="col-sm-2 control-label">Điện thoại:</label>
									      <div class="col-sm-10">
									         <input type="text" class="form-control" name="phone" id="phone">
									      </div>
									   </div>

									   <div class="form-group">
									      <label for="website" class="col-sm-2 control-label">Website:</label>
									      <div class="col-sm-10">
									         <input type="text" class="form-control" name="website" id="website">
									      </div>
									   </div>
									   
									   <div class="form-group">
									      <label for="email" class="col-sm-2 control-label">Email:<span class="validation">*</span> </label>
									      <div class="col-sm-10">
									         <input type="email" class="form-control" name="email" id="email">
									      </div>
									   </div>
									   <div class="form-group">
									      <label for="picture" class="col-sm-2 control-label">Hình ảnh:<span class="validation">*</span> </label>
									      <div class="col-sm-10">
									         <input type="file" class="form-control" name="picture" id="picture" placeholder="Chọn ảnh đại diện">
									      </div>
									   </div>
									   <div class="form-group">
									      <label for="categories" class="col-sm-2 control-label">Chuyên mục:<span class="validation">*</span> </label>
									      <div class="col-sm-10">
									         <select class="form-control">
									         	<option>--Chọn chuyên mục--</option>
												<option>Thời trang & Sức khỏe</option>
												<option>Ẩm thực & Tiệc</option>
												<option>Nguồn địa ốc</option>
												<option>4 mùa & Khuyến mãi</option>
												<option>Điện & Gia dụng</option>
												<option>Xe & Công nghệ</option>
											</select>
									      </div>
									   </div>
									   <div class="form-group">
									      <label for="rodio-user" class="col-sm-2 control-label">Bạn là:</label>
									      <div class="col-sm-10">
									         <label class="radio-inline">
											  <input type="radio" name="rodio-user" id="user-personal" value="option1">
											  <span>Cá nhân</span>
											</label>
											<label class="radio-inline">
											  <input type="radio" name="rodio-user" id="user-company" value="option2">
											  <span>Công ty</span>
											</label>
									      </div>
									   </div>
									   
									   <div class="form-group">
									      <label for="content" class="col-sm-2 control-label">Nội dung:<span class="validation">*</span> </label>
									      <div class="col-sm-10">
									         <img src="images/editor.jpg" alt="">
									      </div>
									   </div>

									   <div class="form-group">
									      <label for="scurity-code" class="col-sm-2 control-label">Scurity Code:<span class="validation">*</span> </label>
									      <div class="col-sm-10">
									         <input type="text" class="form-control" name="scurity-code" id="scurity-code">
									         <div class="random-code">
									         	<img src="images/code.png" alt="">
									         	<a href=""><span class="fa fa-refresh"></span></a>
									         </div>
									      </div>
									   </div>

									   <div class="form-group">
										    <div class="col-sm-offset-2 col-sm-10">
										      <button type="submit" class="btn-user">
										      	Đăng tin
										      	<span class="fa fa-angle-double-right"></span>
										      </button>
										    </div>
										</div>
									   
									</form>-->
								</div>

							</div>
						</div><!--end left-user-->

						<div id="sidebar" class="col-md-3">
							<?php get_template_part('block/menu-user-profile'); ?>
						</div>
					</div>

				</div>
			</section>
<?php
get_footer();
