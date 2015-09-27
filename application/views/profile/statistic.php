<div class="page profile profile-statis-page">
    <div class="sub-wrapper area">
        <div class="grid-section sub-wrapper">
            <?php include('_header.php'); ?>
            <div class="col-m col-12"><h3><?=Language::invokeOutput('statistic-p/captions/heading');?></h3></div>
            <div class="col-m col-12">
                <h4 class="inline-b">
                    <?='<strong>' . isset_get($data['user'], 'username') . '</strong> ' . Language::invokeOutput('statistic-p/join').' '.isset_get($data['user'], 'create_date');?> .
            </div>
            <div class="col-m col-12 general">
                <div class="col-m col-4">
                    <span><?=Language::invokeOutput('frequent/posts');?></span>
                    <h2><?=isset_get($data['user'], 'posts');?></h2>
                </div>
                <div class="col-m col-4">
                    <span><?=Language::invokeOutput('frequent/level');?></span>
                    <h2><?=isset_get($data['user'], 'level');?></h2>
                </div>
                <div class="col-m col-4">
                    <span><?=Language::invokeOutput('frequent/thanked');?></span>
                    <h2><?=isset_get($data, 'thanksC');?></h2>
                </div>
            </div>
            <!-- ~########## -->
            <div class="col-m col-12"><h4><?=Language::invokeOutput('statistic-p/captions/percentage');?></h4></div>
            <div class="col-m col-12 hits">
                <!-- caption -->
                <div class="col-m col-12 caption">
                    <div class="col-m col-3"><?=Language::invokeOutput('statistic-p/percentage/label');?></div>
                    <div class="col-m col-6"><?=Language::invokeOutput('statistic-p/percentage/percentage');?></div>
                    <div class="col-m col-1">&nbsp;</div>
                    <div class="col-m col-2"><?=Language::invokeOutput('statistic-p/percentage/rank');?></div>
                </div>
                <!-- body -->
                <div class="col-m col-12 body">
                    <!-- one hit -->
                    <div class="col-m col-12">
                        <div class="col-m col-12 v-middle">
                            <div class="col-3 v-col"><?=Language::invokeOutput('frequent/posts');?></div>
                            <div class="col-6 v-col">
                                <div class="col-m col-11 bar">
                                    <div style="width: <?=isset_get($data['posts'], 1, 0);?>%"></div>
                                </div>
                            </div>
                            <div class="col-1 v-col"><?=isset_get($data['posts'], 1);?>%</div>
                            <div class="col-2 v-col"><?=isset_get($data['posts'], 0);?></div>
                        </div>
                    </div>
                    <!-- end - one hit -->
                    <!-- one hit -->
                    <div class="col-m col-12">
                        <div class="col-m col-12 v-middle">
                            <div class="col-3 v-col"><?=Language::invokeOutput('frequent/threads');?></div>
                            <div class="col-6 v-col">
                                <div class="col-m col-11 bar">
                                    <div style="width: <?=isset_get($data['threads'], 1, 0);?>%"></div>
                                </div>
                            </div>
                            <div class="col-1 v-col"><?=isset_get($data['threads'], 1);?>%</div>
                            <div class="col-2 v-col"><?=isset_get($data['threads'], 0);?></div>
                        </div>
                    </div>
                    <!-- end - one hit -->
                    <!-- one hit -->
                    <div class="col-m col-12">
                        <div class="col-m col-12 v-middle">
                            <div class="col-3 v-col"><?=Language::invokeOutput('frequent/replies');?></div>
                            <div class="col-6 v-col">
                                <div class="col-m col-11 bar">
                                    <div style="width: <?=isset_get($data['replies'], 1, 0);?>%"></div>
                                </div>
                            </div>
                            <div class="col-1 v-col"><?=isset_get($data['replies'], 1);?>%</div>
                            <div class="col-2 v-col"><?=isset_get($data['replies'], 0);?></div>
                        </div>
                    </div>
                    <!-- end - one hit -->
                    <!-- one hit -->
                    <div class="col-m col-12">
                        <div class="col-m col-12 v-middle">
                            <div class="col-3 v-col"><?=Language::invokeOutput('frequent/thanked');?></div>
                            <div class="col-6 v-col">
                                <div class="col-m col-11 bar">
                                    <div style="width: <?=isset_get($data['thanks'], 1, 0);?>%"></div>
                                </div>
                            </div>
                            <div class="col-1 v-col"><?=isset_get($data['thanks'], 1);?>%</div>
                            <div class="col-2 v-col"><?=isset_get($data['thanks'], 0);?></div>
                        </div>
                    </div>
                    <!-- end - one hit -->
                    <!-- one hit -->
                    <div class="col-m col-12">
                        <div class="col-m col-12 v-middle">
                            <div class="col-3 v-col"><?=Language::invokeOutput('statistic-p/views');?></div>
                            <div class="col-6 v-col">
                                <div class="col-m col-11 bar">
                                    <div style="width: <?=isset_get($data['views'], 1, 0);?>%"></div>
                                </div>
                            </div>
                            <div class="col-1 v-col"><?=isset_get($data['views'], 1);?>%</div>
                            <div class="col-2 v-col"><?=isset_get($data['views'], 0);?></div>
                        </div>
                    </div>
                    <!-- end - one hit -->
                </div>
            </div>
            <!-- ~########## -->
            <div class="col-m col-12 activity-per-day">
                <div class="col-m col-12">
                    <div class="col-m col-3">
                        <h3><?=isset_get($data, 'ppd');?></h3>
                        <span><?=Language::invokeOutput('statistic-p/ppd');?></span>
                    </div>
                    <div class="col-m col-3">
                        <h3><?=isset_get($data, 'rpd');?></h3>
                        <span><?=Language::invokeOutput('statistic-p/rpd');?></span>
                    </div>
                    <div class="col-m col-3">
                        <h3><?=isset_get($data, 'tpd');?></h3>
                        <span><?=Language::invokeOutput('statistic-p/tpd');?></span>
                    </div>
                    <div class="col-m col-3">
                        <h3><?=isset_get($data, 'pvpd');?></h3>
                        <span><?=Language::invokeOutput('statistic-p/pvpd');?></span>
                    </div>
                </div>
            </div>
            <!-- ~########## -->
            <div class="col-m col-12"><h4><?=Language::invokeOutput('statistic-p/captions/recent');?></h4></div>
            <div class="col-m col-12 side-padding recent-act">
                <div class="col-m col-12">
                    <h3 class="inline-b"><?=isset_get($data, 'rReplies') . ' ' . Language::invokeOutput('frequent/replies') . '</h3> ' . Language::invokeOutput('statistic-p/recentDays');?>
                </div>
                <div class="col-m col-12">
                    <h3 class="inline-b"><?=isset_get($data, 'rThreads') . ' ' . Language::invokeOutput('frequent/threads') . '</h3> '. Language::invokeOutput('statistic-p/recentDays');?>
                </div>
                <div class="col-m col-12">
                    <h3 class="inline-b"><?=isset_get($data, 'rThanks') . ' ' . Language::invokeOutput('frequent/thanked') . '</h3> '. Language::invokeOutput('statistic-p/recentDays');?>
                </div>
            </div>
            <!-- ~########## -->
            <div class="col-m col-12"><h4><?=Language::invokeOutput('statistic-p/captions/main');?></h4></div>
            <div class="col-m col-12 side-padding">
                    <?php
                        if (!empty($data['main']))
                        {
                            echo "<div class='col-m col-12 top-topic side-padding'>
                                <a href='forum/{$data['main'][0]->id}'>{$data['main'][0]->title}</a><small>(<strong>{$data['main'][0]->cnt}</strong> " . Language::invokeOutput('frequent/threads') . ")</small>
                              </div>";
                        }else{
                            echo '<span class="no-data">' . Language::invokeOutput('frequent/no-threads') . '</span>';
                         }
                    ?>
            </div>
            <!-- # end - user statistics # !-->
        </div>
    </div><!-- # end sub-wrapper # -->
</div>