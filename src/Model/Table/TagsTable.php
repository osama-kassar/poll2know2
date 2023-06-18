<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TagsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('tags');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        
        $this->hasMany('Exams', [
            'foreignKey' => 'exam_tags',
        ]);
        $this->hasMany('Polls', [
            'foreignKey' => 'poll_tags',
        ]);
    }
    
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('tag')
            ->maxLength('tag', 255)
            ->requirePresence('tag', 'create')
            ->notEmptyString('tag');

        $validator
            ->notEmptyString('rec_state');

        return $validator;
    }
}
