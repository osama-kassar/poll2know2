<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
//use Cake\I18n\I18n;
use Cake\Core\Configure;
use Cake\View\Helper\HtmlHelper;

class DoHelper extends Helper{
	
	public function get($id){
        
		switch($id){
				
			case 'uid':
				$res = md5($_SERVER['HTTP_USER_AGENT'] .  $_SERVER['REMOTE_ADDR']);
				break;
                
			case 'app_folder':
				$res = Configure::read('app_folder');
				break;
                
			case 'langs':
				$res = Configure::read('languages');
				break;
                
			case 'langs_ids':
				$res = Configure::read('languages_ids');
				break;
				
			case 'gender':
				$res = [1=>__('female'), 2=>__('male')];
				break;
                
            case 'statuses': 
                $res = [0=>__("disabled"), 1=>__("enabled"), 2=>__("started"), 3=>__("finished")];
                break;
                
			case 'types':
				$res = [1=>__('one_choice'), 2=>__('multiple_choices'), 3=>__('rate'), 4=>__('add_options')];
				break;
                
			case 'types_input':
				$res = [1=>'radio', 2=>'checkbox', 3=>'', 4=>'text'];
				break;
				
			case 'exam_calc_method':
				$res = [1=>__('percentage_calc'), 2=>__('count_calc'), 3=>__('game')];
				break;
                
			case 'bool':
				$res = ["0"=>__("no"), "1"=>__("yes")];
				break;
                
			case 'btwn':
				$res = [
                    "[0]"=>__("stars").'[1-5]', 
                    "[1]"=>__("agree_disagree").'[0-1]', 
                    "[2]"=>__("agree_disagree").'[1-5]', 
                    "[3]"=>__("like_dislike").'[0-1]', 
                    "[4]"=>__("like_dislike").'[1-5]',
                    "[5]"=>__("true_false").'[0-1]',
                    "[6]"=>__("true_false_maybe").'[1-3]',
                ];
				break;
                
			case 'days':
				$res = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
				break;
				
			case 'reasons':
				$res = ["reporting_error"=>__("reporting_error"), "sponsership"=>__("sponsership"), "compliment"=>__("compliment"), "question"=>__("question"), "complaint"=>__("complaint"), "other"=>__("other")];
				break;
				
			case 'stat_priority':
				$res = ["1"=>__("not_read"), "2"=>__("read"), "3"=>__("important")];
				break;
				
			case 'stat_type':
				$res = ["1"=>__("send"), "2"=>__("response")];
				break;
				
			case 'filters':
				$res = ['country', 'category', 'subcategory', 'keyword'];
				break;
				
			case 'socialmedia':
				$res = ['whatsapp', 'facebook', 'twitter', 'linkedin', 'instagram'];
				break;
				
			case 'UserRoles':
				$res = Configure::read('UserRoles');
				break;
				
			case 'AdminRoles':
				$res = Configure::read('AdminRoles');
				break;
				
			case 'roles':
				$res = Configure::read('roles');
				break;
				
			case 'sitelangs':
				$res = Configure::read('I18n.languages');
				break;
				
			case 'currlang':
				$res = I18n::locale();
				break;
				
			case 'currlang_id':
				$res = array_flip(Configure::read('LANGUAGES_IDS'))[ I18n::locale() ];
				break;
			
			case 'localizedTables':
				$res = array('products'=>__('products'), 'offers'=>__('offers'), 'categories'=>__('categories'));
				break;
			
			case 'parents':
				$res = $this->Categories->find('list',['conditions'=>['parent_id'=>0], 'fields'=>['id','category_name']]);
				break;
		}
		return $res;
	}
	
	public function AnswerFilter($txt){
        $txt = trim($txt);
		$txt = preg_replace('/ء|ى|ؤ|ئ|أ|إ|آ/', 'ا', $txt);
		$txt = preg_replace('/ت|ة|ه/', 'ت', $txt);
        return $txt;
    }
    
	public function ImgSetter($img, $tar){
        $path = "/img/".$tar."_photos/thumb/";
        $noimg = $tar=='polls' ? 'q-mark.jpg' : 'image-placeholder.jpg';
        return empty($img) ? "/img/".$noimg : $path.$img;
    }
    
