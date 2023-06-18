<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Score Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $exam_id
 * @property string $score_result
 * @property string $score_configs
 * @property string $user_ip
 * @property string|null $user_email
 * @property string|null $user_name
 * @property string $hits_ids
 * @property \Cake\I18n\FrozenTime $stat_created
 * @property int $rec_state
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Exam $exam
 */
class Score extends Entity
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
        'user_id' => true,
        'exam_id' => true,
        'score_result' => true,
        'score_configs' => true,
        'user_ip' => true,
        'user_email' => true,
        'user_name' => true,
        'hits_ids' => true,
        'stat_created' => true,
        'rec_state' => true,
        'user' => true,
        'exam' => true,
    ];
}
