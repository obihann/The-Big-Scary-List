	<form id="apfform" action="" method="post"enctype="multipart/form-data">
		<div id="apf-text">
			<div id="apf-response" style="background-color:#E6E6FA ;color:blue;"></div>
			<strong>Your Great Idea </strong> <br/>
			<input type="text" id="apftitle" name="apftitle"/><br /> 
			<br/>
			
			<strong>Tell us about it </strong> <br/>
			<textarea id="apfcontents" name="apfcontents" rows="10" cols="20"></textarea>
		 	<br/>
			
			<a class="saveNewIdea" style="cursor: pointer"><i class="icon-ok"></i> <b>Save Idea</b></a>
		</div>
	</form>

	<form method="post" action="<?php echo get_option('home'); ?>/wp-login.php" id="loginForm">
		<label>Username:</label><input name="log" type="text"><br /><br />
		<label>Password:</label><input name="pwd" type="password"><br /><br />
		<input type="submit" value="Login">
		<input type="hidden" name="redirect_to" value="<?php echo get_option('home'); ?>" />
	</form>

	<div id="registerForm"> <!-- Registration -->
		<div id="register-form">
			<form action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post">
				<label>Username:</label><input type="text" name="user_login" id="user_login" class="input" /><br /><br />
				<label>Email:</label><input type="text" name="user_email" id="user_email" class="input"  /><br /><br />
					<?php do_action('register_form'); ?>
					<input type="submit" value="Register" id="register" />
				<hr />
				<p class="statement">Your password will be e-mailed to you.</p>
			</form>
		</div>
	</div><!-- /Registration -->

	<?php wp_footer(); ?>
	</body>
</html>