<?
class sql6{}
/*
SET @uids := null;
UPDATE bo.faqs SET title = title+ '-' WHERE id <10 AND ( SELECT @uids := CONCAT_WS(',', id, @uids) );
SELECT @uids;
*/

function sanitizefile(&$file){
  $x=pathinfo($file);$y=$x['basename'];
  $y = preg_replace("#([^\w\s\d\_~,;:\[\]\(\).])#",'-',$y);
  $y = preg_replace("~-{2,}~",'-',$y);
  $y = preg_replace("~\.{2,}~",'.',$y);
  $file=str_replace($x['basename'],$y,$file);
  return $file;
}
function fgc1($x){sanitizefile($x);if(!is_file($x))return 0;return file_get_contents($x);}
function fpc1($x,$data){sanitizefile($x);file_put_contents($x,$data);}

function igbrz($file){
  $x=fgc1($file);if(!$x)return[];
  if(in_array(substr($x,0,2),['x'.chr(156),'x'.chr(94),'xœ']) && $uncompressed=@gzuncompress($x))$x=$uncompressed;
  return json_decode($x,1);#igbinary_unserialize
}

function igbwz($file,$data){
  $data=json_encode($data);#igbinary_serialize
  if(strlen($data)>4000)$data=gzcompress($data,2);
  fpc1($file,$data);
}

#$x=sql6(['cd'=>'/web/sqlcache/','con'=>['127.0.0.1','root','a'],'sql'=>"select * from bo.products where id_subsidiary=312",'iP'=>['invalidation1','products:idsub:312']]);print_r($x);die;
redef(THRESHOLD,0.001);#ms to declenche cache
function sql6($p){
#todo:;mysqli
//better use disk cache, cuz memory will autoload it when heavily accessed using LFU algorythmn !
    static $conns;
     $cd=TMP.'sqlcache/';$x=null;$result=[];extract($p);
     if($suppr)$pl=$suppr;
     if($pl){#indexes to remove, according to invalidations
        if(is_string($pl))$pl=explode(',',$pl);
      #print_r($pl);
        $mod=0;
          foreach($pl as $v){
               $f=$cd.$v.'.inv';
               if(!is_file($f) || !trim($v))Continue;
               $x=explode("\n",fgc1($f));
               foreach($x as &$v2){
                    if(!is_file($cd.$v2))continue;
                    $mod++;unlink($cd.$v2);$v2=null;
               }unset($v2);
          }
          
          if($mod){#suppressions effectives
            $x=array_filter(array_unique($x));
            if($x && count($x))fpc1($f,implode("\n",$x));
            else unlink($f);#ni a plus rien .. 
         }
     }
     
     if($con)$thiscon=implode(',',$con);
     $s=['allready-unlinked'=>[]];
     
     if($iP && is_string($iP))$iP=explode(',',$iP);
     
     if(!$FieldIndex)$FieldIndex='id';
     
     $sql=trim($sql);
     if($sql){
     
        if(strtolower(substr($sql,0,4))==='show')$select=1;
        if(stripos($sql,'select')===0)$select=1;
        elseif(stripos($sql,'update')===0){$update=1;$pl[]='update:'.$table;}
        elseif(stripos($sql,'insert')===0)$pl[]='insert:'.$table;
        
        if(!$table){
          preg_match("~(select .* from|update|insert into) +([a-z\d_]+\.)?([a-z\d_]+) ~i",$sql,$m);
          if($m[3])$table=$m[3];
        }

        $path['index']=$cd.$table.'.indexes';
        $index=igbrz($path['index']);

        $md5=md5($sql);$cachepath=$cd.$md5;

        if(is_file($cachepath))return igbrz($cachepath);#returns cached query

        if(!$conns[$thiscon]){
          mysql_connect($con[0],$con[1],$con[2]);#errors ?
          $conns[$thiscon]=1;
        }
       
         if($update){
            $sql.=" and(SELECT @uids:=CONCAT_WS(',',".$FieldIndex.",@uids))";#between where and limit
            mysql_query("SET @uids := null");
         }
         
         $a=microtime(1);
         $x=mysql_query($sql);
        if($update)$x=mysql_query("SELECT cast(@uids as char(1000)) as up");
       
if($select){
  $nr=mysql_num_rows($x);if(!$nr)return;
  #fecth is implicite here
  while($res=@mysql_fetch_assoc($x)){
      if(!$res)continue;
      if($indexes)foreach($indexes as $y)if(!in_array($md5,$index[$y][$res[$y]]))$index[$y][$res[$y]][]=$md5;
      
      if($nr==1 && $single){
          if(count($res)==1)$result=end($res);#1single results return a string : identifier (select name from table where id=9,single=1) => 1
          else $result=$res;#Single Array for Result -> reduce to one dimension if one result (select id,name from table where id=9,single=1) [9,name]
        #elseif($uniqueRow){$res=$t;}
      }
      elseif($pile && isset($res[$pile])){#dépilation
          $id=$res[$pile];
          if(count($res)==1)$result[]=$id;
          else{unset($res[$pile]);$result[$id]=$res;}
      }#select id,name from table where id in(1,2,3),pile=id => [1=>[1,name],2=>[2,name]]
      elseif(count($res)==1 && $single)$res[]=end($res);#select id from table where id in(1,2,3);single=1 => [1,2,3]
      else $result[]=$res;#defaults
      #$res=array_filter($res);
  }
}
          $x=null;
          #print_r(compact('sql','index','result'));die;
        
          if($indexes)igbwz($path['index'],$index);#compressés car mêmes références        
          
          if($update){
            $result=explode(',',end(end($result)));#
            foreach($result as $id){
              $pl[]=$table.':'.$FieldIndex.':'.$id;
            
              if($index && $index[$FieldIndex][$id]){
                  $vals=$index[$FieldIndex][$id];
                  foreach($vals as $md5v){
                    if(in_array($md5v,$s['allready-unlinked']))Continue;
                    $s['allready-unlinked'][]=$md5v;
                    $remove=$cd.$md5v;
                    if(is_file($remove))unlink($remove);
                  }
                  $s['rmindexes']=1;
                  unset($index[$FieldIndex][$id]);
              }#field indexes
            }#all results id
            if($s['rmindexes'])igbwz($path['index'],$index);#removed
          }
        
          $d=(microtime(1))-$a;
          
#die('<pre>'.__FILE__.':'.__LINE__.':'.print_r(compact('cachepath','cd','index','indexes','path','result','select','iP','d'),1));
          
         if($select && $result && $iP){# && $d>THRESHOLD
            igbwz($cachepath,$result);
            foreach($iP as $v){
              $v=str_replace(':','-',$v);
               $f=$cd.$v.'.inv';
               $x=null;if(is_file($f))$x=fgc1($f);$pos=strpos($x,$md5);
               if($pos<1)fpc1($f,"\n".$md5,FILE_APPEND);
            }
         }
      }
//returns at end of select, update ..
     if($result)return $result;
}
