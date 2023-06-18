<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class CompetitionsController extends AppController
{
    
    public function index()
    {
        $competitions = $this->paginate($this->Competitions, [
            'order'=>['id'=>'DESC'],
            'contain'=>['Competitors']
        ]);
        $this->set(compact('competitions'));
    }

    public function view($id = null)
    {
        $competition = $this->Competitions->get($id, [
            "contain"=>["Competitors"]
        ]);
        $this->set('competition', $competition);
    }

}
