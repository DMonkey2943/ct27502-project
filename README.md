## Triển khai trên Apache HTTP

```
# C:/xampp/apache/conf/extra/httpd-vhosts.conf

<VirtualHost *:80>	
    DocumentRoot "C:/xampp/htdocs" 
    ServerName localhost
</VirtualHost>

<VirtualHost *:80>
    DocumentRoot "D:\CNWeb\ct27502-project\public"
    ServerName ct27502-project.localhost
    # Set access permission
    <Directory "D:\CNWeb\ct27502-project\public">
        Options Indexes FollowSymLinks Includes ExecCGI
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

