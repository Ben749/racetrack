<?
$_ENV['titre']='sql6-cached';
require_once'../header.c.php';
#new fun;#ok with autoloader -- fine :)
new sql6;
#$con=[$host,$user,$pass];

$single=1;
$cd=TMP.'sqlcache/';$con=$sqlconn;$iP=['databases'];$pile='Database';
$sql='show databases';
/*using $iP caches the results and index them under those names for cache invalidations*/

#sql6(['pl'=>['databases']]);die;

$x=sql6(compact('con','cd','iP','sql','pile'));#,'pile'=>'Database'
echo'<pre>show database returns : ';print_r($x);

if(!$x or !in_array('test',$x)){/*kindof first migration*/
$sep='§§!';

$migrations=[
  '0.0.1'=>['title'=>"1st migration : creates database test && table products",
    'sqls'=>"create database test".$sep."CREATE TABLE test.products ( id INT NOT NULL AUTO_INCREMENT , id_subsidiary INT NOT NULL , title VARCHAR(255) NOT NULL , `desc` VARCHAR(255) NOT NULL , PRIMARY KEY (id)) ENGINE = InnoDB".$sep."INSERT INTO test.products (id_subsidiary,title,`desc`) VALUES (312, 'fr skis', 'skis fr 2')",
    'suppr'=>'databases',
    'pm'=>[['title'=>'new db test shall show once databases cache previously deleted','sql'=>'show databases','iP'=>'databases','pile'=>'Database']]
  ],
];

  foreach($migrations as $index=>$data){
    echo"\n".$data['title'];
    $sqls=explode($sep,$data['sqls']);
    foreach($sqls as $sql)$x=sql6(compact('con','sql'));
    if($data['suppr'])sql6(['suppr'=>$data['suppr']]);#suppress those caches
    if($data['pm']){#post migration checks
      foreach($data['pm'] as $pm){
        extract($pm);echo"\n".$title.":\n";
        $x=sql6(compact('con','iP','sql','pile'));#,'pile'=>'Database'
        print_r($x);
      }
    }
  }
  
}

$sql="select * from test.products where id_subsidiary=312";
$iP=['clé invalidation 1','products:idsub:312'];
$x=sql6(compact('con','iP','sql'));
echo"\nresults for $sql:";print_r($x);

$sql="select * from test.products";$iP=['products*'];
$x=sql6(compact('con','iP','sql'));
echo"\nresults for $sql:";print_r($x);

echo'</pre>';
require_once'../footer.c.php';