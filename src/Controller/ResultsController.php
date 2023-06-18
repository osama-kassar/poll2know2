<?php
namespace App\Controller;

use App\Controller\AppController;

class ResultsController extends AppController
{
    
    public function delete($id = null)
    {
        $this->autoRender  = false;
        $this->request->allowMethod(['post', 'delete']);
        $result = $this->Results->get($id);
        if ($this->Results->delete($result)) {
            $this->Images->deleteFile('img/results_photos', $result->result_photos);
            $this->Flash->success(__('delete-success'));
        } else {
            $this->Flash->error(__('delete-fail'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function save($id = -1) 
    {
        $this->autoRender  = false;
        $data = json_decode( file_get_contents('php://input'));
        $res=[];
        $res["uploadedPhoto"] = false;
        $oldImage='';
        if($id == '-1'){
            $result = $this->Results->newEntity();
            $data->stat_created = date("Y-m-d H:i:s");
            $data->rec_state = 0;
        }else{
            unset($data->stat_created);
            $result = $this->Results->get($id);
            $oldImage = $result->result_photos;
        }
        // upload, delete photo
        if(!empty($data->img->tmp_name)){
            $thumb = [
                ['doThumb'=>true, 'w'=>450, 'h'=>450, 'dst'=>'thumb']
            ];
            if($this->Images->uploader('img/results_photos', (array)$data->img, '', $thumb)){
                $res["uploadedPhoto"] = true;
                if(!empty($oldImage)){
                    $this->Images->deleteFile("img/results_photos", $oldImage);
                }
                $data->result_photos = $this->Images->getPhotoNames();
            }
        }
        
        $result = $this->Results->patchEntity($result, (array)$data);
        
        if ($newRec = $this->Results->save($result)) {
            $res["status"] = "SUCCESS";
            $res["data"] = $newRec;
        }else{
            $res["status"] = "FAIL";
            $res["data"] = $result->getErrors();
        }
        
        echo json_encode($res);die();
    }
    
}
