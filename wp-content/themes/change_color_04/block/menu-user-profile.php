<?php

global $current_user;
global $language;
 ?>
<div class="title-details title-user">
	<h2>
		<span class="fa fa-newspaper-o"></span>
		<?php echo ($language == 'en')?'User Profile': 'Tài khoản người dùng' ?>
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
			<a href="<?php echo get_site_url() ?>/account/"><?php echo ($language == 'en')?'User information': 'Thông tin tài khoản' ?></a>
		</li>
		<li>
			<span class="fa fa-pencil-square"></span>
			<a href="<?php echo get_site_url() ?>/edit-profile/"><?php echo ($language == 'en')?'Update profile': 'Thay đổi tài khoản' ?></a>
		</li>
		<li>
			<span class="fa fa-file-text-o"></span>
			<a href="<?php echo get_site_url() ?>/list-user-post/"><?php echo ($language == 'en')?'List post': 'Thông tin bài post' ?></a>
		</li>
		<li>
			<span class="fa fa-sign-out"></span>
			<a href="<?php echo wp_logout_url( home_url() ); ?>"><?php echo ($language == 'en')?'Logout': 'Thoát' ?></a>
		</li>
	</ul>
</div>

