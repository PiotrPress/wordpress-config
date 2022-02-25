<?php declare( strict_types = 1 );

namespace PiotrPress\WordPress;

if ( ! \class_exists( __NAMESPACE__ . '\Config' ) ) {
    class Config {
        static public function load( string $path ) {
            switch ( true ) {
                case ( \is_file( $path = \rtrim( $path, '/' ) ) ) : break;
                case ( \is_dir( $path ) and \is_file( $path .= '/.config' ) ) : break;
                default : throw new \RuntimeException( 'Config file does not exists.' );
            }

            foreach ( require_once( $path ) as $name => $value )
                if ( ! @\define( $name, $value ) ) throw new \RuntimeException( 'Failed to define constant.' );
        }
    }
}