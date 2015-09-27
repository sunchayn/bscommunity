<div class="cp-index-page categories-page">
    <div class="sub-wrapper">
        <div class="grid-section">
            <div class="flexbox">
                <?php include(__DIR__.DIRECTORY_SEPARATOR.'../_sidebar.php');?>
                <!-- ###### -->
                <!-- start display -->
                <div class="col-m col-10 cp-display no-margin breads">
                    <div class="col-m col-12">
                        <a href="admin_cp"><?=language::invokeOutput('breads/cp');?></a>
                        <i class="icon-angle-<?=DIRECTION;?>"></i>
                        <a href="admin_cp/categories"><?=language::invokeOutput('breads/categories');?></a>
                        <i class="icon-angle-<?=DIRECTION;?>"></i>
                        <a href="admin_cp/categories?section=rules"><?=language::invokeOutput('breads/rules');?></a>
                    </div>
                    <div class="col-m col-12 content-wrapper">
                        <div class="col-m col-12">
                            <h3><?=Language::invokeOutput('heading-forums');?></h3>
                        </div>
                        <div class="col-m col-12">
                            <?=language::invokeOutput('sel-forum') . ' : ';?>
                            <select class="page-swapper">
                                <option value="admin_cp/categories?section=rules&forum_id=<?=$data['curr_forum']->id;?>"><?=$data['curr_forum']->title;?></option>
                                <?php
                                foreach ($data['forums'] as $forum)
                                    if ($cat->id != $data['curr_forum']->id)
                                        echo '<option value="admin_cp/categories?section=rules&forum_id='. $forum->id .'">'. $forum->title. '</option>';
                                ?>
                            </select>
                        </div>
                        <!-- ########## -->
                        <!-- forums / categories wrapper -->
                        <div class="col-m col-12 categories-wrapper">
                            <!-- #### -->
                            <?php
                            if (empty($data['rules']))
                            {
                                echo '<div class="no-data">'. Language::invokeOutput('no-rules') .'</div>';
                            }else{
                                foreach($data['rules'] as $rule)
                                    include('_rule.php');
                            }
                            ?>
                            <!-- #### -->
                        </div>
                        <!-- end - forums / categories wrapper -->
                        <!-- ###### -->
                        <!-- add new role -->
                        <div class="col-m col-12">
                            <h4><a href="#add-rule" class="triggerPanel" data-panel="add-rule"><?=Language::invokeOutput('newRule');?></a></h4>
                        </div>
                        <div class="overlay"></div>
                        <div class="panel" id="add-rule">
                            <div class="panel-head">
                                <a href="#" class="icon-cancel cancel f-right"></a>
                            </div>
                            <div class="panel-content grid-section">
                                <div class="col-m col-12">
                                    <h2 class="content-heading"><?=Language::invokeOutput('addRule/heading');?></h2>
                                    <p class="section-desc"><?=Language::invokeOutput('addRule/desc');?></p>
                                </div>
                                <form action="ajax/addRule" method="POST" class="ajax noScroll">
                                    <div class="col-m col-12 ajax-loader"></div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addRule/title_ar');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <input type="text" name="title_ar" placeholder="<?=Language::invokeOutput('addRule/placeholder1');?>" class="rad2" tabindex="1"/>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addRule/title_en');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <input type="text" name="title_en" placeholder="<?=Language::invokeOutput('addRule/placeholder1');?>" class="rad2" tabindex="1"/>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addRule/description_ar');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <textarea name="description_ar" class='col-12' rows="3" placeholder="<?=Language::invokeOutput('addRule/placeholder2');?>" tabindex="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addRule/description_en');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <textarea name="description_en" class='col-12' rows="3" placeholder="<?=Language::invokeOutput('addRule/placeholder2');?>" tabindex="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <a href="#" class="formSubmit"><?=Language::invokeOutput('submit-label');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                                        <input type="hidden" name="forum_id" value="<?=$data['curr_forum']->id;?>" />
                                        <input type="hidden" name="token" value="<?=$global['token'];?>" />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="panel" id="edit-rule">
                            <div class="panel-head">
                                <a href="#" class="icon-cancel cancel f-right"></a>
                            </div>
                            <div class="panel-content grid-section">
                                <div class="col-m col-12">
                                    <h2 class="content-heading"><?=Language::invokeOutput('addRule/heading');?></h2>
                                    <p class="section-desc"><?=Language::invokeOutput('addRule/desc');?></p>
                                </div>
                                <form action="ajax/editRule" method="POST" class="ajax noScroll">
                                    <div class="col-m col-12 ajax-loader"></div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addRule/title_ar');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <input type="text" name="title_ar" id="title_ar" placeholder="<?=Language::invokeOutput('addRule/placeholder1');?>" class="rad2" tabindex="1"/>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addRule/title_en');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <input type="text" name="title_en" id="title_en" placeholder="<?=Language::invokeOutput('addRule/placeholder1');?>" class="rad2" tabindex="1"/>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addRule/description_ar');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <textarea name="description_ar" class='col-12' rows="3" id="description_ar" placeholder="<?=Language::invokeOutput('addRule/placeholder2');?>" tabindex="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addRule/description_en');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <textarea name="description_en" class='col-12' rows="3" id="description_en" placeholder="<?=Language::invokeOutput('addRule/placeholder2');?>" tabindex="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <a href="#" class="formSubmit"><?=Language::invokeOutput('submit-label');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                                        <input type="hidden" name="id" id="id" value="" />
                                        <input type="hidden" name="token" value="<?=$global['token'];?>" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end display -->
                <!-- ###### -->