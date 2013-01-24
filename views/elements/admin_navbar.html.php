<?php
use lithium\core\Libraries;
$config = Libraries::get('li3b_core');
$navbarTitle = isset($config['navbarTitle']) ? $config['navbarTitle']:'Lithium Bootstrap';
$navbarTitle = isset($config['adminNavbarTitle']) ? $config['adminNavbarTitle']:$navbarTitle;
?>
<div class="navbar navbar-fixed-top navbar-inverse">
	<div class="navbar-inner">
	<div class="container">
		<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</a>

		<?=$this->html->link($navbarTitle, '/admin', array('class' => 'brand', 'escape' => false)); ?>

		<?php if($user = $this->request()->user) { ?>
			<div class="btn-group pull-right">
			<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
				<?php
				// Some common fields...Adjust this for your application's needs.
				// This also assumes you set the user object in the request.
				$username = isset($user['firstName']) ? $user['firstName']:'';
				$username = isset($user['lastName']) ? $username . ' ' . $user['lastName']:'';
				$username = isset($user['username']) ? $user['username']:$username;
				?>
				<i class="icon-user"></i> <?=$username; ?>
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<li><?=$this->html->link('Settings', '/settings'); ?></li>
				<li><?=$this->html->link('Profile', '/profile'); ?></li>
				<li class="divider"></li>
				<li><a href="/logout">Sign Out</a></li>
			</ul>
			</div>
		<?php } ?>

		<div class="nav-collapse">
			<?=$this->bootstrapMenu->render('admin'); ?>
		</div><!--/.nav-collapse -->
	</div>
	</div>
</div>