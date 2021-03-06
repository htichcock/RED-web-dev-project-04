<?php
/**
 * The template for displaying all pages.
 *
 * @package inhabitent_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
  
		<main id="main" class="site-main" role="main">
			<section class="hero-banner">	
			<?php 
			$image = wp_get_attachment_url( 96 ); 
			echo "<style type='text/css'>
				.hero-banner { 
					background:
					linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)),
					url({$image}) no-repeat center;
					background-size: cover;
					height: 100vh;
					width: 100vw;                         
			</style>";
			?>
				<img class="logo" alt="logo" src="<?php echo get_template_directory_uri()?>/images/inhabitent-logo-full.svg">
			</section>
			<section class="product-info container">
				<h2>Shop Stuff</h2>
				<?php
						$terms = get_terms( array(
								'taxonomy' => 'product-type',
								'hide_empty' => 0,
						) );
						if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
				?>
						<div class="product-type-blocks">

							<?php foreach ( $terms as $term ) : ?>

									<div class="product-type-block-wrapper">
										<img src="<?php echo get_template_directory_uri() . '/images/' . $term->slug; ?>.svg" alt="<?php echo $term->name; ?>" />
										<p><?php echo $term->description; ?></p>
										<p><a href="<?php echo get_term_link( $term ); ?>" class="box-link"><?php echo $term->name; ?> Stuff</a></p>
									</div>

							<?php endforeach; ?>

						</div>
						
				<?php endif; ?>
			</section>

		<?php
			$post_args = array( 'post_type' => 'post', 'order' => 'DSC', 'posts_per_page'=> '3' );
			$posts = get_posts( $post_args ); // returns an array of posts
		?>
			<div class="blog-preview">
				<h2>Inhabitent Journal</h2>
			<?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
				<div class="blog-preview-item">
					<div class="thumbnail-wrapper">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'large' ); ?>
					<?php endif; ?>
					</div>
					<div class="post-info">
						<div class="post-meta">
							<?php inhabitent_posted_on(); ?> / <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?> 
						</div>
						<a href="<?php the_permalink() ?>"><h3><?php the_title() ?></h3></a>

						<a class="box-link" href="<?php the_permalink() ?>">Read Entry</a>
					</div>
				</div>
			<?php endforeach; wp_reset_postdata(); ?>
			</div>
			<div class="adventures-preview">
				<h2>Adventures</h2>
				<div class="container">
					<div class="adventure-1">
						<h3>Getting Back to Nature in a Canoe</h3>
						<a class="box-link" href="">Read More</a>
					</div>
					<div class="container">
						<div class="adventure-2">
							<h3>A Night with Friends at the Beach</h3>
							<a class="box-link" href="">Read More</a>
						</div>
						<div class="container">
							<div class="adventure-3">
								<h3>Taking in the View at Big Mountain</h3>
								<a class="box-link" href="">Read More</a>
							</div>
							<div class="adventure-4">
								<h3>Star-Gazing at the Night Sky</h3>
								<a class="box-link" href="">Read More</a>
							</div>
						</div>
					</div>
				</div>
				<div class="more-adventures">
					<a class="box-link" href="">More Adventures</a>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
