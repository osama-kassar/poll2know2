<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class HitsTable extends Table
{
    
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('hits');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Polls', [
            'foreignKey' => 'poll_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Options', [
            'foreignKey' => 'option_id',
            'joinType' => 'INNER',
        ]);
    }
    
    public function validationDefault(Validator $validator)
    {
//        $validator
//            ->integer('id')
//            ->allowEmptyString('id', null, 'create');
//
//        $validator
//            ->scalar('hit_answer')
//            ->maxLength('hit_answer', 255)
//            ->requirePresence('hit_answer', 'create')
//            ->notEmptyString('hit_answer');
//
//        $validator
//            ->scalar('hit_userinfo')
//            ->maxLength('hit_userinfo', 255)
//            ->requirePresence('hit_userinfo', 'create')
//            ->notEmptyString('hit_userinfo');
//
//        $validator
//            ->scalar('hit_ip')
//            ->maxLength('hit_ip', 255)
//            ->requirePresence('hit_ip', 'create')
//            ->notEmptyString('hit_ip');
//
//        $validator
//            ->requirePresence('rec_state', 'create')
//            ->notEmptyString('rec_state');

        return $validator;
    }
    
    public function buildRules(RulesChecker $rules)
    {
//        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['poll_id'], 'Polls'));
        $rules->add($rules->existsIn(['option_id'], 'Options'));

        return $rules;
    }
}
