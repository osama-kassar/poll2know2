<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comment Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $parent_id
 * @property string $comment_controller
 * @property string $comment_text
 * @property string $comment_username
 * @property string $comment_useremail
 * @property string $comment_useremoji
 * @property string $comment_info
 * @property string $stat_ip
 * @property \Cake\I18n\FrozenTime $stat_created
 * @property int $rec_state
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Comment $parent_comment
 * @property \App\Model\Entity\Comment[] $child_comments
 */
class Comment extends Entity
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
        'parent_id' => true,
        'comment_target' => true,
        'comment_target_id' => true,
        'comment_target_slug' => true,
        'comment_text' => true,
        'comment_username' => true,
        'comment_useremail' => true,
        'comment_useremoji' => true,
        'comment_info' => true,
        'stat_ip' => true,
        'stat_created' => true,
        'rec_state' => true,
        'user' => true,
        'parent_comment' => true,
        'child_comments' => true,
    ];
}
