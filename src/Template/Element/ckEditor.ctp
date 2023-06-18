<div>
<?php //echo $this->Html->script('/plugins/ckeditor4.4.3/ckeditor') ?>
<?php //echo $this->Html->script('/plugins/ckeditor4.5.11/ckeditor') ?>
<?php echo $this->Form->input($textarea_name,['type'=>'textarea', 'label'=>__($textarea_name)]);?>
<?php 
    $currlang='ar';
    $currlang == 'ar' ? $dir = 'rtl' : $dir = 'ltr'; 
?>

<script>
	CKEDITOR.replace( '<?=$textarea_id?>',
    {
		filebrowserBrowseUrl: '<?=$app_folder?>/pages/photos',
		filebrowserImageBrowseUrl: '<?=$app_folder?>/pages/photos',
		filebrowserUploadUrl: '<?=$app_folder?>/admin/articles/uploadphoto?ajax=1',
		filebrowserImageUploadUrl: '<?=$app_folder?>/admin/articles/uploadphoto?ajax=1',
		contentsLangDirection: '<?=$dir?>',
		//BasePath = '/ckfinder/' ,
		//baseHref : '/img/media/thumb/',
		//image2_prefillDimensions : '/img/media/thumb/',
        startupOutlineBlocks : true,
        forcePasteAsPlainText : true,
//        disallowedContent : 'img{width,height}',
//        extraAllowedContent : 'img[width,height]',
//        allowedContent : true,
        language : "ar",
        toolbar :
        [
            [ 'Maximize', 'ShowBlocks'],
            [ 'Source' ],
            [ 'BidiLtr', 'BidiRtl' ],
            [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ],
            //[ 'Find','Replace' ],
            [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ],
            [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
            
            [ 'Link','Unlink','Anchor' ],
            [ 'Image','Flash','Youtube','Table','HorizontalRule','Smiley','SpecialChar' ], 
            [ 'Format','Styles','Font' ],
            [ 'TextColor','BGColor','FontSize'],

        ],
        height: "450px",
        width: "100%",
    });
    
    
//    CKEDITOR.editorConfig = function( config ) {
//        config.toolbarGroups = [
//            { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
//            { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
//            { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
//            { name: 'forms', groups: [ 'forms' ] },
//            '/',
//            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
//            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
//            { name: 'links', groups: [ 'links' ] },
//            { name: 'insert', groups: [ 'insert' ] },
//            '/',
//            { name: 'styles', groups: [ 'styles' ] },
//            { name: 'colors', groups: [ 'colors' ] },
//            { name: 'tools', groups: [ 'tools' ] },
//            { name: 'others', groups: [ 'others' ] },
//            { name: 'about', groups: [ 'about' ] }
//        ];
//    };
    
    
    
    
	CKEDITOR.on( 'dialogDefinition', function( ev ){
		var dialogName = ev.data.name;
		var dialogDefinition = ev.data.definition;
		if ( dialogName == 'image' ) {
			var infoTab = dialogDefinition.getContents( 'info' );
            
             infoTab.remove('txtBorder');
             infoTab.remove('cmbAlign');
             infoTab.remove('txtWidth');
             infoTab.remove('txtHeight');
             infoTab.remove('txtCellSpace');
             infoTab.remove('txtCellPad');
             infoTab.remove('txtCaption');
             infoTab.remove('txtSummary');
            
			var urlField = infoTab.get( 'txtUrl' );
			urlField['default'] = '<?=$app_folder?>/img/media/';
		}
	});
</script>
</div>