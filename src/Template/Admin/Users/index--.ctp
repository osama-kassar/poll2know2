<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Comment'), ['controller' => 'Comments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exams'), ['controller' => 'Exams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exam'), ['controller' => 'Exams', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Hits'), ['controller' => 'Hits', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hit'), ['controller' => 'Hits', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Polls'), ['controller' => 'Polls', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Poll'), ['controller' => 'Polls', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Scores'), ['controller' => 'Scores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Score'), ['controller' => 'Scores', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_fullname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('password') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_role') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_token') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stat_lastlogin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stat_created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stat_logins') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stat_ip') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rec_state') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->user_fullname) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->password) ?></td>
                <td><?= h($user->user_role) ?></td>
                <td><?= h($user->user_token) ?></td>
                <td><?= h($user->stat_lastlogin) ?></td>
                <td><?= h($user->stat_created) ?></td>
                <td><?= $this->Number->format($user->stat_logins) ?></td>
                <td><?= h($user->stat_ip) ?></td>
                <td><?= $this->Number->format($user->rec_state) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
