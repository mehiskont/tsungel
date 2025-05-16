<?php

// Theme
add_theme_support('post-thumbnails');

function scripts() {

    if ($assetsConfig = @file_get_contents(__DIR__ . '/../build/assets.json', true)) {
      $manifest = json_decode($assetsConfig);
      $main = $manifest->main;
      if ($main->css) {
        wp_enqueue_style('theme-css', /*get_template_directory_uri() . "/build/" .*/ $main->css,  false, null);
      }
      if ($main->js) {
        wp_enqueue_script('theme-js', /*get_template_directory_uri() . "/build/" .*/ $main->js, ['jquery'], null, true);

        wp_localize_script(
          'theme-js',
          'Ajax',
          [
            'url'  => admin_url( 'admin-ajax.php' )
          ]
        );
      }
    }
    
    // Add Bulma Modal FX from CDN
    wp_enqueue_style('bulma-modal-fx', 'https://unpkg.com/bulma-modal-fx/dist/css/modal-fx.min.css', [], null);
}
add_action( 'wp_enqueue_scripts', 'scripts' );