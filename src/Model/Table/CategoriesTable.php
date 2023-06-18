<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Categories Model
 *
 * @property &\Cake\ORM\Association\BelongsTo $Languages
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $ParentCategories
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\HasMany $ChildCategories
 * @property &\Cake\ORM\Association\HasMany $Contacts
 * @property \App\Model\Table\ExamsTable&\Cake\ORM\Association\HasMany $Exams
 * @property \App\Model\Table\PollsTable&\Cake\ORM\Association\HasMany $Polls
 *
 * @method \App\Model\Entity\Category get($primaryKey, $options = [])
 * @method \App\Model\Entity\Category newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Category[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Category|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Category saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Category patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Category[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Category findOrCreate($search, callable $callback = null, $options = [])
 */
class CategoriesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('categories');
        $this->setDisplayField('category_name');
        $this->setPrimaryKey('id');

        $this->belongsTo('ParentCategories', [
            'className' => 'Categories',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ChildCategories', [
            'className' => 'Categories',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('Contacts', [
            'foreignKey' => 'category_id',
        ]);
        $this->hasMany('Exams', [
            'foreignKey' => 'category_id',
        ]);
        $this->hasMany('Polls', [
            'foreignKey' => 'category_id',
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
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug')
			->add('slug', [
                'unique' => [
                    'message'   => __('not_unique_slug'),
                    'provider'  => 'table',
                    'rule'      => 'validateUnique'
                ]
            ]);

        $validator
            ->scalar('category_name')
            ->maxLength('category_name', 255)
            ->requirePresence('category_name', 'create')
            ->notEmptyString('category_name')
			->add('category_name', [
                'unique' => [
                    'message'   => __('not_unique_category_name'),
                    'provider'  => 'table',
                    'rule'      => 'validateUnique'
                ]
            ]);

        $validator
            ->scalar('category_params')
            ->maxLength('category_params', 16777215)
            ->requirePresence('category_params', 'create')
            ->notEmptyString('category_params');

        $validator
            ->notEmptyString('category_priority');

        $validator
            ->requirePresence('rec_state', 'create')
            ->notEmptyString('rec_state');

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
//        $rules->add($rules->existsIn(['language_id'], 'Languages'));
//        $rules->add($rules->existsIn(['parent_id'], 'ParentCategories'));

        return $rules;
    }
}
