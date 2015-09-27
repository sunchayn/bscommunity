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
            <form action="ajax/updateThread" method="POST" class="ajax">
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
                <div class="col-m col-12 box">
                    <input type="hidden" name="token" value="<?=$global['token'];?>" />
                    <input type="hidden" name="id" value="<?=isset_get($data['thread'], 'id');?>" />
                    <a id="submit-editor" href="#editThread" class="formSubmit"><?=Language::invokeOutput('submit/thread')?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                </div>
            </form>
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>
<?php Controller::$GLOBAL['addEditor'] = true;?>