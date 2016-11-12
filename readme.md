# Angular JS Base Framework
This repository accommodates the base framework I use for my angular JS projects, might not be up to date

## startup

#### clone project
Clone this git repository, be sure to take all the files. 

### create new apache site
Create a new file in /etc/apache2/sites-available containing the following code. Make sure to allow override. Without it angular route will not work.

```
 <VirtualHost *:80>

        ServerAdmin webmaster@localhost
        ServerName localhost
        DocumentRoot /path/to/document/root

        ErrorLog ${APACHE_LOG_DIR}/your_log_file.log
        CustomLog ${APACHE_LOG_DIR}/your_custom_log_file combined

</VirtualHost>



<Directory /paht/to/document/root>
                Options Indexes FollowSymLinks MultiViews
                AllowOverride All
                Order allow,deny
                allow from all
 </Directory>
               
```

Enable site: ```sudo a2ensite yoursitename```  
Restart site afterwards: ``` sudo service apache2 restart ```

### setup index.php in API
Open the file API/index.php, enter your database credentials like so

```php
$dbuser = "yourDBUsername";
$dbpass = "yourDBPassword";
$dbmain = "yourDBName";
```

### setup your index.php in portal
Open the file portal/index.php, then setup your base URL like so:
```HTML
<base href="your/base/url"/>
```

Check the Angular version to make sure it is the one you want to use. By default Angular 1.5.6 is loaded
```HTML
 <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
```

Now you should be good to go. If not suck to be you!


