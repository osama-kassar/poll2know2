<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;

class ContactsController extends AppController
{
    public function add()
    {
        $this->autoRender = false;
        $contact = $this->Contacts->newEntity();
        
        if ($this->request->is('post')) {
            
            $dt = json_decode(file_get_contents('php://input'), true);
            $dt['contact_categories'] = json_encode((array)$dt['contact_categories']);
            
            $contact = $this->Contacts->patchEntity($contact, $dt);
            $contact->user_id = empty( $this->Auth->User("id") ) ? 0 :  $this->Auth->User("id");
            $contact->category_id = 0;
            $contact->contact_phone = 0;
            $contact->contact_info = $this->Do->getUinfo();
            $contact->stat_created = date("Y-m-d H:i:s");
            $contact->stat_ip = $_SERVER['REMOTE_ADDR'];
            $contact->rec_state = 0;
            if ($this->Contacts->save($contact)) {
                echo json_encode(["status"=>"SUCCESS"]); 
                die();
            }
            echo json_encode($contact->getErrors());
            die();
        }
    }
    
    public function emailus()
    {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $dt = json_decode(file_get_contents('php://input'), true);
            $dt['user_info'] = $this->Do->getUinfo(false);
            
            if(!$this->Do->captchaCheck($dt)){
                echo json_encode([
                    "status"=>"FAIL", 
                    "data"=> ["CaptchaCode".$dt['captchaId']=> [
                        "_required"=> __("captcha_error")
                    ]]]); die();
            }
            $email = new Email();
            $email->setFrom( $this->mailer )
                ->setTo('poll2know@gmail.com')
                ->setSubject(__('from_emailus'))
                ->setEmailFormat('html')
                ->setViewVars(['content' => $dt])
                ->viewBuilder()
                    ->setLayout('emails')
                    ->setTemplate('default');
            
            if($email->send()){
                echo json_encode(["status"=>"SUCCESS", "data"=>1]); die();
            }
            echo json_encode(["status"=>"FAIL", "data"=>0]); die();
        }
    }
    
    
    function beforeFilter(Event $event) 
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'emailus']);
    }
}
