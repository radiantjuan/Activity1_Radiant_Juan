# Activity for ICTDBS507 - Integrate databases with websites

## Instructions to run the PHP application

### Option 1: XAMPP
1. Open xampp
2. run the apache server and the MySQL server
3. open the phpmyadmin
4. create database called php_online_discussion_forum
5. import the `php_online_discussion_forum.sql`
6. Upload the whole folder to htdocs
7. in the C:\xampp\apache\conf\extra\httpd.vhost add this config
    ```
    <VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot "C:/xampp/htdocs/Activity_1_Radiant_Juan/public"
    ServerName localhost
    ServerAlias www.localhost
    ErrorLog "logs/localhost-error.log"
    CustomLog "logs/localhost-access.log" combined
    </VirtualHost>
   ```
8. try accessing the localhost

### Option 2: Docker desktop
1. Install docker desktop
2. open terminal
3. go to the project directory
4. run `docker-compose up`
5. once it's done and running open http://localhost:8181/ to access phpmyadmin
6. import the `php_online_discussion_forum.sql`
7. then access the http://localhost:8080/
8. start by registering
