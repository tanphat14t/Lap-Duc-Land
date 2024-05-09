<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
	<!-- import font google -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300..700;1,300..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
	<script>
		var ajaxUrl = "<?php echo admin_url('admin-ajax.php') ?>";
	</script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/ajax-loader.gif">
</head>
<html>

<body>
	<header id="primary-header" class="<?php echo is_front_page() ? 'home-page' : '' ?>">
		<?php if (is_front_page()) : ?>
			<!-- <div class="background-header">
				<img src="<?php //echo get_template_directory_uri() 
							?>/assets/imgs/bg_header_home.png" alt="">
			</div> -->
		<?php endif; ?>
		<nav class="navbar navbar-expand-lg p-0" role="navigation">
			<div class="page-container h-100">
				<div class="inner">
					<!-- Brand and toggle get grouped for better mobile display -->
					<button class="navbar-toggler btn-toggle" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'your-theme-slug'); ?>">
						<?php include get_stylesheet_directory() . '/assets/imgs/icon-close.svg'; ?>
						<?php include get_stylesheet_directory() . '/assets/imgs/icon-bars.svg'; ?>
					</button>

					<a class="navbar-brand" href="/">
						<?php
						$image = get_field('logo-header', 'option');
						$size = 'full';
						if ($image) {
							echo wp_get_attachment_image($image, $size, "", array("class" => "img-fluid", "alt" => "header logo"));
						} else {
							//show image default
						} ?>
					</a>

					<?php
					wp_nav_menu(array(
						'theme_location'    => 'primary',
						'depth'             => 3,
						'menu_class'        => 'header__menu',
					));
					?>
				</div>
			</div>
		</nav>
	</header>