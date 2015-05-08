class php
{
  $packages = [
    "php5",
    "php5-cli",
    "php5-mysql",
    "php5-dev",
    "php-pear",
    "php-apc",
    "php5-mcrypt",
    "php5-gd",
    "php5-curl",
    "php5-xdebug",
    "php5-intl",
    "php5-sqlite"
    ]

    package
    {
      $packages:
        ensure  => latest,
    }

}
