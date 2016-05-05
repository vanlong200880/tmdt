<?php
global $language;
?>
<section id="wrap-new-adv" class="wrap-new-adv">
				<div class="container">
					<div class="row">
            <?php if(!wpmd_is_phone()): ?>
						<div class="col-md-2 col-sm-4 col-xs-12">
							<div class="category-menu-left">
								<h2><?php echo ($language =='en')?'Category':'Danh mục'; ?></h2>
                <ul class="menu-left">
                  <?php get_template_part('block/menu_category'); ?>
                </ul>
									
							</div>
						</div>
            <?php endif; ?>
						<div class="col-md-6 col-sm-8 col-xs-12">
							<?php get_template_part('block/slider'); ?>
						</div>
						<div class="col-md-4 col-sm-12 col-xs-12">
              <?php get_template_part('block/top3'); ?>
						</div>
					</div>
				</div>
			</section>