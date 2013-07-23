<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />
		<title><?php bloginfo( 'name' ); ?></title>

		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

		<?php wp_head(); ?>
	</head>
<body>
<?php if( !is_user_logged_in() ) : ?>
	<article id="loginArea">
		<span> Log In:</span>
		<form method="post" action="<?php echo get_option('home'); ?>/wp-login.php">
			<label>Username:</label><input name="log" type="text"><label>Password:</label><input name="pwd" type="password">
			<input type="submit" value="Login">
			<input type="hidden" name="redirect_to" value="<?php echo get_option('home'); ?>" />
		</form>
	</article>
<?php endif; ?>