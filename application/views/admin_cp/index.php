<div class="cp-index-page">
    <div class="sub-wrapper">
        <div class="grid-section">
            <div class="flexbox">
                <?php include('_sidebar.php');?>
                <!-- ###### -->
                <!-- start display -->
                <div class="col-m col-10 cp-display no-margin">
                    <div class="col-m col-12 breads">
                        <a href="admin_cp"><?=Language::invokeOutput('breads/cp');?></a>
                        <i class="icon-angle-<?=DIRECTION;?>"></i>
                        <a href="admin_cp/index"><?=Language::invokeOutput('breads/general');?></a>
                    </div>
                    <div class="content-wrapper">
                        <!-- stats start-->
                        <div class="col-m col-12">
                            <h3><?=Language::invokeOutput('headers/statistic');?></h3>
                        </div>
                        <div class="col-m col-12 general-stats">
                            <div class="col-m col-2">
                                <span><?=$data['users-count'];?></span>
                                <?=language::invokeOutput('frequent/users');?>
                            </div>
                            <div class="col-m col-2">
                                <span><?=$data['categories-count'];?></span>
                                <?=language::invokeOutput('frequent/categories');?>
                            </div>
                            <div class="col-m col-2">
                                <span><?=$data['forums-count'];?></span>
                                <?=language::invokeOutput('frequent/forums');?>
                            </div>
                            <div class="col-m col-2">
                                <span><?=$data['threads-count'];?></span>
                                <?=language::invokeOutput('frequent/threads');?>
                            </div>
                            <div class="col-m col-2">
                                <span><?=$data['replies-count'];?></span>
                                <?=language::invokeOutput('frequent/replies');?>
                            </div>
                            <div class="col-m col-2">
                                <span><?=$data['visits-count'];?></span>
                                <?=language::invokeOutput('visits');?>
                            </div>
                        </div>
                        <!-- end stats -->
                        <!-- ####### -->
                        <!-- activity track -->
                        <div class="col-m col-12">
                            <h3><?=Language::invokeOutput('headers/activity');?></h3>
                        </div>
                        <div class="col-m col-12">
                            <canvas id="monthlyActivity"></canvas>
                        </div>
                        <!-- end - activity track -->
                        <!-- ####### -->
                        <!-- recent activities -->
                        <div class="col-m col-12">
                            <h3><?=Language::invokeOutput('headers/recent');?></h3>
                        </div>
                        <div class="col-m col-12 recentActivities">
                            <?php
                                if (!empty($data['last-thread']))
                                {
                                    ?>
                                    <!-- one activity -->
                                    <div class="col-m col-12">
                                        <a href="profile/<?=$data['last-thread']->UID;?>"><?=$data['last-thread']->username;?></a> <?=Language::invokeOutput('postThread');?><br />
                                        <a href="thread/<?=$data['last-thread']->id;?>"><?=$data['last-thread']->title;?></a>
                                    </div>
                                    <!-- end - one activity -->
                            <?php } else { echo '<div class="col-m col-12">'.Language::invokeOutput('no-last-thread').'</div>'; }?>
                            <!-- ######## -->
                            <?php
                            if (!empty($data['last-reply']))
                            {
                                ?>
                                <!-- one activity -->
                                <div class="col-m col-12">
                                    <a href="profile/<?=$data['last-reply']->id;?>"><?=$data['last-reply']->username;?></a> <?=Language::invokeOutput('addReply');?><br />
                                    <a href="thread/<?=$data['last-reply']->thread_id;?>"><?=$data['last-reply']->title;?></a>
                                </div>
                                <!-- end - one activity -->
                            <?php } else { echo '<div class="col-m col-12">'.Language::invokeOutput('no-last-reply').'</div>'; }?>
                            <!-- ######## -->
                        </div>
                        <!-- end -  recent activities -->
                        <!-- ####### -->
                        <!-- Browser Usage -->
                        <div class="col-m col-12">
                            <!-- browser usage -->
                            <div class="col-m col-6 browserUsage">
                                <div class="col-m col-12 box">
                                    <h3><?=Language::invokeOutput('headers/usage');?></h3>
                                </div>
                                <div class="col-m col-12">
                                    <div class="col-m col-6">
                                        <canvas id="browserUsage"></canvas>
                                    </div>
                                    <div class="col-m col-6">
                                        <ul>
                                            <li><i class="pieColor1"></i>google chrome</li>
                                            <li><i class="pieColor2"></i>mozilla firefox</li>
                                            <li><i class="pieColor3"></i>Internet Explorer</li>
                                            <li><i class="pieColor4"></i>other</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- end - browser usage -->
                            <!-- ####### -->
                            <!-- top visiting countries -->
                            <div class="col-m col-6">
                                <div class="col-m col-12 box">
                                    <h3><?=Language::invokeOutput('headers/countries');?></h3>
                                </div>
                                <div class="col-m col-12 topVisiting">
                                    <?php
                                    foreach($data['top-countries'] as $country)
                                        echo '<div><strong>'. $country[1] .'%</strong> - ' . $country[0] . '</div>';
                                    ?>
                                    <small><?=Language::invokeOutput('dependIP');?></small>
                                </div>
                            </div>
                            <!-- end - top visiting countries -->
                            <!-- ####### -->
                        </div>
                        <!-- end -  Browser Usage -->
                        <!-- ####### -->
                        <!-- server usage -->
                        <div class="col-m col-12">
                            <h3><?=Language::invokeOutput('headers/server');?></h3>
                        </div>
                        <div class="col-m col-12 en">
                            <?=$data['usage'][2];?>% ( <?=$data['usage'][0];?> Go / <?=$data['usage'][1];?> Go )
                        </div>
                        <div class="col-m col-12 skill-master">
                            <div class="col-m col-12 bar">
                                <div style="width: <?=$data['usage'][2];?>%;"></div>
                            </div>
                        </div>
                        <!-- end - server usage -->
                        <!-- ####### -->
                        <!-- home page -->
                        <div class="col-m col-12">
                            <a href="<?=URL;?>home"><?=language::invokeOutput('visitHome');?></a>
                            <i class="icon-<?=DIRECTION;?>"></i><br />
                            <span>- <?=language::invokeOutput('contactMe/part1');?> <a href="http://www.facebook.com/mazn.touati" class="color-5"><?=language::invokeOutput('contactMe/part2');?></a> .</span>
                        </div>
                        <!-- end - home page -->
                        <!-- ####### -->
                    </div>
                </div>
                <!-- end display -->
                <!-- ###### -->
<?php Controller::$GLOBAL['charts'] = true;?>