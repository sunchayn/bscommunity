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
            </div>
            <form action="ajax/updateReply" method="POST" class="ajax">
                <div class="col-m col-12 box">
                    <h3><?=Language::invokeOutput('update/reply');?></h3>
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
                    <textarea id="bseContentHolder" name="content" class="col-12 bse" rows="17" placeholder="<?=Language::invokeOutput('content/reply')?>">
                        <?=isset_get($data['reply'], 'content');?>
                    </textarea>
                </div>
                <div class="col-m col-12 box">
                    <input type="hidden" name="token" value="<?=$global['token'];?>" />
                    <input type="hidden" name="id" value="<?=$data['reply']->id;?>" />
                    <input type="hidden" name="thread_id" value="<?=$data['reply']->thread_id;?>" />
                    <a id="submit-editor" href="#updateReply" class="formSubmit"><?=Language::invokeOutput('submit/reply')?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                </div>
            </form>
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>
<?php Controller::$GLOBAL['addEditor'] = true;?>