<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Competitor Entity
 *
 * @property int $id
 * @property int $competition_id
 * @property string $competitor_name
 * @property string $competitor_email
 * @property string $competitor_configs
 * @property int $competitor_score
 * @property string $competitor_info
 * @property \Cake\I18n\FrozenTime $stat_created
 * @property int $rec_state
 *
 * @property \App\Model\Entity\Competition $Competition
 */
class Competitor extends Entity
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
        'competition_id' => true,
        'competitor_name' => true,
        'competitor_email' => true,
        'competitor_gender' => true,
        'competitor_configs' => true,
        'competitor_score' => true,
        'competitor_info' => true,
        'stat_created' => true,
        'stat_updated' => true,
        'stat_ip' => true,
        'rec_state' => true,
        'Competition' => true,
    ];
}
