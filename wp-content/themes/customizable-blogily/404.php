<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package customizable Lite
 */

get_header(); ?>

<div id="page" class="single">
	<article id="content" class="article page">
		<div class="single_post">
			<div class="error-404-content">
				<header>
					<h1 class="title"><?php esc_html_e('Error 404', 'customizable-blogily' ); ?></h1>
				</header>
				<div class="post-content">
					<p><?php esc_html_e('Oops! We couldn\'t find this Page.', 'customizable-blogily' ); ?></p>
					<p><?php esc_html_e('Please check your URL or use the search form below.', 'customizable-blogily' ); ?></p>
					<?php get_search_form();?>
				</div><!--.post-content--><!--#error404 .post-->
			</div>
		</div>
	</article>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>