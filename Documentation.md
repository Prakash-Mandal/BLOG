# Syntax Guideline for the Blog Site

*  Code should not use tabs for indenting , rather use 4 spaces .
*  There should be a soft limit of 120 charaters in a line.
*  The namespace declaration should be at the top of the file, and one line should be blank after declaration.The block of use declaration should be ended with a blank line.
```
    <?php
    namespace Model;

    use Model\Article;
    use [View\HeaderView];
    
    // ... additional PHP code ...

```
*  The naming of classes should start with uppercase for every word and no space in between two words. The opening and closing braces for the classes should be on a new line. The opening and closing braces for the methods should also be on a new line.
```
    class Article extends AnotherClass implements AnotherInterface
    {
       //Body of the class ...
    }
```
*  Opening braces for methods MUST go on the next line, and closing braces should also go on the next line after the body as well. Visibility MUST be declared on all properties and methods **abstract** and **final** MUST be declared before the visibility **static** MUST be declared after the visibility.
```
    final public static function __construct()
    {
        //Body of the function...
    }
```
*  Control structure keywords MUST have one space after them, method and function calls MUST NOT.
*  Opening braces for control structures MUST go on the same line, and closing braces MUST go on the next line after the body. Opening parentheses for control structures MUST NOT have a space after them, and closing parentheses for control structures MUST NOT have a space before.
```
    if (condition) {
        //Body for the control statement...
    }
    switch (variable) {
        case 1:
            //body for case 1...
        break;
        case2:
            //body for case 2...
        break;
        default:
            //body for default...
        break;
    }
```
*  Variables must be sperated with a space in between the assignment operator and the value. Variable names should follow the camelCase convention ***i.e,*** *if the variable name if of more than one words, the next word should start with uppercase and no spaces between two words.*
```
    $variable = ‘value’;
	$integer = 100;
	$string = ‘String Variable’;
	$boolean = true;
	$objectName = {name : Prakash};
```

## Running the Blog Project in NginX with HTTPS

### Installation
#### Pre-requisite
* Nginx
* Mysql 8.0.14
* PHP 7.2.14 with the following extensions installed
    * php7.2-xml
    * php7.2-cli
	* php7.2-common
	* php7.2-fpm
	* php7.2-gd
	* php7.2-gettext
	* php7.2-mbstring
	* php7.2-mysql

#### Installation Steps

##### Installing Nginx

* We can install Nginx by typing:
```    sudo apt-get update```
```    sudo apt-get install nginx ```
* Adding the Nginx to the firewall list is done by Nginx itself, check it by typing:
```    sudo ufw app list```
```    sudo ufw allow 'Nginx HTTP'```
```    sudo ufw allow 'Nginx HTTPS'```
* Start the Nginx service by typing:
```    sudo systemctl start nginx```
* Check that the service is up and running by typing:
```    systemctl status nginx```
* Type into the browser to see the server working
***```    http://[server_domain_or_IP/localhost]```***


### _Setting up the project _

#### Create a SSL Certificate
* create a folder *certificates* in the profect folder for storing the certificates 
```sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout [project_path]/certificate/nginx-selfsigned.key -out [project_path]/certificate/nginx-selfsigned.crt```
* We will be prompted with few questions about our server in order to embed the information correctly in the certificate.


#### Create a virtual host configuration file with **.conf** extension.
Example: **blog.test.conf**
```sudo nano /etc/nginx/sites-available/[virtual_host_file_name]```
* Add the following configuration:
```
    # This server block for redirecting every HTTP request to a HTTPS request
    #server {
    #	listen 80;
    #	listen 127.0.0.1:80;
    #
    #   server_name [domain_name]];
    #
    #    return 301 https://[domain_name]/;
    #}
    server {
        listen 443 ssl ;
        listen 127.0.0.1:443 ssl default_server;
        
        # added index.php in the begining because its the first page of the Blog.
        index index.php index.nginx-debian.html;
    
        server_name [domain_name];
        
        root [path to project folder];
        
        # pass the path of the certificate file.
        ssl_certificate     [path to th ecertificate file];
        # pass the path of the public key  associated with the certificate file
        ssl_certificate_key [path to public key file];
    
        #serving the location request
        location / {
            autoindex on; //
        }
        # pass the PHP scripts to FastCGI server
    	location ~ \.php$ {
            include snippets/fastcgi-php.conf;
            #	# With php7.2-fpm:
            fastcgi_pass unix:/run/php/php7.2-fpm.sock;
        }
        # deny access to .htaccess files, if Apache's document root
	    # concurs with nginx's one
        location ~ /\.ht {
            deny all;
        }
    }
```
**Please replace the placeholders with appropriate values.**

* Run the following create a link for virtual host in sites-enabled
``` sudo ln -s /etc/nginx/sites-available/example.com /etc/nginx/sites-enabled/ ```
* chech for any syntax errors in the config file
```sudo nginx -t```
* Open Local Hosts file
```sudo nano /etc/hosts```
* Add the following to the Local Hosts file
```127.0.0.1   [domain_name]```
* Now open a browser, visit your domain and you should see the home page.
