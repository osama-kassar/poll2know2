<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Result Entity
 *
 * @property int $id
 * @property int $exam_id
 * @property string $result_name
 * @property string $result_min
 * @property string $result_max
 * @property string $result_text
 * @property string $result_photos
 * @property \Cake\I18n\FrozenTime $stat_created
 * @property int $rec_state
 *
 * @property \App\Model\Entity\Exam $exam
 */
class Result extends Entity
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
        'exam_id' => true,
        'result_name' => true,
        'result_min' => true,
        'result_max' => true,
        'result_text' => true,
        'result_photos' => true,
        'stat_created' => true,
        'rec_state' => true,
        'exam' => true,
    ];
}
