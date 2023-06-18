<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CommentsTable extends Table
{
    
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('comments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        
        $this->belongsTo('Polls', [
            'foreignKey' => 'comment_target_id',
        ]);
        
        $this->belongsTo('ParentComments', [
            'className' => 'Comments',
            'foreignKey' => 'parent_id',
        ]);
        
        $this->hasMany('ChildComments', [
            'className' => 'Comments',
            'foreignKey' => 'parent_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->requirePresence('comment_text', 'create')
            ->notBlank('comment_text');
        
        $validator
            ->requirePresence('comment_useremail', 'create')
			->add('comment_useremail', 'valid', ['rule' => 'email', 'message' => __('incorrect_email')])
            ->notBlank('comment_useremail');
        
        $validator
            ->requirePresence('comment_username', 'create')
            ->notBlank('comment_username');


        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
//        $rules->add($rules->existsIn(['user_id'], 'Users'));
//        $rules->add($rules->existsIn(['parent_id'], 'ParentComments'));

        return $rules;
    }
}
