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
                        <a href="admin_cp/categories?section=categories"><?=language::invokeOutput('breads/mForums');?></a>
                    </div>
                    <div class="col-m col-12 content-wrapper">
                        <div class="col-m col-12">
                            <h3><?=Language::invokeOutput('heading-forums');?></h3>
                        </div>
                        <div class="col-m col-12">
                            <?=language::invokeOutput('sel-forum') . ' : ';?>
                            <select class="page-swapper">
                                <option value="admin_cp/categories?section=forums&cat_id=<?=$data['curr_cat']->id;?>"><?=$data['curr_cat']->title;?></option>
                                <?php
                                foreach ($data['categories'] as $cat)
                                    if ($cat->id != $data['curr_cat']->id)
                                        echo '<option value="admin_cp/categories?section=forums&cat_id='. $cat->id .'">'. $cat->title. '</option>';
                                ?>
                            </select>
                        </div>
                        <!-- ########## -->
                        <!-- forums / categories wrapper -->
                        <div class="col-m col-12 categories-wrapper">
                            <!-- end - forums / categories heading -->
                            <!-- #### -->
                            <?php
                            if (empty($data['forums']))
                            {
                                echo '<div class="no-data">'. Language::invokeOutput('no-forums') .'</div>';
                            }else{
                                foreach($data['forums'] as $forum)
                                    include('_forums.php');
                            }
                            ?>
                            <!-- #### -->
                        </div>
                        <!-- end - forums / categories wrapper -->
                        <!-- ###### -->
                        <!-- add new forum -->
                        <div class="col-m col-12">
                            <h4><a href="#add-forum" class="triggerPanel" data-panel="add-forum"><?=Language::invokeOutput('newForum');?></a></h4>
                        </div>
                        <div class="overlay"></div>
                        <div class="panel" id="add-forum">
                            <div class="panel-head">
                                <a href="#" class="icon-cancel cancel f-right"></a>
                            </div>
                            <div class="panel-content grid-section">
                                <div class="col-m col-12">
                                    <h2 class="content-heading"><?=Language::invokeOutput('addForum/heading');?></h2>
                                    <p class="section-desc"><?=Language::invokeOutput('addForum/desc');?></p>
                                </div>
                                <form action="ajax/addForum" method="POST" class="ajax noScroll">
                                    <div class="col-m col-12 ajax-loader"></div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addForum/title');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <input type="text" name="title" placeholder="<?=Language::invokeOutput('addForum/placeholder1');?>" class="rad2" tabindex="1"/>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addForum/logo');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <input type="text" name="logo" placeholder="<?=Language::invokeOutput('addForum/placeholder3');?>" class="rad2" tabindex="2"/>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addForum/description');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <textarea name="desc" class='col-12' rows="6" placeholder="<?=Language::invokeOutput('addForum/placeholder2');?>" tabindex="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <a href="#" class="formSubmit"><?=Language::invokeOutput('submit-label');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                                        <input type="hidden" name="cat_id" value="<?=$data['curr_cat']->id;?>" />
                                        <input type="hidden" name="token" value="<?=$global['token'];?>" />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end - add new forum -->
                        <!-- ########## -->
                        <div class="panel" id="edit-forum">
                            <div class="panel-head">
                                <a href="#" class="icon-cancel cancel f-right"></a>
                            </div>
                            <div class="panel-content grid-section">
                                <div class="col-m col-12">
                                    <h2 class="content-heading"><?=Language::invokeOutput('editForum/heading');?></h2>
                                    <p class="section-desc"><?=Language::invokeOutput('editForum/desc');?></p>
                                </div>
                                <form action="ajax/updateForum" method="POST" class="ajax noScroll">
                                    <div class="col-m col-12 ajax-loader"></div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addForum/title');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <input type="text" name="title" id="title" placeholder="<?=Language::invokeOutput('addForum/placeholder1');?>" class="rad2" tabindex="1"/>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addForum/logo');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <input type="text" name="logo" id="logo" placeholder="<?=Language::invokeOutput('addForum/placeholder3');?>" class="rad2" tabindex="2"/>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addForum/description');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <textarea name="desc" id="desc" class='col-12' rows="6" placeholder="<?=Language::invokeOutput('addForum/placeholder2');?>" tabindex="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <a href="#" class="formSubmit"><?=Language::invokeOutput('submit-label');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                                        <input type="hidden" id="cat_id" name="cat_id" value="" />
                                        <input type="hidden" id="id" name="id" value="" />
                                        <input type="hidden" name="token" value="<?=$global['token'];?>" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end display -->
                <!-- ###### -->