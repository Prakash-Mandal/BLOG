# My Blog Page

A sample blog website where a user can write blogs and later watch over his 
works.

# Installation
## Pre-requisite
* Apache 2.4.18
* Mysql 8.0.14
+ PHP 7.2.14 with the following extensions installed
    * php7.2-xml 
    * php7.2-zip 
    * mcrypt 
    * php7.2-mcrypt 
    * php7.2-mbstring
    * php7.2-curl

## Installation steps
## Apache 2.4.18
```
sudo apt-get update
sudo apt-get install apache2 apache2-bin
```
## MYSQL 8.0.14 (tab + enter)
```
wget https://dev.mysql.com/downloads/repo/apt/mysql-apt-config_0.8.12-1_all.deb
sudo dpkg -i mysql-apt-config_0.8.12-1_all.deb
sudo apt-get update
sudo apt-get install mysql-server
mysqld --initialize
```
## PHP 7.2
```
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install php7.2 php7.2-mysql
```

Search packages by running
```
apt-cache search php7.2
```
and install respective package by running
```
sudo apt-get install package-name
```
```
sudo apt-get install php7.2-xml php7.2-zip mcrypt php7.2-mcrypt php7.2-mbstring php7.2 curl
sudo phpenmod mcrypt
sudo phpenmod mbstring
```
## Enable mod rewrite
```
sudo a2enmod rewrite
sudo service apache2 restart
```

# Setting up project

##Clone repository:
```
git clone https://Prakash-Mandal@bitbucket.org/Prakash-Mandal/blog.git

```

##Blog Project

##Added APIs to checkEMail

There is a folder Ajax/products in which there are the initial states of the APIs.
This folder should be stored outside the blog folder in /var/www/html/ or you root folder except the folder in which the blog folder is hosted.
Till now we have added api for :
* Checking the email given by the user is already present or not.
~~~
Planned to add APIs for :
* Checking of valid emails
* Loging of user
* Signing up of users
* Getting user's blog list 
* Serching for a blog or user.

