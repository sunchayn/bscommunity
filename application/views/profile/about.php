<div class="page profile profile-about-page grid-section ">
    <div class="sub-wrapper area">
        <div class="sub-wrapper">
            <?php include_once('_header.php'); ?>
            <div class="col-m col-12 ">
                <h3><?=Language::invokeOutput('about-p/captions/about') . ' ' . $data['user']->username;?></h3>
            </div>
            <div class="col-m col-12 about-heading">
                <h3><?=Language::invokeOutput('about-p/captions/general');?></h3>
            </div>
            <div class="col-m col-12 about-content general-info">
                <div class="col-m col-12 box">
                    <h4><?=Language::invokeOutput('about-p/who');?></h4>
                    <p><?=isset_get($data['user'], 'about');?></p>
                </div>
                <div class="col-m col-12 box">
                    <h4><?=Language::invokeOutput('about-p/quote');?></h4>
                    <p class="quote">
                        <?php
                        $reverse = (DIRECTION == 'left') ? 'right' : 'left';
                        echo '<i class="icon-quote-'.$reverse.'"></i>';
                        if ( !empty($data['quote']) )
                            echo isset_get($data['quote'], 0) . "<small> - " . isset_get($data['quote'], 1) . "</small>";
                        else
                            echo Language::invokeOutput('about-p/no-quote');
                        ?>
                    </p>
                </div>
            </div>
            <!-- end general -->
            <!-- ############ -->
            <!-- basic information -->
            <div class="col-m col-12 about-heading">
                <h3><?=Language::invokeOutput('about-p/captions/basic');?></h3>
            </div>
            <div class="col-m col-12 about-content base-info">
                <div class="col-m col-12">
                    <div class="col-m col-5"><?=Language::invokeOutput('about-p/complete-name');?></div>
                    <div class="col-m col-7">
                        <?=isset_get($data['user'], 'first_name').' '.isset_get($data['user'], 'last_name');?>
                    </div>
                </div>
                <div class="col-m col-12">
                    <div class="col-m col-5"><?=Language::invokeOutput('about-p/gender');?></div>
                    <div class="col-m col-7"><?=usersAPI::getGender($data['user']->sexe);?></div>
                </div>
                <div class="col-m col-12">
                    <div class="col-m col-5"><?=Language::invokeOutput('about-p/origin');?></div>
                    <div class="col-m col-7"><?=isset_get($data['user'], 'country');?></div>
                </div>
                <div class="col-m col-12">
                    <div class="col-m col-5"><?=Language::invokeOutput('about-p/languages');?></div>
                    <div class="col-m col-7"><?=isset_get($data, 'languages');?></div>
                </div>
                <div class="col-m col-12">
                    <div class="col-m col-5"><?=Language::invokeOutput('about-p/birthday');?></div>
                    <div class="col-m col-7">
                        <?=$data['birthday'] .' '. usersAPI::getAge($data['user']->birthday) .' '. Language::invokeOutput('about-p/years');?></div>
                </div>
            </div>
            <!-- end basic information -->
            <!-- ############ -->
            <!-- education -->
            <div class="col-m col-12 about-heading">
                <h3><?=Language::invokeOutput('captions/education');?></h3>
            </div>
            <div class="col-m col-12 about-content">
                <?php
                if (empty($data['education']))
                {
                    echo "<div class='col-m col-12 no-data'>" . Language::invokeOutput('no-education') . "</div>";
                }else{
                    foreach($data['education'] as $title)
                    {
                        $years = $title->years[1] - $title->years[0];
                        ?>
                        <div class="col-m col-12 education">
                            <!-- # one-title # !-->
                            <div class="col-m col-12 ed-title">
                                <h3><?=$title->title;?></h3>
                                <h4><?=$title->department;?></h4>
                                <h5>
                                    <?=$title->years[0] . ' - ' . $title->years[1] . ' ( ' . $years . ' ' . Language::invokeOutput('frequent/years') .' )';?>
                                </h5>
                                <?php
                                    if (isset($title->website))
                                        echo "<small><a href='{$title->website}'>". Language::invokeOutput('about-p/website') ."</a></small>";
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <!-- end - education -->
            <!-- ############ -->
            <!-- skills -->
            <div class="col-m col-12 about-heading">
                <h3><?=Language::invokeOutput('captions/skills');?></h3>
            </div>
            <div class="col-m col-12 about-content">
                <?php
                if (empty($data['skills']))
                {
                    echo "<div class='col-m col-12 no-data'>" . Language::invokeOutput('no-skills') . "</div>";
                }else{
                    foreach($data['skills'] as $skill)
                    {
                ?>
                    <div class="col-m col-12 skill-box v-middle">
                        <div class="col-2 v-col"><?=$skill->label;?>
                                <?php
                                    if (isset($skill->certification))
                                        echo " <small>(<a href='{$skill->certification}'>". Language::invokeOutput('about-p/certification') ."</a>)</small>";
                                ?>
                        </div>
                        <div class="col-9 v-col skill-master">
                            <div class="col-m col-12 bar">
                                <div style="width: <?=$skill->master;?>%;"></div>
                            </div>
                        </div>
                        <div class="col-1 v-col">(<?=$skill->master;?>/100)</div>
                    </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="col-m col-12 about-heading">
                <h3><?=Language::invokeOutput('captions/interests');?></h3>
            </div>
            <div class="col-m col-12 about-content">
                <?php
                if (empty($data['interests']))
                {
                    echo "<div class='col-m col-12 no-data'>" . Language::invokeOutput('no-interests') . "</div>";
                }else{
                    echo "<div class='col-m col-12 interests'>";
                    foreach($data['interests'] as $interest)
                        echo '<span>' . $interest . '</span>';
                    echo "</div>";
                }
                ?>
            </div>
        </div><!-- # end sub-wrapper # -->
    </div>
</div>