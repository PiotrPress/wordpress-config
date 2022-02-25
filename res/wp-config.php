<?php declare( strict_types = 1 );

@ini_set( 'display_errors', '0' );

require_once __DIR__ . '/vendor/autoload.php';

try { PiotrPress\WordPress\Config::load( __DIR__ ); }
catch ( Exception $e ) { trigger_error( $e->getMessage(), E_USER_ERROR ); }

$table_prefix = defined( 'DB_PREFIX' ) ? DB_PREFIX : 'wp_';

if ( ! defined( 'ABSPATH' ) ) define( 'ABSPATH', __DIR__ . '/' );
require_once( ABSPATH . 'wp-settings.php' );