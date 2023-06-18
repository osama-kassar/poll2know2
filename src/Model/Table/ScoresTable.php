<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ScoresTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('scores');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Exams', [
            'foreignKey' => 'exam_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Competitors', [
            'foreignKey' => 'competitor_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Matches', [
            'foreignKey' => 'id',
            'joinType' => 'INNER',
        ]);
        
		$this->addBehavior('Inc');
    }

    public function validationDefault(Validator $validator)
    {

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
//        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['exam_id'], 'Exams'));

        return $rules;
    }
}
