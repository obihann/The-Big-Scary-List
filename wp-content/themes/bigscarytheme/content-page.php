<?php if( !is_user_logged_in() ) : ?>
	<header class="entry-header">
		<h1><?php the_title(); ?></h1>
	</header><!-- .entry-header -->
	<article id="theStory">
		<?php the_content(); ?>
	</article>
	<article id="loginArea">
		<form method="post" action="<?php echo get_option('home'); ?>/wp-login.php">
			<label>Username:</label><input name="log" type="text"><label>Password:</label><input name="pwd" type="password">
			<input type="submit" value="Login">
			<input type="hidden" name="redirect_to" value="<?php echo get_option('home'); ?>" />
		</form>
	</article>
<?php else: ?>
	<header class="entry-header">
		<h1>Your Big Scary List:</h1>
	</header><!-- .entry-header -->
<?php endif; ?>