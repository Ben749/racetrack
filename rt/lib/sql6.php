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
  return json_decode($x);#igbinary_unserialize
}

function igbwz($file,$data){
  $data=json_encode($data);#igbinary_serialize
  if(strlen($data)>4000)$data=gzcompress($data,2);
  fpc1($file,$data);
}

#$x=sql6(['cd'=>'/web/sqlcache/','con'=>['127.0.0.1','root','a'],'sql'=>"select * from bo.products where id_subsidiary=312",'iP'=>['invalidation1','products:idsub:312']]);print_r($x);die;
redef(THRESHOLD,0.001);#ms to declenche cache
function sql6($p){
//better use disk cache, cuz memory will autoload it when heavily accessed using LFU algorythmn !
     $cd='/z/tmp/sql/';$x=null;$result=[];extract($p);
     $s=['allready-unlinked'=>[]];
     if($iP && is_string($iP))$iP=explode(',',$iP);
     if($pl && is_string($pl))$pl=explode(',',$pl);
     
     if(!$FieldIndex)$FieldIndex='id';
     
     if($sql){
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

        if(is_file($cachepath))return igbrz($cachepath);

        mysql_connect($con[0],$con[1],$con[2]);
       
         if($update){
            $sql.=" and(SELECT @uids:=CONCAT_WS(',',".$FieldIndex.",@uids))";#between where and limit
            mysql_query("SET @uids := null");
         }
         
         $a=microtime(1);
         $x=mysql_query($sql);
       
        if($update)$x=mysql_query("SELECT cast(@uids as char(1000)) as up");
       
         while($res=@mysql_fetch_assoc($x)){
            if(!$res)continue;$result[]=$res;
            if($indexes)foreach($indexes as $y)if(!in_array($md5,$index[$y][$res[$y]]))$index[$y][$res[$y]][]=$md5;
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

     if($pI){#indexes to remove, according to invalidations
          foreach($pI as $v){
               $f=$cd.$v.'.inv';
               if(!is_file($f) || !trim($v))continue;
               $x=explode("\n",fgc1($f));
               foreach($x as $v2){
                    if(!is_file($cd.$v2))continue;
                    unlink($cd.$v2);
               }
          }
     }
//returns at end of select, update ..
     if($result)return $result;
}
