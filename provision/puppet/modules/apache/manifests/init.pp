class apache 
{      
    package 
    { 
        "apache2":
            ensure  => present,
            require => [Exec["manager update"],Package['php5'], Package['php5-dev'], Package['php5-cli']]
    }

    file 
    { 
        "/etc/apache2/sites-available/local.vhost.conf":
            ensure  => present,
            owner => root, group => root,
            source  => "/var/www/resources/apache/vhost",
            require => Package['apache2'],
    }

    exec 
    { 
        "a2ensite localhost":
            command => "a2ensite local.vhost.conf",
            require => [Package['apache2'],File["/etc/apache2/sites-available/local.vhost.conf"]],
    }
    
    exec 
    { 
        "a2enmod rewrite":
            command => "a2enmod rewrite",
            require => Exec["a2ensite localhost"],
    }

    exec 
    { 
        "service apache2 restart":
            command => "/etc/init.d/apache2 restart",
            refreshonly => true,
            subscribe => [Exec["a2ensite localhost"], Exec["a2enmod rewrite"]],
    }

}
