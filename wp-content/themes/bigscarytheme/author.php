<?php 
	/*
	Template Name: Big Scary List
	*/

	get_header();

	global $wp_query;

	$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
	$userID = $curauth->ID;
	$user = $curauth->user_nicename;
?>


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
	});
</script>

<div id="primary" class="author">		

		<div id="score">
			<h2><?php echo $user; ?>'s Score:</h2>
			<p id="yourScore"></p>
			<h3><?php echo $user; ?>'s Potential:</h3>
			<p id="potential"></p>
		</div>
			
		<?php				
			wp_reset_query();
			$args = array( 'post_type' => 'scaryIdeas', 'meta_key' => 'status', 'meta_value' => 'started', 'orderby' => 'progress', 'post_per_page' => -1, 'author' => $userID );
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
				$args = array( 'post_type' => 'scaryIdeas', 'meta_key' => 'status', 'meta_value' => 'idea', 'post_per_page' => -1, 'author' => $userID );
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
				$args = array( 'post_type' => 'scaryIdeas', 'meta_key' => 'status', 'meta_value' => 'completed', 'orderby' => 'progress', 'post_per_page' => -1, 'author' => $userID );
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
	
</div><!-- #primary -->

<?php get_footer(); ?>