<?php get_header(); ?>

<main class="main" role="main">
	<div class="container px-4 sm:px-6 md:px-8">

		<?php while (have_posts()) : the_post(); ?>

			<article <?php post_class(); ?>>

				<header role="heading">
					<h1 class="post__title"><?php the_title(); ?></h1>
				</header>

				<?php the_content(); ?>

			</article>

		<?php endwhile; ?>

	</div>
</main>

<?php get_footer(); ?>
