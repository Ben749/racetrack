<?
$_ENV['titre']='sql6-cached';
require_once'header.c.php';
#new fun;#ok with autoloader -- fine :)
new sql6;

$fetch=$single=1;
$cd=TMP.'sqlcache/';$con=$sqlconn;$iP=['databases'];$pile='Database';
$sql='show databases';

#sql6(['pl'=>['databases']]);die;

$x=sql6(compact('con','cd','iP','sql','pile'));#,'pile'=>'Database'
echo'<pre>show database returns : ';print_r($x);

if(!$x or !in_array('test',$x)){
  echo"creates database test && table products";
    $sql="create database test";$x=sql6(compact('con','sql'));
    $sql="CREATE TABLE test.products ( id INT NOT NULL AUTO_INCREMENT , id_subsidiary INT NOT NULL , title VARCHAR(255) NOT NULL , `desc` VARCHAR(255) NOT NULL , PRIMARY KEY (id)) ENGINE = InnoDB";$x=sql6(compact('con','sql'));
    
    $sql="INSERT INTO test.products (id,id_subsidiary,title,`desc`) VALUES (NULL, '312', 'fr skis', 'skis fr 2')";$x=sql6(compact('con','sql'));
    
    sql6(['suppr'=>['databases']]);
    
    $sql='show databases';
    $x=sql6(compact('con','iP','sql','pile'));#,'pile'=>'Database'
    echo"new db test shall show once databases cache previously deleted :\n".print_r($x,1);
}

echo"\nresults:";
$sql="select * from test.products where id_subsidiary=312";
$iP=['invalidation1','products:idsub:312'];
$x=sql6(compact('con','iP','sql'));
print_r($x);

echo'</pre>';
require_once'footer.c.php';