<form id="contacts_form">
    <ul class="shopping-cart-items">
        <li class="followus">
            <div>
            <?=$this->Form->control("categories_ids", ["options"=> $this->Do->lcl($c_list, ["id", "category_name"]), "type"=>"select", "empty"=>false, "class"=>"form-control easySelect", "multiple"=>"multiple", "label"=>__("categories")])?>
            </div>
            <div>
            <?=$this->Form->control("contact_fullname", ["type"=>"text", "class"=>"form-control", "ng-model"=>"rec.contact.contact_fullname", "label"=>__("name")])?>
            </div>
            <div>
            <?=$this->Form->control("contact_email", ["type"=>"text", "class"=>"form-control", "ng-model"=>"rec.contact.contact_email", "label"=>__("email")])?>
            </div>
        </li>
        <li> 
            <button class="btn btn-secondary btn-block  swipe-to-top" type="submit" 
               href="javascript:void(0);"
               ng-click="rec.contact.contact_categories = getSelectVal('.easySelect');
                         callAction ('/contacts/add?ajax=1', 'contact', 'post', 'contact_btn', '', 'contacts_form')"
               id="contact_btn"><span></span> <?=__('send')?></button> </li>
    </ul>
</form>