<ul class="shopping-cart-items dropdown_list">
    <li class="text-center" ng-if="latestScores.length<1">
        <i class="fas fa-spinner fa-pulse"></i>
    </li>
    <li ng-repeat="score in latestScores">
        <a href="<?= $path . '/' . $currlang ?>/scores/view/{{score.id}}">
            <div class="">
                <div class="text-center">
                    <div><?= $this->Html->image("/img/avatars/crown_2.png", ["alt" => "winners", "style" => "height: 30px"]) ?></div>
                    <b>{{score.user_name}}</b>
                </div>
                <div class="greenText">
                    <?= __('score') ?> <b>{{score.score_result}}%</b>
                </div>
                <div>
                    <?= __('exam') ?> {{score.exam.exam_title}}
                </div>
            </div>
        </a>
    </li>
</ul>