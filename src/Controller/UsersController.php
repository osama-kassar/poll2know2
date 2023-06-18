<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\ContactForm;
//use Cake\Auth\AbstractPasswordHasher;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\Utility\Security;

class UsersController extends AppController{
	
	public function dashboard() {
		$user = $this->Auth->User();
		$req = $this->loadModel('Requests');
        
		$views = $this->loadModel('Requests')->find("all", [
			"conditions"=>["user_id"=>$user['id']],
			"fields"=>["val"=>"SUM(Requests.stat_views)"]
		])->toArray()[0]->val;
        
		$shares = $this->loadModel('Requests')->find("all", [
			"conditions"=>["user_id"=>$user['id']],
			"fields"=>["val"=>"SUM(Requests.stat_shares)"]
		])->toArray()[0]->val;
        
        $company = $this->Users->Companies->find("all",[
				"conditions"=>["user_id"=>$user['id']], 
				"fields"=>["stat_views","stat_shares"] ])->first();
        $total_req = $this->loadModel('Requests')->find("all",["conditions"=>["user_id"=>$user['id']] ])->count();
		$stats = [
			//"req_views"=>$this->Do->call('requests_stat_views', $user['id']),
			//"req_shares"=>$this->Do->call('requests_stat_shares', $user['id']),
			"req_views"=>empty($views) ? 0 : $views,
			"req_shares"=>empty($shares) ? 0 : $shares,
			"req_total"=>empty($total_req) ? 0 : $total_req ,
			"company"=>empty($company) ? (object)["stat_views"=>0, "stat_shares"=>0] : $company
		];
        $this->set(compact('user','stats'));
	}
	public function login() {
		if(!empty(strpos($_SERVER['REQUEST_URI'], 'ajax'))){
			$this->autoRender = false;
			$this->request->data = json_decode(file_get_contents('php://input'), true);
		}
		if(!is_null($this->Auth->user('id'))){
			echo json_encode(["status"=>false, "user"=>$this->Auth->user()]); return ;
		}
		if ($this->request->is('post')) {
            
			$user = $this->Auth->identify();
            
			if (!$user) { 
                echo json_encode(["status"=>false, "user"=>$user]); return ;
            }else{
				$user = $this->Do->convertJson( $user );
			}
            
            $lastlogin = date("Y-m-d H:i:s");
            
			if ($user['rec_state'] == 1) {
				$this->Auth->setUser($user);
                $this->Do->adder([
                    "id"=>$user['id'], 
                    "stat_lastlogin"=>$lastlogin,
                    "stat_logins"=>$user['stat_logins']+1
                ], "Users");
				$this->Cookie->write('User', $user);
            }else{
                echo json_encode(["status"=>"NOT_ACTIVE", "user"=>$user]); return ;
            }
			echo json_encode(["status"=>true, "user"=>$user]); return ;
		}
    }
	
    public function logout() {
        $this->autoRender = false;
        if( !empty( $this->Auth->User("id") ) ){
            echo $this->Auth->User("id");
            $this->Cookie->delete('User');
            return $this->redirect($this->Auth->logout());
        }
    }
    
