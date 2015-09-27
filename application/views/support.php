<div class="page support-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12 content-heading">
                <h2><?=language::invokeOutput('heading');?></h2>
                <p class="section-desc"><?=language::invokeOutput('desc');?></p>
            </div>
            <div class="col-m col-12 box">
                <small><?=language::invokeOutput('hint'). ' ';?><a href="FAQ"><?=language::invokeOutput('menu/FAQ');?></a></small>
            </div>
            <div class="col-m col-12">
                <form action="ajax/sendSupport" method="POST" class="ajax">
                    <!-- AJAX LOADER -->
                    <div class="ajax-loader" style="display:none;">
                        <img src="<?=URL;?>/img/loader.gif" alt="ajax-loader"/>
                    </div>
                    <!-- end -  AJAX LOADER -->
                    <div class="col-m col-12 box">
                        <input type="text" name="title" placeholder="<?=Language::invokeOutput('placeholder/title');?>" class="col-12" />
                    </div>
                    <div class="col-m col-12 box">
                        <textarea name="content" class="col-12 bse" rows="17" placeholder="<?=Language::invokeOutput('placeholder/content');?>"></textarea>
                    </div>
                    <div class="col-m col-12 box">
                        <input type="hidden" name="token" value="<?=$global['token'];?>" />
                        <a id="submit-editor" href="#support" class="formSubmit"><?=Language::invokeOutput('submit-label');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                    </div>
                </form>
            </div>
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>