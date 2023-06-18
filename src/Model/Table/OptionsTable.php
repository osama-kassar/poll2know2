<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class OptionsTable extends Table
{
    
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('options');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Polls', [
            'foreignKey' => 'poll_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Hits', [
            'foreignKey' => 'option_id',
			'dependent' => true,
			'cascadeCallbacks' => true
        ]);
    }
    
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

//        $validator
//            ->scalar('option_text')
//            ->maxLength('option_text', 255)
//            ->requirePresence('option_text', 'create')
//            ->notEmptyString('option_text');
//
//        $validator
//            ->scalar('option_configs')
//            ->maxLength('option_configs', 255)
//            ->notEmptyString('option_configs');

        return $validator;
    }
    
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['poll_id'], 'Polls'));

        return $rules;
    }
}
