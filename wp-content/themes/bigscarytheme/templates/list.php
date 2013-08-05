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
			function updatePercent(event) {
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
								mover.remove();
								$("#completed article header h4").remove();
								$("#completed .sectionHeader").after(mover);

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
			}

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

			function startIdea(event) {
				event.preventDefault();
				var target = event.target;
				var parent = $(target).parent().parent();
				var id = parent.attr("id").replace("post-", "");
				parent.remove();
				parent.find(".overlay").remove();

				var d = new Date();
				var dateStr = "Work Started " + d.getMonth() + " " + d.getDate() + " " + d.getFullYear();
				var prog = $("<span></span>").addClass("inProgressPercent").text("0%");
				var status = $("<h4></h4>").html(dateStr + "<br />The current progress is ").append(prog);
				parent.find("header").append(status);

				$("#started .sectionHeader").after(parent);

				$(".inProgressPercent").unbind("click").click(updatePercent);

				var data = {
					action: 'update_project',
					project: id,
					field: "status",
					value: "started"
				};

				$.post('<?php echo $site_url;?>/wp-admin/admin-ajax.php', data);

				return false;				
			}

			$(document).ready(function(){
				 UpdateScore();

				$(".saveNewIdea").unbind("click").click(function(idea){
					idea.preventDefault();

					var data = {
						action: 'new_idea',
						idea: $("#apftitle").val(),
						desc: $("#apfcontents").val()
					};

					$.post('<?php echo $site_url;?>/wp-admin/admin-ajax.php', data, function(id) {
						$(".fancybox-overlay").hide();
						$("#apftitle").val("");
						$("#apfcontents").val("");

						var overlay = $("<div></div>").addClass("overlay");
						overlay.append( $("<a>").text("Start the project").attr("href", "#") );

						var title = $("<h3></h3>").append( $("<a>").text(data.idea).attr("href", "#").addClass("startProject") );
						var header = $("<header></header>").addClass("entry-header");
						header.append(title);

						var article = $("<article></article>").attr("id", "post-"+id).addClass("project");
						article.append(overlay);
						article.append(header);
						article.append( $("<p></p>").text(data.desc) );

						$("#ideas .sectionHeader").after(article);

						article.click(startIdea);
					});

					return false;
				});

				$("#ideas .project .overlay a").click(startIdea);

				$(".inProgressPercent").unbind("click").click(updatePercent);
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
					<header class="sectionHeader">
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
					<header class="sectionHeader">
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
					<header class="sectionHeader">
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