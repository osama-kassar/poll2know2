<form class="form-inline" ng-submit="searchKeyword.length>2 ? goTo('/<?=$currlang?>/search/'+searchKeyword+'/-1') : opAlert('<?=__('no_keyword')?>', 'error')">
    <div class="search-field-module">
<!--
        <div class="search-field-select">
            <?=$this->Form->select('search_category', [__("polls"), __("exams")], [
                "type"=>"select",
                "div"=>false,
                "class"=>"selectpicker",
                "empty"=>false
            ])?>
        </div>
-->
        <div class="search-field-wrap" style="width: 100%;">
            <?=$this->Form->text('search_keyword', [
                "type"=>"search",
                "div"=>false,
                "placeholder"=>__("search_keyword"),
                "data-placement"=>"bottom",
                "data-toggle"=>"tooltip",
                "title"=>__("search_polls"),
                "ng-model"=>"searchKeyword",
                "ng-change"=>"searchKeyword.length>2 ? callAction('/search/'+searchKeyword+'/-1/?ajax=1', 'searchRes', false, 'search_btn', 'search') : rec.searchRes={};",
                "ng-focus"=>"searchKeyword.length>2 ? callAction('/search/'+searchKeyword+'/-1/?ajax=1', 'searchRes', false, 'search_btn', 'search') : '';",
                "autocomplete"=>"off"
            ])?>
            <button class="btn btn-secondary swipe-to-top" id="search_btn"> <span><i class="fas fa-search"></i></span> </button>
        </div>

        <div class="search_result {{ rec.searchRes.exams.length > 0 || rec.searchRes.polls.length > 0 ? 'res_show' : ''}}" on-click-out>
            <div ng-if="rec.searchRes.exams.length>0">
                <b><?=__('exams')?></b>
                <div ng-repeat="itm in rec.searchRes.exams" class="res_item">
                    <a href="<?=$path.'/'.$currlang?>/exam/{{itm.slug}}">{{itm.exam_title}}</a>
                </div>
            </div>
            <div ng-if="rec.searchRes.polls.length>0">
                <b><?=__('polls')?></b>
                <div ng-repeat="itm in rec.searchRes.polls" class="res_item">
                    <a href="<?=$path.'/'.$currlang?>/poll/{{itm.slug}}">{{itm.poll_title}}</a>
                </div>
            </div>
        </div>
    </div>
</form>