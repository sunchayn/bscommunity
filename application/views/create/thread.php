<div class="page newThreadReply-page">
    <div class="draftResult"><?=Language::invokeOutput('savingDraft');?> <img src="<?=URL;?>img/loader.gif" alt="loader"></div>
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12 breads">
                <a href="home"><?=isset_get($global, 'site_name');?></a>
                <i class="icon-angle-<?=DIRECTION;?>"></i>
                <a href="category/<?=isset_get($data['category'], 'id');?>"><?=isset_get($data['category'], 'title');?></a>
                <i class="icon-angle-<?=DIRECTION;?>"></i>
                <a href="forum/<?=isset_get($data['forum'], 'id');?>"><?=isset_get($data['forum'], 'title');?></a>
                <i class="icon-angle-<?=DIRECTION;?>"></i>
                <span href="#"><?=Language::invokeOutput('create/thread');?></span>
            </div>
            <form action="ajax/createThread" method="POST" class="ajax editor inboxDraft">
                <div class="col-m col-12 box">
                    <h3><?=Language::invokeOutput('create/thread')?></h3>
                </div>
                <!-- AJAX LOADER -->
                <div class="ajax-loader" style="display:none;">
                    <img src="<?=URL;?>/img/loader.gif" alt="ajax-loader"/>
                </div>
                <!-- end -  AJAX LOADER -->
                <div class="col-m col-12 box">
                    <input type="text" name="title" placeholder="<?=Language::invokeOutput('placeholder/thread');?>" class="col-12 draftTrigger">
                </div>
                <div class="col-m col-12 box">
                    <textarea id="bseContentHolder" name="content" class="col-12 bse" rows="17" placeholder="<?=Language::invokeOutput('content/thread');?>"></textarea>
                </div>
                <div class="col-m col-12 box">
                    <input type="text" name="keywords" class="col-8 draftTrigger" placeholder="<?=Language::invokeOutput('placeholder/keywords');?>"><br />
                    <small><?=Language::invokeOutput('setKeywords')?></small>
                </div>
                <div class="col-m col-12">
                    <input type="hidden" name="token" value="<?=$global['token'];?>" />
                    <input type="hidden" name="forum_id" value="<?=isset_get($data['forum'], 'id');?>" />
                    <input type="hidden" name="attachments" class="attachmentsBus" value="" />
                    <input type="hidden" name="draft" value="<?=$data['draft'];?>">
                </div>
            </form>
            <form action="ajax/uploadAttachments" method="POST" class="attch-holder" enctype="multipart/form-data">
                <!-- attachment -->
                <div class="col-m col-12 box">
                    <h4 href="#"><?=Language::invokeOutput('attach/add');?></h4>
                    <input type="file" name="attachs[]" class="filesInput" placehodler="<?=Language::invokeOutput('attach/choise');?>" multiple>
                    <small><a href="#upload-attach" class="attch-uploader formSubmit"><?=Language::invokeOutput('attach/upload');?></a></small>
                    <div class="hidden-item upload-loader"><img src="<?=URL;?>/img/loader.gif" alt="ajax-loader"/></div>
                    <div class="att-rslt succ-attch hidden-item"></div>
                    <div class="att-rslt fail-attch hidden-item"></div>
                </div>
                <!-- end -attachment -->
            </form>
            <div class="col-m col-12 box">
                <a id="submit-editor" href="#addThread"><?=Language::invokeOutput('submit/thread');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
            </div>
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>
<?php Controller::$GLOBAL['addEditor'] = true; Controller::$GLOBAL['draftVariable'] = true; ?>