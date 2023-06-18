<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use Cake\I18n\Time;

class ExamsTable extends Table
{
    
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('exams');
        $this->setDisplayField('exam_title');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Polls', [
            'foreignKey' => 'exam_id',
			'dependent' => true,
			'cascadeCallbacks' => true
        ]);
        $this->hasMany('Competitions', [
            'foreignKey' => 'exam_id',
        ]);
        
        $this->hasMany('Scores', [
            'foreignKey' => 'exam_id',
        ]);
        
        $this->hasMany('Results', [
            'foreignKey' => 'exam_id',
			'dependent' => true,
			'cascadeCallbacks' => true
        ]);
        
        $this->hasMany('Comments', [
            'foreignKey' => 'comment_target_id',
        ])->setConditions([
            'comment_target' => 'Exams',
        ]);
        
        $this->hasMany('Matches', [
            'foreignKey' => 'exam_id',
        ]);
        
        $this->belongsTo('Tags', [
            'foreignKey' => 'exam_tags',
            'joinType' => 'INNER',
        ]);
		$this->addBehavior('Inc');
		$this->addBehavior('Select');
    }
    
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('exam_title')
            ->maxLength('exam_title', 255, __('too_long'))
            ->requirePresence('exam_title', 'create')
            ->notBlank('exam_title', __('error_empty'));
//
//        $validator
//            ->scalar('exam_desc')
//            ->maxLength('exam_desc', 16777215)
//            ->maxLength('exam_desc', 255, __('too_long'))
//            ->requirePresence('exam_desc', 'create')
//            ->notBlank('exam_desc', __('error_empty'));
//
//        $validator
//            ->scalar('seo_keywords')
//            ->maxLength('seo_keywords', 255, __('too_long'))
//            ->requirePresence('seo_keywords', 'create')
//            ->notBlank('seo_keywords', __('error_empty'));


        return $validator;
    }
    
    public function buildRules(RulesChecker $rules)
    {
//        $rules->add($rules->existsIn(['language_id'], 'Languages'));
//        $rules->add($rules->existsIn(['user_id'], 'Users'));
//        $rules->add($rules->existsIn(['category_id'], 'Categories'));

        return $rules;
    }
}
