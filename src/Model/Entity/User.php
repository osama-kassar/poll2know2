<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;



/**
 * User Entity
 *
 * @property int $id
 * @property string $user_fullname
 * @property string $email
 * @property string $password
 * @property string $user_role
 * @property string $user_token
 * @property \Cake\I18n\FrozenTime $stat_lastlogin
 * @property \Cake\I18n\FrozenTime $stat_created
 * @property int $stat_logins
 * @property string $stat_ip
 * @property int $rec_state
 *
 * @property \App\Model\Entity\Comment[] $comments
 * @property \App\Model\Entity\Exam[] $exams
 * @property \App\Model\Entity\Hit[] $hits
 * @property \App\Model\Entity\Poll[] $polls
 * @property \App\Model\Entity\Score[] $scores
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_fullname' => true,
        'email' => true,
        'password' => true,
        'user_role' => true,
        'user_token' => true,
        'stat_lastlogin' => true,
        'stat_created' => true,
        'stat_logins' => true,
        'stat_ip' => true,
        'rec_state' => true,
        'comments' => true,
        'exams' => true,
        'hits' => true,
        'polls' => true,
        'scores' => true,
        'iagree' => true,
        'maillist' => true
    ];
    
    protected $_hidden = [
        'password'
    ];
    
    
    protected function _setPassword($password){
        return (new DefaultPasswordHasher)->hash($password);
    }

}
