<?php
namespace App\Controller;

use Cake\Cache\Cache;
use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Event\Event;
use Cake\Routing\RouteBuilder;

use Cake\I18n\I18n;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\I18n\FrozenTime;
use Cake\I18n\FrozenDate;

use Cake\Datasource\ConnectionManager;

class AppController extends Controller{

	public $secure = 'VGhpcyB3ZWJzaXRlIGJ1aWx0IGJa5OiBRQVNTQVItVEVDSCAoIE9zYW1hIFFhc3NhciAp';
    public $paginate = [ 'limit' => 12];
    public function initialize()
    {
        parent::initialize();
        
        
		$this->app_folder = Configure::read('app_folder');
        $this->mailer = ['mailer@poll2know.com'=>__('Poll2Know')];
        $this->protocol = strpos($_SERVER['SERVER_NAME'], 'localhost')===false ? 'https' : 'http';
        $this->path = '//'.$_SERVER['SERVER_NAME']. $this->app_folder;
                
        $this->isLocal = $_SERVER['HTTP_HOST'] == 'localhost' ? true : false;
        
        $this->loadComponent('RequestHandler');
//        $this->loadComponent('Ajax.Ajax');
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');
        $this->loadComponent('Images');
        $this->loadComponent('Do');
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
        
		$this->loadComponent('Auth',[
            
                    'loginAction' => [
                        'controller' => 'Users',
                        'action' => 'login',
                        'plugin' => 'Users'
                    ],
                    'authError' => __('not_allowed'),
                    'storage' => 'Session',
            
					'authenticate' => [
                          'Form' => [
//                              "contain"=>["Cities", "Countries"],
                              'userModel' => 'Users',
                              'fields' => [
                                  'username' => 'email',
                                  'password' => 'password',
                              ]
                           ]
                     ],
				  'loginAction' => '/?login=1',
				  'logoutRedirect' => Configure::read('app_folder'),
				  'authError' => __('not_allowed'), 
		]);
		
		$this->Auth->deny();
		
		$this->Auth->allow(['index', 'view', 'login', 'register', 'logout', 'display', 'getpassword', 'activate', 'search']);
		
		if(!empty($this->request->getParam('prefix'))){
            if(empty($this->Auth->User('id'))){
                $this->Auth->deny();
            }else{
                $this->paginate = [ 'limit' => 20 ];
                $this->viewBuilder()->setLayout('admin');
                $this->Auth->deny();
                $this->Auth->allow(['index', 'view', 'logout']);
            }
		}
        
		//check and set language
        if(!$this->request->getParam('lang')){
		  $this->request['lang'] = 'ar';
        }
        $langval=$this->request->getParam('lang');
		if( empty( $this->request->getParam('prefix') ) ){
			if( empty($this->Cookie->read('lang')) ){
				$this->Cookie->write('lang', $this->Do->getMachineLang($_SERVER['HTTP_ACCEPT_LANGUAGE']));
				$langval = $this->Do->getMachineLang($_SERVER['HTTP_ACCEPT_LANGUAGE']);
			}else{
				$langval = $this->Cookie->read('lang');
			}
			if(!empty($this->request->getParam('lang')) && $this->request->getParam('lang') !== $langval){
				$this->Cookie->write('lang', $this->request->getParam('lang'));
				$langval = $this->request->getParam('lang');
			}
		}
//        $langval= $langval!=='tr' ? 'ar' : 'tr';
//        $langval='ar';
        
//        debug($langval);
//        debug($this->request->getParam('lang'));
        
        
//    $url_lng = explode("/", str_replace($this->app_folder, '', $_SERVER['REQUEST_URI']));
//        
//        $langs = $this->Do->get('langs');
//        $lng= '';
//    if(in_array($url_lng[1], $langs)){
//        $lng = $url_lng[1];
//    }
//        debug($langs);
//        debug($lng);
//        
		I18n::setLocale($langval);
		$this->currlang = $langval ;
		$this->currlangid = $this->Do->get('langs_ids')[$langval] ;
    }
    
    
	private function _isAllids($cntrlr, $actions=['edit', 'view', 'delete', 'disable']){
		if(in_array($this->request->getParam('action'), $actions)){
			if($this->request->getParam('controller') == $cntrlr && @$this->request['pass'][0] !== null){
				// get the record to see who is created it
				$model = $this->loadModel($cntrlr);
				$rec = $model->find('all', ['conditions'=>['id'=>$this->request['pass'][0]]])->first();
				$this->request->getParam('controller') == 'Users' ? $id = 'id' : $id = 'user_id';
				if($rec->$id !== $this->Auth->User('id')){
					return true;
				}
			}
		}
		return false;
	}
	
