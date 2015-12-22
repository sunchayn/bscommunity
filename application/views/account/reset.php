<div class="page acount-mg-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12 content-heading">
                <h2><?=language::invokeOutput('reset/heading');?></h2>
                <p class="section-desc"><?=language::invokeOutput('reset/desc');?></p>
            </div>
            <form action="ajax/reset" method="post" class="ajax col-m col-12 box">
                <!-- AJAX LOADER -->
                <div class="ajax-loader" style="display:none;">
                    <img src="<?=URL;?>/img/loader.gif" alt="ajax-loader"/>
                </div>
                <!-- end -  AJAX LOADER -->
                <div class="col-m col-12 box">
                    <?php
                        if (is_string($data['result']))
                            echo '<span class="color-6">'. $data['result'] .'</span>';
                        else { ?>
                        <div class="col-m col-12 box"><?=language::invokeOutput('reset/label-pass');?></div>
                        <div class="col-m col-12">
                            <input type="password" name="password" class="col-4" placeholder="<?=language::invokeOutput('reset/placeholder');?>">
                        </div>
                        <div class="col-m col-12 box"><?=language::invokeOutput('reset/label-re');?></div>
                        <div class="col-m col-12">
                            <input type="password" name="re-password" class="col-4" placeholder="<?=language::invokeOutput('reset/placeholder');?>">
                        </div>
                        <div class="col-m col-12 box">
                            <input type="hidden" name="token" value="<?=$global['token'];?>" />
                            <input type="hidden" name="hash" value="<?=$data['result']->hash;?>" />
                            <a href="#send" class="formSubmit"><?=language::invokeOutput('reset/sub');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                        </div>
                    <?php  }  ?>
                </div>
            </form>
            <div class="col-m col-12 box">
            </div>
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>