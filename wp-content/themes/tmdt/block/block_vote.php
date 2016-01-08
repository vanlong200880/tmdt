<section id="tab-vote" class="tab-vote all-article">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-sm-12- col-xs-12">
				
						   <!-- Nav tabs -->
						   <ul class="nav nav-tabs" role="tablist">
						      <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Bài mới nhất</a></li>
						      <li><span>|</span></li>
						      <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Bình chọn nhiều nhất</a></li>
						   </ul>
						   <!-- Tab panes -->
						   <div class="tab-content">
						      <div role="tabpanel" class="tab-pane active" id="home">
						      		<?php get_template_part('block/news/hot'); ?>
                      <div class="viewmore">
                        <a class="btn-base" href="<?php echo get_site_url() ?>/bai-viet-moi-nhat/">Xem thêm <span class="fa fa-angle-double-right"></span></a>
                     </div>
						      </div>
						      <div role="tabpanel" class="tab-pane" id="profile">
						      		<?php get_template_part('block/news/vote'); ?>
                      <div class="viewmore">
                        <a class="btn-base" href="<?php echo get_site_url() ?>/binh-chon-nhieu-nhat/">Xem thêm <span class="fa fa-angle-double-right"></span></a>
                     </div>
						      </div>

						   </div><!--end tab-content-->
						</div><!--end col-md-12-->

					</div>
				</div>
			</section>