<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Poll Entity
 *
 * @property int $id
 * @property string $slug
 * @property int $language_id
 * @property int $user_id
 * @property int $category_id
 * @property int $exam_id
 * @property string $poll_title
 * @property string $poll_text
 * @property int $poll_type
 * @property int $poll_priority
 * @property string $poll_configs
 * @property string $poll_tags
 * @property string $seo_keywords
 * @property string $seo_desc
 * @property string $seo_image
 * @property int $stat_hits
 * @property \Cake\I18n\FrozenTime $stat_created
 * @property \Cake\I18n\FrozenTime $stat_publish_at
 * @property int $stat_views
 * @property int $stat_shares
 * @property int $rec_state
 *
 * @property \App\Model\Entity\Language $language
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Exam $exam
 * @property \App\Model\Entity\Comment[] $comments
 * @property \App\Model\Entity\Hit[] $hits
 * @property \App\Model\Entity\Option[] $options
 */
class Poll extends Entity
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
        'slug' => true,
        'language_id' => true,
        'user_id' => true,
        'category_id' => true,
        'exam_id' => true,
        'poll_title' => true,
        'poll_text' => true,
        'poll_type' => true,
        'poll_priority' => true,
        'poll_configs' => true,
        'poll_tags' => true,
        'seo_keywords' => true,
        'seo_desc' => true,
        'seo_image' => true,
        'stat_hits' => true,
        'stat_created' => true,
        'stat_publish_at' => true,
        'stat_ispublic' => true,
        'stat_ispoll' => true,
        'stat_views' => true,
        'stat_shares' => true,
        'rec_state' => true,
        'language' => true,
        'user' => true,
        'category' => true,
        'exam' => true,
        'comments' => true,
        'hits' => true,
        'options' => true,
    ];
}
