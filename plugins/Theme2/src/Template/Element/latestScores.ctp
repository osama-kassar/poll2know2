            <div class="my-dropdown-lg score-dropdown-lg">
              <div class="latest-score">
                <a href="<?= $path . '/' . $currlang ?>/scores/view/{{score.id}}">
                  <div class="text-center name">
                  <?= $this->Html->image("/img/avatars/crown_2.png", ["alt" => "winners"]) ?>
                    <b>{{score.user_name}}</b>
                  </div>
                  <div class="greenText"><?= __('score') ?> <b>{{score.score_result}}%</b></div>
                  <div> <?= __('exam') ?> {{score.exam.exam_title}}</div>
                </a>
              </div>

            </div>