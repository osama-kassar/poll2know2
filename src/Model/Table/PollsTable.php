<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PollsTable extends Table
{
    
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('polls');
        $this->setDisplayField('poll_title');
        $this->setPrimaryKey('id');
        
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER',
        ]);
        
        $this->belongsTo('Exams', [
            'foreignKey' => 'exam_id',
            'joinType' => 'INNER',
        ]);
        
        $this->hasMany('Hits', [
            'foreignKey' => 'poll_id',
        ]);
        
        $this->hasMany('Options', [
            'foreignKey' => 'poll_id',
			'dependent' => true,
			'cascadeCallbacks' => true
        ]);
        
        $this->hasMany('Comments', [
            'foreignKey' => 'comment_target_id',
        ])->setConditions([
            'comment_target' => 'Polls',
        ]);
        
        $this->belongsTo('Tags', [
            'foreignKey' => 'poll_tags',
            'joinType' => 'INNER',
        ]);
        
		$this->addBehavior('Select');
		$this->addBehavior('Inc');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('poll_title')
            ->maxLength('poll_title', 255, __('too_long'))
            ->requirePresence('poll_title', 'create')
            ->notBlank('poll_title', __('error_empty'));

        $validator
            ->scalar('poll_text')
            ->minLength('poll_text', 10, __('too_short'))
            ->requirePresence('poll_text', 'create')
            ->notBlank('poll_text');

        $validator
            ->scalar('poll_type')
            ->requirePresence('poll_type', 'create')
            ->notBlank('poll_type', __('error_empty'));

//        $validator
//            ->scalar('poll_tags')
//            ->maxLength('poll_tags', 255)
//            ->requirePresence('poll_tags', 'create')
//            ->notBlank('poll_tags', __('error_empty'));

//        $validator
//            ->scalar('seo_image')
//            ->requirePresence('seo_image', 'create')
//            ->notEmptyFile('seo_image', __('error_empty'));

        return $validator;
    }
    
    public function buildRules(RulesChecker $rules)
    {
//        $rules->add($rules->existsIn(['language_id'], 'Languages'));
//        $rules->add($rules->existsIn(['user_id'], 'Users'));
//        $rules->add($rules->existsIn(['category_id'], 'Categories'));
//        $rules->add($rules->existsIn(['exam_id'], 'Exams'));

        return $rules;
    }
}
