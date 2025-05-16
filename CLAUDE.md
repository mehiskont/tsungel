# Tsungel WordPress Theme Documentation

## Overview

Tsungel is a custom WordPress theme built for a restaurant/bar with a focus on visual appeal and content management through Advanced Custom Fields (ACF). The theme uses a modular architecture with a modern build system.

## Theme Structure

```
tsungel/
├── _sass/                  # SCSS files organized by function
│   ├── components/         # UI component styles
│   ├── core/               # Variables, mixins, fonts, buttons
│   ├── layout/             # Page-specific layouts
│   └── vendors/            # Third-party CSS customizations
├── assets/                 # Static files (images, fonts)
│   ├── fonts/              # Custom "Attic" font files
│   └── *.png, *.jpg        # Theme images
├── build/                  # Compiled assets
├── inc/                    # Core PHP functionality files
│   ├── acf-fields.php      # ACF field definitions
│   ├── actions.php         # WordPress hooks and actions
│   ├── customizer.php      # Theme customizer settings
│   ├── filters.php         # WordPress filters
│   ├── global-functions.php# Core theme functions
│   └── ...                 # Other functionality modules
├── partials/               # Reusable template parts
│   ├── modal-content.php   # Contact modal
│   ├── modal-menu.php      # Menu modal
│   └── modal-story.php     # Our Story modal
├── scripts/                # JavaScript source files
│   ├── src/                # JS source code
│   │   ├── routes/         # Page-specific JavaScript
│   │   └── util/           # Utility functions
│   ├── build.js            # Build script
│   ├── start.js            # Development script
│   └── webpack.config.js   # Webpack configuration
├── functions.php           # Core theme functions file
├── header.php              # Site header
├── footer.php              # Site footer
├── style.css               # Theme metadata
└── template-*.php          # Custom page templates
```

## ACF Integration

Advanced Custom Fields is central to the theme's functionality, providing a user-friendly way to manage theme settings and content.

### Theme Settings Page

The theme creates a "Theme General Settings" page in the WordPress admin (configured in `inc/customizer.php`):

```php
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' 	=> 'Theme General Settings',
        'menu_title'	=> 'Theme Settings',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));
}
```

### Key ACF Fields

The theme uses the following ACF option fields:

| Field Name | Type | Usage |
|------------|------|-------|
| `facebook` | URL | Facebook link in header |
| `instagram` | URL | Instagram link in header |
| `menutitle` | Text | Title for menu modal |
| `day` | File/Link | Day menu PDF |
| `night` | File/Link | Night menu PDF |
| `brunch` | File/Link | Brunch menu PDF |
| `contact-details` | WYSIWYG | Contact information |
| `our story` | WYSIWYG | Restaurant story content |

### Accessing ACF Fields

Fields are accessed using the `get_field()` or `the_field()` functions with the 'option' parameter:

```php
// Example: Get Facebook URL
$facebook_url = get_field('facebook', 'option');

// Example: Output contact details
the_field('contact-details', 'option');

// Example: Use "our story" field (note the space in the field name)
$story_content = get_field('our story', 'option');
```

## Navbar/Header System

The header (`header.php`) contains the main site navigation and is built with Bulma CSS framework.

### Structure

```
+---------------------------------------------------------------+
| Logo        |                   | Menu | Story | Contact | Social |
+---------------------------------------------------------------+
```

### Navigation Elements

1. **Logo**: Links to the home page
   ```php
   <a href="<?php echo esc_url(home_url('/')); ?>">
     <img class="logo" src="<?php bloginfo('template_url'); ?>/assets/logo.png" alt="<?php bloginfo('name'); ?>"/>
   </a>
   ```

2. **Menu Button**: Opens the menu modal with PDF links
   ```php
   <a href="#" class="button button-yellow menu-modal">Menu</a>
   ```

3. **Story Button**: Opens the story modal with restaurant story
   ```php
   <a href="#" class="button button-yellow story-modal">Story</a>
   ```

4. **Contact Button**: Opens the contact modal
   ```php
   <a href="#" class="button contact-modal">Contact</a>
   ```

5. **Social Icons**: Conditionally displayed based on ACF fields
   ```php
   <?php if(get_field('facebook','option')): ?>
   <a href="<?php the_field('facebook','option'); ?>" target="_blank">
     <img src="<?php bloginfo('template_url'); ?>/assets/icon--fb.png" alt="facebook"/>
   </a>
   <?php endif; ?>
   ```

## Modal System

The theme uses a robust modal system to display content without page navigation.

### Modal Types

