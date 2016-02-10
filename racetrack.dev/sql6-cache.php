<?
require_once'../rt/prepend.php';
#new fun;#ok with autoloader -- fine :)
new sql6;
#CREATE TABLE test.products ( id INT NOT NULL AUTO_INCREMENT , id_subsidiary INT NOT NULL , title VARCHAR(255) NOT NULL , `desc` VARCHAR(255) NOT NULL , PRIMARY KEY (id)) ENGINE = InnoDB;INSERT INTO `products` (`id`, `id_subsidiary`, `title`, `desc`) VALUES (NULL, '312', 'fr skis', 'skis fr 2');

$x=sql6(['cd'=>TMP.'sqlcache/','con'=>['127.0.0.1','root','a'],'sql'=>"select * from test.products where id_subsidiary=312",'iP'=>['invalidation1','products:idsub:312']]);
print_r($x);die;
