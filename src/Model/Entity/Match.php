<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Match Entity
 *
 * @property int $id
 * @property int $exam_id
 * @property int|null $match_score1
 * @property int|null $match_score2
 * @property \Cake\I18n\Time $stat_created
 * @property int $stat_views
 * @property int $stat_shares
 * @property int $rec_state
 */
class Match extends Entity
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
        'match_score1' => true,
        'match_score2' => true,
        'stat_created' => true,
        'stat_views' => true,
        'stat_shares' => true,
        'rec_state' => true,
    ];
}
