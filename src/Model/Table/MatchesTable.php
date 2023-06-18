<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class MatchesTable extends Table
{
    
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('matches');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Exams', [
            'foreignKey' => 'exam_id',
            'joinType' => 'INNER',
        ]);
        
        $this->hasOne('Score1', [
            'className' => 'Scores',
            'foreignKey' => 'id',
            'bindingKey' => 'match_score1',
        ])->setProperty('score1');
        
        $this->hasOne('Score2', [
            'className' => 'Scores',
            'foreignKey' => 'id',
            'bindingKey' => 'match_score2',
        ])->setProperty('score2');
        
        
		$this->addBehavior('Inc');
    }
    
    public function validationDefault(Validator $validator)
    {
//        $validator
//            ->integer('id')
//            ->allowEmptyString('id', null, 'create');
//
//        $validator
//            ->integer('match_score1')
//            ->allowEmptyString('match_score1');
//
//        $validator
//            ->integer('match_score2')
//            ->allowEmptyString('match_score2');
//
//        $validator
//            ->dateTime('stat_created')
//            ->notEmptyDateTime('stat_created');
//
//        $validator
//            ->integer('stat_views')
//            ->notEmptyString('stat_views');
//
//        $validator
//            ->integer('stat_shares')
//            ->notEmptyString('stat_shares');
//
//        $validator
//            ->notEmptyString('rec_state');

        return $validator;
    }
    
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['exam_id'], 'Exams'));

        return $rules;
    }
}
