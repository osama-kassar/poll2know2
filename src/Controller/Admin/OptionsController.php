<?php

namespace App\Controller\Admin;


use App\Controller\AppController;

class OptionsController extends AppController
{
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories'],
        ];
        $options = $this->paginate($this->Options);
        $this->set(compact('options'));
    }
    
    public function view($id = null)
    {
        $option = $this->Options->get($id, [
            'contain' => ['Languages', 'Users', 'Categories', 'Exams', 'Comments', 'Hits', 'Options'],
        ]);

        $this->set('option', $option);
    }

    public function delete($id = null)
    {
        $this->autoRender  = false;
        $option = $this->Options->get($id);
        if ($delRec = $this->Options->delete($option)) {
            $this->Images->deleteFile('img/options_photos', $option->option_photo);
            $res = ["status"=>"SUCCESS", "data"=>$delRec];
        }else{
            $res = ["status"=>"FAIL", "data"=>$option->getErrors()];
        }
        echo json_encode($res);die();
    }
    
    public function save($id=-1)
    {
        $this->autoRender  = false;
        $data = json_decode( file_get_contents('php://input'));
        if(@$data->poll_type == 4){
            $data->option_value = $this->Do->AnswerFilter($data->option_value);
        }
        if( $id > -1){
            $option = $this->Options->get($id, [
                'contain' => [],
            ]);
        }else{
            $option = $this->Options->newEntity();
        }

        $option = $this->Options->patchEntity($option, (array)$data);
        if ($newRec = $this->Options->save($option)) {
            $res = ["status"=>"SUCCESS", "data"=>$newRec];
        }else{
            $res = ["status"=>"FAIL", "data"=>$option->getErrors()];
        }
        echo json_encode($res);die();
    }
    
}
