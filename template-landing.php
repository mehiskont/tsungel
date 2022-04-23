<?php 
/* Template name: landing */
get_header(); ?>

<div id="primary" class="content-area">

            <img class="balta is-hidden-mobile" src="<?php bloginfo('template_url'); ?>/assets/img--balta.png" alt="Tšungel Baltijaamas">
            <img class="hands hands-1 is-hidden-mobile" src="<?php bloginfo('template_url'); ?>/assets/img--hands-1.png" alt="Hands Tšungel" />
            <img class="hands hands-2 is-hidden-mobile" src="<?php bloginfo('template_url'); ?>/assets/img--hands-2.png" alt="Hands Tšungel" />
            <!-- illukad -->
            <img class="frog shake-animation is-hidden-mobile" src="<?php bloginfo('template_url'); ?>/assets/img--konn-01.png" alt="Konn Tšungel" />
            <img class="bug shake-animation" src="<?php bloginfo('template_url'); ?>/assets/img--putukas-01.png" alt="Putukas Tšungel" />

            <img class="bat shake-animation is-hidden-mobile" src="<?php bloginfo('template_url'); ?>/assets/img--nahkhiir-01.png" alt="Nahkhiir Tšungel" />
            <img class="apes shake-animation" src="<?php bloginfo('template_url'); ?>/assets/img--ahvid-tantsivad-01.png" alt="Ahvid Tšungel" />

            <img class="croc shake-animation is-hidden-mobile" src="<?php bloginfo('template_url'); ?>/assets/img--krokodill-01.png" alt="Krokodill Tšungel" />
            <img class="snake shake-animation" src="<?php bloginfo('template_url'); ?>/assets/img--uss-01.png" alt="Ahvid Tšungel" />
            <img class="tiger shake-animation" src="<?php bloginfo('template_url'); ?>/assets/img--tiiger-01.png" alt="Tiiger Tšungel" />

            <img class="trees trees-1 is-hidden-mobile" src="<?php bloginfo('template_url'); ?>/assets/img--puud-01.png" alt="Trees Tšungel" />
            <img class="trees trees-2 " src="<?php bloginfo('template_url'); ?>/assets/img--puud-01.png" alt="Trees Tšungel" />
            <img class="trees trees-3" src="<?php bloginfo('template_url'); ?>/assets/img--puud-01.png" alt="Trees Tšungel" />

</div><!-- .content-area -->
<script>
const appHeight = () => {
 const doc = document.documentElement
 doc.style.setProperty(‘ — app-height’, `${window.innerHeight}px`)
}
window.addEventListener(‘resize’, appHeight)
appHeight()
</script>
<style>
:root {
 — app-height: 100%;
}
html,
body {
 padding: 0;
 margin: 0;
 overflow: hidden;
 width: 100vw;
 height: 100vh;
 height: var( — app-height);
}
</style>
<?php get_footer(); ?>