	public function DtSetter($v, $k){
        if(in_array($k, ["stat_ip", "user_ip"])){ 
            $v = "<a href='https://whatismyipaddress.com/ip/".$v."' target='new'>".$v."</a>";
        }
        if(in_array($k, ["bool"])){ 
            $v = ($v*1) == 1 ? __("yes") : __("no");
        }
        if(in_array($k, ["stat_created", "stat_updated", "stat_publish_at", "stat_lastlogin"])){ 
            $v = !empty($v) ? $v->format("Y-m-d H:i:s") : $v;
        }
        if($k == "language_id"){ 
            $v = !empty($this->get('langs')[$v]) ? __($this->get('langs')[$v]) : $v;
        }
        if($k == "rec_state"){ 
            $vals = ["disabled", "enabled", "started", "finished"];
            $v = __($vals[$v]);
        }
        if(in_array($k, ["score_photo", "seo_image", "result_photos", "option_photo"])){
            $pth = explode("_", $k)[0]."s";
            if($k == "seo_image"){
                $pth = strtolower($this->request->getParam("controller")); 
            }
            $v = empty($v) ? $this->_View->Html->image("/img/".$pth."_photos/thumb/".$v,  ["style"=>"height:100px", "show-img"=>""]) : '';
        }
        return $v;
    }
    
	public function getLangId($lang=null){
        $currlangid = !empty($lang) ? $lang : ($this->get('langs_ids')[$this->request->getParam('lang')]);
        $res = !empty($this->request->getQuery('language_id')) ? $this->request->getQuery('language_id') : $currlangid;
        return $res;
    }
	public function prcntg($v1, $v2){
        if($v1>$v2){ return 100;}
        if($v1 > 0 || $v2 > 0){
            return ($v1 / $v2) * 100;
        }
        return 0;
    }
	
	public function convertJson($obj){
        $res = $obj->toArray();
		foreach($res as $key=>$elm){
            if(is_array($elm)){
                foreach($elm as $subKey => $subElm){
                    foreach($subElm as $subSubKey => $subSubElm){
                        if(is_string($subSubElm) ){
                            $jsonElm = json_decode($subSubElm, JSON_UNESCAPED_UNICODE);
                            if((json_last_error() == JSON_ERROR_NONE)){ 
                                $res[$key][$subKey][$subSubKey] = $jsonElm;
                            }
                        }
                    }
                }
            }
            if(is_string($elm) ){
                $jsonElm = json_decode($elm, JSON_UNESCAPED_UNICODE);
                if((json_last_error() == JSON_ERROR_NONE)){ 
                    $res[$key] = $jsonElm;
                }
            }
		}
	}
	
    public function rounder($val){
        $val = !is_numeric($val) ? (float)$val : $val;
        $bigNo = floor($val);
        $smallNo = $val - $bigNo;
        $rounded = $smallNo > 0.7 ? 1 : $smallNo < 0.3 ? 0 : 0.5;
        return $rounded+$bigNo;
    }
	
	public function getMachineLang($val){
		foreach(Configure::read('I18n.languages') as $lang){
			if(strpos($val, $lang) !== false){
				return $lang;
			}
		}
	}
    
	public function getCatName($param){
		if( is_numeric($param[1]) && $param[0] !== 'keyword'){
			$this->Categories = TableRegistry::get('Categories');
			$res = $this->Categories->find('list',['conditions'=>['id'=>$param[1]] ])->toList();
			return __($res[0]);
		}
		return urldecode (__($param[1]));
	}
	
	public function adrs($text){
		$AddHtmlEnd = false;
		$text = trim ($text);
		//$text = preg_replace('{(.)\2+}','$1',$text); 
        $text = preg_replace('{( ?.)\1{2,}}','$1$1',$text);
		$text = preg_replace('/ /', '_', $text);
		$text = preg_replace('/أ|إ|آ/', 'ا', $text);
		$text = preg_replace('/~/', '_', $text);
		$text = preg_replace('/`|\!|\@|\#|\^|\&|\(|\)|\|/', '', $text);
		$text = preg_replace('/{|}|\[|\]/', '_', $text);
		$text = preg_replace('/\+|\*|\/|\=|\%|\$|×/', '', $text);
		$text = preg_replace('/,|\.|\'|;|\?|\<|\>|"|:/', '', $text);
		$text = preg_replace('/^_/', '', $text);
		$text = preg_replace('/_$/', '', $text);
		$text = preg_replace('/_/', '-', $text);
		if ($AddHtmlEnd) {
			$text .= '.html';
		}
		return strtolower($text);
	}
	
