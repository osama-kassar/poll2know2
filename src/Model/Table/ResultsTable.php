<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ResultsTable extends Table
{
    
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('results');
        $this->setDisplayField('result_name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Exams', [
            'foreignKey' => 'exam_id',
            'joinType' => 'INNER'
        ]);
    }

    public function validationDefault(Validator $validator)
    {

        $validator
            ->scalar('result_name')
            ->maxLength('result_name', 255)
            ->requirePresence('result_name', 'create')
            ->notEmptyString('result_name');

        $validator
            ->scalar('result_text')
            ->requirePresence('result_text', 'create')
            ->notEmptyString('result_text');

        return $validator;
    }

    
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['exam_id'], 'Exams'));

        return $rules;
    }
}
