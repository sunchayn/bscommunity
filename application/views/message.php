<div class="page inbox-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12 flexbox">
                <aside class="col-m col-2 inbox-panel">
                    <a href="create/message" id="new-msg"><?=language::invokeOutput('create');?></a>
                    <div>
                        <a href="inbox" <?=isset_get($data['selected'], 'inbox', '');?>><?=language::invokeOutput('in-menu/inbox');?></a>
                        <a href="inbox?section=sent" <?=isset_get($data['selected'], 'sent', '');?>><?=language::invokeOutput('in-menu/sent');?></a>
                        <a href="inbox?section=draft" <?=isset_get($data['selected'], 'draft', '');?>><?=language::invokeOutput('in-menu/draft');?></a>
                    </div>
                </aside>
                <!-- end - aside panel -->
                <!-- ######### -->
                <!-- inbox body -->
                <div class="col-m col-10 inbox-content">
                    <div class="col-m col-12 heading v-middle">
                        <a href="<?=isset_get($data, 'back');?>" class="icon-<?=(DIRECTION == 'left') ? 'right' : 'left';?> v-col">&nbsp;<?=Language::invokeOutput('message/back');?></a>
                        <h2 class="inline-b v-col"> - <?=isset_get($data['message'], 'title');?></h2>
                    </div>
                    <div class="col-m col-12 sender-info v-middle">
                        <div class="col-8 v-col v-middle">
                            <?php
                                if ($data['message']->sender === '0')
                                {
                                    ?>
                                    <h3><a href="#administration"><?=Language::invokeOutput('frequent/administration');?></a></h3>
                                    <?php
                                }else{
                            ?>
                            <div class="v-col">
                                <img src="<?=isset_get($data['message'], 'profile_picture');?>" alt="sender-picture" class="img-circel x-50" />
                            </div>
                            <div class="v-col">
                                <h3><a href="profile/<?=isset_get($data['message'], 'uID');?>"><?=isset_get($data['message'], 'username');?></a></h3>
                                <small><?=language::invokeOutput('frequent/level').' '.isset_get($data['message'], 'level');?></small>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="col-4 v-col a-right">
                            <span class="middle"><?=isset_get($data['message'], 'date');?></span><small> ( <?=usersAPI::getDays($data['message']->date).' '.language::invokeOutput('frequent/days');?> ) - </small>
                            <a href="#" class="middle"><?=Language::invokeOutput('frequent/delete');?></a>
                        </div>
                    </div>
                    <!-- ############## -->
                    <div class="col-m col-12 box msg-core"><?=isset_get($data['message'], 'content');?></div>
                    <!-- ############## -->
                    <?php
                        if (!empty($data['sub-inbox'])) {
                            echo '<small>'.language::invokeOutput('sub-inbox').'</small><div class="col-m col-12 sub-inbox">';
                            foreach ($data['sub-inbox'] as $message)
                                include('partials/_subInbox.php');
                            echo '</div>';
                        }
                    ?>
                    <form class="col-m col-12 reply-box ajax noScroll" action="ajax/responseMessage" method="POST">
                        <div class="col-m col-12"><?=Language::invokeOutput('message/reply');?></div>
                        <!-- AJAX LOADER -->
                        <div class="ajax-loader col-m col-12"></div>
                        <!-- end -  AJAX LOADER -->
                        <div class="col-m col-12 box">
                            <textarea rows="7" placeholder="<?=Language::invokeOutput('message/placeholder');?>" name="content"></textarea>
                        </div>
                        <div class="col-m col-12">
                            <input type="hidden" name="token" value="<?=$global['token'];?>">
                            <input type="hidden" name="id" value="<?=isset_get($data['message'], 'id');?>">
                            <a href="#" class="formSubmit"><?=Language::invokeOutput('message/submit');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                        </div>
                    </form>
                </div>
                <!-- end - inbox body -->
            </div>
        </div><!-- end grid-section -->
    </div><!-- end sub-wrapper -->
</div>