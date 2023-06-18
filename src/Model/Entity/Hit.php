<?php

namespace App\Model\Entity;



use Cake\ORM\Entity;

class Hit extends Entity

{
    protected $_accessible = [

        'user_id' => true,
        'poll_id' => true,
        'option_id' => true,
        'hit_answer' => true,
        'hit_userinfo' => true,
        'hit_ip' => true,
        'stat_create' => true,
        'rec_state' => true,
        'user' => true,
        'poll' => true,
        'option' => true,

    ];

}

