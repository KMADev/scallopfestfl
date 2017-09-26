<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kmaevent
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-64266966-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments)};
    gtag('js', new Date());

    gtag('config', 'UA-64266966-1');
</script>
<meta name="google-site-verification" content="7yW6uXBDZKIWY9w7g4adTaAagAy1C6yHoR7krxcptiU" />
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'kmaevent' ); ?></a>

    <div class="hidden-lg-up">
        <div class="collapse navbar-toggleable-sm justify-content-center" id="mobile-nav">
            <?php wp_nav_menu(
                array(
                    'theme_location'  => 'mobile-menu',
                    'container_class' => 'navbar',
                    'container_id'    => 'navbarMobile',
                    'menu_class'      => 'navbar-nav justify-content-center text-center',
                    'fallback_cb'     => '',
                    'menu_id'         => 'mobile-menu',
                    'walker'          => new WP_Bootstrap_Navwalker(),
                )
            ); ?>
        </div>
    </div>
    <div class="hidden-lg-up">
        <div class="logo mobile">
            <a href="/"><img src="<?php echo get_template_directory_uri() . '/img/logo.png'; ?>" alt="Florida Scallop & Music Festival" class="logo-img img-fluid"></a>
        </div>
    </div>
    <div id="top-top">
        <div class="container hidden-md-down">
            <div class="row">
                <div class="col">
                    <div class="social">
                    <?php
                    $socialLinks = getSocialLinks('svg','circle');
                    if(is_array($socialLinks)) {
                        foreach ( $socialLinks as $socialId => $socialLink ) {
                            echo '<a class="' . $socialId . '" href="' . $socialLink[0] . '" target="_blank" >' . $socialLink[1] . '</a>';
                        }
                    }
                    ?>
                    </div>
                </div>
                <div class="col text-md-right my-auto">
	                <?php wp_nav_menu(
		                array(
			                'theme_location'  => 'mini-top-right',
			                'container_class' => 'navbar',
			                'container_id'    => 'navbarMini',
			                'menu_class'      => 'navbar-nav ml-auto text-right',
			                'fallback_cb'     => '',
			                'menu_id'         => 'mini-menu',
			                'walker'          => new WP_Bootstrap_Navwalker(),
		                )
	                ); ?>
                </div>
            </div>
        </div>
    </div>
    <div id="top" class="text-right">
        <div class="hidden-lg-up">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile-nav">
                MENU
                <span class="icon-box">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </span>
            </button>
            <div class="social my-auto">
                <?php
    		    $socialLinks = getSocialLinks('svg','circle');
                if(is_array($socialLinks)) {
                    foreach ( $socialLinks as $socialId => $socialLink ) {
                        echo '<a class="' . $socialId . '" href="' . $socialLink[0] . '" target="_blank" >' . $socialLink[1] . '</a>';
                    }
                }
                ?>
            </div>
        </div>
        <div class="hidden-md-down">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col text-md-left my-auto">
	                    <?php wp_nav_menu(
		                    array(
			                    'theme_location'  => 'top-left',
			                    'container_class' => 'navbar',
			                    'container_id'    => 'navbarLeft',
			                    'menu_class'      => 'navbar-nav mr-auto text-left',
			                    'fallback_cb'     => '',
			                    'menu_id'         => 'left-menu',
			                    'walker'          => new WP_Bootstrap_Navwalker(),
		                    )
	                    ); ?>
                    </div>
                    <div class="col-lg-2 col-xl-3 mh-auto">
                        <div class="logo desktop text-center mh-auto">
                            <a href="/"><img src="<?php echo get_template_directory_uri() . '/img/logo.png'; ?>" alt="Florida Scallop & Music Festival" class="logo-img img-fluid"></a>
                        </div>
                    </div>
                    <div class="col text-md-right my-auto">
	                    <?php wp_nav_menu(
		                    array(
			                    'theme_location'  => 'top-right',
			                    'container_class' => 'navbar',
			                    'container_id'    => 'navbarRight',
			                    'menu_class'      => 'navbar-nav ml-auto text-right',
			                    'fallback_cb'     => '',
			                    'menu_id'         => 'right-menu',
			                    'walker'          => new WP_Bootstrap_Navwalker(),
		                    )
	                    ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header id="masthead" class="site-header">

    </header>



