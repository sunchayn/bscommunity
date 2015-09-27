<div class="page account-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12">
                <?php include_once '_side.php'; ?>
                <div class="col-m col-9 content">
                    <!-- about settings -->
                    <div class="col-m col-12 content-heading">
                        <h2><?=Language::invokeOutput('heading/about');?></h2>
                        <p class="section-desc"><?=Language::invokeOutput('heading/about');?></p>
                    </div>
                    <div class="col-m col-12 content-body">
                        <!-- one label -->
                        <div class="col-m col-12 field-label input-to-toggle-wrapper">
                            <div class="col-m col-4">
                                <h5><?=Language::invokeOutput('labels/who');?></h5>
                                <small class="label-desc"><?=Language::invokeOutput('label-desc/who');?></small>
                            </div>
                            <div class="col-m col-7">
                                <div class="col-m col-12 input-to-toggle">
                                    <form action="ajax/updateUser" method="POST" class="ajaxModal">
                                        <input type="text" name="about" value="<?=isset_get($data['user'], 'about');?>">
                                        <input type="hidden" name="token" value="<?=$global['token'];?>">
                                        <a class="icon-cancel toggle-back"></a>
                                    </form>
                                </div>
                                <?=isset_get($data['user'], 'about');?>
                            </div>
                            <div class="col-m col-1">
                                <a href="#" class="toggle-input"><?=Language::invokeOutput('edit-label');?></a>
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- ########## -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label input-to-toggle-wrapper">
                            <div class="col-m col-4">
                                <h5><?=Language::invokeOutput('labels/quote');?></h5>
                                <small class="label-desc"><?=Language::invokeOutput('label-desc/quote');?></small>
                            </div>
                            <div class="col-m col-7">
                                <div class="col-m col-12 input-to-toggle">
                                    <form action="ajax/updateUser" method="POST" class="ajaxModal">
                                        <input type="text" name ="quote" value="<?=implode('- ',json_decode(isset_get($data['user'], 'quote')));?>">
                                        <input type="hidden" name="token" value="<?=$global['token'];?>">
                                        <a class="icon-cancel toggle-back"></a>
                                    </form>
                                </div>
                                <?=implode('- ',json_decode(isset_get($data['user'], 'quote')));?>
                            </div>
                            <div class="col-m col-1">
                                <a href="#" class="toggle-input"><?=Language::invokeOutput('edit-label');?></a>
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- ########## -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label input-to-toggle-wrapper">
                            <div class="col-m col-4">
                                <h5><?=Language::invokeOutput('labels/languages');?></h5>
                                <small class="label-desc"><?=Language::invokeOutput('label-desc/languages');?></small>
                            </div>
                            <div class="col-m col-7">
                                <div class="col-m col-12 input-to-toggle">
                                    <form action="ajax/updateUser" method="POST" class="ajaxModal">
                                        <input type="text" name ="languages" value="<?=isset_get($data, 'languages');?>">
                                        <input type="hidden" name="token" value="<?=$global['token'];?>">
                                        <a class="icon-cancel toggle-back"></a>
                                    </form>
                                </div>
                                <?=isset_get($data, 'languages');?>
                            </div>
                            <div class="col-m col-1">
                                <a href="#" class="toggle-input"><?=Language::invokeOutput('edit-label');?></a>
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- ########## -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label input-to-toggle-wrapper">
                            <div class="col-m col-4">
                                <h5><?=Language::invokeOutput('labels/interests');?></h5>
                                <small class="label-desc"><?=Language::invokeOutput('label-desc/interests');?></small>
                            </div>
                            <div class="col-m col-7">
                                <div class="col-m col-12 input-to-toggle">
                                    <form action="ajax/updateUser" method="POST" class="ajaxModal">
                                        <input type="text" name ="interest" value="<?=isset_get($data, 'interests');?>">
                                        <input type="hidden" name="token" value="<?=$global['token'];?>">
                                        <a class="icon-cancel toggle-back"></a>
                                    </form>
                                </div>
                                <?=isset_get($data, 'interests');?>
                            </div>
                            <div class="col-m col-1">
                                <a href="#" class="toggle-input"><?=Language::invokeOutput('edit-label');?></a>
                            </div>
                        </div>
                        <div class="col-m col-12 split-dashed"></div>
                        <!-- end - one label -->
                        <!-- ########## -->
                        <!-- one label -->
                        <div class="col-m col-12 section-caption">
                            <h3><?=Language::invokeOutput('labels/education');?></h3>
                            <p class="section-desc"><?=Language::invokeOutput('label-desc/education');?></p>
                        </div>
                        <div class="col-m col-12 box">
                            <a href="#add-title" class="triggerPanel" data-panel="add-title"><?=Language::invokeOutput('ed-title/toggle');?></a>
                            <div class="panel" id="add-title">
                                <div class="panel-head">
                                    <a href="#" class="icon-cancel cancel f-right"></a>
                                </div>
                                <div class="panel-content grid-section">
                                    <div class="col-m col-12">
                                        <h2 class="content-heading"><?=Language::invokeOutput('ed-title/heading');?></h2>
                                        <p class="section-desc"><?=Language::invokeOutput('ed-title/desc');?></p>
                                    </div>
                                    <form action="ajax/addTitle" method="POST" class="ajax noScroll">
                                        <div class="col-m col-12 ajax-loader"></div>
                                        <div class="col-m col-12 login-label">
                                            <div class="col-m col-12 box">
                                                <h4><?=Language::invokeOutput('ed-title/label1');?></h4>
                                            </div>
                                            <div class="col-m col-12">
                                                <input type="text" name="title" placeholder="<?=Language::invokeOutput('ed-title/placeholder1');?>" class="rad2" tabindex="1"/>
                                            </div>
                                        </div>
                                        <div class="col-m col-12 login-label">
                                            <div class="col-m col-12 box">
                                                <h4><?=Language::invokeOutput('ed-title/label2');?></h4>
                                                <small><?=Language::invokeOutput('ed-title/desc1');?></small>
                                            </div>
                                            <div class="col-m col-12">
                                                <input type="text" name="department" placeholder="<?=Language::invokeOutput('ed-title/placeholder2');?>" class="rad2" tabindex="2"/>
                                            </div>
                                        </div>
                                        <div class="col-m col-12 login-label">
                                            <div class="col-m col-12 box">
                                                <h4><?=Language::invokeOutput('ed-title/label3');?></h4>
                                                <small><?=Language::invokeOutput('ed-title/desc2');?></small>
                                            </div>
                                            <div class="col-m col-12">
                                                <input type="text" name="years" placeholder="<?=Language::invokeOutput('ed-title/placeholder3');?>" class="rad2" tabindex="3"/>
                                            </div>
                                        </div>
                                        <div class="col-m col-12 login-label">
                                            <div class="col-m col-12 box">
                                                <h4><?=Language::invokeOutput('ed-title/label4');?></h4>
                                                <small><?=Language::invokeOutput('ed-title/desc3');?></small>
                                            </div>
                                            <div class="col-m col-12">
                                                <input type="text" name="website" placeholder="<?=Language::invokeOutput('ed-title/placeholder4');?>" class="rad2" tabindex="4"/>
                                            </div>
                                        </div>
                                        <div class="col-m col-12 login-label">
                                            <a href="#" class="formSubmit"><?=Language::invokeOutput('submit-label');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                                            <input type="hidden" name="token" value="<?=$global['token'];?>" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                            if (empty($data['education']))
                            {
                                echo "<div class='no-data col-m col-12 field-label'>". Language::invokeOutput('no-data') ."</div>";
                            }else{
                                foreach($data['education'] as $key => $education)
                                    include '_education.php';
                            }
                        ?>
                        <!-- end - one label -->
                        <div class="col-m col-12 split-dashed"></div>
                        <!-- end - education section -->
                        <!-- ############ -->
                        <!-- skills section -->
                        <div class="col-m col-12 section-caption">
                            <h3><?=Language::invokeOutput('labels/skills');?></h3>
                            <p class="section-desc"><?=Language::invokeOutput('label-desc/skills');?></p>
                        </div>
                        <div class="col-m col-12 box">
                            <a href="#add-skill" class="triggerPanel" data-panel="add-skill"><?=Language::invokeOutput('u-skills/toggle');?></a>
                            <div class="panel" id="add-skill">
                                <div class="panel-head">
                                    <a href="#" class="icon-cancel cancel f-right"></a>
                                </div>
                                <div class="panel-content grid-section">
                                    <div class="col-m col-12">
                                        <h2 class="content-heading"><?=Language::invokeOutput('u-skills/heading');?></h2>
                                        <p class="section-desc"><?=Language::invokeOutput('u-skills/desc');?></p>
                                    </div>
                                    <form action="ajax/addSkill" method="POST" class="ajax noScroll">
                                        <div class="col-m col-12 ajax-loader"></div>
                                        <div class="col-m col-12 login-label">
                                            <div class="col-m col-12 box">
                                                <h4><?=Language::invokeOutput('u-skills/label1');?></h4>
                                            </div>
                                            <div class="col-m col-12">
                                                <input type="text" name="label" placeholder="<?=Language::invokeOutput('u-skills/placeholder1');?>" class="rad2" tabindex="1"/>
                                            </div>
                                        </div>
                                        <div class="col-m col-12 login-label">
                                            <div class="col-m col-12 box">
                                                <h4><?=Language::invokeOutput('u-skills/label2');?></h4>
                                                <small><?=Language::invokeOutput('u-skills/desc1');?></small>
                                            </div>
                                            <div class="col-m col-12">
                                                <input type="text" name="master" placeholder="<?=Language::invokeOutput('u-skills/placeholder2');?>" class="rad2" tabindex="2"/>
                                            </div>
                                        </div>
                                        <div class="col-m col-12 login-label">
                                            <div class="col-m col-12 box">
                                                <h4><?=Language::invokeOutput('u-skills/label3');?></h4>
                                                <small><?=Language::invokeOutput('u-skills/desc2');?></small>
                                            </div>
                                            <div class="col-m col-12">
                                                <input type="text" name="certification" placeholder="<?=Language::invokeOutput('u-skills/placeholder3');?>" class="rad2" tabindex="3"/>
                                            </div>
                                        </div>
                                        <div class="col-m col-12 login-label">
                                            <a href="#" class="formSubmit"><?=Language::invokeOutput('submit-label');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                                            <input type="hidden" name="token" value="<?=$global['token'];?>" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                            if (empty($data['skills']))
                            {
                                echo "<div class='no-data col-m col-12 field-label'>". Language::invokeOutput('no-data') ."</div>";
                            }else{
                                foreach($data['skills'] as $key => $skill)
                                    include '_skills.php';
                            }
                        ?>
                        <!-- end - skills section -->
                        <!-- ############ -->
                    </div>
                    <!-- end -  about settings -->
                    <!-- ########## -->
                </div>
            </div>
        </div>
    </div>
</div>