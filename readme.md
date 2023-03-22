# WordPress Config

This library separates WordPress [configuration constants](https://wordpress.org/support/article/editing-wp-config-php/) from `wp-config.php` to `.config` file where they are stored in PHP associative array. 

## Installation via `composer.json` file

```json
{
  "require": {
    "piotrpress/wordpress-config": "^2.0"
  },
  "scripts": {
    "post-update-cmd": "php -r \"copy('vendor/piotrpress/wordpress-config/res/wp-config.php', 'wp-config.php');\""
  }
}
```

**NOTE:** if `.config` file doesn't exists, it'll be created automatically.

## Usage

Fill in the missing configuration in `.config` file.

## Resources

Check out example implementation in the [piotrpress/wordpress](https://github.com/PiotrPress/wordpress) package.

## Requirements

PHP >= `7.4` version.

## License

[MIT](license.txt)