	public function appendURL($var, $cond=false){
		$url_arr = @explode('?', $_SERVER['REQUEST_URI']);
		$url = @explode('&', $url_arr[1]) ;
		if (empty($url)) {  return false;  }
		if($cond == 'array'){
			return $url;
		}
		if($cond == 'remove'){
			$ind = array_search($var, $url);
			unset($url[$ind]);
		}else{
			array_push($url, $var);
		}
		$newurl=[]; $complex_arr=[];
		foreach($url as $uVal){
			$ind = @explode('=',$uVal);
			if(!empty($ind[0])){
				$complex_arr[$ind[0]] = [ $ind[0], $ind[1] ];
			}
		}
		
		foreach($complex_arr as $itm){
			$newurl[]= $itm[0].'='.$itm[1] ;
		}
		
		if($cond == 'params'){
			return '?'.implode('&',$newurl);
		}
		return $url_arr[0].'?'.implode('&',$newurl);
	}
	
	public function lcl($arr, $fields=false){
        if(is_string($arr)){ return __($arr, true); }
        if(is_object($arr)){ $arr = (array)$arr; }
		$res=[]; 
		foreach($arr as $k=>$v){
            if(is_object($v)){ $v = (array)$v; }
            if($fields){
                $res[$v[ $fields[0] ]] = __($v[ $fields[1] ], true);
                if(count($fields)>2){
                    $res[$v[ $fields[0] ]].= ' ('.$v[ $fields[2] ].')';
                }
            }else{
                $res[$k] = __($v, true);
            }
		}
		return $res;
	}
    
	/*public function SortableLink($title, $url, $fieldName ,$var){
		if($var['orderdir'] == 'DESC'){
			$var['orderdir'] = 'ASC';
		}else{
			$var['orderdir'] = 'DESC';
		}
		$var['orderby'] = $fieldName;
		$url = $this->appendURL ($url, $var);
		return sprintf ('<a href="%s">%s</a>', $url, $title);
	}*/
	
	/*public function paging($total, $type='numbers', $separator=' ', $perpage=PPAGE){
		$prms_arr=array();
		$url = $this->here.'?';
		if(!empty($_GET)){
			foreach($_GET as $key => $val){
				if($key !== 'p'){
					$prms_arr[] =$key.'='.$val;
				}
			}
			if(!empty($prms_arr)){
				$url .= implode('&',$prms_arr) . '&';
			}
		}
		!isset($_GET['p']) ? $_GET['p']=1 : 1==1;
		if($total>$perpage){
			for($i=0; $i<floor($total / $perpage); $i++){
				if($_GET['p'] == ($i+1)){
					echo '<span>'.($i+1).'</span>'.$separator;
				}else{
					echo '<a href='.$url.'p='.($i+1).'><span>'.($i+1).'</span></a>'.$separator;
				}
			}
		}
	}*/
	
