﻿config.php


$config['index_page'] = "index.php" to $config['index_page'] = "" 
and 
$config['uri_protocol'] ="AUTO" to $config['uri_protocol'] = "REQUEST_URI"



.htaccess


RewriteEngine on
RewriteCond $1 !^(index\.php|[Javascript / CSS / Image root Folder name(s)]|robots\.txt)
RewriteRule ^(.*)$ /index.php/$1 [L]