    public function register() {
		if(!empty($this->Auth->User('id')) && $this->Auth->User('role') !== 'root'){
			$this->Flash->error(__('one_account_allowed'));
			$this->redirect(['controller'=>'Users', 'action'=>'dashboard']);
		}
		
		$user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            if(!empty(strpos($_SERVER['REQUEST_URI'], 'ajax'))){
                $this->autoRender = false;
                $userDT = json_decode(file_get_contents('php://input'), true);
            }else{
                $userDT = $this->request->data;
            }
			$user = $this->Users->patchEntity($user, $userDT);
			$user->stat_created = date("Y-m-d H:i:s");
			$user->user_role = 'user.free';
			$user->stat_ip = $_SERVER['REMOTE_ADDR'];
			$user->rec_state = 0;
			$user->user_token = base64_encode($user->email.'-'.$user->password);
            
            $newRec = $this->Users->save($user);
            if ($newRec) {
                
                $newRec['app_folder'] = $this->app_folder;
				$email = new Email();
				$email->from( $this->mailer )
					->to($newRec->email)
					->subject(__('new_account'))
					->emailFormat('html')
                    ->viewVars(['content' => $newRec])
                    ->viewBuilder()
                        ->layout('emails')
                        ->template('register_tm');
                
				if($email->send()){
                    if(@$_GET['ajax'] == 1){echo json_encode(["status"=>"SUCCESS"]); die ;}
                    $this->Flash->success(__('send-success'));
                }else{
                    if(@$_GET['ajax'] == 1){echo json_encode(["status"=>"FAIL"]); die ;}
                    $this->Flash->error(__('send-fail'));
                }
            }else{
				if(@$_GET['ajax'] == 1){echo json_encode($user->getErrors());die();}
                $this->Flash->error(__('register-fail'));
			}
        }
		if(@$_GET['ajax'] == 1){
			return json_encode($user);
		}else{
			$this->set(compact('user'));
			$this->set('_serialize', ['user']);
		}
    }
	
	public function activate($code=null){
		$this->autoRender = false;
		$checkUser = $this->Users->find('all',['conditions'=>['user_token'=>$code]])->first();
        
		if($checkUser == null){
			$this->Flash->error(__('expired_link'));
			return $this->redirect('/');
		}
		if($checkUser->user_token == $code){
			$user = $this->Users->newEntity();
			$user->id = $checkUser->id;
			$user->rec_state = '1';
			$user->user_token = '1';
			if($this->Users->save($user)){
				$this->Flash->success(__('account_activated'));
			}else{
				$this->Flash->error(__('error_activated_msg'));
			}
			$this->redirect("/?login=1");
		}else{
			$this->Flash->error(__('wrong_id'));
			$this->redirect("/");
		}
	}
	
	public function getpassword($code = null){
        $this->autoRender = false;
		
        // SET NEW PASSWORD
		if($code){
            $userDT = $this->Users->findByUserToken($code)->first()->toArray();
            if(empty($userDT)){
                $this->Flash->error(__('email_not_found'));
                return $this->redirect('/');
            }
            $this->Auth->setUser($userDT);
            $this->Cookie->write('User', $userDT);
			return $this->redirect(['controller'=>'Users', 'action'=>'myaccount']);
        }
        
        
        
        // SEND EMAIL CONTAIN LINK TO SET PASSWORD
		if(!empty( $this->Auth->User('id') )){
			return $this->redirect(['controller'=>'Users', 'action'=>'myaccount']);
		}
        $userDT = json_decode(file_get_contents('php://input'), true);
        
        $checkUser = $this->Users->findByEmail( $userDT['email'] )->first();
        if(empty($checkUser)){
            if(@$_GET['ajax'] == 1){ echo -1; die(); }
            $this->Flash->error(__('email_not_found'));
        }
        $checkUser['user_token'] = $this->Do->setPW(32,0);
        $checkUser['app_folder'] = $this->app_folder;
        
		$user = $this->Users->newEntity();
        $user->id = $checkUser['id'];
        $user->user_token = $checkUser['user_token'];
        if($upRec = $this->Users->save($user)){
            $email = new Email();
            $email->from( $this->mailer )
                ->to($userDT['email'])
                ->subject(__('new_password_subject'))
                ->emailFormat('html')
                ->viewVars(['content' => $checkUser])
                ->viewBuilder()
                    ->layout('emails')
                    ->template('getpassword_tm');
            
            if($email->send()){
                if(@$_GET['ajax'] == 1){echo 1; die();}
                $this->Flash->success(__('send-success'));
                $this->redirect(['controller'=>'users', 'action'=>'login']);
            }else{
                if(@$_GET['ajax'] == 1){echo 0; die();}
                $this->Flash->success(__('send-success'));
            }
        }
		
        $this->set('user', $user);
	}
	
