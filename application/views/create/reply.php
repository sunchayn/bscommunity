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
                <a href="thread/<?=isset_get($data['thread'], 'id');?>"><?=isset_get($data['thread'], 'title');?></a>
                <i class="icon-angle-<?=DIRECTION;?>"></i>
                <span href="#"><?=Language::invokeOutput('create/reply')?></span>
            </div>
            <form action="ajax/createReply?redirect=true" method="POST" class="ajax editor">
                <div class="col-m col-12 box">
                    <h3><?=Language::invokeOutput('create/reply')?></h3>
                </div>
                <div class="col-m col-12 box">
                    <?=Language::invokeOutput('addReplyTo')?><a href="thread/<?=isset_get($data['thread'], 'id');?>"><?=isset_get($data['thread'], 'title');?></a>
                </div>
                <!-- AJAX LOADER -->
                <div class="ajax-loader" style="display:none;">
                    <img src="<?=URL;?>/img/loader.gif" alt="ajax-loader"/>
                </div>
                <!-- end -  AJAX LOADER -->
                <div class="col-m col-12 box">
                    <textarea id="bseContentHolder" name="content" class="col-12 bse" rows="17" placeholder="<?=Language::invokeOutput('content/reply')?>"></textarea>
                </div>
                <div class="col-m col-12 box">
                    <input type="hidden" name="token" value="<?=$global['token'];?>" />
                    <input type="hidden" name="author_id" value="<?=$global['logged']->id;?>" />
                    <input type="hidden" name="thread_id" value="<?=isset_get($data['thread'], 'id');?>" />
                    <a id="submit-editor" href="#addReply"><?=Language::invokeOutput('submit/reply')?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                </div>
            </form>
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>
<?php Controller::$GLOBAL['addEditor'] = true;?>