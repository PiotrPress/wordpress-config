# WordPress Config

This library separates WordPress [configuration constants](https://wordpress.org/support/article/editing-wp-config-php/) from `wp-config.php` to `.config` file where they are stored in PHP associative array. 

## Installation

```shell
$ composer require piotrpress/wordpress-config
```

## Usage

1. Copy `wp-config.php` file from `res` directory to WordPress' root directory.
2. Copy `.config` file from `res` directory to WordPress' root directory.
3. Fill in the missing content in `.config` file.

## License

[MIT](license.txt)