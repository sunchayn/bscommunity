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
            <div class="col-m col-12 thread-title"><h2><?=$data['thread']->title;?></h2></div>
            <!-- ####### -->
            <!-- # author panel # -->
            <div class="col-m col-12 author-panel">
                <div class="col-m col-4 v-top">
                    <img src="img/logo.png" alt="user-photo" width="100" height="100" class="img-edge v-col"/>
                    <span class="col-4 author-name v-col">
                        <h3><a href="profile/<?=$data['author']->id;?>"><?=$data['author']->username;?></a>
                        </h3>
                        <small><?=$data['author']->country;?></small><br />
                        <small>#<?=$data['author']->id;?></small><br />
                        <small><?=usersAPI::getGender($data['author']->sexe);?></small>
                    </span>
                </div>
                <div class="col-m col-4">
                    <h3><?=Language::invokeOutput('author/stats/title');?></h3>
                    <span><?=Language::invokeOutput('frequent/level'). ' : ' .$data['author']->level;?></span><br />
                    <span><?=Language::invokeOutput('frequent/posts'). ' : ' .$data['author']->posts;?></span><br />
                    <span><?=Language::invokeOutput('frequent/thanked'). ' : ' .$data['author']->thanked;?></span><br />
                    <span><?=Language::invokeOutput('frequent/registerS'). ' : ' .$data['author']->create_date;?></span>
                </div>
                <div class="col-m col-4">
                    <h3><?=Language::invokeOutput('author/contact/title');?></h3>
                    <span><a href="create/message/<?=$data['author']->id;?>"><?=Language::invokeOutput('author/contact/pm');?></a></span><br />
                    <span><a href="#"><?=Language::invokeOutput('author/contact/social');?></a></span><br />
                </div>
            </div>
            <!-- # end - author panel # -->
            <!-- #  ~~~~~~~~ # -->
            <div class="col-m col-12 box">
                <small><?=Language::invokeOutput('frequent/posted'). '  ' .$data['thread']->create;?></small>
                <?php
                if (accessAPI::getInstance()->checkAccessToUpdateThread($data['thread']->author_id))
                    echo "- <small><a href='edit/thread/{$data['thread']->id}'>". Language::invokeOutput('update-thread') ."</a></small>";
                ?>
                - <small><a href="#report-reply" data-reported="<?=$data['thread']->id;?>" data-type="0" data-panel="report-panel" class="reportTrigger triggerPanel"><?=language::invokeOutput('frequent/report');?></a></small>
            </div>
            <!-- #  thread core # -->
            <div class="col-m col-12 thread-core<?=(usersAPI::warExternal())? ' external' : '';?>"><?=renderOutput($data['thread']->content);?></div>
            <!-- #  end - thread core # -->
            <!-- #  ~~~~~~~~ # -->
            <!-- #  thread-footer # -->
            <div class="col-m col-12 thread-footer">
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
                                        <small>senior member</small>
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
            </div>
            <!-- #  end - thread-footer # -->
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
                <div class="col-m col-12 v-middle">
                    <div class="col-10 v-col">
                        <input type="hidden" name="thread_id" value="<?=isset_get($data['thread'], 'id');?>" />
                        <input type="hidden" name="token" value="<?=isset_get($global, 'token');?>" />
                        <div class="content-heading">
                            <h3><?=Language::invokeOutput('addReplyTitle');?></h3>
                            <ul class="section-desc have-arrow">
                                <li><?=Language::invokeOutput('reply-rules/0');?></li>
                                <li><?=Language::invokeOutput('reply-rules/1');?></li>
                            </ul>
                        </div>
                        <textarea rows="10" name="content"></textarea>
                    </div>
                    <div class="col-2 v-col a-center">
                        <a href="#addReply" class="formSubmit"><?=Language::invokeOutput('addReply');?></a><br />
                        <span><?=Language::invokeOutput('frequent/or');?><br /><?=Language::invokeOutput('frequent/open');?></span>
                        <a href="create/reply/<?=isset_get($data['thread'], 'id');?>"><?=Language::invokeOutput('fullReply');?></a>
                    </div>
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
                        <span class="linkHolder"></span>
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