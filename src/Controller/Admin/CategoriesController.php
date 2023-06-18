<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 *
 * @method \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $conditions = [];
        if(!empty($this->request->getQuery('tar'))){
            $conditions['Categories.language_id'] = $this->request->getQuery('tar');
        }
//        if(!empty($this->request->getQuery('from'))){
//            $conditions['Categories.stat_created >= '] = $this->request->getQuery('from');
//        }
//        if(!empty($this->request->getQuery('to'))){
//            $conditions['Categories.stat_created <= '] = $this->request->getQuery('to');
//        }
        if(!empty($this->request->getQuery('key'))){
            if(is_numeric($this->request->getQuery('key'))){
                $conditions['Categories.parent_id'] = $this->request->getQuery('key');
            }else{
                $conditions['OR'][] = ['Categories.category_name LIKE '=>'%'.$this->request->getQuery('key').'%'];
            }
        }
        $this->paginate = [
            'contain' => ['ParentCategories'],
            'conditions' => $conditions,
            'order'=>['id'=>'DESC']
        ];
        $categories = $this->paginate($this->Categories);
        $targetList = $this->Do->lcl($this->Do->get('langs'));
        $this->set(compact('categories', 'targetList'));
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rec = $this->Categories->get($id, [
            'contain' => [],
        ]);

        $this->set('rec', $rec);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $category = $this->Categories->newEntity();
        if ($this->request->is('post')) {
            $cats = explode("::", $this->request->getData('category_name') );
            $data = [];
            foreach($cats as $k=>$cat){
                $data[$k] = $this->request->getData();
                $data[$k]["category_name"] = $cat;
                $data[$k]["category_params"] = json_encode($this->request->getData('category_params'));
                $data[$k]["slug"] = $this->Do->slugger($cat);
                $data[$k]["rec_state"] = 1;
            }
            $category = $this->Categories->patchEntities($category, $data);
            if ($this->Categories->saveMany($category)) {
                $this->Flash->success(__('save-success'));
                return $this->redirect($this->referer());
            }else{
                $this->Flash->error(__('save-fail'));
            }
        }
        $parents = $this->Categories->ParentCategories->find('list', [
            'conditions' => ['parent_id'=>0]
        ]);
        $languages = $this->Do->lcl( $this->Do->get('langs'));
        $this->set(compact('category', 'parents', 'languages'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => [],
        ]);
        $category->category_params = json_decode($category->category_params);
        if ($this->request->is(['patch', 'post', 'put'])) {
//            debug($this->request->getData());die();
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            $category->category_params = json_encode($this->request->getData('category_params'));
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('save-success'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('save-fail'));
        }
        $parents = $this->Categories->ParentCategories->find('list', [
            'conditions' => ['parent_id'=>0]
        ]);
        $languages = $this->Do->lcl($this->Do->get('langs'));
        $this->set(compact('category', 'parents', 'languages'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        if(!$this->_isAuthorized(true)){
            echo json_encode( ["status"=>"FAIL", "data"=>"no-auth"] );
            die();
        }
        $delRec = $this->Categories->deleteAll(['id IN ' => explode(",", $id)]);
        
        if ($this->request->getQuery('ajax') == '1') {
            if ($delRec) {
                $res = ["status"=>"SUCCESS", "data"=>$delRec];
            }else{
                $res = ["status"=>"FAIL", "data"=>$delRec->getErrors()];
            }
            echo json_encode($res);die();
        }else{
            if ($delRec) {
                $this->Flash->success(__('delete-success'));
            } else {
                $this->Flash->error(__('delete-fail'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function enable($val=1, $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        if(!$this->_isAuthorized(true)){
            echo json_encode( ["status"=>"FAIL", "data"=>"no-auth"] ); die();
        }
        $records = explode(",",$id);
        $errors=[];
        foreach($records as $rec){
            if(!is_numeric($rec)){continue;}
            $dt= $this->Categories->newEntity();;
            $dt["id"] = $rec;
            $dt["rec_state"] = $val;
            if(!$this->Categories->save($dt)){
                $errors[] = $dt->getErrors();
            }
        }
        
        if ($this->request->getQuery('ajax') == '1') {
            if (empty($errors)) {
                $res = ["status"=>"SUCCESS", "data"=>$dt];
            }else{
                $res = ["status"=>"FAIL", "data"=>$dt->getErrors()];
            }
            echo json_encode($res);die();
        }else{
            if (empty($errors)) {
                $this->Flash->success(__('update-success'));
            } else {
                $this->Flash->error(__('update-fail'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
