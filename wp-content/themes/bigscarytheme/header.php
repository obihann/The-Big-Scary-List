<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />
		<title><?php bloginfo( 'name' ); ?></title>

		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

		<?php wp_head(); ?>
		<script type="text/javascript">
			$(document).ready(function() {
				$(".loginLink").fancybox();
			});
		</script>
	</head>
<body>
<a href="https://github.com/obihann/The-Big-Scary-List"><img style="position: fixed; top: 0; left: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_left_darkblue_121621.png" alt="Fork me on GitHub"></a>
<section id="settingsArea">
	<?php if( is_user_logged_in() ) : ?>
	<?php
		global $current_user;
		get_currentuserinfo();
		//var_dump($current_user);
	?>
	<article id="userArea">
		<a href="<?php echo home_url(); ?>"><i class="icon-home"></i> My list</a>
		<a href="<?php echo home_url(); ?>/author/<?php echo $current_user->user_login; ?>"><i class="icon-link"></i>Share My List</a>
		<a href="<?php echo wp_logout_url( $redirect ); ?>"><i class="icon-remove"></i>Log Out</a>
	</article>
<?php else: ?>
	<article id="loginArea">
		<a href="#loginForm" class="loginLink"><i class="icon-user"></i> Login</a>
	</article>
	<?php endif; ?>
</section>
<header class="site-header">
	<h1><?php bloginfo('name'); ?></h1>
</header><!-- .entry-header -->