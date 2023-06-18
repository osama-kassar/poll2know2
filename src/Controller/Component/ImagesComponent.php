<?php

namespace App\Controller\Component;

require_once('ArGD.php');

use Cake\Controller\Component;
use ArabicGD;


class ImagesComponent extends Component {
	
	var $allowed_ext = array(
                 'images'=>array('jpg','jpeg','gif','png'),
                 'media'=>array('swf','flv'),
                 'doc'=>array('doc','pdf')
                 );
	var $max_upload_size = 3500;// per kilobyte
	var $Error_Msg = array();
    var $photosname = array();
    
    function uploader($path, $file, $name, $thumb, $crup=0, $watermark=false)
    {
        $file = !is_array($file) ? (array)$file : $file;  
		!empty($name) ? $newName = $name.'.'.$this->getExt((array)$file) : $newName = date('ymd').time().count($this->photosname).'.'.$this->getExt($file);
        
        if(strlen($file['tmp_name'])>255){
            $img = explode(",", $file['tmp_name'])[1];
            $isUploaded = file_put_contents($path.'/'.$newName, base64_decode($img));
        }else{
            $isUploaded = move_uploaded_file($file['tmp_name'], $path.'/'.$newName);
        }
        
		if($isUploaded) {
            $this->photosname[] = $newName;
            // waternmark
            if($watermark){
                $this->addWaterMark($path.'/'.$newName, $watermark);
            }
			for($i=0; $i<count($thumb); $i++){
				if($thumb[$i]['doThumb']){
					$this->resizer($path.'/'.$newName, $path.'/'.$thumb[$i]['dst'].'/'.$newName, $thumb[$i]['w'], $thumb[$i]['h'], $crup);
				}
			}
			return true;
		}else{
			return false;
		}
	}
    
    function url_uploader($path, $file, $name, $thumb, $watermark=false)
    {
        @$rawImage = file_get_contents($file);
        
        if($rawImage) {
            if(file_put_contents($path.'/'.$name, $rawImage) ){
                // waternmark
                if($watermark){
                    $this->addWaterMark($path.'/'.$name, $watermark);
                }
				for($i=0; $i<count($thumb); $i++){
					if($thumb[$i]['doThumb']){
						$this->resizer($path.'/'.$name, $path.'/'.$thumb[$i]['dst'].'/'.$name, $thumb[$i]['w'], $thumb[$i]['h'], 0);
					}
				}
                return true;
            }
        } else {
            return false;
        }
    }

    function creator($path, $imgInfo)
    {
//    $imgInfo = [
//        "text"=>[], 
//        "bg"=>"", 
//        "imgName"=>"", 
//        "thumb"=>[['doThumb'=>true, 'w'=>400, 'h'=>400, 'dst'=>'thumb']]
//    ]
        return $this->resizer($imgInfo["bg"], 'img/'.$path.'_photos/'.$imgInfo["imgName"], 800, 800, 0, $imgInfo["text"]);
    }
    
	function getPhotoNames()
    {
        return implode(",",$this->photosname);
    }
    
	function addWaterMark($img, $watermark){
        // add water mark or text
        $white = imagecolorallocate( $img, 255, 255, 255);
        $grey  = imagecolorallocate( $img, 128, 128, 128);
        $black = imagecolorallocate( $img, 0, 0, 0);
        $font = getcwd().'/fonts/a-jannat-lt-bold.otf';
//        debug($font);
        $font_size=26;
        // Text TO ARABIC 
        $do = new ArabicGD();
        $text='';
        foreach($watermark as $line){
            if(!empty($line)){
                $text .= $do->arabicText($line, "", 'normal') ."\n";
            }
        }
        // set text in center
        // list($x, $y) = $this->ImageTTFCenter($img, $text, $font, $font_size);
        $x = 180;
        $y = 300;
        imagettfbbox ( $font_size , 0 , $font , $text );
        imagettftext ($img, $font_size, 0, $x, $y, $white, $font, $text);
        // Add some shadow to the text
        $this->setStroke($img, $font_size, 0, $x, $y, $black, $white , $font, $text, 15);
    }
    
