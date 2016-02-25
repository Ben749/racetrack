<?
$fun=new f;
register_shutdown_function(function(){global $fun;if($_GET['r'])$fun->r302($_GET['r'].'#post required migration');});#print_r($_ENV);

$_ENV['titre']='sql6-cached';
require_once'../header.c.php';echo'<pre>';
#new fun;#ok with autoloader -- fine :)
new sql6;
#$con=[$host,$user,$pass];

$single=1;
$cd=TMP.'sqlcache/';$con=$sqlconn;$iP=['databases'];$pile='Database';
/*using $iP caches the results and index them under those names for cache invalidations*/

#sql6(['pl'=>['databases']]);die;
$sep='§§!';

$migrations=[
  '0.0.1.createdb.test'=>[
    'title'=>"1st migration : creates database test && table products",
    'precheck'=>function(){
      global $con;$sql='show databases';$iP=['databases'];$pile='Database';
      $x=sql6(compact('con','iP','sql','pile'));#,'pile'=>'Database'
      if(!$x)return"#show database failed";
      if(in_array('test',$x)){touch(TMP.'sqlcache/migration.0.0.1');return"#migration allready done";}
    },
    'sqls'=>"create database test".$sep."CREATE TABLE test.products ( id INT NOT NULL AUTO_INCREMENT , id_subsidiary INT NOT NULL , title VARCHAR(255) NOT NULL , `desc` VARCHAR(255) NOT NULL , PRIMARY KEY (id)) ENGINE = InnoDB".$sep."INSERT INTO test.products (id_subsidiary,title,`desc`) VALUES (312, 'fr skis', 'skis fr 2')",
    'suppr'=>'databases',
    'pm'=>[['title'=>'new db test shall show once databases cache previously deleted','sql'=>'show databases','iP'=>'databases','pile'=>'Database']]
  ],
/** for mysqli usage **/  
  '0.0.2.table.articles'=>[
    'title'=>'articles',
    'precheck'=>function(){
      global $con;$sql='show tables from test';$pile='Tables_in_test';$x=sql6(compact('con','sql','pile'));
      if(!$x)return"#$sql failed";if(in_array('articles',$x)){touch(TMP.'sqlcache/migration.0.0.2');return"#migration exists";}
    },
     'sqls'=>"CREATE TABLE test.articles (id INT NOT NULL AUTO_INCREMENT,id_season INT NOT NULL,title VARCHAR(255) NOT NULL,contents VARCHAR(255) NOT NULL,PRIMARY KEY (id)) ENGINE=InnoDB".$sep."INSERT INTO test.articles (id_season,title,contents) VALUES (24,'Spring 2016','Spring, hummingbirds..')"
  ]
  #id,title,id_season from articles
];

foreach($migrations as $index=>$data){
    if(is_file(TMP.'sqlcache/migration.'.$index))continue;
    echo"\nMigration:".$data['title'];
    if($data['precheck']){$erreur=$data['precheck']();if($erreur)die($erreur);}
    
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
    touch(TMP.'sqlcache/migration.'.$index);
}

$sql="select * from test.products where id_subsidiary=312";
$iP=['cle-invalidation-1','products:idsub:312'];
$x=sql6(compact('con','iP','sql'));
echo"\nresults for $sql:";print_r($x);

$sql="select * from test.products";$iP=['products*'];
$x=sql6(compact('con','iP','sql'));
echo"\nresults for $sql:";print_r($x);

echo'</pre>';
require_once'../footer.c.php';