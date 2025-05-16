<?php
/**
 * Temporary debug output to diagnose field access issues
 */

function add_story_debug_output() {
    // Only add for admins
    if (!current_user_can('administrator')) {
        return;
    }
    
    // Add to footer
    add_action('wp_footer', 'output_story_debug_info');
}
add_action('init', 'add_story_debug_output');

function output_story_debug_info() {
    if (!function_exists('get_field')) {
        return;
    }
    
    // Safely get fields
    $story_content = get_field('our_story', 'option');
    $story_content_exists = !empty($story_content);
    $story_content_length = $story_content ? strlen($story_content) : 0;
    $contact_file = get_field('contact-file', 'option');
    $contact_file_exists = !empty($contact_file);
    
    // Check all possible story field names
    $story_variations = [
        'our_story' => get_field('our_story', 'option'),
        'ourstory' => get_field('ourstory', 'option'),
        'our-story' => get_field('our-story', 'option'),
        'story' => get_field('story', 'option')
    ];
    
    ?>
    <!-- ACF Debug Info (only visible to admins) -->
    <script>
        console.log('ACF Debug Info:');
        console.log('Story field variations:');
        <?php foreach($story_variations as $name => $value): ?>
        console.log('<?php echo $name; ?> exists:', <?php echo json_encode(!empty($value)); ?>, 'length:', <?php echo json_encode(strlen($value ?? '')); ?>);
        <?php endforeach; ?>
        console.log('contact-file exists:', <?php echo json_encode($contact_file_exists); ?>);
        
        // Check all option fields
        console.log('All option fields:');
        <?php 
        if(function_exists('get_fields')) {
            $all_fields = get_fields('option');
            if(is_array($all_fields)) {
                foreach($all_fields as $key => $value) {
                    if(is_string($value)) {
                        echo "console.log('{$key}', 'type: string', 'length: " . strlen($value) . "');\n";
                    } else {
                        echo "console.log('{$key}', 'type: " . gettype($value) . "');\n";
                    }
                }
            }
        }
        ?>
    </script>
    <?php
}