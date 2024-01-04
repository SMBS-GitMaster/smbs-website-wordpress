<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Smbs Solutions">
	<meta name="author" content="https://youtube.com/smbs">
	<?php
	wp_head();
	?>

</head>

<body>

	<header class="header">
		<div class="header__container container container-xxl">
			<a href="/" class="header__logo">
				<?php
				if (function_exists('the_custom_logo')) {
					$custom_logo_id = get_theme_mod('custom_logo');
					$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
				}
				?>
				<figure class="header__logo-image">
					<img alt="Smbs logo" loading="lazy" src="<?php echo $logo[0] ?>">
				</figure>
			</a>
			<div class="header__menu-container">

				<nav class="header__menu">
					<?php
					if (has_nav_menu('primary')) {
						wp_nav_menu(
							array(
								'menu' => 'primary',
								'container' => '',
								'theme_location' => 'primary',
								'items_wrap' => '<ul id="" class="header__links">%3$s</ul>'
							)
						);
					}
					?>
				</nav>
				<a href="<?php echo esc_url(get_theme_mod('smbs_header_button_url', '#')); ?>" class="header__button">
					<?php echo esc_html(get_theme_mod('smbs_header_button_text', 'Default Text')); ?>
				</a>


				<!-- <nav class="header__menu-mobile navbar bg-body-tertiary fixed-top">
					<div class="container-fluid">
						<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
							<div class="offcanvas-body">
								<?php
								if (has_nav_menu('primary')) {
									wp_nav_menu(
										array(
											'menu' => 'primary',
											'container' => '',
											'theme_location' => 'primary',
											'items_wrap' => '<ul id="" class="header__links">%3$s</ul>'
										)
									);
								}
								?>
							</div>
						</div>
					</div>
				</nav> -->

			</div>

		</div>
	</header>


	<main>