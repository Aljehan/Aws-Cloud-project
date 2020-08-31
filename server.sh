# Update Ubuntu software packages.
apt-get update

# We create a shell variable MYSQL_PWD that contains the MySQL root password
export MYSQL_PWD='123456'

# If you run the `apt-get install mysql-server` command
# manually, it will prompt you to enter a MySQL root
# password. The next two lines set up answers to the questions
# the package installer would otherwise ask ahead of it asking,
# so our automated provisioning script does not get stopped by
# the software package management system attempting to ask the
# user for configuration information.
echo "mysql-server mysql-server/root_password password $MYSQL_PWD" | debconf-set-selections 
echo "mysql-server mysql-server/root_password_again password $MYSQL_PWD" | debconf-set-selections

# Install the MySQL database server.
apt-get -y install mysql-server

# Run some setup commands to get the database ready to use.
# First create a database.
echo "CREATE DATABASE timetabledb;" | mysql


# Then create a database user "webuser" with the given password.
echo "CREATE USER 'dbuser'@'%' IDENTIFIED BY '123456';" | mysql

# Grant all permissions to the database user "webuser" regarding
# the "fvision" database that we just created, above.
echo "GRANT ALL PRIVILEGES ON timetabledb.* TO 'dbuser'@'%'" | mysql


# Set the MYSQL_PWD shell variable that the mysql command will
# try to use as the database password ...
export MYSQL_PWD='123456'

cat /vagrant/setup-database.sql | mysql -u dbuser timetabledb

sed -i'' -e '/bind-address/s/127.0.0.1/0.0.0.0/' /etc/mysql/mysql.conf.d/mysqld.cnf

# We then restart the MySQL server to ensure that it picks up
# our configuration changes.
service mysql restart

