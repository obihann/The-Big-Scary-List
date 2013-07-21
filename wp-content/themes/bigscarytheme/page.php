<?php 
	global $wp_query;
	get_header();
	$projects = 0;
	$potential = 0;
?>

		<div id="primary">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>

			<div id="score">
				<h2>Your Score:</h2>
				<p id="yourScore"></p>
				<h3>Your Potential:</h3>
				<p id="potential"></p>
			</div>
				
			<?php				
				wp_reset_query();
				$args = array( 'post_type' => 'scaryIdeas', 'meta_key' => 'status', 'meta_value' => 'started', 'orderby' => 'progress', 'post_per_page' => -1 );
				query_posts( $args );
			?>
			
			<?php if( is_user_logged_in() ) : ?>
				<script type="text/javascript">
					$(document).ready(function(){
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
									});
								}
							});
						});
					});
				</script>

				<section id="theIdeas">
					<?php if ( have_posts() ) : ?>
					<article id="started">
						<header>
							<?php 
								$ips = $wp_query->found_posts;
								$projects += $ips;
							?>
							<h2>In Progress (<?php echo $ips; ?>)</h2>
						</header>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', 'ip' ); ?>
						<?php endwhile; ?>
					</article>
					<?php endif; ?>
					
					<?php
						wp_reset_query();		
						$args = array( 'post_type' => 'scaryIdeas', 'meta_key' => 'status', 'meta_value' => 'idea', 'post_per_page' => -1);
						query_posts( $args );
					?>
	
					<?php if ( have_posts() ) : ?>
					<article id="ideas">
						<header>
							<?php 
								$ideas = $wp_query->found_posts;
								$projects += $ideas;
							?>
							<h2>Only Ideas (<?php echo $ideas; ?>)</h2>
						</header>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', get_post_format() ); ?>
						<?php endwhile; ?>
					</article>
					<?php endif; ?>
					<div style="clear: both;"></div>
				</section>
				<div style="clear: both;"></div>
			
			<?php endif; //is_user_logged_in()  ?>
		</div><!-- #primary -->
		<?php
			$potential = $projects * 10;
		?>
		<script>
			var score = <?php echo $projects; ?>;

			$(".inProgressPercent").each(function(e) {
				var points = $(this).html();
				points = points.replace("%", "");
				score += points / 10;
			});

			$("#yourScore").append( score );
			$("#potential").append( <?php echo $potential; ?> );
		</script>


<?php get_footer(); ?>