	/*public function setLen($txt, $len=40){
		if(strlen($txt) > $len){
			strpos($txt, ' ', $len) > 0 ? $spacepos = strpos($txt, ' ', $len) : $spacepos = strrpos($txt, ' ');
			$newtxt = substr($txt, 0, $spacepos).'...';
			return $newtxt;
		}else{
			return $txt.'...';
		}
	}*/
	
//	public function captcha($tar, $lbl=false, $type='numeric', $chars = 4){
//		$salt=Security::salt();
//		$canvas_w = $chars * 20;
//		
//		echo '
//        <table style="width:auto;">
//            <tr>
//                <td>
//                <div id="inp'.$tar.'"></div>'.
//                    $this->_View->Form->control('CaptchaCode', 
//                        ['id'=>'CaptchaCode'.$tar, 
//                         'name'=>'CaptchaCode'.$tar, 
//                         'label'=>false,
//                         'placeholder' => __('CaptchaCode')]).'
//                </td>
//                <td>
//                    <a href="javascript:void(0);" onclick="setCaptcha("'.$salt.'", "'.$tar.'","'.$type.'", '.$chars.'); title="'.__('click_to_refresh').'">
//                        <canvas width="'.$canvas_w.'" height="30" id="can'.$tar.'" style="direction:ltr; display:block-inline;"></canvas>
//                    </a>
//                </td>
//            </tr>
//        </table>
//
//        <script> 
//        $( document ).ready(function() {
//          setCaptcha("'.$salt.'", "'.$tar.'","'.$type.'", '.$chars.');
//        });
//        </script>';
//    
//	}
//	public function captcha($tar, $lbl=false, $type='numeric', $chars = 4){
//		$salt=Security::getSalt();
//		$canvas_w = $chars * 20;
//		
//		echo "
//        <table style='width:auto;'>
//            <tr>
//                <td>
//                    <div id='inp".$tar."'></div>".
//                        $this->_View->Form->control('CaptchaCode', 
//                             ['id'=>'CaptchaCode'.$tar, 'name'=>'CaptchaCode'.$tar, 'style'=>'width:120px;display:block-inline;', 'label'=>false, 'ng-model'=>'CaptchaCode'.$tar, 'maxlength'=>$chars, 'placeholder'=>__('CaptchaCode'), 'class'=>'form-control text-center'])."
//                </td>
//                <td>
//                    <a href=\"javascript:void(0);\" onclick=\"setCaptcha('".$salt."', '".$tar."','".$type."', ".$chars.");\" title='".__('click_to_refresh')."' style='height:28px; display:block'>
//                        <canvas width='".$canvas_w."' height='30' id='can".$tar."' style='direction:ltr; display:block-inline;'></canvas>
//                    </a>
//                </td>
//            </tr>
//        </table>
//        
//        <script> 
//            $( document ).ready(function() {
//              setCaptcha('".$salt."', '".$tar."','".$type."', ".$chars.");
//            });
//        </script>";
//	}
    
    
//    public function gen_secret($type='', $chars='', $tar=''){
//        
//        
//        $type = empty($type) ? 'numeric' : $type;
//        $chars = empty($chars) ? 4 : $chars;
//        $tar = empty($tar) ? 'secret' : $tar;
//        
//		$salt=Security::getSalt();
//        $schema=[
//            'alphaNumeric'=> ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v', 'w','x','y','z','0','1', '2','3','4','5','6','7','8','9'],
//            'alpha'=> ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p', 'q','r','s','t','u','v','w','x','y','z'],
//            'numeric'=>['0','1','2','3','4','5','6','7','8','9']
//        ];
//        $secret = '';
//        for($i=0; $i<$chars; $i++){
//            $secret .= $schema[$type][ rand(0, count($schema[$type])-1 ) ];
//        }
//        if($tar == 'secret'){
//            return $secret;
//        }
//        $pointer = rand(0, $chars);
//        
//        $res = $secret.substr(0, $pointer) . $salt.substr(0,21) . $secret.substr($pointer, -1) . $salt.substr(21, -1);
//            
//        return $res;
//    }
    public function captcha($tar, $lbl=false, $type='numeric', $chars = 4){
		$salt=Security::getSalt();
//		$secretSource = $this->gen_secret('','','source');
//		$secret = $this->gen_secret();
		$canvas_w = $chars * 20;
		
		echo "
        <table style='width:auto;'>
            <tr>
                <td>
                    <div id='inp".$tar."'></div>".
            
                        $this->_View->Form->control('CaptchaCode'.$tar, 
                             ['id'=>'CaptchaCode'.$tar, 
                              'name'=>'CaptchaCode'.$tar,
                              'ng-model'=>'CaptchaCode'.$tar,
//                              'dt-src'=>$secretSource, 
                              
                              'style'=>'width:120px;display:block-inline;', 
                              'label'=>false,  
                              'maxlength'=>$chars, 
                              'placeholder'=>__('CaptchaCode'), 
                              'class'=>'form-control text-center'])."
                </td>
                <td>
                    <a href=\"javascript:void(0);\" onclick=\"setCaptcha('".$salt."', '".$tar."','".$type."', ".$chars.");\" title='".__('click_to_refresh')."' id='captcha_btn_".$tar."' style='height:28px; display:block'>
                        <canvas width='".$canvas_w."' height='30' id='can".$tar."' style='direction:ltr; display:block-inline;'></canvas>
                    </a>
                </td>
            </tr>
        </table>
        
        <script> 
            $( document ).ready(function() {
              setCaptcha('".$salt."', '".$tar."','".$type."', ".$chars.");
            });
        </script>";
	}
	
