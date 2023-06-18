<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Comment'), ['controller' => 'Comments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exams'), ['controller' => 'Exams', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exam'), ['controller' => 'Exams', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hits'), ['controller' => 'Hits', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hit'), ['controller' => 'Hits', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Polls'), ['controller' => 'Polls', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Poll'), ['controller' => 'Polls', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Scores'), ['controller' => 'Scores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Score'), ['controller' => 'Scores', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User Fullname') ?></th>
            <td><?= h($user->user_fullname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Role') ?></th>
            <td><?= h($user->user_role) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Token') ?></th>
            <td><?= h($user->user_token) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stat Ip') ?></th>
            <td><?= h($user->stat_ip) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stat Logins') ?></th>
            <td><?= $this->Number->format($user->stat_logins) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rec State') ?></th>
            <td><?= $this->Number->format($user->rec_state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stat Lastlogin') ?></th>
            <td><?= h($user->stat_lastlogin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stat Created') ?></th>
            <td><?= h($user->stat_created) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Comments') ?></h4>
        <?php if (!empty($user->comments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Poll Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('Comment Text') ?></th>
                <th scope="col"><?= __('Comment Configs') ?></th>
                <th scope="col"><?= __('Stat Ip') ?></th>
                <th scope="col"><?= __('Stat Created') ?></th>
                <th scope="col"><?= __('Rec State') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->comments as $comments): ?>
            <tr>
                <td><?= h($comments->id) ?></td>
                <td><?= h($comments->poll_id) ?></td>
                <td><?= h($comments->user_id) ?></td>
                <td><?= h($comments->parent_id) ?></td>
                <td><?= h($comments->comment_text) ?></td>
                <td><?= h($comments->comment_configs) ?></td>
                <td><?= h($comments->stat_ip) ?></td>
                <td><?= h($comments->stat_created) ?></td>
                <td><?= h($comments->rec_state) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Comments', 'action' => 'view', $comments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Comments', 'action' => 'edit', $comments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Comments', 'action' => 'delete', $comments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Exams') ?></h4>
        <?php if (!empty($user->exams)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Language Id') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Category Id') ?></th>
                <th scope="col"><?= __('Exam Title') ?></th>
                <th scope="col"><?= __('Exam Desc') ?></th>
                <th scope="col"><?= __('Exam Period') ?></th>
                <th scope="col"><?= __('Seo Keywords') ?></th>
                <th scope="col"><?= __('Seo Desc') ?></th>
                <th scope="col"><?= __('Seo Image') ?></th>
                <th scope="col"><?= __('Stat Created') ?></th>
                <th scope="col"><?= __('Stat Publish At') ?></th>
                <th scope="col"><?= __('Stat Views') ?></th>
                <th scope="col"><?= __('Stat Shares') ?></th>
                <th scope="col"><?= __('Stat Rate') ?></th>
                <th scope="col"><?= __('Rec State') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->exams as $exams): ?>
            <tr>
                <td><?= h($exams->id) ?></td>
                <td><?= h($exams->language_id) ?></td>
                <td><?= h($exams->slug) ?></td>
                <td><?= h($exams->user_id) ?></td>
                <td><?= h($exams->category_id) ?></td>
                <td><?= h($exams->exam_title) ?></td>
                <td><?= h($exams->exam_desc) ?></td>
                <td><?= h($exams->exam_period) ?></td>
                <td><?= h($exams->seo_keywords) ?></td>
                <td><?= h($exams->seo_desc) ?></td>
                <td><?= h($exams->seo_image) ?></td>
                <td><?= h($exams->stat_created) ?></td>
                <td><?= h($exams->stat_publish_at) ?></td>
                <td><?= h($exams->stat_views) ?></td>
                <td><?= h($exams->stat_shares) ?></td>
                <td><?= h($exams->stat_rate) ?></td>
                <td><?= h($exams->rec_state) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Exams', 'action' => 'view', $exams->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Exams', 'action' => 'edit', $exams->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Exams', 'action' => 'delete', $exams->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exams->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Hits') ?></h4>
        <?php if (!empty($user->hits)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Poll Id') ?></th>
                <th scope="col"><?= __('Option Id') ?></th>
                <th scope="col"><?= __('Hit Answer') ?></th>
                <th scope="col"><?= __('Hit Userinfo') ?></th>
                <th scope="col"><?= __('Hit Ip') ?></th>
                <th scope="col"><?= __('Rec State') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->hits as $hits): ?>
            <tr>
                <td><?= h($hits->id) ?></td>
                <td><?= h($hits->user_id) ?></td>
                <td><?= h($hits->poll_id) ?></td>
                <td><?= h($hits->option_id) ?></td>
                <td><?= h($hits->hit_answer) ?></td>
                <td><?= h($hits->hit_userinfo) ?></td>
                <td><?= h($hits->hit_ip) ?></td>
                <td><?= h($hits->rec_state) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Hits', 'action' => 'view', $hits->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Hits', 'action' => 'edit', $hits->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Hits', 'action' => 'delete', $hits->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hits->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Polls') ?></h4>
        <?php if (!empty($user->polls)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Language Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Category Id') ?></th>
                <th scope="col"><?= __('Exam Id') ?></th>
                <th scope="col"><?= __('Poll Title') ?></th>
                <th scope="col"><?= __('Poll Text') ?></th>
                <th scope="col"><?= __('Poll Type') ?></th>
                <th scope="col"><?= __('Poll Priority') ?></th>
                <th scope="col"><?= __('Poll Configs') ?></th>
                <th scope="col"><?= __('Poll Tags') ?></th>
                <th scope="col"><?= __('Seo Keywords') ?></th>
                <th scope="col"><?= __('Seo Desc') ?></th>
                <th scope="col"><?= __('Seo Image') ?></th>
                <th scope="col"><?= __('Stat Hits') ?></th>
                <th scope="col"><?= __('Stat Created') ?></th>
                <th scope="col"><?= __('Stat Publish At') ?></th>
                <th scope="col"><?= __('Stat Views') ?></th>
                <th scope="col"><?= __('Stat Shares') ?></th>
                <th scope="col"><?= __('Rec State') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->polls as $polls): ?>
            <tr>
                <td><?= h($polls->id) ?></td>
                <td><?= h($polls->slug) ?></td>
                <td><?= h($polls->language_id) ?></td>
                <td><?= h($polls->user_id) ?></td>
                <td><?= h($polls->category_id) ?></td>
                <td><?= h($polls->exam_id) ?></td>
                <td><?= h($polls->poll_title) ?></td>
                <td><?= h($polls->poll_text) ?></td>
                <td><?= h($polls->poll_type) ?></td>
                <td><?= h($polls->poll_priority) ?></td>
                <td><?= h($polls->poll_configs) ?></td>
                <td><?= h($polls->poll_tags) ?></td>
                <td><?= h($polls->seo_keywords) ?></td>
                <td><?= h($polls->seo_desc) ?></td>
                <td><?= h($polls->seo_image) ?></td>
                <td><?= h($polls->stat_hits) ?></td>
                <td><?= h($polls->stat_created) ?></td>
                <td><?= h($polls->stat_publish_at) ?></td>
                <td><?= h($polls->stat_views) ?></td>
                <td><?= h($polls->stat_shares) ?></td>
                <td><?= h($polls->rec_state) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Polls', 'action' => 'view', $polls->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Polls', 'action' => 'edit', $polls->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Polls', 'action' => 'delete', $polls->id], ['confirm' => __('Are you sure you want to delete # {0}?', $polls->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Scores') ?></h4>
        <?php if (!empty($user->scores)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Exam Id') ?></th>
                <th scope="col"><?= __('Score Result') ?></th>
                <th scope="col"><?= __('Score Created') ?></th>
                <th scope="col"><?= __('Rec State') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->scores as $scores): ?>
            <tr>
                <td><?= h($scores->id) ?></td>
                <td><?= h($scores->user_id) ?></td>
                <td><?= h($scores->exam_id) ?></td>
                <td><?= h($scores->score_result) ?></td>
                <td><?= h($scores->score_created) ?></td>
                <td><?= h($scores->rec_state) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Scores', 'action' => 'view', $scores->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Scores', 'action' => 'edit', $scores->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Scores', 'action' => 'delete', $scores->id], ['confirm' => __('Are you sure you want to delete # {0}?', $scores->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
