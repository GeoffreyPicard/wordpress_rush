<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head profile="http://gmpg.org/xfn/11">

<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<title><?php wp_title( '-', true, 'right' ); echo wp_specialchars( get_bloginfo('name'), 1 ) ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.css" type="text/css" media="screen" />

	<!--[if lte IE 6]><script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/supersleight-min.js"></script><![endif]-->
<?php wp_enqueue_script(get_bloginfo('template_directory').'/js/jquery.js'); ?>
<?php wp_enqueue_script('superfish', get_bloginfo('template_directory').'/js/superfish.js', array('jquery'), '1.7'); ?>
<?php wp_enqueue_script(get_bloginfo('template_directory').'/js/nav.js'); ?>
<?php if (trim(get_option('ft_header_code')) <> "") { echo stripslashes(get_option('ft_header_code')); } ?>
<?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>

<?php wp_head(); ?> <!-- #NE PAS SUPPRIMER cf. codex wp_head() -->
</head>
<body <?php body_class() ?>>
<div id="header">
	<div class="pads clearfix header_top">
		<a href="<?php echo get_option('home'); ?>">
			<img id="site-logo" src="https://www.hautehorlogerie.org/uploads/tx_fhhbrands/chopard_logo-white-400.png" alt="<?php bloginfo('name'); ?>" />
		</a>
		<!--<div id="blocsearch"> <?php include('searchfor	m.php'); ?></div>-->
		<div class="header_button_top">
			<?php if (!is_front_page()) : include('searchform.php'); endif; ?>
			<button type="button" class="button_annonce">Publier votre annonce</button>
			<?php if (is_user_logged_in()) : ?>
				<a type="button" class="button_connect" href="<?php echo wp_logout_url("http://localhost:8888/"); ?>"> SE DECONNECTER</a>
			<?php endif;?>
			<?php if (!is_user_logged_in()) : ?>
				<a type="button" class="button_connect" href="<?php echo wp_login_url("http://localhost:8888/"); ?>"> SE CONNECTER</a>
				<a type="button" class="button_connect" href="<?php echo wp_registration_url("http://localhost:8888/"); ?>"> S'INSCRIRE</a>
			<?php endif;?>
		</div>
	</div>
	<div class="welcome">
		<p class="welcome_home">BIENVENUE A LA MAISON</p>
		<p class="welcome_text">Louer des logements uniques auprès d'hôtes locaux dans 190+ pays.</p>
		<a href="http://localhost:8888/?page_id=6"><button class="mode_emploi">MODE D'EMPLOI</button></a>
	</div>
	<div class="header_bottom">
		<div class="header_bottom_button">
			<?php if (is_front_page()) : include('searchform.php'); endif; ?>
		</div>
	</div>
</div><!--  #header -->

<div id="container">
	<div class="pads clearfix">