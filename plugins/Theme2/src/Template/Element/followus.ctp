<!-- <form id="contacts_form">
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
 -->
<div class="my-dropdown-lg send-dropdown-lg" id="contacts_form">
<style>.dropdown-menu.fade {
   display: block;
   opacity: 0;
   pointer-events: none;
}

.show > .dropdown-menu.fade {
   pointer-events: auto;
   opacity: 1;
}</style>
                <form action="#">
            <?=$this->Form->control("categories_ids", ["options"=> $this->Do->lcl($c_list, ["id", "category_name"]), "type"=>"select", "empty"=>false, "class"=>"form-control easySelect", "multiple"=>"multiple", "label"=>__("categories")])?>

                  <!-- <label>Categories</label>
                  <select name="languages" size="4">
                <option>Art and fun</option>
                  <option>Study and leatning</option>
                  <option>Healthy and medical</option>
                  <option>Trading</option>
                  <option>Industry</option>
                  <option>Tours</option>
                  <option>Sport</option>
                  <option>Peronal</option>
                  <option>Politics</option>
                  <option>Cars</option>
                  <option>Cooking</option>
                </select>
                <span class="select-category">Select Catagory</span> -->
                <div>
            <?=$this->Form->control("contact_fullname", ["type"=>"text", "class"=>"form-control", "ng-model"=>"rec.contact.contact_fullname", "label"=>__("name")])?>

                  <!-- <label for="content-fullname-lg">Name</label>
                  <input
                    type="text"
                    name="content-fullname"
                    id="content-fullname-lg"
                  /> -->
                </div>
                <div>
            <?=$this->Form->control("contact_email", ["type"=>"text", "class"=>"form-control", "ng-model"=>"rec.contact.contact_email", "label"=>__("email")])?>

                  <!-- <label for="content-email-lg">E-mail</label>
                  <input
                  type="text"
                  name="content-email"
                  id="content-email-lg"
                  /> -->
                </div>
                <button type="submit" 
               href="javascript:void(0);"
               ng-click="rec.contact.contact_categories = getSelectVal('.easySelect');
                         callAction ('/contacts/add?ajax=1', 'contact', 'post', 'contact_btn', '', 'contacts_form')"
               id="contact_btn" class="btn text-light w-100 rounded-0"><span></span> <?=__('send')?> </button>
              </form>
            </div>