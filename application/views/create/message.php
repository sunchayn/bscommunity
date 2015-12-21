<div class="page newThreadReply-page">
    <div class="draftResult"><?=Language::invokeOutput('savingDraft');?> <img src="<?=URL;?>img/loader.gif" alt="loader"></div>
    <div class="area sub-wrapper">
            <form action="ajax/sendMessage" method="POST" class="ajax inboxDraft">
                <div class="col-m col-12 box">
                    <h3><?=Language::invokeOutput('create/message')?></h3>
                </div>
                <!-- AJAX LOADER -->
                <div class="ajax-loader" style="display:none;">
                    <img src="<?=URL;?>/img/loader.gif" alt="ajax-loader"/>
                </div>
                <!-- end -  AJAX LOADER -->
                <div class="col-m col-12 box">
                    <?php
                        if (!empty($data['user']))
                        {
                            echo '<input type="hidden" name="receiver" id="uniqueReciever" value="'.$data['user']->id.'"/>';
                            echo "<a href='profile/{$data['user']->id}' class='receiverHolder'>{$data['user']->username}</a>";
                        }
                        else
                        {?>
                            <input type="text" name="receiver" id="getReceiver" placeholder="<?=Language::invokeOutput('placeholder/receiver');?>" class="col-2 draftTrigger" />
                            <span class="not-found color-5"></span>
                        <?php } ?>
                </div>
                <div class="col-m col-12 box">
                    <input type="text" name="title" placeholder="<?=Language::invokeOutput('placeholder/message');?>" class="col-12 draftTrigger" />
                </div>
                <div class="col-m col-12 box">
                    <textarea name="content" class="col-12 bse draftTrigger" rows="17" placeholder="<?=Language::invokeOutput('content/message');?>"></textarea>
                </div>
                <div class="col-m col-12 box">
                    <input type="hidden" name="token" value="<?=$global['token'];?>" />
                    <input type="hidden" name="draft" value="<?=$data['draft'];?>">
                    <a class="formSubmit" href="#sendMsg"><?=Language::invokeOutput('submit/message');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                </div>
            </form>
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>
<?php Controller::$GLOBAL['draftVariable'] = true; ?>