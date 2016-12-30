<?php

// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Anthology Pro' );
define( 'CHILD_THEME_URL', 'https://evermo.re' );
define( 'CHILD_THEME_VERSION', '1.0' );

// Start the engine
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove)
load_child_theme_textdomain( 'anthology-pro', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'anthology-pro' ) );

// Enqueue scripts and styles
include_once( get_stylesheet_directory() . '/lib/enqueue.php' );

// Add Image upload and Color select to WordPress Theme Customizer
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Markup and Support
include_once( get_stylesheet_directory() . '/lib/markup-support.php' );

// Alter Default Genesis Structure
include_once( get_stylesheet_directory() . '/lib/alter-structure.php' );

// Markup and Support
include_once( get_stylesheet_directory() . '/lib/nav.php' );

// Widgets
include_once( get_stylesheet_directory() . '/lib/widgets.php' );

// Conditional Content Relationships
include_once( get_stylesheet_directory() . '/lib/content-relationships.php' );

// Podcasting Capabilities
include_once( get_stylesheet_directory() . '/lib/podcasting.php' );

// Edit Single
include_once( get_stylesheet_directory() . '/lib/single.php' );