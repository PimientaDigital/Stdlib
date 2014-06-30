class php
{
  $packages = [
    "php5",
    "php5-cli",
    "php5-mysql",
    "php-pear",
    "php5-dev",
    "php-apc",
    "php5-mcrypt",
    "php5-gd",
    "php5-curl",
    "libapache2-mod-php5",
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