	function resizer($src, $dst, $width, $height, $crop=0, $watermark=false)
    {
		$this->Error_Msg = array();
		if(!list($w, $h) = @getimagesize($src)){
			$this->Error_Msg[] = 'dimensions_error'; 
			return "Unsupported picture type!";
		}
		$type = strtolower(substr(strrchr($src,"."),1));
		if($type == 'jpeg') $type = 'jpg';
		switch($type){
			case 'bmp': $img = imagecreatefromwbmp($src); break;
			case 'gif': $img = imagecreatefromgif($src); break;
			case 'jpg': $img = imagecreatefromjpeg($src); break;
			case 'png': $img = imagecreatefrompng($src); break;
			default : return "Unsupported picture type!";
			$this->Error_Msg[] = 'type_error'; break;
		}
        // waternmark
		if($watermark){
            $this->addWatermark($img, $watermark);
        }
		// resize
		if($crop){
			if($w < $width or $h < $height){
				return "Picture is too small!";
				$this->Error_Msg[] = 'picture_small';
			}
			$ratio = max($width/$w, $height/$h);
			$h = $height / $ratio;
			$x = ($w - $width / $ratio) / 2;
			$w = $width / $ratio;
		}else{
			if($w < $width and $h < $height){
				return "Picture is too small!";
				$this->Error_Msg[] = 'picture_small';
			}
			$ratio = min($width/$w, $height/$h);
			$width = $w * $ratio;
			$height = $h * $ratio;
			$x = 0;
		}
		
		$new = imagecreatetruecolor($width, $height);
		
		// preserve transparency
		if($type == "gif" or $type == "png"){
			imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
			imagealphablending($new, false);
			imagesavealpha($new, true);
		}
		
		imagecopyresampled($new, $img, 0, 0, $x, 0, $width, $height, $w, $h);
		
		switch($type){
			case 'bmp': imagewbmp($new, $dst); break;
			case 'gif': imagegif($new, $dst); break;
			case 'jpg': imagejpeg($new, $dst); break;
			case 'png': imagepng($new, $dst); break;
		}
		return true;
	}
	
    private function setStroke(&$image, $size, $angle, $x, $y, &$textcolor, &$strokecolor, $fontfile, $text, $px) {
        for($c1 = ($x-abs($px)); $c1 <= ($x+abs($px)); $c1++)
            for($c2 = ($y-abs($px)); $c2 <= ($y+abs($px)); $c2++)
                $bg = imagettftext($image, $size, $angle, $c1, $c2, $strokecolor, $fontfile, $text);
            return imagettftext($image, $size, $angle, $x, $y, $textcolor, $fontfile, $text);
    }
    
    private function ImageTTFCenter($image, $text, $font, $size, $angle = 45) 
    {
        $xi = imagesx($image);
        $yi = imagesy($image);

        $box = imagettfbbox($size, $angle, $font, $text);

        $xr = abs(max($box[2], $box[4]));
        $yr = abs(max($box[5], $box[7]));

        $x = intval(($xi - $xr) / 2);
        $y = intval(($yi + $yr) / 2);

        return array($x, $y);
    }
    
	function getExt($file)
    {
		$fileext = substr($file['type'],6);
		switch($fileext){
			case 'jpeg':
			case 'jpg':
			$res = 'jpg';
			break;
			
			default:
			$res = $fileext;
			break;
		}
		return $res;
	}
	
	function deleteFile($path, $img)
    {
        if(is_array($img)){
            foreach($img as $file){
                $file_arr = explode("/", $file);                
                @unlink('img/'.$file_arr[0].'_photos/'.$file_arr[1]);
                @unlink('img/'.$file_arr[0].'_photos/thumb/'.$file_arr[1]);
                @unlink('img/'.$file_arr[0].'_photos/middle/'.$file_arr[1]);
            }
            return;
        }
		@unlink($path.'/'.$img);
		@unlink($path.'/thumb/'.$img);
		@unlink($path.'/middle/'.$img);
	}
}
?>