//    public function view($id = null){
//        $user = $this->Users->get($id, [
//            'contain' => []
//        ]);
//        $this->set('user', $user);
//        $this->set('_serialize', ['user']);
//    }
//	
//	public function packages(){
//		$id = $this->Auth->User('id'); 
//        $user = $this->Users->get($id, [
//            'contain' => []
//        ]);
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            $user = $this->Users->patchEntity($user, $this->request->data);
//            if ($this->Users->save($user)) {
//                $this->Flash->success(__('save-success'));
//                return $this->redirect($this->referer());
//            } else {
//                $this->Flash->error(__('save-fail'));
//            }
//        }
//		$this->set(compact('user'));
//        $this->set('_serialize', ['user']);
//    }
//	
//	
//	public function delphoto(){
//		$this->autoRender = false;
//		$id = $this->Auth->User('id'); 
//		$user = $this->Users->get( $id );
//		$dt['id'] = $id;
//		$dt[ $_GET['field'] ] = $this->Do->delItm( [$_GET['photo']], $user[$_GET['field']], 'img/users_photos' );
//		$res = $this->Do->adder($dt, 'Users');
//		if( $res  ){
//            $user->photo = $res->photo;
//            $this->request->session()->write('Auth.User.photo', '');
//        	$this->Flash->success(__('save-success'));
//         	return $this->redirect('/myaccount');
//		}
//	}
//	
//    public function edit($id = null){
//		$id = $this->Auth->User('id'); 
//        $user = $this->Users->get($id, [
//            'contain' => []
//        ]);
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            //debug($this->Auth->User());die();
//            if(!empty($this->request->data['new_password'])){
//				$user->password = $this->request->data['new_password'];
//			}
//            $user = $this->Users->patchEntity($user, $this->request->data);	
//			
//			// delete multiple selected photos
//			/*if($this->Do->isChkd( $user->photo_list ) || !empty($_FILES['photo_0']['name'])){
//				$user->photo = $this->Do->delItm( [$user->photo], $user->photo, 'img/users_photos' );
//			}*/
//			if(!empty($_FILES['photo_0']['name'])){
//				$img = $_FILES['photo_0'];
//				$thumb_params = array(
//					array('doThumb'=>true, 'w'=>300, 'h'=>300, 'dst'=>'thumb')
//					);
//				$this->Do->delItm( [$user->photo], $user->photo, 'img/users_photos' );
//				$this->Images->uploader('img/users_photos', $img, 'profile_'.$user->id, $thumb_params, 1);
//				$user->photo = $this->Images->photosname[0];
//				$this->request->session()->write('Auth.User.photo', $this->Images->photosname[0]);
//			}
//            if ($this->Users->save($user)) {
//                $this->Flash->success(__('save-success'));
//                return $this->redirect($this->referer());
//            } else {
//                $this->Flash->error(__('save-fail'));
//            }
//        }
//		$languages = $this->Do->get('langs');
//		
//        $cities = $this->Do->lcl( 
//			$this->loadModel('Categories')->find('list')
//				->where( ['parent_id'=>$user->country_id] )
//				->orWhere( ['id'=>$user->country_id] )
//		);
//        
//		$this->set(compact('user','languages','countries','cities'));
//        $this->set('_serialize', ['user']);
//    }
//	
//	public function delete($id = null){
//		$this->autoRender = false;
//		$this->request->allowMethod(['post', 'delete']);
//		
//		$record = $this->Users->get($id);
//		$record->status == 1 ? $enbled = 0 : $enbled = 1;
//		$record->id = $id;
//		$record->status = $enbled;
//		if ($this->Users->save($record)){
//			$this->Flash->success(__('disable-success').' '.$enbled);
//		} else {
//			$this->Flash->error(__('disable-fail'));
//		}
//		return $this->redirect(['action' => 'index']);
//		
//    }
    
}