	public function num($num){
		return number_format(floor($num));
	}
	
	
	/*public function currencyCalc($from_id, $sum, $ext=true){				
		
			convrting conditions and rules
			
			USD -> SAR = N * SAR[c_rate]
			USD -> TRY = N * TRY[c_rate]
			
			TRY -> USD = ( USD[c_rate] / TRY[c_rate] ) * N
			SAR -> USD = ( USD[c_rate] / SAR[c_rate] ) * N
			
			TRY -> SAR = ( USD[c_rate] / TRY[c_rate] ) * ( N * SAR[c_rate] )
			SAR -> TRY = ( USD[c_rate] / SAR[c_rate] ) * ( N * TRY[c_rate] )
		
		$res = $sum;
		$to = $this->_View->viewVars['currency'];
		$currencies = $this->_View->viewVars['currencies'];
		$to_id = $unit = null;
		$currencies_arr=[];
		
		foreach($currencies as $v){
			if($v->c_name == $to){$to_id = $v->id;}
			if($v->c_name == 'USD'){$unit = $v;}
			$currencies_arr[$v->id]=$v;
		}
		
		if(($from_id == $to_id) == false){
			if($currencies_arr[$from_id]->c_name == 'USD'){
				$res = $sum * $currencies_arr[$to_id]->c_rate;
			}
			
			if($currencies_arr[$to_id]->c_name == 'USD'){
				$res = ($currencies_arr[ $unit->id ]->c_rate / $currencies_arr[$from_id]->c_rate) * $sum;
			}
			
			if($currencies_arr[$from_id]->c_name !== 'USD' && $currencies_arr[$to_id]->c_name !== 'USD'){

				$res = ($currencies_arr[ $unit->id ]->c_rate / $currencies_arr[$from_id]->c_rate) * ( $sum *  $currencies_arr[$to_id]->c_rate ) ;
			}
		}
		$ext ? $extension = ' '. __($to) : $extension = '';
		return $this->num($res).$extension;
	}*/
	
	public function readFolder($dir, $page=0){
		if(!empty($_GET['p'])){
			$page = $_GET['p'];
		}else{
			$page = 0;
		}
		$appf = $this->_View->viewVars['app_folder'];
		$res=[]; $inc=0; $offset=50;
		if (is_dir($dir)) {
			if (chdir($dir)) {
				array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);
				for ($i=($page*$offset); $i<($page+1)*$offset; $i++) {
					if(!empty($files[$i])){
						if($files[$i] != '..' && $files[$i] != '.' && $files[$i] != 'thumb'){
							$inc++;
							$res[] = $files[$i];
						}
					}
				}
				$pages = ceil(count($files) / $offset);
				echo "<div class='photoPaginator'>";
				for($j=0; $j<$pages; $j++){
					if($j == $page){
						echo '<a class="active">'.($j+1).'</a>';
					}else{
						echo '<a href="?p='.$j.'">'.($j+1).'</a>';
					}
				}
				echo "</div>";
				//krsort($res);
				//debug($res);
				echo '<div>';
				foreach($res as $photo){
					echo '
					<span>
						<a href="javascript:setLink(\''.$appf.'/'.$dir.$photo.'\');">
							<img src="'.$appf.'/'.$dir.$photo.'">
						</a>'.$photo.'
					</span>';
				}
				echo '</div>';
			}
		}else{
			echo 'not dir';
		}
	}
	
	public function tags($txt){
		$txtArr = explode(',',$txt);
		echo '<ul>';
		foreach($txtArr as $val){
			echo '<li>'.$this->_View->Html_View->Html->link($val.' <i class="fa fa-tag" aria-hidden="true"></i>',
				["controller"=>"Articles", "action"=>"index", "keyword"=>$val],
				["escape"=>false]).'</li>';
		}
		echo '</ul>';
	}
	
}

?>