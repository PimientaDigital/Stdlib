class apache 
{      
    package 
    { 
        "apache2":
            ensure  => present,
            require => [Exec["manager update"],Package['php5'], Package['php5-dev'], Package['php5-cli']]
    }
    

    #file 
    #{ 
        #"/etc/apache2/sites-available/local.vhost.conf":
            #ensure  => present,
            #owner => root, group => root,
            #source  => "/var/www/resource/apache/vhost",
            #require => Package['apache2'],
    #}

    #exec 
    #{ 
        #"a2ensite localhost":
            #command => "a2ensite local.vhost.conf",
            #require => [Package['apache2'],file["/etc/apache2/sites-available/local.vhost.conf"]],
    #}
    
    exec 
    { 
        "a2enmod rewrite":
            command => "a2enmod rewrite",
            require => Package["apache2"],
    }

    exec 
    { 
        "service apache2 restart":
            command => "/etc/init.d/apache2 restart",
            require => Exec["a2enmod rewrite"],
    }

}
