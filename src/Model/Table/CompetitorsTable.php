<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CompetitorsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('competitors');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Competitions', [
            'foreignKey' => 'competition_id',
            'joinType' => 'INNER',
        ]);
        $this->hasOne('Scores')
            ->setDependent(true);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('competitor_name')
            ->maxLength('competitor_name', 255)
            ->requirePresence('competitor_name', 'create')
            ->notEmptyString('competitor_name');

//        $validator
//            ->scalar('competitor_email')
//            ->maxLength('competitor_email', 255)
//            ->requirePresence('competitor_email', 'create')
//            ->notEmptyString('competitor_email');
//
//        $validator
//            ->scalar('competitor_configs')
//            ->requirePresence('competitor_configs', 'create')
//            ->notEmptyString('competitor_configs');
//
//        $validator
//            ->integer('competitor_score')
//            ->requirePresence('competitor_score', 'create')
//            ->notEmptyString('competitor_score');
//
//        $validator
//            ->scalar('competitor_info')
//            ->maxLength('competitor_info', 255)
//            ->requirePresence('competitor_info', 'create')
//            ->notEmptyString('competitor_info');
//
//        $validator
//            ->dateTime('stat_created')
//            ->requirePresence('stat_created', 'create')
//            ->notEmptyDateTime('stat_created');
//
//        $validator
//            ->requirePresence('rec_state', 'create')
//            ->notEmptyString('rec_state');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['competition_id'], 'Competitions'));

        return $rules;
    }
}
