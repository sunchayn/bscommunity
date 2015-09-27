<div class="page inbox-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12 flexbox">
                <aside class="col-m col-2 inbox-panel">
                    <a href="create/message" id="new-msg"><?=Language::invokeOutput('create');?></a>
                    <div>
                        <a href="inbox" <?=isset_get($data['selected'], 'inbox', '');?>><?=Language::invokeOutput('in-menu/inbox');?></a>
                        <a href="inbox?section=sent" <?=isset_get($data['selected'], 'sent', '');?>><?=Language::invokeOutput('in-menu/sent');?></a>
                        <a href="inbox?section=draft" <?=isset_get($data['selected'], 'draft', '');?>><?=Language::invokeOutput('in-menu/draft');?></a>
                    </div>
                </aside>
                <!-- end - aside panel -->
                <div class="col-m col-10 inbox-content">
                    <div class="col-m col-12 heading">
                        <h2><?=Language::invokeOutput('heading'.$data['postfix']);?></h2>
                    </div>
                    <form action="ajax/deleteMessages" method="post" class="col-m col-12 deleteMsg">
                        <input type="hidden" name="token" value="<?=$global['token'];?>">
                        <div class="col-m col-12 box">
                            <div class="col-m col-12 tools">
                                <div class="col-m col-5 a-left">
                                    <input type="checkbox" id="selectAll" class="selectAll">
                                    <label for="selectAll" class="anchorCheckLabel"><?=Language::invokeOutput('check');?></label> -
                                    <a href="#deleteSelected" class="formSubmit"><?=Language::invokeOutput('delete');?></a>
                                </div>
                                <div class='col-m col-7 a-right pagination left-sm'><?=$data['pages'];?></div>
                            </div>
                        </div>
                        <div class="col-m col-12 messages">
                            <?php
                                if (!empty($data['messages']))
                                {
                                    foreach ($data['messages'] as $message)
                                    {
                                        $prefix = '';
                                        $class = '';
                                        if ($data['postfix'] == '1' && $message->sender == $global['logged']->id)
                                        {
                                            $prefix = '<span class="color-5">[' . Language::invokeOutput('prefix/response') . ']</span>';
                                        }elseif($data['postfix'] == '2' && !is_null($message->last_response))
                                            $prefix =  '<span class="color-5">[' . Language::invokeOutput('prefix/inbox') . ']</span>';
                                        if ($message->sender == $global['logged']->id && $message->has_response == '1')
                                            $class = 'unread';
                                        elseif($message->sender != $global['logged']->id && $message->is_rec_read == 0)
                                            $class = 'unread';
                                        include('partials/_inbox.php');
                                    }
                                }else{
                                    echo "<div class='no-data'>" . Language::invokeOutput('no-msg') . "</div>";
                                }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- end grid-section -->
    </div><!-- end sub-wrapper -->
</div>