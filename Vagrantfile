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
    aws.access_key_id = "ASIA4RJWHJFI5RGUWL7Z"
    aws.secret_access_key = "tZcYiummXq0NdGx0TI13oLozcOl6amY1RkBDCN3q"
    aws.session_token = "FwoGZXIvYXdzEG0aDFUHYksYMpU3h8L6bSLLAWEPT0tfizzUVxMgrJsyYbmdBPfz0jqAUwWlyx00bpNDRrHVV4JiDFNehuibDUir4APQvQR4Eqggct9Opn5sF1Z9j4Cp84GqVe+BDbJXuir9qm9ooL8AHoOTI2FiGVW1Rdj4VBJaWzyhYBtS4pUaT/aVs82Eb5ptIQMSMyDeFle+ULG1NqnXP23CeYsZ1RzD17KsHqGPKO5Ax4VpHtNcUiIy2v9dCABM4TSentKnEv3ED3ebDqfU7VHN3mSQaaZc3l4Uh9tbw2bjGIZQKKK12vsFMi3N/d3TOPu3XnWwtKY5JWl3A5brob+o4rR94NbljZvUIGp9qzk/engZOKO3UEQ="


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
    aws.security_groups = ["sg-04327b222118afb69", "sg-8be61db5"]

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
      cp /vagrant/read-www/index.php /var/www/html/
      a2ensite test-website
      a2dissite 000-default
      service apache2 reload
      sudo rm /var/www/html/index.html
sudo apt-get install mysql-server
      
    SHELL
end

    config.vm.define "write-server" do |webserver|

      webserver.vm.hostname = "write-server"

      webserver.vm.provision "shell",inline: <<-SHELL
 apt-get update
      apt-get install -y apache2 php libapache2-mod-php php-mysql
      cp /vagrant/test-website2.conf /etc/apache2/sites-available/
      cp /vagrant/write-www/index.php /var/www/html/
      a2ensite test-website2
      a2dissite 000-default
      service apache2 reload
      sudo rm /var/www/html/index.html
sudo apt-get install mysql-server
    SHELL

  end

    config.vm.provision "shell", inline: <<-SHELL
     apt-get update
     apt-get install -y apache2
   SHELL

end


