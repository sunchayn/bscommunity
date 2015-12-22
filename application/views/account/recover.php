<div class="page acount-mg-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12 content-heading">
                <h2><?=language::invokeOutput('recover/heading');?></h2>
                <p class="section-desc"><?=language::invokeOutput('recover/desc');?></p>
            </div>
            <form action="ajax/recover" method="post" class="ajax col-m col-12 box">
                <!-- AJAX LOADER -->
                <div class="ajax-loader" style="display:none;">
                    <img src="<?=URL;?>/img/loader.gif" alt="ajax-loader"/>
                </div>
                <!-- end -  AJAX LOADER -->
                <div class="col-m col-12 box">
                    <input type="text" name="email" placeholder="<?=language::invokeOutput('recover/placeholder');?>" class="col-7" />
                </div>
                <div class="col-m col-12 box">
                    <input type="checkbox" id="re" name="re-mail">
                    <label for="re"><?=language::invokeOutput('recover/rec-mail');?></label>
                </div>
                <div class="col-m col-12 box">
                    <input type="hidden" name="token" value="<?=$global['token'];?>" />
                    <a href="#send" class="formSubmit"><?=language::invokeOutput('recover/send');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                </div>
            </form>
            <div class="col-m col-12 box">
            </div>
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>