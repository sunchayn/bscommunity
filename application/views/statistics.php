<div class="page stats-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12 content-heading">
                <h2><?=Language::invokeOutput('page-title');?></h2>
                <p class="section-desc"><?=Language::invokeOutput('desc');?></p>
            </div>
            <!-- members stats -->
            <div class="col-m col-12 box">
                <h3><?=Language::invokeOutput('users-stats/heading');?></h3>
            </div>
            <div class="col-m col-12 box">
                <div class="col-m col-6">
                    <canvas id="statsChart1"></canvas>
                    <div class="a-center">
                        <div class="label bg-color-3 rad2 middle">
                            <span class="color-1"><?=$data['users-count'].' '.Language::invokeOutput('frequent/users');?></span>
                        </div>
                    </div>
                </div>
                <div class="col-m col-6">
                    <canvas id="statsChart2"></canvas>
                    <div class="a-center">
                        <div class="label bg-color-3 rad2 middle">
                            <span class="color-1"><?=$data['females'].'% '.Language::invokeOutput('frequent/female').' - '.$data['males'].'% '.Language::invokeOutput('frequent/male').' - '.$data['unset'].'% '.Language::invokeOutput('frequent/unset');?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-m col-12 box">
                <h4>- <?=Language::invokeOutput('users-stats/ages');?></h4>
                <canvas id="agesChart"></canvas>
                <div class="a-center">
                    <div class="label bg-color-3 rad2 middle">
                        <span class="color-1"><span class="char-color-1 middle"></span> <?=Language::invokeOutput('frequent/male');?></span>
                    </div>
                    <div class="label bg-color-3 rad2 middle">
                        <span class="color-1"><span class="char-color-2 middle"></span> <?=Language::invokeOutput('frequent/female');?></span>
                    </div>
                </div>
            </div>
            <div class="col-m col-12 box">
                <h4>- <?=Language::invokeOutput('users-stats/country');?></h4>
                <canvas id="cntryChart"></canvas>
            </div>
            <div class="col-m col-12 box">
                <div class="col-m col-4">
                    <h5 class="box"><?=Language::invokeOutput('users-stats/active');?></h5>
                    <div class="user-modal col-m col-12">
                        <i class="icon-bookmark"></i>
                        <h4 class="inline-b"><a href="profile/<?=$data['most-active']->id;?>"><?=$data['most-active']->username;?></a></h4><small> (<?=Language::invokeOutput('frequent/level'). ' ' .$data['most-active']->level;?>)</small>
                        <br />
                        <p>
                            <span>
                                <?=Language::invokeOutput('users-desc/gender'.$data['most-active']->sexe).' '
                                .$data['most-active']->country.' '
                                .language::invokeOutput('users-desc/have').' '
                                .usersAPI::getAge($data['most-active']->birthday).' '
                                .Language::invokeOutput('users-desc/years').' '
                                .usersAPI::getDays($data['most-active']->create_date).' '
                                .Language::invokeOutput('users-desc/days').', '
                                .Language::invokeOutput('users-desc/made'.$data['most-active']->sexe).'<em> '
                                .$data['most-active']->posts.' </em>'
                                .Language::invokeOutput('users-desc/activities');?>
                            </span><br />
                            <span><?=Language::invokeOutput('users-desc/thank');?></span>
                        </p>
                    </div>
                </div>
                <div class="col-m col-4">
                    <h5 class="box"><?=Language::invokeOutput('users-stats/recent');?></h5>
                    <div class="user-modal col-m col-12">
                        <h4 class="inline-b"><a href="profile/<?=$data['most-recent']->id;?>"><?=$data['most-recent']->username;?></a></h4><small> (<?=Language::invokeOutput('frequent/level'). ' ' .$data['most-recent']->level;?>) </small>
                        <br />
                        <p>
                            <span><?=Language::invokeOutput('users-desc/gender'.$data['most-recent']->sexe).' '
                                .isset_get($data['most-recent'], 'country').' '
                                .language::invokeOutput('users-desc/have').' '
                                .usersAPI::getAge($data['most-recent']->birthday).' '
                                .Language::invokeOutput('users-desc/years').' <em> '
                                .usersAPI::getDays($data['most-recent']->create_date).' </em> '
                                .Language::invokeOutput('users-desc/days');?>
                                </span><br />
                            <span><?=Language::invokeOutput('users-desc/welcome');?></span>
                        </p>
                    </div>
                </div>
                <div class="col-m col-4">
                    <h5 class="box"><?=Language::invokeOutput('users-stats/old');?></h5>
                    <div class="user-modal col-m col-12">
                        <h4 class="inline-b"><a href="profile/<?=$data['most-old']->id;?>"><?=$data['most-old']->username;?></a></h4><small> (<?=Language::invokeOutput('frequent/level'). ' ' .$data['most-old']->level;?>) </small>
                        <br />
                        <p>
                            <span><?=Language::invokeOutput('users-desc/gender'.$data['most-old']->sexe).' '
                                .isset_get($data['most-old'], 'country').' '
                                .language::invokeOutput('users-desc/have').' '
                                .usersAPI::getAge($data['most-old']->birthday).' '
                                .Language::invokeOutput('users-desc/years').' <em> '
                                .usersAPI::getDays($data['most-old']->create_date).' </em> '
                                .Language::invokeOutput('users-desc/days');?>
                            </span><br />
                            <span><?=Language::invokeOutput('users-desc/faith');?></span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-m col-12 box">
                <?=Language::invokeOutput('users-stats/birthday/part1').'<em> '. count($data['have-birthday']) .' </em>'. Language::invokeOutput('users-stats/birthday/part2');?>
                <?php
                if (!empty($data['have-birthday']))
                {
                    ?>
                    , <a href="#" id="birthday-modal" class="open-modal color-4" data-id="birthday"><?=Language::invokeOutput('users-stats/birthday/part3');?></a>
                    <!-- modal start -->
                    <div class="overlay"></div>
                    <div id="birthday" class="modal rad2" >
                        <div class="modal-body">
                            <div class="col-m col-12 content-heading">
                                <h2><?=Language::invokeOutput('birthdayModal/title');?></h2>
                                <p class="section-desc">
                                    <?=Language::invokeOutput('birthdayModal/desc');?>
                                </p>
                            </div>
                            <?php
                            foreach($data['have-birthday'] as $user)
                            {
                                ?>
                                <div class="col-m col-12 usersInModal">
                                    <h4 class="inline-b">
                                        <a href="profile/<?=$user->id;?>"><?=$user->username;?></a>
                                    </h4>
                                    <small>( <?=usersAPI::getAge($user->birthday). ' ' .Language::invokeOutput('frequent/years');?> )</small>
                                    <br>
                                    <small><?=Language::invokeOutput('frequent/level'). ' ' .$user->level;?></small>
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
                <?php }else{echo '.';} ?>
            </div>
            <!-- end - members stats -->
            <!-- ########## -->
            <!-- categories stats -->
            <div class="col-m col-12 box">
                <h3><?=Language::invokeOutput('categories-stats/heading');?></h3>
            </div>
            <div class="col-m col-12 cftr">
                <div class="col-m col-3">
                    <span><?=isset_get($data, 'categories-count');?></span><br />
                    <?=Language::invokeOutput('categories-stats/categories');?>
                </div>
                <div class="col-m col-3">
                    <span><?=isset_get($data, 'forums-count');?></span><br />
                    <?=Language::invokeOutput('categories-stats/forums');?>
                </div>
                <div class="col-m col-3">
                    <span><?=isset_get($data, 'threads-count');?></span><br />
                    <?=Language::invokeOutput('categories-stats/threads');?>
                </div>
                <div class="col-m col-3">
                    <span><?=isset_get($data, 'replies-count');?></span><br />
                    <?=Language::invokeOutput('categories-stats/replies');?>
                </div>
            </div>
            <div class="col-m col-12 box">
                <h4>- <?=Language::invokeOutput('categories-stats/hot');?></h4>
                <canvas id="catChart"></canvas>
            </div>
            <!-- end - categories stats -->
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>
<?php Controller::$GLOBAL['charts'] = true;?>