<div class="page profile profile-general-page">
    <div class="sub-wrapper area">
        <div class="grid-section sub-wrapper">
            <?php
                include_once('_header.php');
            ?>
            <div class="col-m col-12">
                <h3><?=Language::invokeOutput('captions/general');?></h3>
            </div>
            <div class="col-m col-12">
                <div class="col-m col-12 user-stats resp-margin">
                    <div class="col-m col-3">
                        <h3><?=Language::invokeOutput('stats/threads');?></h3>
                        <span><?=isset_get($data['stats'], 'threads');?></span>
                    </div>
                    <div class="col-m col-3">
                        <h3><?=Language::invokeOutput('stats/replies');?></h3>
                        <span><?=isset_get($data['stats'], 'replies', '');?></span>
                    </div>
                    <div class="col-m col-3">
                        <h3><?=Language::invokeOutput('stats/level');?></h3>
                        <span><?=isset_get($data['user'], 'level');?></span>
                    </div>
                    <div class="col-m col-3">
                        <h3><?=Language::invokeOutput('stats/thanked');?></h3>
                        <span><?=isset_get($data['stats'], 'thanked');?></span>
                    </div>
                </div>
                <div class="col-m col-12 user-stats resp-margin">
                    <div class="col-m col-3">
                        <h3><?=Language::invokeOutput('stats/country');?></h3>
                        <span><?=isset_get($data['user'], 'country');?></span>
                    </div>
                    <div class="col-m col-3">
                        <h3><?=Language::invokeOutput('stats/sexe');?></h3>
                        <span><?=usersAPI::getGender(isset_get($data['user'], 'sexe'))?></span>
                    </div>
                    <div class="col-m col-3">
                        <h3><?=Language::invokeOutput('stats/age');?></h3>
                        <span><?=usersAPI::getAge(isset_get($data['user'], 'birthday'));?></span>
                    </div>
                    <div class="col-m col-3">
                        <h3><?=Language::invokeOutput('stats/id');?></h3>
                        <span>#<?=isset_get($data['user'], 'id', '');?></span>
                    </div>
                </div>
            </div>
            <div class="col-m col-12">
                <small>
                    <?=isset_get($data['user'], 'username');?>, <?=Language::invokeOutput('date/1') . isset_get($data['user'], 'create_date', '') . ' ('. usersAPI::getDays(isset_get($data['user'], 'create_date')) . ' ' . Language::invokeOutput('frequent/days') .')';?> .
                </small>
            </div>
            <div class="col-m col-12 split"></div>
            <!-- # last threads # !-->
            <div class="col-m col-12">
                <h3><?=Language::invokeOutput('captions/threads');?></h3>
            </div>
            <?php
                if ($data['stats']['threads'] == 0)
                {
                    echo "<div class='col-m col-12 no-data'>" . Language::invokeOutput('no-threads') . "</div>";
                }else{
                    foreach($data['threads'] as $thread)
                    {
                    ?>
                        <div class="col-m col-12 user-last-thread">
                            <div class="col-m col-12 thread-heading">
                                <h2><a href="thread/<?=$thread->id;?>"><?=$thread->title;?></a></h2>
                            </div>
                            <div class="col-m col-12 thread-body">
                                <p>
                                    <?=mb_substr(strip_tags($thread->content), 0, 100, 'UTF-8') . '... ';?>
                                    <small>
                                        <a href="thread/<?=$thread->id;?>">
                                            <?=Language::invokeOutput('see-more/full-threads') ;?>
                                        </a>
                                    </small>
                                </p>
                                <small><?=Language::invokeOutput('date/0') . $thread->create;?> .</small>
                            </div>
                        </div>
                <?php } ?>
                <div class="col-m col-12 see-all">
                    <a href="profile/threads/<?=isset_get($data['user'], 'id');?>">
                        <?=Language::invokeOutput('see-more/threads') . ' ( '.  isset_get($data['stats'], 'threads') . ' )';?>
                    </a>
                </div>
            <?php } ?>
            <!-- #end last threads # !-->
            <div class="col-m col-12 split"></div>
            <!-- # about user # !-->
            <div class="col-m col-12">
                <h3><?=Language::invokeOutput('captions/about');?></h3>
            </div>
            <div class="col-m col-12 about-user">
                <p>
                    <?=isset_get($data['user'], 'about');?>
                </p>
            </div>
            <!-- # end- about user # !-->
            <!-- # ~~~~~~~~ # !-->
            <div class="col-m col-12 split"></div>
            <!-- # user education# !-->
            <div class="col-m col-12">
                <h3><?=Language::invokeOutput('captions/education');?></h3>
            </div>
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
                        <div class="col-m col-12 one-title">
                            <h3><?=$title->title;?></h3>
                            <h4><?=$title->department;?></h4>
                            <h5>
                                <?=$title->years[0] . ' - ' . $title->years[1] . ' ( ' . $years . ' ' . Language::invokeOutput('frequent/years') .' )';?>
                            </h5>
                        </div>
                        <!-- # end one-title # !-->
                    </div>
            <?php
                }
            }
            ?>
            <!-- # end- user education# !-->
            <!-- # ~~~~~~~~ # !-->
            <div class="col-m col-12 split"></div>
            <!-- # user skills# !-->
            <div class="col-m col-12">
                <h3><?=Language::invokeOutput('captions/skills');?></h3>
            </div>
            <?php
            if (empty($data['skills']))
            {
                echo "<div class='col-m col-12 no-data'>" . Language::invokeOutput('no-skills') . "</div>";
            }else{
                echo "<div class='col-m col-12 skills'>";
                foreach($data['skills'] as $skill)
                    echo '<span>' . $skill->label . '</span>';
                echo "</div>";
            }
            ?>
            <!-- # end- user skills# !-->
            <!-- # ~~~~~~~~ # !-->
            <div class="col-m col-12 split"></div>
            <!-- # user interest# !-->
            <div class="col-m col-12">
                <h3><?=Language::invokeOutput('captions/interests');?></h3>
            </div>
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
            <!-- # end- user interest# !-->
            <!-- # ~~~~~~~~ # !-->
            <div class="col-m col-12 a-right">
                <small>
                    <?=Language::invokeOutput('views/0'). ' ' . isset_get($data['user'], 'views') . ' ' . Language::invokeOutput('views/1');?>
                </small>
            </div>
        </div>
    </div><!-- # end sub-wrapper # -->
</div><!-- # end user-page # -->
