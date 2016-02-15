# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|
  config.vm.box = "deimosfr/debian-jessie"

  config.vm.network "private_network", ip: "192.168.33.10"

  config.vm.synced_folder ".", "/var/www/deployer", type: 'nfs', :nfs => { :mount_options => ["dmode=777","fmode=777"] }
  # config.vm.synced_folder "../data", "/vagrant_data"

  config.vm.provider "virtualbox" do |vb|
    # Display the VirtualBox GUI when booting the machine
    vb.gui = true
    # Customize the amount of memory on the VM:
    vb.memory = "512"
  end
  
  config.vm.provision "shell", inline: <<-SHELL
    #apt-get install -y software-properties-common
    
    echo 'deb http://packages.dotdeb.org jessie all' >> /etc/apt/sources.list
    echo 'deb-src http://packages.dotdeb.org jessie all'  >> /etc/apt/sources.list

    wget https://www.dotdeb.org/dotdeb.gpg
    apt-key add dotdeb.gpg

    apt-get update
    sudo apt-get install -y mysql-server
    sudo apt-get install -y apache2
    sudo apt-get install -y php7.0
    sudo apt-get install -y php7.0-mysql
    sudo apt-get install -y php7.0-curl

    sudo cp /var/www/deployer/deployer-apache.conf /etc/apache2/sites-available/deployer.conf
    sudo a2ensite deployer.conf
    sudo a2dissite 000-default.conf

    sudo service apache2 restart

    php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php
    php -r "if (hash('SHA384', file_get_contents('composer-setup.php')) === '781c98992e23d4a5ce559daf0170f8a9b3b91331ddc4a3fa9f7d42b6d981513cdc1411730112495fbf9d59cffbf20fb2') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); }"
    php composer-setup.php

    sudo php composer-setup.php --install-dir=/usr/bin
    sudo ln -s /usr/bin/composer.phat /usr/bin/composer

    rm composer-setup.php

    echo 'CREATE DATABASE IF NOT EXISTS deployer;' | mysql -u root -p

    cd /var/www/deployer
    composer install
  SHELL
end
