<?
function thumbgen($params){
    global $debug;$ts=2;
    $owidth=$oheight=$filename=$h=$w=$ext=$posy=$posx=$srcx=$srcy=null;$quality=90;
    extract($params);
    if(!is_file($filename))return'!not file';
    $info = getimagesize($filename);
    if(!$info)return'image error - no mime';

    $mime = $info['mime'];
    switch ($mime) {
        case 'image/jpeg':$image_create_func = 'imagecreatefromjpeg';$image_save_func = 'imagejpeg';$ext = 'jpg';break;
        case 'image/png':$image_create_func = 'imagecreatefrompng';$image_save_func = 'imagepng';$ext = 'png';$quality=0;break;
        case 'image/gif':$image_create_func = 'imagecreatefromgif';$image_save_func = 'imagegif';$ext = 'gif';break;
        default:return 'Unknown image type.';
    }

    $img = $image_create_func($filename);
    list($cuwidth, $cuheight) = getimagesize($filename);
    $oheight=$cuheight;$owidth=$cuwidth;
    $ratio=$cuwidth/$cuheight;
    if($h && !$w)$w=$h*$ratio;
    if($w && !$h)$h=$w/$ratio;
    $width=$w;$height=$h;
    $tmp = imagecreatetruecolor($width, $height);
    $posx = $posy = 0;

    if (isset($cropping)) {
        if(isset($resize)){#cropped from middle
            if($ratio>=1){$srcy=0;$srcx = ($cuwidth - $cuheight) / 2  ;$cuwidth=$cuheight;}
            else{$srcx = 0;$srcy=($cuheight - $cuwidth)/ 2 ;$cuheight=$cuwidth;}
        }
        else{
            $srcx = ($cuwidth - $width) / 2;
            $srcy = ($cuheight - $height) / 2;
            $cuwidth = $width;$cuheight = $height;
        }
        #print_r(compact('ratio','posx','posy','srcx','srcy','width','height','cuwidth','cuheight'));
        #imagecopyresampled($tmp, $img, $posx, $posy, $srcx, $srcy, $width, $height, $cuwidth, $cuheight);$image_save_func($tmp, $target, $quality);
    }
    else {
        if (isset($vertical_center) || isset($horizontal_center)) {
            if (isset($background_color)) {
                $hex2rgb = $this->hex2rgb($background_color);
                $color = imagecolorallocate($tmp, $hex2rgb[0], $hex2rgb[1], $hex2rgb[2]); //filled in white
                imagefilledrectangle($tmp, 0, 0, $width, $height, $color);
            }
            if (isset($vertical_center)) {
                $height = ($cuheight / $cuwidth) * $width;
            }
            if (isset($horizontal_center)) {
                $width = ($cuwidth / $cuheight) * $height;
            }
            /** ne pas dépasser ni les dimensions spécifiées, ni celle de l'image source -> cumul des deux centrages */
            $height = ($height > $cuheight) ? $cuheight : (($height > $oheight) ? $oheight : $height);
            $width = ($width > $cuwidth) ? $cuwidth : (($width > $owidth) ? $owidth : $width);
        }
        /** sinon la déformation est explicite*/
    }

    imagecopyresampled($tmp, $img, $posx, $posy, $srcx, $srcy, $width, $height, $cuwidth, $cuheight);

    if(strpos($target,'thumb/') && 0){#salomon-retry until less than 30% of the thumb is white
        $count=getPixelCountByColor($tmp,16777215);
        while(($count[0]/$count[1])>0.3){
            $w*=2;$h*=2;$cuwidth*=2;$cuheight*=2;#417x1000px
            $srcx = ($owidth - $w) /2;
            $srcy = ($oheight - $h) /2 ;
            if($srcx+$cuwidth>$owidth || $srcy+$cuheight>$oheight)break;
            imagecopyresampled($tmp, $img, $posx, $posy, $srcx, $srcy, $width, $height, $cuwidth, $cuheight);
            #dst,src,dtsx,dsty,srcx,srcy,destw,desth,srcw,srch
            $count=getPixelCountByColor($tmp,16777215);
        }
        #kill([__line__]+compact('filename','target','w','h','posx','posy','srcx','srcy','width','height','cuwidth','cuheight'));
    }

    if (isset($grayscale)) {
        imagefilter($tmp, IMG_FILTER_GRAYSCALE);
    }

    if (!isset($target)){
        $image_save_func($tmp);imagedestroy($tmp);return;
    }
    #makereps($target);
    $success=1;
    try{$success=@touch($target);}catch(Exception $e){$success='!no writable';if(J9)$success='!'.$e->getMessage();}#can't write this file ..
    if(is_file($target))$image_save_func($tmp,$target,$quality);# . $ext
    #else $success='!target not writable';
    #touch($target,$ts);#resized
    imagedestroy($tmp);return $success;
}