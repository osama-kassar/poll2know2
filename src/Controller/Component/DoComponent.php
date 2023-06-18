<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;

use Cake\ORM\TableRegistry;
use Cake\I18n\I18n;
use Cake\Utility\Security;
use App\Controller\Component\ImagesComponent;
use Cake\Datasource\ConnectionManager;
use Cake\Utility\Hash;

class DoComponent extends Component {
	
	public function get($id, $params=null){
        $res='';
		switch($id){
				
			case 'uid':
				$res = md5($_SERVER['HTTP_USER_AGENT'] .  $_SERVER['REMOTE_ADDR']);
				break;
                
			case 'app_folder':
				$res = Configure::read('app_folder');
				break;
				
			case 'days':
				$res = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
				break;
				
			case 'types':
				$res = [1=>__('one_choice'), 2=>__('multiple_choices'), 3=>__('rate'), 4=>__('add_options')];
				break;
				
			case 'gender':
				$res = [1=>__('female'), 2=>__('male')];
				break;
                
			case 'exam_calc_method':
				$res = [1=>__('percentage_calc'), 2=>__('count_calc'), 3=>__('game')];
				break;
                
			case 'bool':
				$res = ["0"=>__("no"), "1"=>__("yes")];
				break;
                
			case 'exp_method':
				$res = array(1=>__('retail'), 2=>__('wholesale'));
				break;
				
			case 'langs':
				$res = Configure::read('languages');
				break;
				
			case 'module_index':
				$res = Configure::read('module_index');
				break;
                
			case 'langs_ids':
				$res = Configure::read('languages_ids');
				break;
				
			case 'prefered_contacts':
				$res = ['whatsapp', 'phone', 'email'];
				break;
				
			case 'contact_reason':
				$res = ["question", "buy_request", "complain", "other"];
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
				
			case 'mainCategories':
				$res = [1=>__('countries_categories'), 2=>__('articles_categories'), 4=>__('requests_categories'), 7=>__('companies_categories')];
				break;
		}
		return $res;
	}
    
	public function AnswerFilter($txt){
        $txt = trim($txt);
		$txt = preg_replace('/ء|ى|ؤ|ئ|أ|إ|آ/', 'ا', $txt);
        return $txt;
    }
    
    public function get_last_rec_number($table, $tar='Auto_increment')
    {
        $conn = ConnectionManager::get('default');
        $dbName = Configure::read('isLocal') ? 'poll2know' : 'poll2kno_poll2know';
        $q = $conn->execute("SHOW TABLE STATUS FROM `".$dbName."` WHERE `name` LIKE '".$table."' ")->fetchAll('assoc');
        // debug($q);die();
        return $q[0][$tar];
    }
	public function setChartObj($obj, $type='PieChart', $mdl='Polls'){
        $res=[];
        if($type == 'gauge'){
            $res = [
                "data"=>[ ['Label', 'Value'], [trim(strip_tags($obj->name)), $obj->val]],
                "options"=>[
                    "width"=> 800, "height"=> 240,
                    "yellowFrom"=> 25, "yellowTo"=> 75,
                    "redFrom"=> 0, "redTo"=> 25,
                    "greenFrom"=> 75, "greenTo"=> 100,
                    "minorTicks"=> 25,
                    "majorTicks"=> ["0", "25", "50", "75", "100"],
                    "dir"=>"rtl"
//                    "format"=>["suffix"=>"%", "fractionDigits"=>0]
                ],
                "type"=> "Gauge"
            ];
        }
        if($type == 'PieChart'){
            $res["options"] = [ 
            //            "title" => $obj->poll_title,
                "tooltip"=> ["isHtml"=> true, "style"=>""],
                "colors" => ["#eba556", "#7c81e5", "#87e089", "#7bb3eb", "#7a6f8d", "#ce4472", "#4c7494", "#b085b6", "#6c4c8c","#eba556", "#7c81e5", "#87e089", "#7bb3eb", "#7a6f8d", "#ce4472", "#4c7494", "#b085b6", "#6c4c8c"],
                "is3D"=>true,
                "height"=>500,
                "legend"=>"none",
                "pieHole"=>"0.4",
                "dir"=>"rtl"
            ];
            $res["type"] = $type;
            $res["rtlTable"] = true;
            $data = ["cols"=>[
                            ["id"=>"t", "label"=>"Topping", "type"=>"string"],
                            ["id"=>"s", "label"=>"Slices", "type"=>"number"]
                        ], "rows"=>[] ];
            foreach($obj->options as $itm){
                $txt = trim( strip_tags( $itm->option_text ) );
                $txt = preg_replace('/\s+/', ' ', $txt) ;
                $ind = strpos($txt, "http");
                if($ind !== false){
                    $txt = substr($txt, 0, $ind);
                }
                $data["rows"][] = [
                    "c"=>[
                        ["v"=>$txt], 
                        ["v"=>$obj->poll_type == 3 ? $itm->stat_totalrate : $itm->stat_hits]]
                ];
            }
            $res["data"] = $data;
        }
        $chartObj = json_encode($res, JSON_UNESCAPED_UNICODE);
        return $res;
    }
    
