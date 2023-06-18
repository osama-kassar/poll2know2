<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CompetitionsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('competitions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Exams', [
            'foreignKey' => 'exam_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Competitors', [
            'foreignKey' => 'competition_id',
			'dependent' => true,
			'cascadeCallbacks' => true
        ]);
        $this->hasMany('Comments', [
            'foreignKey' => 'comment_target_id',
        ])->setConditions([
            'comment_target' => 'Competitions',
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('competition_title')
            ->maxLength('competition_title', 255)
            ->requirePresence('competition_title', 'create')
            ->notEmptyString('competition_title');

        $validator
            ->dateTime('stat_created')
            ->requirePresence('stat_created', 'create')
            ->notEmptyDateTime('stat_created');

        $validator
            ->requirePresence('rec_state', 'create')
            ->notEmptyString('rec_state');

        return $validator;
    }
    
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['exam_id'], 'Exams'));

        return $rules;
    }
}
