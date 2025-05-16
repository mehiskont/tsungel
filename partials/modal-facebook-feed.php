
<div id="modal-facebook" class="facebook-popup modal modal-fx-3dFlipVertical">
    <div class="modal-background yellow">
        <img class="modal-ape" src="<?php bloginfo('template_url'); ?>/assets/img--ahv.png" alt="ahv"/>
    </div>
    <div class="modal-content overflow-hidden">
        <div class="columns is-centered">
            <div class="column is-narrow">
                <div class="modal-content--inner">
                    <div class="modal-facebook-content box">
                    <img class="box--bg" src="<?php bloginfo('template_url'); ?>/assets/img--menumodal.png" alt="story bg">
                        <div class="box--content">
                            <?php
                            // Display the Facebook feed using its shortcode
                            if (shortcode_exists('custom-facebook-feed')) {
                                echo do_shortcode('[custom-facebook-feed feed=1]'); // Or your specific feed ID
                            } else {
                                // Only show to administrators if shortcode doesn't exist
                                if(current_user_can('administrator')) {
                                    echo '<div class="admin-notice">';
                                    echo '<p><strong>Admin Notice:</strong> The "custom-facebook-feed" shortcode is not available. Please ensure the Smash Balloon plugin is active.</p>';
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="close-modal modal-close">×</a>
</div><!-- bulma modal -->