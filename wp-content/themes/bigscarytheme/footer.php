	<?php if( !is_user_logged_in() ) : ?>
		<article id="loginArea">
			<form method="post" action="<?php echo get_option('home'); ?>/wp-login.php">
				<label>Username:</label><input name="log" type="text"><label>Password:</label><input name="pwd" type="password">
				<input type="submit" value="Login">
				<input type="hidden" name="redirect_to" value="<?php echo get_option('home'); ?>" />
			</form>
		</article>
	<?php endif; ?>
	<?php wp_footer(); ?>
	</body>
</html>