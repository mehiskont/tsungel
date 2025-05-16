<div id="modal-menu" class="menu-popup modal modal-fx-3dFlipVertical">
    <div class="modal-background yellow">
        <img class="modal-ape" src="<?php bloginfo('template_url'); ?>/assets/img--ahv.png" alt="ahv"/>
    </div>
    <div class="modal-content overflow-hidden">
        <div class="columns is-centered">
            <div class="column is-narrow">
                <div class="modal-content--inner">
                    <div class="modal-menu-content box">
                       <img class="box--bg" src="<?php bloginfo('template_url'); ?>/assets/img--menumodal.png" alt="menumodal bg" />
                        <div class="box--content formenu">
                            <div class="modal-menu has-text-centered">
                                <?php if(get_field('menutitle','option')): ?><h2><?php the_field('menutitle','option'); ?></h2><?php endif; ?>
                                <div class="is-flex modal-menu--buttons">
                                    
                                    <?php
                                    $link = get_field('day','option');
                                    if( $link ):
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                                    <a href="<?php echo $link_url; ?>" class="button button-larger" target="<?php echo esc_attr($link_target); ?>">
                                        <?php echo esc_html($link_title); ?>
                                    </a>
                                    <?php endif; ?><!-- day menu -->

                                    <?php
                                    $link = get_field('night','option');
                                    if( $link ):
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                                    <a href="<?php echo $link_url; ?>" class="button button-larger" target="<?php echo esc_attr($link_target); ?>">
                                        <?php echo esc_html($link_title); ?>
                                    </a>
                                    <?php endif; ?><!-- day menu -->

                                                                        <?php
                                    $link = get_field('brunch','option');
                                    if( $link ):
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                                    <a href="<?php echo $link_url; ?>" class="button button-larger" target="<?php echo esc_attr($link_target); ?>">
                                        <?php echo esc_html($link_title); ?>
                                    </a>
                                    <?php endif; ?><!-- day menu -->
                          
                                    

                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="close-modal modal-close">×</a>
</div><!-- bulm modal -->