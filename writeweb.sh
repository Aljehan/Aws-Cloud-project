apt-get update
apt-get install -y apache2 php libapache2-mod-php php-mysql


cp /vagrant/test-website2.conf /etc/apache2/sites-available/
# activate our website configuration ...
a2ensite test-website2
# ... and disable the default website provided with Apache
a2dissite 000-default
# Reload the webserver configuration, to pick up our changes
service apache2 reload
