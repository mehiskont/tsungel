<div id="modal-contact" class="contact-popup modal modal-fx-3dFlipVertical">
    <div class="modal-background">
        <img class="modal-ape" src="<?php bloginfo('template_url'); ?>/assets/img--ahv.png" alt="ahv"/>
    </div>
    <div class="modal-content overflow-hidden">
        <div class="columns is-centered">
            <div class="column is-narrow">
                <div class="modal-content--inner">
                    <div class="modal-contact box">
                        
                        <img class="box--bg" src="<?php bloginfo('template_url'); ?>/assets/img--kontakt.png" alt="kontakt bg" />
                        
                        <div class="box--content">
                            <?php the_field('contact-details','option'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="close-modal modal-close">×</a>
</div><!-- bulm modal -->