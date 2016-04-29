<?
/** 
https://openclassrooms.com/courses/les-captchas-anti-bot

Challenge : math additions to text results in French explode(',','un,deux,trois,quatre,cinq,six,sept,huit,neuf,dix,onze,douze,treize,quatorze,quinze,seize,dix-sept,dix-huit,dix-neuf,vingt');
$n1 = mt_rand(0,10);$n2 = mt_rand(0,10);$resultat = $n1 + $n2;
$phrase = $nbrFr[$n1] .' plus '.$nbrFr[$n2];

which is the colour of the [green,white,brown] horse ?
input class=s name=[mail|adress]

GLIB text to image with striken dots, lossely compression
$largeur = strlen($mot) * 10;
$hauteur = 20;
$img = imagecreate($largeur, $hauteur);
$blanc = imagecolorallocate($img, 255, 255, 255);
$noir = imagecolorallocate($img, 0, 0, 0);
imagepng($img);imagedestroy($img);

*/
function emailConfirmationLink($email){#or inserted_ic $id
  =md5($email);
}
function image($mot){
  $size = 32;
  $marge = 5;
  $box = imagettfbbox($size, 0, './smartie.ttf', $mot);
  $largeur = $box[2] - $box[0];
  $hauteur = $box[1] - $box[7];

  $img = imagecreate($largeur+$marge*2, $hauteur+$marge*2);
  $blanc = imagecolorallocate($img, 255, 255, 255);
  $noir = imagecolorallocate($img, 0, 0, 0);
  imagepng($img);
  imagedestroy($img);
}

imagettftext($img, $size, 0,$marge,$hauteur+$marge, $noir, './smartie.ttf', $mot);

<label for="captcha">Recopiez le mot : <img src="captcha.php" alt="Captcha" /></label>