<?php get_header(); ?>

<div id="primary" class="content-area">

<div class="content-wrap">        
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-8">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>
</div><!-- our default content -->

</div><!-- .content-area -->
<?php get_footer(); ?>