1. **Menu Modal** (`modal-menu.php`): 
   - Shows buttons linking to menu PDFs
   - Styled with a yellow background
   - Uses ACF fields 'menutitle', 'day', 'night', 'brunch'

2. **Story Modal** (`modal-story.php`):
   - Displays restaurant story content
   - Uses ACF field 'our story'
   - Styled similar to the menu modal with a yellow background

3. **Contact Modal** (`modal-content.php`):
   - Shows contact information
   - Uses ACF field 'contact-details'
   - Styled with a regular background

### Modal Implementation

1. **HTML Structure**:
   ```php
   <div id="modal-story" class="story-popup modal modal-fx-3dFlipVertical">
       <div class="modal-background yellow">
           <img class="modal-ape" src="<?php bloginfo('template_url'); ?>/assets/img--ahv.png" alt="ahv"/>
       </div>
       <div class="modal-content">
           <!-- Modal content here -->
       </div>
   </div>
   ```

2. **Loading Modals**: Modals are included in the footer
   ```php
   <?php get_template_part('partials/modal','content'); ?>
   <?php get_template_part('partials/modal','menu'); ?>
   <?php get_template_part('partials/modal','story'); ?>
   ```

3. **JavaScript Triggers**:
   ```javascript
   // Story modal trigger
   $('.story-modal').click(function(e) {
     e.preventDefault();
     $('.story-popup').addClass('is-active');
   });
   
   // Modal close functionality
   $('.close-modal, .modal-background').click(function() {
     $('.story-popup').removeClass('is-active');
   });
   ```

## CSS/SCSS Organization

The theme uses SCSS with a well-organized structure:

1. **Core**: `_sass/core/`
   - `_variables.scss`: Color schemes, breakpoints
   - `_mixins.scss`: Reusable style mixins
   - `_fonts.scss`: Font definitions
   - `_buttons.scss`: Button styles

2. **Components**: `_sass/components/`
   - `_header.scss`: Header styling
   - `_footer.scss`: Footer styling
   - `_modal.scss`: Modal styling

3. **Layout**: `_sass/layout/`
   - `_default.scss`: Default page layout
   - `_home.scss`: Home page specific layout

4. **Vendor Customizations**: `_sass/vendors/`
   - `_bulma-custom.scss`: Bulma framework customizations

## JavaScript Architecture

The theme uses a modular JavaScript approach with Webpack:

1. **Entry Point**: `scripts/src/index.js`
2. **Router System**: `scripts/src/util/Router.js`
3. **Route-Specific Code**: `scripts/src/routes/`
4. **Common Code**: `scripts/src/routes/common.js` (runs on all pages)

## Build System

Uses Webpack for asset compilation:

1. **Configuration**: `scripts/webpack.config.js`
2. **Development**: `npm run start`
3. **Production**: `npm run build`

## Key Files for Development

When making changes to the theme, focus on these key files:

1. **Theme Options**: `inc/customizer.php`
2. **ACF Fields**: Managed through WordPress admin
3. **JavaScript**: `scripts/src/routes/common.js`
4. **CSS**: `_sass/components/_*.scss`
5. **Templates**: `header.php`, `footer.php`, `partials/*.php`

## Common Tasks

### Adding a New Modal

1. Create a new file in `partials/` (e.g., `modal-events.php`)
2. Add it to `footer.php`:
   ```php
   <?php get_template_part('partials/modal','events'); ?>
   ```
3. Create a button trigger in `header.php`:
   ```php
   <a href="#" class="button events-modal">Events</a>
   ```
4. Add JavaScript in `scripts/src/routes/common.js` or create a custom JS file:
   ```javascript
   $('.events-modal').click(function(e) {
     e.preventDefault();
     $('.events-popup').addClass('is-active');
   });
   ```

### Adding New ACF Fields

Fields should be added through the WordPress ACF admin interface to maintain consistency. For new option fields:

1. Navigate to Custom Fields → Field Groups → Add New
2. Set "Location" to "Options Page" equals "Theme General Settings"
3. Add your fields
4. Access in code with:
   ```php
   get_field('your_field_name', 'option');
   ```

## Troubleshooting

### Modal Content Not Displaying

1. Check the field name in WordPress admin
2. Verify ACF field access in code (note spaces in field names)
3. Check JavaScript triggers in browser console
4. Verify modal includes in footer.php

### CSS Changes Not Appearing

1. Ensure SCSS is compiled with `npm run build`
2. Check browser cache (hard refresh)
3. Verify selector specificity

### JavaScript Functionality Issues

1. Check browser console for errors
2. Verify jQuery selectors match HTML
3. Ensure script is properly enqueued in `inc/actions.php`