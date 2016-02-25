<?
class wunserializer{}
function wUnserializer(&$debug){
  if(in_array(gettype($debug),['array','object']))return $debug;
  try{$debug=unserialize($debug);}
  catch(Exception $e){$debug=preg_replace_callback('/s:([0-9]+):"(.*?)"/','fix_broken_serialized_array',$debug);$debug=unserialize($debug);}
  if(is_string($debug))$debug=['#unserialization error'];
  return $debug;
}

function fix_broken_serialized_array($match) {return "s:".strlen($match[2]).":\"".$match[2]."\""; }

function fix_str_length($matches) {
    $string = $matches[2];
    $right_length = strlen($string); // yes, strlen even for UTF-8 characters, PHP wants the mem size, not the char count
    return 's:' . $right_length . ':"' . $string . '";';
}
function fix_serialized($string) {// securities
    if(!preg_match('/^[aOs]:/', $string))return $string;
    if(in_array(gettype($string),['array','object']))return $string;
    
    $x=@unserialize($string);
    if($x !== false)return $x;
    $string = preg_replace("%\n%", "", $string);
    // doublequote exploding
    $data = preg_replace('%";%', "µµµ", $string);
    $tab = explode("µµµ", $data);
    $new_data = '';
    foreach ($tab as $line)$new_data .= preg_replace_callback('%\bs:(\d+):"(.*)%', 'fix_str_length', $line);
    return $new_data;
}