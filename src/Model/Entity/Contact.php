<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contact Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $contact_fullname
 * @property string $contact_email
 * @property string $contact_phone
 * @property string $contact_info
 * @property string $contact_categories
 * @property \Cake\I18n\FrozenTime $stat_created
 * @property string $stat_ip
 * @property int $rec_state
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Category $category
 */
class Contact extends Entity
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
        'category_id' => true,
        'contact_fullname' => true,
        'contact_email' => true,
        'contact_phone' => true,
        'contact_info' => true,
        'contact_categories' => true,
        'stat_created' => true,
        'stat_ip' => true,
        'rec_state' => true,
        'user' => true,
        'category' => true,
    ];
}
