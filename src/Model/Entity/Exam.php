<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Exam Entity
 *
 * @property int $id
 * @property int $language_id
 * @property string $slug
 * @property int $user_id
 * @property int $category_id
 * @property string $exam_title
 * @property string $exam_desc
 * @property string $exam_period
 * @property string $seo_keywords
 * @property string $seo_desc
 * @property string $seo_image
 * @property \Cake\I18n\FrozenTime $stat_created
 * @property \Cake\I18n\FrozenTime $stat_publish_at
 * @property int $stat_views
 * @property int $stat_shares
 * @property string $stat_rate
 * @property int $rec_state
 *
 * @property \App\Model\Entity\Language $language
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Poll[] $polls
 * @property \App\Model\Entity\Score[] $scores
 */
class Exam extends Entity
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
        'language_id' => true,
        'slug' => true,
        'user_id' => true,
        'category_id' => true,
        'exam_title' => true,
        'exam_desc' => true,
        'exam_period' => true,
        'exam_calc_method' => true,
        'exam_configs' => true,
        'exam_tags' => true,
        'seo_keywords' => true,
        'seo_desc' => true,
        'seo_image' => true,
        'stat_created' => true,
        'stat_publish_at' => true,
        'stat_ispublic' => true,
        'stat_views' => true,
        'stat_shares' => true,
        'stat_rate' => true,
        'rec_state' => true,
        
        'language' => true,
        'user' => true,
        'category' => true,
        'comments' => true,
        'polls' => true,
        'scores' => true,
        'results' => true,
        
    ];
}
