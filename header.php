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
<!-- Meta Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '1156766178199284');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=1156766178199284&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
</head>
<body <?php body_class(); ?> style="background-image:url('<?php bloginfo('template_url'); ?>/assets/background.jpg');">

<div id="page" class="site">
	<header id="masthead" class="site-header">
        <div class="container">
            <div class="columns is-flex">
                <div class="logo column">
                    <a href="<?php echo get_home_url(); ?>" class="main-logo"><img width="300" height="300" src="<?php bloginfo('template_url'); ?>/assets/logo.png"></a>
                </div><!-- logo -->

                <div class="nav-col column is-narrow">
                    <nav id="site-navigation" class="main-navigation is-flex">
                       
                        <a href="#" class="button button-yellow ts-menu-trigger" data-modal="menu" target="_blank" rel="noopener noreferrer">Menu</a>
                       
                        <?php /* Always show the story button like contact */ ?>
                        <a href="#" class="button button-yellow ts-story-trigger" data-modal="story">Story</a>
                        
                        <?php if(get_field('contact-file','option')):  ?>
                            <a href="#" class="button button-yellow ts-contact-trigger" data-modal="contact">Contact</a>
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

                    <?php if(get_field('soundcloud','option') ) : ?>
                        <a class="social-icon" href="<?php the_field('soundcloud','option'); ?>" target="_blank" rel="noopener noreferrer">
                            <span class="social-icon--holder sc"></span>
                        </a>
                    <?php endif; ?>
                </div><!-- socialcol -->

            </div><!-- columns -->
	    </div><!-- container -->
    </header><!-- #masthead -->

<div id="content" class="site-content">
