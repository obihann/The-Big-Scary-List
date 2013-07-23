<?php 
	/*
	Template Name: Big Scary List
	*/

	get_header();

	global $wp_query;
	global $current_user;
	get_currentuserinfo();
?>

<div id="primary">
	
	<?php if( !is_user_logged_in() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'page' ); ?>
		<?php endwhile; // end of the loop. ?>
	<?php else: ?>
		<script type="text/javascript">
			function UpdateScore() {
				var score = $(".project").size();
				var potential = score * 10;

				$(".inProgressPercent").each(function(e) {
					var points = $(this).html();
					points = points.replace("%", "");
					score += points / 10;
				});
			
				$("#yourScore").html( Math.round(score) );
				$("#potential").html( potential );
			}

			$(document).ready(function(){
				 UpdateScore();

				$("#ideas .project .overlay a").unbind("click").click(function(event){
					event.preventDefault();
					var target = event.target;
					var parent = $(target).parent().parent();
					var id = parent.attr("id").replace("post-", "");

					parent.remove();
					$("#started").append(parent);

					var data = {
						action: 'update_project',
						project: id,
						field: "status",
						value: "started"
					};

					$.post('<?php echo $site_url;?>/wp-admin/admin-ajax.php', data);

					return false;
				});

				$(".inProgressPercent").unbind("click").click(function(event){
					var target = event.target;
					var targetID = $(event.target).attr("id");
					var progress = $(target).html();
					var input = $("<input>");

					$(input).attr("value", progress);
					$(input).val(progress);
					$(input).attr("class", "inProgressPercentInput");
					$(target).before( input );
					$(target).hide();
				
					$(".inProgressPercentInput").bind("keypress", function(e){
						if( e.keyCode == 13 )
						{
							$(this).hide();

							var article = $(target).parent().parent().parent();
							var currentID = $(article).attr('id').replace("post-", "");
							var value = $(input).val();
							var data = {
								action: 'update_project',
								project: currentID,
								field: "progress",
								value: value
							};

							$.post('<?php echo $site_url;?>/wp-admin/admin-ajax.php', data, function(str)
							{
								$(target).html(value);
								$(target).show();
								UpdateScore();

								if(value == "100%") {
									var mover = $("#post-"+currentID);
									console.log(mover);
									mover.remove();
									$("#completed").append(mover);

									var status = {
										action: 'update_project',
										project: currentID,
										field: "status",
										value: "completed"
									};

									$.post('<?php echo $site_url;?>/wp-admin/admin-ajax.php', status);
								}
							});
						}
					});
				});
			});
		</script>
			
		<?php				
			wp_reset_query();
			$args = array( 'post_type' => 'scaryIdeas', 'meta_key' => 'status', 'meta_value' => 'started', 'orderby' => 'progress', 'post_per_page' => -1, 'author' => $current_user->ID );
			query_posts( $args );
		?>

		<section id="theIdeas">
			<?php if ( have_posts() ) : ?>
				<article id="started">
					<header>
						<h2>In Progress</h2>
					</header>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', 'ip' ); ?>
					<?php endwhile; ?>
			</article>
			<?php endif; ?>
			
			<?php
				wp_reset_query();		
				$args = array( 'post_type' => 'scaryIdeas', 'meta_key' => 'status', 'meta_value' => 'idea', 'post_per_page' => -1, 'author' => $current_user->ID);
				query_posts( $args );
			?>

			<?php if ( have_posts() ) : ?>
				<article id="ideas">
					<header>
						<h2>Only Ideas</h2>
					</header>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', 'ideas' ); ?>
					<?php endwhile; ?>
				</article>
			<?php endif; ?>
			
			<?php
				wp_reset_query();
				$args = array( 'post_type' => 'scaryIdeas', 'meta_key' => 'status', 'meta_value' => 'completed', 'orderby' => 'progress', 'post_per_page' => -1, 'author' => $current_user->ID );
				query_posts( $args );
			?>

			<?php if ( have_posts() ) : ?>
				<article id="completed">
					<header>
						<h2>Completed</h2>
					</header>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', 'completed' ); ?>
					<?php endwhile; ?>
				</article>
			<?php endif; ?>

			<?php wp_reset_query();	?>
			
			<article id="newProject">
				<header>
					<h2>Your Next Project</h2>
				</header>
				<lnabel>Name:</label><br />
				<input type="text" /><br />
				<lnabel>Description:<br />
				</label><textarea></textarea><br />
			</article>
			<div style="clear: both;"></div>
		</section>
		<div style="clear: both;"></div>
	
	<?php endif; //is_user_logged_in()  ?>
</div><!-- #primary -->

<?php get_footer(); ?>