	public function isBrowserSupported($returnObj=false){
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
            $bname = 'IE';
            $ub = "MSIE";
        }elseif(preg_match('/Firefox/i',$u_agent)){
            $bname = 'Firefox';
            $ub = "Firefox";
        }elseif(preg_match('/OPR/i',$u_agent)){
            $bname = 'Opera';
            $ub = "Opera";
        }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
            $bname = 'Chrome';
            $ub = "Chrome";
        }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
            $bname = 'Safari';
            $ub = "Safari";
        }elseif(preg_match('/Netscape/i',$u_agent)){
            $bname = 'Netscape';
            $ub = "Netscape";
        }elseif(preg_match('/Edge/i',$u_agent)){
            $bname = 'Edge';
            $ub = "Edge";
        }elseif(preg_match('/Trident/i',$u_agent)){
            $bname = 'IE';
            $ub = "MSIE";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
        }
        $i = count($matches['browser']);
        if ($i != 1) {
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= @$matches['version'][0];
            }else {
                $version= @$matches['version'][1];
            }
        }else {
            $version= $matches['version'][0];
        }

        // check if we have a number
        if ($version==null || $version=="") {$version="?";}

        $b = array(
//            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
//            'pattern'    => $pattern
        );
        if($returnObj){ return $b; }
        $isSupported = true;
        if( $b['name'] == 'IE' ||  $b['name'] == 'Firefox' && $b['version'] < 45  ||  $b['name'] == 'Firefox' && $b['version'] < 53 ){
            $isSupported = false;
        }
        return $isSupported;
    }
    
    public function calcRate($allrats) {
        $totalRates = 0.0;
        foreach($allrats as $itm){
            $totalRates += $itm->hit_answer*1;
        }
        // total Rates / total Hits
        return number_format( $totalRates / count($allrats->toArray()) ,1);
    }
    
    public function isHitted($obj, $type="poll")
    {
		$mdl = TableRegistry::get("Hits");
        if( $type=="poll" ){
            $cond["poll_id"] = $obj->id;
        }else{
            $cond["option_id"] = $obj->id;
            $cond["poll_id"] = $obj->poll_id;
        }
        if( !empty( $this->authUser['id'] ) ){
            $cond["user_id"] = $this->authUser['id'];
        }else{
            $cond["hit_ip"] = $_SERVER["REMOTE_ADDR"];
        }
        $hits_count = $mdl->find("all", ["conditions"=>$cond])->count();
        return $hits_count > 0 ? 1 : 0;
    }
    
    public function getHit($poll)
    {
		$mdl = TableRegistry::get("Hits");
        $cond['poll_id'] = $poll->id;
        $res = [];
        if(!empty($this->authUser['id'])){
            $cond['user_id'] = $this->authUser['id'];
        }else{
            $cond['hit_ip'] = $_SERVER['REMOTE_ADDR'];
        }
        $data = $mdl->find("all", [
            "conditions"=>$cond,
            "fields"=>["option_id"]
        ])->toArray();
        foreach($data as $dt){
            $res[] = $dt->option_id;
        }
        return $res;
    }
    
	public function setHitted($polls, $hits){
        // check options and pick WRONG & RIGHT answers
        for($i=0; $i<count($polls); $i++)
        {
            $answer = 1;
            for($j=0; $j<count($polls[$i]->options); $j++)
            {
                $polls[$i]->options[$j]->option_configs = json_decode($polls[$i]->options[$j]->option_configs, true);
                
                $ind = array_search( $polls[$i]->options[$j]->id, array_column($hits, 'option_id'));
                
                if($ind === false){
                    $polls[$i]->options[$j]->isHitted = 0;
                }else{
                    $polls[$i]->options[$j]->isHitted = 1;
                    if($polls[$i]->poll_type == 4){
                        if($polls[$i]->options[$j]->option_value != $hits[$ind]['hit_answer']){
                            $answer = 0;
                        }
                    }else{
                        if($polls[$i]->options[$j]->option_configs['isCorrect']*1 == 0){
                            $answer = 0;
                        }
                    }
                }
            }
            $polls[$i]->isCorrectAnswer = $answer;
        }
        return $polls;
    }
    
	public function getLangId($lang=null){
        $currlangid = !empty($lang) ? $lang : ($this->get('langs_ids')[$this->request->getParam('lang')]);
        $res = !empty($this->request->getQuery('language_id')) ? $this->request->getQuery('language_id') : $currlangid;
        return $res;
    }
    
	public function convertJson($obj){
        
        if(is_object($obj)){ $obj = $obj->toArray(); }
        
        foreach($obj as $k=>&$elm){

            if(is_object($elm) && !($elm instanceof \Cake\I18n\Time)){ $elm = $elm->toArray(); }

            // recurtion into sub arrays
            if(is_array($elm)){
                $elm = $this->convertJson($elm);
                continue ;
            }

            // convert json string into json obj
            if(is_string($elm)){
                if(strlen($elm) == 0){ continue; }
                if( $elm[0] == '{' || $elm[0] == '['){
                    $elm =  json_decode($elm, true);
                }
            }

            // convert date object into readable date
            if($elm instanceof \Cake\I18n\Time){
                $elm = $elm->format('Y-m-d H:i:s');
            }

            // convert number to strings
            if(is_numeric($elm)){
                $elm = $elm.'';
            }
        }
        return $obj;
    }
    
	public function getExt($file)
    {
        $file_arr = explode(".", $file);
		$fileext = $file_arr[count($file_arr)-1];
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
    public function slugger($url)
    {
        $url = trim($url);
        $text = preg_replace('{(.)\1+}','$2',$url);
		$text = preg_replace('/ /', '-', $text);
		$text = preg_replace('/أ|إ|آ/', 'ا', $text);
		$text = preg_replace('/~/', '-', $text);
		$text = preg_replace('/`|\!|\@|\#|\^|\&|\(|\)|\|/', '', $text);
		$text = preg_replace('/{|}|\[|\]/', '', $text);
		$text = preg_replace('/\+|\*|\/|\=|\%|\$|×/', '', $text);
		$text = preg_replace('/,|\.|\'|;|\?|\؟|\<|\>|"|:/', '', $text);
		$text = preg_replace('/^_/', '', $text);
		$text = preg_replace('/_$/', '', $text);
		$text = preg_replace('/_/', '', $text);

        return (mb_strtolower($text, 'UTF-8'));
    }
    
    public function keywordMaker($t)
    {
		$text = preg_replace('{(.)\1+}','$1',$t);
		$text = preg_replace('/ /', ' ', $text);
		$text = preg_replace('/أ|إ|آ/', 'ا', $text);
		$text = preg_replace('/~/', ' ', $text);
		$text = preg_replace('/`|\!|\@|\#|\^|\&|\(|\)|\|/', '', $text);
		$text = preg_replace('/{|}|\[|\]/', '', $text);
		$text = preg_replace('/\+|\-|\*|\/|\=|\%|\$|×/', '', $text);
		$text = preg_replace('/,|\.|\'|;|\?|\<|\>|"|:/', '', $text);
		$text = preg_replace('/^_/', '', $text);
		$text = preg_replace('/_$/', '', $text);
		$text = preg_replace('/_/', '', $text);

		$valArr = explode(" ", $text);
		$res = [];
		foreach($valArr as $itm){
			if(strlen($itm)>3 && !in_array($itm, $res)){ 
				$res[] = $itm;
			}
		}
		return implode(",",$res);
    }

    public function getUinfo($isJson=true){
        $info = [
            "agent"=> $this->isBrowserSupported(true)["name"], 
            "ip"=>@$_SERVER['REMOTE_ADDR'], 
            "lang"=>@$_SERVER['HTTP_ACCEPT_LANGUAGE'], 
            "connection"=>@$_SERVER['HTTP_CONNECTION']
        ];
        return $isJson ? json_encode($info) : $info;
    }
    
    public function setLclIds($obj, $lclRec=false){
        $res = !($lclRec) ? ["en"=>"", "ar"=>"", "tr"=>""] : json_decode($lclRec->language_ids, true);
        foreach($this->get('langs_ids') as $k => $v){
            $obj->language_id == $v ? $res[$k] = $obj->id : "";
        }
        return json_encode($res);
    }
    
	public function Num($n){
		$formated = number_format($n, 2, ',', '.');
		return $formated;
	}
	
	public function lcl($arr, $isObj=false){
		$res=[]; 
		foreach($arr as $k=>$v){
			$res[$k] = __($v, true);
		}
        asort($res);
		return $res;
	}
	
	public function setPW($length = 8, $type=1){
        $chrs = ["abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789", "0123456789"];
		$pass = array(); 
		$alphaLength = strlen($chrs[$type]) - 1; 
		for ($i = 0; $i < $length; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $chrs[$type][$n];
		}
		return implode($pass); 
    }
	
	public function call($precedure, $id){
		$conn = ConnectionManager::get('default');
		$dt = $conn->execute("CALL `$precedure`($id);")->fetchAll('assoc')[0]['val'];
		return $dt;
	}
	
	public function getFolder($dir="img/articles/"){
		$res=array();$inc=0;
		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
					if($file != '..' && $file != '.' && $file != 'thumb'){
						$inc++;
						$stat = stat($dir.$file);
						$res[$stat['mtime']+$inc] = $file;
					}
				}
				closedir($dh);
			}
			krsort($res);
		}else{
			$res = 'not dir';
		}
		return $res;
	}
	
	public function delItm($vals, $from, $path){
		$from_arr = explode('|',$from);
		for($i=0; $i<count($vals); $i++){
			if($vals[$i] !== '0'){
				ImagesComponent::deleteFile($path, $vals[$i]);
				unset($from_arr[array_search($vals[$i], $from_arr)]);
			}
		}
		return implode('|',$from_arr) ;
	}
	
	public function isChkd($vals){
		for($i=0; $i<count($vals); $i++){
			if($vals[$i] !== '0'){
				return true;
			}
		}
		return false;
	}
	
	public function getMachineLang($val){
		foreach(Configure::read('languages') as $lang){
			if(strpos($val, $lang) !== false){
				return $lang;
			}
		}
	}
	
	public function adder($dt, $mdl){
		$model = TableRegistry::get($mdl);
		$record = $model->newEntity();
        $errors = [];
        if(is_array(@$dt[0])){
            $data=$dt;
            for($i=0; $i<count($dt); $i++){
                if(isset($dt[$i]['id'])){
                    $record = $model->get($dt['id']);
                    $data[$i] = $model->patchEntity($record, $dt[$i]);
                }else{
                    $data[$i] = $model->newEntity($dt[$i]);
                }
                if($data[$i]->getErrors()){
                    $errors[] = $data[$i]->getErrors();
                }
            }
            if(!empty($errors)){ return $errors; }
            $newRecs = $model->saveMany($data);
            if($newRecs){ return $newRecs; }
            return false;
        }else{
            if(isset($dt['id'])){
                $record = $model->get($dt['id']);
            }
            foreach($dt as $k => $v){
                if($v == "--escape"){continue;}
                $record[$k] = $v;
            }
            if($newRec = $model->save($record)){
                return $newRec;
            }
            return false;
        }
	}
	
	/*public function getConfig($key, $tar=null){
		$tar == null ? $cond = ['config_key'=>$key] : $cond = ['config_key'=>$key, 'config_tar'=>$tar];
		$res = TableRegistry::get('Configs')->find('all', ['conditions'=>$cond])->first();
		return $res->config_val;
	}*/
	
	public function calc($dt, $col){
		$res = 0;
		foreach($dt as $d){
			$res = $res + $d->$col;
		}
		return $res == 0 ? $res = 1 : $res = $res;
	}
	
	public function captchaCheck($dt){
		$salt=Security::getSalt();
		$code = str_replace(substr($salt, 0, 21),'', $dt['CaptchaCodeSource']);
		$code = str_replace(substr($salt, 21),'', $code);
		if($code == @$dt['CaptchaCode']){
			return true;
		}
		return false;
	}
	
	public function increaseHits($clm = 'readcounter'){
		$model = $this->Controller->modelClass;
		$ModelInit = ClassRegistry::init($model);
		
		$id = Router::getParams();
		$val = $ModelInit->find('first', array('conditions'=>"`".$model."`.`id` = '".$id."'", 'fields' => $clm));
		
		$ModelInit->id = $id;
		return $ModelInit->saveField($clm, ($val[$model][$clm]+1));
	}
	
	public function setLbl($dt){
		$res=[];
		foreach($dt as $k => $v){
			$res[$k] = __($v);
		}
		return $res;
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
	public function getParents($cid, $lang){
        $categories = TableRegistry::get('Categories');
        $lvls=['lvl0'=>[], 'lvl1'=>[], 'lvl2'=>[]];
        $res=['lvl0'=>[], 'lvl1'=>[], 'lvl2'=>[]];
        for($i=2; $i>-1; $i--){
            $pid = empty($next_id) ? $cid : $next_id;
            $tar = $categories->get($pid);
            $list = $categories->find('all')->where([
                'parent_id'=>$tar->parent_id, 'language_id'=>$lang
            ])->toArray();
            if($tar->parent_id)
            $next_id = $list[0]->parent_id;
            $res['lvl'.$i]['list'] = Hash::combine($list, '{n}.id', '{n}.category_name'); 
            $res['lvl'.$i]['value'] = $tar->id;
            if($tar->parent_id == 0){break;}
            if(empty( $next_id )){break;}
        }
        $filtered_array = array_filter($res);
        $inc=0;
        foreach($filtered_array as $itm){
            $lvls['lvl'.$inc] = $itm['list'];
            $lvls['lvl'.$inc.'_value'] = $itm['value'];
            $inc++;
        }
        debug($lvls);
        return $lvls;
    }
}
?>








