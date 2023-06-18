<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Category Entity
 *
 * @property int $id
 * @property int $language_id
 * @property string $slug
 * @property int $parent_id
 * @property string $category_name
 * @property string $category_params
 * @property int $category_priority
 * @property int $rec_state
 *
 * @property \App\Model\Entity\Category $parent_category
 * @property \App\Model\Entity\Category[] $child_categories
 * @property \App\Model\Entity\Exam[] $exams
 * @property \App\Model\Entity\Poll[] $polls
 */
class Category extends Entity
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
        'parent_id' => true,
        'category_name' => true,
        'category_params' => true,
        'category_priority' => true,
        'category_priority' => [
            'icon'=>true,
            'link'=>true,
            'isProtected'=>true
        ],
        'rec_state' => true,
        'parent_category' => true,
        'child_categories' => true,
        'exams' => true,
        'polls' => true
    ];
}
