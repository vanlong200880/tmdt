<?php

global $current_user;
 ?>
<div class="title-details title-user">
	<h2>
		<span class="fa fa-newspaper-o"></span>
		Tài khoản người dùng
	</h2>
</div>

<div class="info-user">
	<ul>
		<li>
			<span class="fa fa-user"></span>
			<span><?php echo $current_user->display_name; ?></span>
		</li>
    <li>
			<span class="fa fa-pencil-square"></span>
			<a href="<?php echo get_site_url() ?>/account/">Thông tin tài khoản</a>
		</li>
		<li>
			<span class="fa fa-pencil-square"></span>
			<a href="<?php echo get_site_url() ?>/edit-profile/">Thay đổi tài khoản</a>
		</li>
		<li>
			<span class="fa fa-file-text-o"></span>
			<a href="<?php echo get_site_url() ?>/list-user-post/">Thông tin bài post</a>
		</li>
		<li>
			<span class="fa fa-sign-out"></span>
			<a href="<?php echo wp_logout_url( home_url() ); ?>">Thoát</a>
		</li>
	</ul>
</div>