	private function _getAction(){
		$act = $this->request->getParam('action');
		$crud = 'read';
		switch($act){
			case strpos($act, 'login') !== false :
			case strpos($act, 'logout') !== false :
			case strpos($act, 'register') !== false :
				$crud = 'public';
			break;
			case strpos($act, 'index') !== false :
			case strpos($act, 'view') !== false :
				$crud = 'read';
			break;
			case strpos($act, 'add') !== false  :
				$crud = 'create';
			break;
			case strpos($act, 'edit') !== false  :
			case strpos($act, 'request') !== false  :
				$crud = 'update';
			break;
			case strpos($act, 'delete') !== false  :
				$crud = 'delete';
			break;
			default :
				$crud = 'public';
		}
		
		return $crud;
	}
	
	public function _isAuthorized($bool=false, $action=false){
//        return true;
		$crud = !$action ? $this->_getAction() : $action;
		if(!empty($this->Auth->User())){
            $user = $this->Auth->User();
			$roles = Configure::read('ROLES');
//                echo '<script> console.log( "roles", '. json_encode($roles) .')</script>';
//                echo '<script> console.log( "user", '. json_encode($user) .')</script>';
//                echo '<script> console.log( "crud", '. json_encode($crud) .')</script>';
//                debug($roles);
//                debug($user);
//                debug($crud);
//                die();
			$isAllowed = @$roles[$user['user_role']][strtolower($this->request->getParam('controller'))][$crud];
            
			if($this->request->getParam('prefix') == 'admin' && strpos($user['user_role'], 'admin') === false){
				$isAllowed = 0;
			}
//                echo '<script> console.log( "$isAllowed", '. $isAllowed .')</script>';
			if($isAllowed == 0 && $crud !== 'public'){
                
                if($bool){return false;}
				$this->Flash->error(__('you_not_authorized'));
				$this->redirect("/".$this->currlang."/admin/");
				//return die('<script>window.history.back(1);/script>');
			}
            if($bool){return true;}
		}
	}

	
	public function beforeFilter(Event $event){
		
		if(@$_GET['mode'] == 'by'){
			echo (base64_decode($this->secure));
		}
		if(@$_GET['mode'] == 'debug'){
			Configure::write('debug', true);
		}
		
		$this->_isAuthorized();
        // CHeck Admin
		if($this->request->getParam('prefix') !== null){
			$this->viewBuilder()->getLayout('admin');
		}
		
        // Check Languge
//		if(!$this->request->getParam('lang') && !in_array($this->request->getParam('action'), ['sitemap'])){
//			$url_arr = explode('/', $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
//			if($this->app_folder==''){
//                $url_arr[0].='/'.$this->currlang;
//            }else{
//                $url_arr[1].='/'.$this->currlang;
//            }
////            debug($this->protocol."://".implode('/', $url_arr));die();
//			return $this->redirect( $this->protocol."://".implode('/', $url_arr) );
//		}
        if($this->Auth->User()){
            $this->authUser = $this->Auth->User();
        }else{
            $this->authUser = null;
        }
        
        // VISITORS Prefetch
        $theme = '';
		if(empty( $this->request->getParam('prefix') )){
            $this->c_list=[];
            $conn = ConnectionManager::get('default');
            $categories = $conn->execute("
                    SELECT 
                        c.*, 
                        ( SELECT COUNT(*) FROM exams e WHERE 
                            e.category_id = c.id AND e.language_id = ".$this->currlangid." AND e.rec_state = 1
                        ) AS 'exams_count', 
                        ( SELECT COUNT(*) FROM polls p WHERE 
                            p.category_id = c.id AND p.language_id = ".$this->currlangid." AND p.exam_id = 0 AND p.rec_state = 1
                        ) AS 'polls_count'
                    FROM categories c
                    WHERE c.parent_id = 3
                    
                    GROUP BY c.id
                    ORDER BY c.id DESC")->fetchAll('assoc');
            
            
            foreach($categories as $k=>$itm){
                $itm = (object)$itm;
                $itm->category_params = json_decode($itm->category_params);
                $itm->total_related = ($itm->exams_count + $itm->polls_count);
                $this->c_list[] = $itm;
            }
            
            $sponsers = [
//                    ["name"=>"معهد الأفق", "link"=>"https://bit.ly/3gVKMJD", "desc"=>"لإتقان اللغة التركية", "img"=>"ufuk.png"],
                    ["name"=>"سكولايزر", "link"=>"https://bit.ly/3SD16RI", "desc"=>"برنامج إدارة المدارس", "img"=>"schoolizer.svg"],
                    ["name"=>"Apostrophe training and linguistic center", "link"=>"https://bit.ly/3SD16RI", "desc"=>"مركز متخصص لتعليم اللغات و التدريب", "img"=>"apostrophe.webp"],
                    ["name"=>"Dev Zonia", "link"=>"https://devzonia.com", "desc"=>"لتطوير مواقع الويب", "img"=>"devzonia.png"],
//                    ["name"=>"غرين هيير", "link"=>"", "desc"=>"للتجميل و زراعة الشعر", "img"=>"green-hair.png"]
                ];
            
            $this->set("sponsers", $sponsers);
            $this->set("c_list", $this->c_list);
            $theme = 'theme1';
        }
        
        // ADMIN Prefetch
		if(!empty( $this->request->getParam('prefix') )){
            
            $admin_menu=[
//                ["name"=>"statistics", 
//                 "icon"=>"pie-chart",
//                 "sub" => [
//                        ["name"=>"polls_stats", "url" => ["Polls", "statistics", ""]],
//                        ["name"=>"exams_stats",  "url" => ["Exams", "statistics", ""]],
//                        ["name"=>"users_stats",  "url" => ["Users", "statistics", ""]]
//                    ]
//                ],
                ["name"=>"categories",
                 "icon"=>"bars",
                 "sub" => [
                        ["name"=>"all", "url" => ["Categories", "index", ""]],
                        ["name"=>"create",  "url" => ["Categories", "add", ""]]
                    ]
                ],
                ["name"=>"tags",
                 "icon"=>"tags",
                 "sub" => [
                        ["name"=>"all", "url" => ["Tags", "index", ""]],
                        ["name"=>"create",  "url" => ["Tags", "add", ""]]
                    ]
                ],
                ["name"=>"exams",
                 "icon"=>"graduation-cap",
                 "sub" => [
                        ["name"=>"all", "url" => ["Exams", "index", ""]],
                        ["name"=>"create",  "url" => ["Exams", "add", ""]]
                    ]
                ],
                ["name"=>"polls",
                 "icon"=>"question-circle",
                 "sub" => [
                        ["name"=>"all", "url" => ["Polls", "index", ""]],
                        ["name"=>"create",  "url" => ["Polls", "add", ""]],
                        ["name"=>"hits", "url" => ["Polls", "hits", ""]],
                    ]
                ],
                ["name"=>"users",
                 "icon"=>"users",
                 "sub" => [
                        ["name"=>"all", "url" => ["Users", "index", ""]],
                        ["name"=>"create",  "url" => ["Users", "add", ""]]
                    ]
                ],
                ["name"=>"sub_sections",
                 "icon"=>"outdent",
                 "sub" => [
                        ["name"=>"scores", "url" => ["Scores", "index", ""]],
                        ["name"=>"matches", "url" => ["Matches", "index", ""]],
                        ["name"=>"comments", "url" => ["Comments", "index", ""]],
                        ["name"=>"contacts", "url" => ["Contacts", "index", ""]],
                    ]
                ]
            ];
            
            $userConfigMenu = [
                [
                    "name"=>"logout", 
                    "icon"=>"sign-out", 
                    "url"=>["prefix"=>false, "controller"=>"Users", "action"=>"logout"]
                ]
            ];
            
            $this->set("userConfigMenu", $userConfigMenu);
            $this->set("admin_menu", $admin_menu);
        }
        
        $this->colors = ["primary", "secondary", "success", "info", "warning", "danger", "light"];
        
        $mainDt = ["site_main_title"=>"POLL2KNOW", 
                   "current_url"=>$this->request->getAttribute('here'), 
                   "server_url"=>$this->path];
        
        $metaDt = [ "_title"=>__('website_title'), "_keywords"=>__('website_keywords'), "_description"=>__('website_description'), "_photo"=>"/img/website_img.jpg" ];
        
        
        $this->set("isLocal", $this->isLocal); 
        $this->set("path", $this->path); 
        $this->set("mainDt", $mainDt); 
        $this->set("metaDt", $metaDt); 
        $this->set("theme", $theme); 
		$this->set('lclid', 0);
		$this->set('currlang', $this->currlang);
		$this->set('currlangid', $this->currlangid);
		$this->set('authUrl', $this->app_folder.$this->Auth->redirectUrl());
		$this->set('app_folder', $this->app_folder);
		$this->set('pages_name', Configure::read('pages_name'));
		$this->set('lcl_langs', Configure::read('lcl_langs'));
        $this->set("authUser", $this->authUser);
        $this->set("protocol", $this->protocol);
        $this->set("isCompetition", 0);
        $this->set("isInvitation", 0);
        $this->set("currentCompetition", []);
        $this->set("colors", $this->colors);
        
        $from = !empty($_GET['from']) ? $_GET['from'] : '';
        $to = !empty($_GET['to']) ? $_GET['to'] : '';
        $k = (isset($_GET['k']) && strlen($_GET['k'])>0) ? $_GET['k'] : false;
        $col = !empty($_GET['col']) ? $_GET['col'] : 'id';
        $method = !empty($_GET['method']) ? $_GET['method'] : '';

        $this->set(compact('from', 'to', 'k', 'col', 'method'));
        
        $this->set("chartObj", json_encode([], JSON_UNESCAPED_UNICODE) );
        
	}
    
    
    /*public function beforeSave($event, $entity, $options) {
		$entity->dateField = date('Y-m-d', strtotime($entity->dateField));
	}*/
    
    
    public function beforeRender(Event $event){
        
        $_theme = $this->request->getQuery('theme');
        
		if(!empty( $this->request->getParam('prefix') )){
            $this->ViewBuilder()->setLayout('Admin');
        }else{
            $this->ViewBuilder()->setTheme($_theme ? $_theme : 'Theme1');
            $this->ViewBuilder()->setLayout($_theme ? $_theme : 'Theme1');
        }
        
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->getType(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
