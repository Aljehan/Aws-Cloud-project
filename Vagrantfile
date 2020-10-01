# -*- mode: ruby -*-
# vi: set ft=ruby :

# A Vagrantfile to set up two VMs, a webserver and a database server,
# connected together using an internal network with manually-assigned
# IP addresses for the VMs.

Vagrant.configure("2") do |config|
  # The AWS provider does not actually need to use a Vagrant box file.
  config.vm.box = "dummy"

  config.vm.provider :aws do |aws, override|

  # security information from aws server
    aws.access_key_id = "ASIA4RJWHJFI66RVUUV5"
    aws.secret_access_key = "zjv5nDBfkOT6L5lq3sWxqdfTihk+4OzEm3sYdcfu"
    aws.session_token = "FwoGZXIvYXdzED4aDEm09bdy8EJk5daPZyLLAQL7rgrxZhGVJQxCyPjzGLhTJwW7ZmZ2J1rjWKpX8TVhf0X2Wf7i2AEuDfRtgdkI3uIYQNB2xvLpS3uxSJibYIgB5SYBimWqNNYNLaPGdC+A4n9PfETIbDfl07gqgBdHteXZ9+eNWRsbzN9F1kRu5YrbQiyt2a8lyalPNi05JVMB60MPJ306/xs/532QztmyURegHJtWIf6lLfOp6q8wjtJC+xO6tsLH5LVX2uFjO0OLyG2E3N2xXs3gt0/eO/SW/5gveE+scEHwqYzGKOWc0PsFMi3iX3ZyqaT36qzIVRm61KNTb2gNX9ywOZh08SVKoVo7iAG8K7SScXFmKkJBksw="

  # this is a form of configuration not seen earlier in our use of
  # Vagrant: it defines a particular named VM, which is necessary when
  # your Vagrantfile will start up multiple interconnected VMs. I have
  # called this first VM "webserver" since I intend it to run the
  # webserver (unsurprisingly...).
  config.vm.define "read-server" do |webserver|
    # These are options specific to the webserver VM
    webserver.vm.hostname = "read-server"
    
    # This type of port forwarding has been discussed elsewhere in
    # labs, but recall that it means that our host computer can
    # connect to IP address 127.0.0.1 port 8080, and that network
    # request will reach our webserver VM's port 80.
    webserver.vm.network "forwarded_port", guest: 80, host: 7080, host_ip: "127.0.0.1"
    
    # We set up a private network that our VMs will use to communicate
    # with each other. Note that I have manually specified an IP
    # address for our webserver VM to have on this internal network,
    # too. There are restrictions on what IP addresses will work, but
    # a form such as 192.168.2.x for x being 11, 12 and 13 (three VMs)
    # is likely to work.
    webserver.vm.network "private_network", ip: "192.168.2.11"

    # This following line is only necessary in the CS Labs... but that
    # may well be where markers mark your assignment.
    webserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]

    # Now we have a section specifying the shell commands to provision
    # the webserver VM. Note that the file test-website.conf is copied
    # from this host to the VM through the shared folder mounted in
    # the VM at /vagrant
    webserver.vm.provision "shell", path:"readweb.sh"

  end

  # Here is the section for defining the database server, which I have
  # named "dbserver".
  config.vm.define "dbserver" do |dbserver|
    dbserver.vm.hostname = "dbserver"
    # Note that the IP address is different from that of the webserver
    # above: it is important that no two VMs attempt to use the same
    # IP address on the private_network.
    dbserver.vm.network "private_network", ip: "192.168.2.12"
    dbserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]
    
    dbserver.vm.provision "shell", path:"server.sh"
  end

  config.vm.define "write-server" do |webserver|

    webserver.vm.hostname = "write-server"

    webserver.vm.network "forwarded_port", guest: 80, host: 7081, host_ip: "127.0.0.1"
    
    webserver.vm.network "private_network", ip: "192.168.2.13"

    webserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]

    webserver.vm.provision "shell", path:"writeweb.sh"

  end

end

#  LocalWords:  webserver xenial64
