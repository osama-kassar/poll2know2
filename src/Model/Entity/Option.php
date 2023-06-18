<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Option Entity
 *
 * @property int $id
 * @property int $poll_id
 * @property string $option_text
 * @property string $option_photo
 * @property string $option_configs
 * @property int $stat_hits
 * @property float $stat_totalrate
 * @property int $rec_state
 *
 * @property \App\Model\Entity\Poll $poll
 * @property \App\Model\Entity\Hit[] $hits
 */
class Option extends Entity
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
        'poll_id' => true,
        'option_text' => true,
        'option_photo' => true,
        'option_value' => true,
        'option_configs' => true,
        'stat_hits' => true,
        'stat_totalrate' => true,
        'rec_state' => true,
        'poll' => true,
        'hits' => true,
    ];
}
