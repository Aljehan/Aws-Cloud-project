# -*- mode: ruby -*-
# vi: set ft=ruby :
class Hash
  def slice(*keep_keys)
    h = {}
    keep_keys.each { |key| h[key] = fetch(key) if has_key?(key) }
    h
  end unless Hash.method_defined?(:slice)
  def except(*less_keys)
    slice(*keys - less_keys)
  end unless Hash.method_defined?(:except)
end

# A Vagrantfile to set up two VMs, a webserver and a database server,
# connected together using an internal network with manually-assigned
# IP addresses for the VMs.

Vagrant.configure("2") do |config|
  # The AWS provider does not actually need to use a Vagrant box file.
  config.vm.box = "dummy"

  config.vm.provider :aws do |aws, override|

    # security information from aws server
    aws.access_key_id = "ASIA4RJWHJFI4WHSFAUW"
    aws.secret_access_key = "FV18TMCOaknKwa/4kXnNVaJRrEKZfIAX0zZ26kg/"
    aws.session_token = "FwoGZXIvYXdzEFQaDAtHq8r+JrH60BDvsCLLAVDfXjANfkJjlCGFw1jblrJI8yNXq2ym1Z1WxCVOT4RczWEeBdJF5uFQGU7QzP2r0m0t/X/s2WFu/AoC6gXfAwpgI/wR5E/5Nze+z4wJZLvzhZcZpiFpiACFN4bGalzH1GzIzHIkFyUuu27jk4DrDPxvth+JiJQxEO2LievVnFsLnsKDOuEbja7YfIC7NkZKiYXm+UxLCMnXR4mMOu3JJ9p6nqztby453Hlnn2Q88VtC9PepBJviXeW/bf62sH+T2wx+hbFLTf5qDPE7KK+A1fsFMi3DLWXuA5Z0NA9D1NV9DWEn8w/8Lq19nDNd4f9yRT7C14AqjxNZAQ1PILR8nPg="


    # The region for Amazon Educate is fixed.
    aws.region = "us-east-1"

    # These options force synchronisation of files to the VM's
    # /vagrant directory using rsync, rather than using trying to use
    # SMB (which will not be available by default).
    override.nfs.functional = false
    override.vm.allowed_synced_folder_types = :rsync

    # The keypair_name parameter tells Amazon which public key to use.
    aws.keypair_name = "cosc349"
    # The private_key_path is a file location in your macOS account
    # (e.g., ~/.ssh/something).
    override.ssh.private_key_path = "~/.ssh/cosc349.pem"

    # Choose your Amazon EC2 instance type (t2.micro is cheap).
    aws.instance_type = "t2.micro"
    #security group code for shh to access VM
    aws.security_groups = ["sg-04327b222118afb69"]

    #region and its subnet
    aws.availability_zone = "us-east-1a"
    aws.subnet_id = "subnet-9bb206c4"

    #ami code
    aws.ami = "ami-0f40c8f97004632f9"

    #Vagrant connects using username "ubuntu".
    override.ssh.username = "ubuntu"
  end

  

  # this is a form of configuration not seen earlier in our use of
  # Vagrant: it defines a particular named VM, which is necessary when
  # your Vagrantfile will start up multiple interconnected VMs. I have
  # called this first VM "webserver" since I intend it to run the
  # webserver (unsurprisingly...).
  config.vm.define "read-server" do |webserver|
    # These are options specific to the webserver VM
    webserver.vm.hostname = "read-server"
    

    webserver.vm.provision "shell",inline: <<-SHELL
 apt-get update
      apt-get install -y apache2 php libapache2-mod-php php-mysql
      cp /vagrant/test-website.conf /etc/apache2/sites-available/
      chmod 400 /vagrant
      chmod 400 /vagrant/read-www
      chmod 400 /vagrant/read-www/index.php
      a2ensite test-website
      a2dissite 000-default
      service apache2 reload
    SHELL

    config.vm.define "write-server" do |webserver|

      webserver.vm.hostname = "write-server"

      webserver.vm.provision "shell",inline: <<-SHELL
 apt-get update
      apt-get install -y apache2 php libapache2-mod-php php-mysql
      cp /vagrant/test-website2.conf /etc/apache2/sites-available/
      chmod 400 /vagrant
      chmod 400 /vagrant/write-www
      chmod 400 /vagrant/write-www/index.php
      a2ensite test-website2
      a2dissite 000-default
      service apache2 reload
    SHELL

  end

    config.vm.provision "shell", inline: <<-SHELL
     apt-get update
     apt-get install -y apache2
   SHELL

end
