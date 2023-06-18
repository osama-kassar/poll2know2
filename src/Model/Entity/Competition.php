<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Competition Entity
 *
 * @property int $id
 * @property int $exam_id
 * @property string $competition_title
 * @property \Cake\I18n\FrozenTime $stat_created
 * @property int $rec_state
 */
class Competition extends Entity
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
        'competition_title' => true,
        'seo_image' => true,
        'stat_created' => true,
        'stat_views' => true,
        'stat_shares' => true,
        'rec_state' => true,
    ];
}
