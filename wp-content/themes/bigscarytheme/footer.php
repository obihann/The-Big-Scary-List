
	<form method="post" action="<?php echo get_option('home'); ?>/wp-login.php" id="loginForm">
		<label>Username:</label><input name="log" type="text"><br /><br />
		<label>Password:</label><input name="pwd" type="password"><br /><br />
		<input type="submit" value="Login">
		<input type="hidden" name="redirect_to" value="<?php echo get_option('home'); ?>" />
	</form>

	<?php wp_footer(); ?>
	</body>
</html>