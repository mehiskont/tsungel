<div id="modal-story" class="story-popup modal modal-fx-3dFlipVertical">
    <div class="modal-background yellow">
        <img class="modal-ape" src="<?php bloginfo('template_url'); ?>/assets/img--ahv.png" alt="ahv"/>
    </div>
    <div class="modal-content overflow-hidden">
        <div class="columns is-centered">
            <div class="column is-narrow">
                <div class="modal-content--inner">
                    <div class="modal-story-content box">
                    <img class="box--bg" src="<?php bloginfo('template_url'); ?>/assets/img--menumodal.png" alt="story bg">
                        <div class="box--content">
                            <?php
                            // Get the story content
                            if(function_exists('get_field')) {
                                $story_content = get_field('our-story', 'option');
                                
                                if(!empty($story_content)) {
                                    // Simple solution - display with positioning to fit in the oval
                                    echo '<div class="story-text">' . $story_content . '</div>';
                                } else {
                                    // Only show to administrators
                                    if(current_user_can('administrator')) {
                                        echo '<div class="admin-notice">';
                                        echo '<p><strong>Admin Notice:</strong> Please add content to the "Our Story" field in Theme Settings.</p>';
                                        echo '</div>';
                                    } else {
                                        echo '<p>Our story will be coming soon...</p>';
                                    }
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