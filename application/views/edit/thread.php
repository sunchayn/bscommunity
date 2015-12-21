<div class="page newThreadReply-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12 breads">
                <a href="home"><?=isset_get($global, 'site_name');?></a>
                <i class="icon-angle-<?=DIRECTION;?>"></i>
                <a href="category/<?=isset_get($data['category'], 'id');?>"><?=isset_get($data['category'], 'title');?></a>
                <i class="icon-angle-<?=DIRECTION;?>"></i>
                <a href="forum/<?=isset_get($data['forum'], 'id');?>"><?=isset_get($data['forum'], 'title');?></a>
                <i class="icon-angle-<?=DIRECTION;?>"></i>
                <span href="#"><?=Language::invokeOutput('update/thread') . ' ' .isset_get($data['thread'], 'title');?></span>
            </div>
            <form action="ajax/updateThread" method="POST" class="ajax editor">
                <div class="col-m col-12 box">
                    <h3><?=Language::invokeOutput('update/thread')?></h3>
                </div>
                <!-- AJAX LOADER -->
                <div class="ajax-loader" style="display:none;">
                    <img src="<?=URL;?>/img/loader.gif" alt="ajax-loader"/>
                </div>
                <!-- end -  AJAX LOADER -->
                <div class="col-m col-12 box">
                    <input type="text" name="title" placeholder="<?=Language::invokeOutput('placeholder/thread')?>" class="col-12"  value="<?=isset_get($data['thread'], 'title');?>" />
                </div>
                <div class="col-m col-12 box">
                    <textarea id="bseContentHolder" name="content" class="col-12 bse" rows="17" style="display:none;" placeholder="<?=Language::invokeOutput('content/thread')?>"><?=isset_get($data['thread'], 'content');?></textarea>
                </div>
                <div class="col-m col-12 box">
                    <input type="text" name="keywords" class="col-8" placeholder="<?=Language::invokeOutput('placeholder/keywords')?>" value="<?=isset_get($data['thread'], 'keywords');?>" /><br />
                    <small>
                        <?=Language::invokeOutput('setKeywords')?>
                    </small>
                </div>
                <div class="col-m col-12 hidden-item">
                    <input type="hidden" name="token" value="<?=$global['token'];?>" />
                    <input type="hidden" name="id" value="<?=isset_get($data['thread'], 'id');?>" />
                    <input type="hidden" name="attachments" class="attachmentsBus" value="" />
                </div>
                <?php if ($data['thread']->attachments == 1) { ?>
                    <!-- #  attachments # -->
                    <div class="col-m col-12">
                        <small><?=Language::invokeOutput('curr-attachments');?></small>
                        <div class="col-m col-12">
                            <?=attachmentAPI::getInstance()->getFilesReadyForDownload($data['thread']->id);?>
                        </div>
                        <div class="col-m col-12">
                            <input type="checkbox" name="delCurrAttach" id="delC">
                            <label for="delC"><?=language::invokeOutput('delete-curr-attch');?></label>
                        </div>
                    </div>
                    <!-- #  attachments # -->
                <?php } ?>
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
                <a id="submit-editor" href="#editThread"><?=Language::invokeOutput('frequent/update')?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
            </div>
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>
<?php Controller::$GLOBAL['addEditor'] = true;?>