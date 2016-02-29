<?#Catches jserrors

if($_REQUEST['x'])file_put_contents(TMP.'jserrors.log',"\n".$_REQUEST['x'],FILE_APPEND);