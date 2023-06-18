<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;


/**
 * Users Model
 *
 * @property \App\Model\Table\CommentsTable&\Cake\ORM\Association\HasMany $Comments
 * @property \App\Model\Table\ExamsTable&\Cake\ORM\Association\HasMany $Exams
 * @property \App\Model\Table\HitsTable&\Cake\ORM\Association\HasMany $Hits
 * @property \App\Model\Table\PollsTable&\Cake\ORM\Association\HasMany $Polls
 * @property \App\Model\Table\ScoresTable&\Cake\ORM\Association\HasMany $Scores
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('user_fullname');
        $this->setPrimaryKey('id');

        $this->hasMany('Comments', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Exams', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Hits', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Polls', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Scores', [
            'foreignKey' => 'user_id',
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
            ->scalar('user_fullname')
            ->requirePresence('user_fullname', 'create')
            ->maxLength('user_fullname', 255)
            ->notBlank('user_fullname', __('error_empty'));
        
        $validator
            ->boolean('iagree', __('must_agreed'))
            ->requirePresence('iagree', 'create')
            ->equals('iagree', true, __('must_agreed'));
        
        $validator
            ->scalar('email')
            ->requirePresence('email', 'create')
            ->maxLength('email', 255)
			->add('email', 'valid', ['rule' => 'email', 'message' => __('incorrect_email')])
			->notBlank('email', __('error_empty'))
			->add('email', [
                'unique' => [
                    'message'   => __('not_unique_email'),
                    'provider'  => 'table',
                    'rule'      => 'validateUnique'
                ]
            ]);

        $validator
            ->scalar('password')
            ->requirePresence('password', 'create')
            ->maxLength('password', 32, __('password_too_long'))
            ->minLength('password', 8, __('password_too_short'))
            ->notBlank('password', __('error_empty'));

        return $validator;
    }
    public function buildRules(RulesChecker $rules){
		return $rules;
    }
}
