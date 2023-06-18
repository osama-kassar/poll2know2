
<form class="search-box d-flex">
    <div class="search-field-module" style='width:100%'>
    <div class="search-field-wrap" style="width: 100%;height: 100%;">
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
            <button class="" id="search_btn"> 
                <i class="fas fa-search"></i>        
        </button>
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