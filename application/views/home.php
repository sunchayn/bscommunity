<!-- # content area # -->
<div class="page index-page">
    <div class="sub-wrapper grid-section">
        <section class="col-m col-12 general-welcome">
            <h3><?=Language::invokeOutput('welcome-heading') .' '. $global['site_name'];?></h3>
            <?php if (usersAPI::isLogged()){ ?>
                <p><?=Language::invokeOutput('members-welcome/part-one').'<strong>'.$global['logged']->username.'</strong>'.Language::invokeOutput('members-welcome/part-two');?></p>
           <?php } else { ?>
                <p><?=Language::invokeOutput('visitors-welcome');?></p>
           <?php } ?>
        </section>
        <!-- # categories area # -->
        <section class="col-m col-12 category-section">
        <?php
         if (!empty($data['categories'])) {
             foreach ($data['categories'] as $cat)
                 include 'partials/_categories.php';
         }else{
             echo '<div class="col-m col-12 no-data">'. Language::invokeOutput('no-cat') .'</div>';
         }
        ?>
        </section><!-- # end categories area # -->
        <!-- # stats board # -->
        <section class="col-m col-12 stats-board">
            <div class="col-m col-12">
                <h2><?=Language::invokeOutput('statistics/heading');?></h2>
            </div>
            <div class="col-m col-12 box">
                <div class="col-m col-4">
                    <div class="col-m col-12">
                        <div class="col-m col-12 box">
                            <h3><?=onlineAPI::getInstance()->getOnlineUsers();?> <?=Language::invokeOutput('statistics/online');?>
                        </div>
                        <div class="col-m col-12 box">
                            <h3><?=count($data['have-birthday'])?><?=Language::invokeOutput('statistics/birthday');?>
                        </div>
                        <?php
                            if (!empty($data['have-birthday']))
                            {
                                foreach($data['have-birthday'] as $key => $userHaveBirthday)
                                {
                                    if ($key != 0) echo "<span>-</span>";
                                    echo "<span><a href='profile/{$userHaveBirthday->id}'>{$userHaveBirthday->username}</a><small> (".usersAPI::getAge($userHaveBirthday->birthday) . language::invokeOutput('frequent/years').")</small></span>";
                                }
                            }
                        ?>
                        <div class="col-m col-12 box">
                            <h3><?=$data['join-us-today'][0]->cID;?><?=Language::invokeOutput('statistics/join');?>
                        </div>
                        <div class="col-m col-12 box">
                            <span>
                                <?=Language::invokeOutput('statistics/recent-user/part-one');?>
                                <strong><a href="profile/<?=$data['last-user']->id?>"><?=$data['last-user']->username?></a></strong>
                                <?=Language::invokeOutput('statistics/recent-user/part-two');?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-m col-12 split-dashed show-sm"></div>
                <div class="col-m col-4">
                    <div class="col-m col-12">
                        <h3><?=Language::invokeOutput('statistics/recent-threads');?></h3>
                        <ul>
                            <?php
                            if (!empty($data['recent-threads']))
                            {
                                foreach ($data['recent-threads'] as $thread)
                                {
                            ?>
                                    <li><i class="icon-angle-<?=DIRECTION;?>"></i>&nbsp;<a href="thread/<?=$thread->id;?>"><?=$thread->title;?></a></li>
                            <?php
                                }
                            }else{
                                echo Language::invokeOutput('statistics/no-recent-threads');
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="col-m col-12 box">
                        <h3><?=Language::invokeOutput('statistics/hot-threads');?></h3>
                        <ul class="ar">
                            <?php
                            if (!empty($data['hot-threads']))
                            {
                                foreach ($data['hot-threads'] as $thread)
                                {
                                    ?>
                                    <li><i class="icon-angle-<?=DIRECTION;?>"></i>&nbsp;
                                        <bdo dir="<?=DIRECTION_CODE;?>">
                                            <a href="thread/<?=$thread->id;?>"><?=$thread->title?></a>
                                            <small>( <?=$thread->Cnt.' '.Language::invokeOutput('statistics/hot-threads-replies');?> )</small>
                                        </bdo>
                                    </li>
                                <?php
                                }
                            }else{
                                echo Language::invokeOutput('statistics/no-hot-threads');
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-m col-12 split-dashed show-sm"></div>
                <div class="col-m col-4">
                    <div class="col-m col-12">
                        <h3><?=Language::invokeOutput('statistics/general/heading');?></h3>
                    </div>
                    <div class="col-m col-12 records box">
                        <div class="col-m col-4">
                            <h4><?=$data['users-count'];?></h4>
                            <span><?=Language::invokeOutput('statistics/general/users');?></span>
                        </div>
                        <div class="col-m col-4">
                            <h4><?=$data['threads-count'];?></h4>
                            <span><?=Language::invokeOutput('statistics/general/threads');?></span>
                        </div>
                        <div class="col-m col-4">
                            <h4><?=$data['replies-count'];?></h4>
                            <span><?=Language::invokeOutput('statistics/general/replies');?></span>
                        </div>
                    </div>
                    <div class="col-m col-12">
                        <a href="statistics"><?=Language::invokeOutput('frequent/more');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                    </div>
                </div>
            </div>
        </section>
        <!-- # end stats board # -->
    </div>
</div>
<!-- # end content area # -->

