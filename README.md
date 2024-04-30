# Activity for ICTDBS507 - Integrate databases with websites

## Instructions to run the PHP application

### Option 1: XAMPP
1. Open xampp
2. run the apache server and the MySQL server

#### Importing the database
3. open the phpmyadmin
4. create database called php_online_discussion_forum
5. import the `php_online_discussion_forum.sql`

#### Deploying the PHP forum activity to XAMPP
6. Upload the whole folder to htdocs and rename it `K230925_activity`
7. Open the `C:\xampp\apache\conf\extra\httpd-vhosts.conf` to any editor and paste the config below:
    ```
   <VirtualHost *:80>
   ServerAdmin webmaster@localhost
   DocumentRoot "C:/xampp/htdocs/K230925_activity/public"
   ServerName studentphpforum.local
   
       <Directory "C:/xampp/htdocs/K230925_activity/public">
           Options Indexes FollowSymLinks
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
   ```
8. Copy the server name `studentphpforum.local`
9. Go to `C:\Windows\System32\drivers\etc`
10. Open or run notepad as an administrator
11. Drag and drop the hosts file from `C:\Windows\System32\drivers\etc`
12. At the very bottom of the file paste this `127.0.0.1 studentphpforum.local`
13. Restart the apache stopping and starting it again in the XAMPP panel
14. try accessing the http://studentphpforum.local
15. Start by registering yourself by going to `http://studentphpforum.local/register`

### Option 2: Docker desktop
1. Install docker desktop
2. open terminal
3. go to the project directory
4. run `docker-compose up`
5. once it's done and running open http://localhost:8181/ to access phpmyadmin
6. import the `php_online_discussion_forum.sql`
7. then access the http://localhost:8080/
8. start by registering
