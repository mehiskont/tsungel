<?php
/**
 * The header for our theme
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<title><?php wp_title(); ?></title>
</head>
<body <?php body_class(); ?> style="background-image:url('<?php the_post_thumbnail_url(); ?>');">

<div id="page" class="site">
	<header id="masthead" class="site-header">
        <div class="container">
            <div class="columns">
                <div class="logo column">
                    <a href="<?php echo get_home_url(); ?>" class="main-logo"><img width="300" height="300" src="<?php bloginfo('template_url'); ?>/assets/logo.png"></a>
                </div><!-- logo -->

                <div class="nav-col column is-narrow">
                    <nav id="site-navigation" class="main-navigation is-flex">
                        <?php if(get_field('menu-file','option')): ?>
                            <a href="<?php the_field('menu-file','option'); ?>" class="button" target="_blank" rel="noopener noreferrer">Menüü</a>
                        <?php endif; ?>
                        <?php if(get_field('contact-file','option')):  ?>
                            <a href="#" class="button button-yellow contact-modal">Kontakt</a>
                        <?php endif; ?>
                    </nav><!-- #site-navigation -->
                </div><!-- nav-col -->

                <div class="column footer-bottom--social is-narrow">
                    <?php if(get_field('facebook','option') ) : ?>
                        <a class="social-icon" href="<?php the_field('facebook','option'); ?>" target="_blank" rel="noopener noreferrer">
                            <span class="social-icon--holder fb"></span>
                        </a>
                    <?php endif; ?>
                    <?php if(get_field('instagram','option') ) : ?>
                        <a class="social-icon" href="<?php the_field('instagram','option'); ?>" target="_blank" rel="noopener noreferrer">
                            <span class="social-icon--holder ig"></span>
                        </a>
                    <?php endif; ?>
                </div><!-- socialcol -->

            </div><!-- columns -->
	    </div><!-- container -->
    </header><!-- #masthead -->

<div id="content" class="site-content">
