<?php declare( strict_types = 1 );

namespace PiotrPress\WordPress;

use PiotrPress\Configer;
use PiotrPress\Remoter\Url;
use PiotrPress\Remoter\Request;

if ( ! \class_exists( __NAMESPACE__ . '\Config' ) ) {
    class Config {
        static protected array $defaults = [
            'DB_NAME' => '',
            'DB_USER' => '',
            'DB_PASSWORD' => '',
            'DB_HOST' => 'localhost',
            'DB_CHARSET' => 'utf8',
            'DB_COLLATE' => '',
            'AUTH_KEY' => '',
            'SECURE_AUTH_KEY' => '',
            'LOGGED_IN_KEY' => '',
            'NONCE_KEY' => '',
            'AUTH_SALT' => '',
            'SECURE_AUTH_SALT' => '',
            'LOGGED_IN_SALT' => '',
            'NONCE_SALT' => '',
            'WP_DEBUG' => false
        ];

        static public function salt( string $file ) : void {
            $response = ( new Request( new URL( 'https://api.wordpress.org/secret-key/1.1/salt/' ), 'GET' ) )->send();
            if ( 200 !== (int)$response->getHeader()->get( 'code' ) ) throw new \RuntimeException( 'Failed to download salts.' );

            \preg_match_all("/define\('(.*)',\s*'(.*)'\);/", $response->getContent(), $matches, \PREG_SET_ORDER );
            if ( ! $matches ) throw new \RuntimeException( 'Failed to generate salts.' );

            $config = new Configer( $file );
            foreach ( $matches as $match ) {
                list( , $name, $value ) = $match;
                $config[ $name ] = $value;
            }
            if ( ! $config->save() ) throw new \RuntimeException( "Failed to save salts to file: $file." );
        }

        static public function setup( string $file, array $data = [] ) : void {
            $config = new Configer( $file, self::$defaults );
            foreach ( $data as $name => $value ) $config[ $name ] = $value;
            if ( ! $config->save() ) throw new \RuntimeException( "Failed to save data to file: $file." );
        }

        static public function load( string $file ) : void {
            if ( ! \is_file( $file ) ) {
                self::setup( $file );
                self::salt( $file );
            }

            foreach ( ( new Configer( $file ) ) as $name => $value )
                if ( ! @\define( $name, $value ) ) throw new \RuntimeException( "Failed to define constant: $name." );
        }
    }
}