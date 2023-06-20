
create DATABASE IF NOT EXISTS `containers` COLLATE 'utf8_general_ci' ;
grant all on `containers`.* TO 'webdev'@'%' ;

grant all privileges  on *.* to 'webdev'@'%' ;

FLUSH PRIVILEGES ;
