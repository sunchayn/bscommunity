<div class="page thread-page">
    <div class="sub-wrapper area">
        <div class="grid-section">
            <div class="col-m col-12 breads">
                <a href="home"><?=$data['page-title'];?></a>
                <i class="icon-angle-<?=DIRECTION;?>"></i>
                <a href="category/<?=$data['cat']->id;?>"><?=$data['cat']->title;?></a>
                <i class="icon-angle-<?=DIRECTION;?>"></i>
                <a href="forum/<?=$data['forum']->id;?>"><?=$data['forum']->title;?></a>
                <i class="icon-angle-<?=DIRECTION;?>"></i>
                <span><?=$data['thread']->title;?></span>
                <div class="clear"></div>
            </div>
            <!-- ####### -->
            <!-- # author panel # -->
            <div class="col-m col-12 author-panel">
                <div class="col-m col-12 center-sm">
                    <h3 class="inline-b middle"><a href="profile/<?=$data['author']->id;?>"><?=$data['author']->username;?></a></h3>&nbsp;<small class="middle">- <?=$data['author']->role;?></small>
                </div>
                <div class="col-m col-12">
                    <div class="col-m col-2 user-picture a-center">
                        <img src="<?=isset_get($data['author'], 'profile_picture', 'unset');?>" alt="user-photo" class="v-col img-circel x-100"/>
                    </div>
                    <div class="col-m col-10">
                        <div class="col-m col-12 author-stats">
                            <div class="col-m col-3">
                                <span><?=$data['author']->level;?></span><br />
                                <?=Language::invokeOutput('frequent/level');?>
                            </div>
                            <div class="col-m col-3">
                                <span><?=$data['author']->posts;?></span><br />
                                <?=Language::invokeOutput('frequent/posts');?>
                            </div>
                            <div class="col-m col-3">
                                <span><?=$data['author']->thanked;?></span><br />
                                <?=Language::invokeOutput('frequent/thanked');?>
                            </div>
                            <div class="col-m col-3">
                                <span><?=usersAPI::getDays($data['author']->create_date);?></span><br />
                                <?=Language::invokeOutput('daysS');?>
                            </div>
                        </div>
                        <div class="col-m col-12">
                            <a href="create/message/<?=$data['author']->id;?>"><?=Language::invokeOutput('author/contact/pm');?></a>
                            <?php 
                                if (isset($data['authorSocial']->facebook) && !empty($data['authorSocial']->facebook))
                                    echo ' - <a href="http://facebook.com/'. $data['authorSocial']->facebook .'">'. Language::invokeOutput('author/contact/facebook') .'</a>';
                            
                                if (isset($data['authorSocial']->twitter) && !empty($data['authorSocial']->twitter))
                                    echo ' - <a href="http://twitter.com/'. $data['authorSocial']->twitter .'">'. Language::invokeOutput('author/contact/twitter') .'</a>';
                            
                                if (isset($data['authorSocial']->youtube) && !empty($data['authorSocial']->youtube))
                                    echo ' - <a href="http://youtube.com/'. $data['authorSocial']->youtube .'">'. Language::invokeOutput('author/contact/youtube') .'</a>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- # end - author panel # -->
            <!-- #  ~~~~~~~~ # -->
            <div class="col-m col-12 box">
                <small><?=Language::invokeOutput('frequent/posted'). '  ' .$data['thread']->create;?></small>
                <?php
                if (accessAPI::getInstance()->checkAccessToUpdateThread($data['thread']->author_id))
                    echo "<span class='middle'>-</span> <small><a href='edit/thread/{$data['thread']->id}'>". Language::invokeOutput('update-thread') ."</a></small> ";
                if (accessAPI::getInstance()->checkAccessToDeleteThread($data['thread']->author_id))
                    echo "<span class='middle'>-</span> <small><a href='#delete-thread' class='deleteThread' data-content='id=".$data['thread']->id."&forum=".$data['forum']->id."&token=".$global['token']."'>". Language::invokeOutput('delete-thread') ."</a></small>";
                ?>
                <span class="middle">-</span> <small><a href="#report-reply" data-reported="<?=$data['thread']->id;?>" data-type="0" data-panel="report-panel" class="reportTrigger triggerPanel"><?=language::invokeOutput('frequent/report');?></a></small>
            </div>
            <!-- #  thread core # -->
            <div class="col-m col-12 thread-core<?=(usersAPI::warExternal())? ' external' : '';?>">
                <?=renderOutput($data['thread']->content);
                    if ($data['thread']->attachments == 1)
                    {
                        ?>
                        <!-- #  attachments # -->
                        <div class="col-m col-12 thread-attachments">
                            <small><?=Language::invokeOutput('thread-attachments');?></small>
                            <div class="col-m col-12">
                                <?=attachmentAPI::getInstance()->getFilesReadyForDownload($data['thread']->id);?>
                            </div>
                        </div>
                        <!-- #  attachments # -->
                        <?php
                    }
                ?>
            </div>
            <!-- #  end - thread core # -->
            <div class="col-m col-12 thread-likes">
                <div class="col-m col-2">
                    <form action="ajax/addThank" method="POST" class="ajaxModal">
                        <input type="hidden" name="thread_id" value="<?=isset_get($data['thread'], 'id');?>">
                        <input type="hidden" name="author_id" value="<?=isset_get($data['author'], 'id');?>">
                        <input type="hidden" name="token" value="<?=isset_get($global, 'token');?>">
                        <a href="#thank" class="formSubmit"><?=Language::invokeOutput('thank');?></a>
                    </form>
                </div>
                <div class="col-m col-10">
                    <?php
                    if (!empty($data['thanks']))
                    {
                        $x = 0;
                        foreach($data['thanks'] as $thank)
                        {
                            if ($x++ == 7) break;
                            echo "<a href='profile/{$thank->thank_user}'>{$thank->username}</a>, ";
                        }
                        echo "<em><a href='#' class='open-modal' id='modalAllThankUsers' data-id='AllThankUsers'>". Language::invokeOutput('seeFullUsers') ."</a></em>";
                    }else{
                        echo Language::invokeOutput('no-thanks');
                    }
                    ?>
                    <!-- modal start -->
                    <div class="overlay"></div>
                    <div id="AllThankUsers" class="modal rad2" >
                        <div class="modal-body">
                            <div class="col-m col-12 content-heading">
                                <h2><?=Language::invokeOutput('thanksModal/title');?></h2>
                                <p class="section-desc">
                                    <?=Language::invokeOutput('thanksModal/descPart1');?>
                                    <strong><a href="profile/<?=isset_get($data['author'], 'id');?>"><?=isset_get($data['author'], 'username');?></a></strong>
                                    <?=Language::invokeOutput('thanksModal/descPart2');?>
                                </p>
                            </div>
                            <?php
                            foreach($data['thanks'] as $thank)
                            {
                                ?>
                                <div class="col-m col-12 usersInModal">
                                    <h4>
                                        <a href="profile/<?=$thank->thank_user;?>"><?=$thank->username;?></a>
                                    </h4>
                                    <small><?=language::invokeOutput('frequent/level').' '.$thank->level;?></small>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-color2 rad cancel f-right">
                                <?=Language::invokeOutput('frequent/cancel');?>
                            </a>
                        </div>
                    </div>
                    <!-- modal end -->
                </div>
            </div>
            <!-- #  ~~~~~~~~ # -->
            <!-- #  operation panel # -->
            <div class="col-m col-12 v-middle operation-panel">
                <div class="col-3 v-col">
                    <a href="create/reply/<?=isset_get($data['thread'], 'id');?>" class="addReplyBtn"><i class="icon-comment"></i> <?=Language::invokeOutput('addReply');?></a>
                </div>
                <div class="col-6 v-col a-center margin">
                    <a href="thread/<?=$data['thread']->id;?>/?order=recent" <?=isset_get($data, 'recent', '');?>"><?=language::invokeOutput('recent');?></a> -
                    <a href="thread/<?=$data['thread']->id;?>/?order=rate" <?=isset_get($data, 'rate', '');?> ><?=language::invokeOutput('rated');?></a>
                </div>
            </div>
            <!-- #  end - operation panel # -->
            <!-- #  ~~~~~~~~ # -->
            <!-- #  replies area # -->
            <div class="col-m col-12 replies-area">
                <?php
                if (!empty($data['replies']))
                {
                    $x = ((int)isset_get($_GET, 'page', 1) - 1 ) * Paginator::$per_page;
                    foreach($data['replies'] as $reply)
                    {
                        $x++;
                        include 'partials/_replies.php';
                    }
                } else
                    echo "<div class='col-m col-12 no-data'>" . Language::invokeOutput('no-replies') . "</div>";
                ?>
            </div>
            <!-- # pagination # -->
            <?=isset_get($data, 'pages')?>
            <!-- # add reply # -->
            <form action="ajax/createReply" method="POST" class="ajax col-m col-12 add-reply noScroll">
                <!-- AJAX LOADER -->
                <div class="ajax-loader" style="display:none;">
                    <img src="<?=URL;?>/img/loader.gif" alt="ajax-loader"/>
                </div>
                <!-- end -  AJAX LOADER -->
                <div class="col-m col-12 reply-box-holder">
                    <div class="text-area">
                        <input type="hidden" name="thread_id" value="<?=isset_get($data['thread'], 'id');?>" />
                        <input type="hidden" name="token" value="<?=isset_get($global, 'token');?>" />
                        <textarea rows="5" name="content" placeholder="<?=Language::invokeOutput('addReply-placeholder');?>"></textarea>
                    </div>
                    <div class="col-m col-12 box-anchors">
                        <a href="#addReply" class="formSubmit"><?=Language::invokeOutput('quick-reply');?></a> -
                        <a href="create/reply/<?=$data['thread']->id;?>"><?=Language::invokeOutput('fullReply');?></a>
                    </div>
                </div>
                <div class="col-m col-12 reply-rules">
                    <small><?=Language::invokeOutput('reply-rules/0');?></small>
                    <small><?=Language::invokeOutput('reply-rules/1');?></small>
                </div>
            </form>
            <!-- report panel !-->
            <div class="panel" id="report-panel">
                <div class="panel-head">
                    <a href="#" class="icon-cancel cancel f-right"></a>
                </div>
                <div class="panel-content grid-section">
                    <div class="col-m col-12">
                        <h2 class="content-heading"><?=Language::invokeOutput('reportPanel/heading');?></h2>
                        <p class="section-desc"><?=Language::invokeOutput('reportPanel/desc');?></p>
                    </div>
                    <form action="ajax/report" method="POST" class="ajax noScroll">
                        <div class="col-m col-12 ajax-loader"></div>
                        <div class="col-m col-12 login-label">
                            <div class="col-m col-12 box">
                                <h4><?=Language::invokeOutput('reportPanel/input1');?></h4>
                                <small><?=Language::invokeOutput('reportPanel/desc1');?></small>
                            </div>
                            <div class="col-m col-12">
                                <textarea class="col-12" name="content" rows="10" placeholder="<?=Language::invokeOutput('reportPanel/placeholder1');?>"></textarea>
                            </div>
                        </div>
                        <div class="col-m col-12 login-label">
                            <a href="#" class="formSubmit"><?=Language::invokeOutput('reportPanel/submit-report');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                            <input type="hidden" name="reported" id="reported" value="" />
                            <input type="hidden" name="type" id="type" value="" />
                            <input type="hidden" name="token" value="<?=$global['token'];?>" />
                        </div>
                    </form>
                </div>
            </div>
            <!-- external links warning !-->
            <div class="panel externalPanel" id="externalLink">
                <div class="panel-head">
                    <a href="#" class="icon-cancel cancel f-right"></a>
                </div>
                <div class="panel-content grid-section">
                    <div class="col-m col-12">
                        <h2><?=language::invokeOutput('external/heading');?></h2>
                        <p><?=language::invokeOutput('external/desc');?></p>
                    </div>
                    <div class="col-m col-12">
                        <bdo dir="auto"><span class="linkHolder"></span></bdo>
                    </div>
                    <div class="col-m col-12">
                        <a href="" class="theLink"><?=language::invokeOutput('external/go');?></a>&nbsp;
                        <i class="icon-<?=DIRECTION;?>"></i>
                    </div>
                    <div class="col-m col-12 hint">
                        <span><?=language::invokeOutput('external/hint');?></span>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- # end sub-wrapper # -->
</div><!-- # end thread-page # -->