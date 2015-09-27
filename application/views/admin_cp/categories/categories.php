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
                        <a href="admin_cp/categories?section=categories"><?=language::invokeOutput('breads/mCategories');?></a>
                    </div>
                    <div class="col-m col-12 content-wrapper">
                        <div class="col-m col-12">
                            <h3><?=Language::invokeOutput('heading-cat');?></h3>
                        </div>
                        <!-- ########## -->
                        <!-- forums / categories wrapper -->
                        <div class="col-m col-12 categories-wrapper">
                            <!-- end - forums / categories heading -->
                            <!-- #### -->
                            <?php
                                if (empty($data['categories']))
                                {
                                    echo '<div class="no-data">'. Language::invokeOutput('no-categories') .'</div>';
                                }else{
                                    foreach($data['categories'] as $cat)
                                        include('_category.php');
                                }
                            ?>
                            <!-- #### -->
                        </div>
                        <!-- end - forums / categories wrapper -->
                        <!-- ###### -->
                        <!-- add new category -->
                        <div class="col-m col-12">
                            <h4><a href="#add-category" class="triggerPanel" data-panel="add-category"><?=Language::invokeOutput('new');?></a></h4>
                        </div>
                        <div class="panel" id="add-category">
                            <div class="panel-head">
                                <a href="#" class="icon-cancel cancel f-right"></a>
                            </div>
                            <div class="panel-content grid-section">
                                <div class="col-m col-12">
                                    <h2 class="content-heading"><?=Language::invokeOutput('addCategory/heading');?></h2>
                                    <p class="section-desc"><?=Language::invokeOutput('addCategory/desc');?></p>
                                </div>
                                <form action="ajax/addCategory" method="POST" class="ajax noScroll">
                                    <div class="col-m col-12 ajax-loader"></div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addCategory/title');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <input type="text" name="title" placeholder="<?=Language::invokeOutput('addCategory/placeholder1');?>" class="rad2" tabindex="1"/>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addCategory/description');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <textarea name="desc" class='col-12' rows="6" placeholder="<?=Language::invokeOutput('addCategory/placeholder2');?>" tabindex="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addCategory/order');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <input type="text" name="order" placeholder="<?=Language::invokeOutput('addCategory/placeholder3');?>" class="rad2" tabindex="3"/>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <a href="#" class="formSubmit"><?=Language::invokeOutput('submit-label');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                                        <input type="hidden" name="token" value="<?=$global['token'];?>" />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="panel" id="edit-category">
                            <div class="panel-head">
                                <a href="#" class="icon-cancel cancel f-right"></a>
                            </div>
                            <div class="panel-content grid-section">
                                <div class="col-m col-12">
                                    <h2 class="content-heading"><?=Language::invokeOutput('editCategory/heading');?></h2>
                                    <p class="section-desc"><?=Language::invokeOutput('editCategory/desc');?></p>
                                </div>
                                <div class="col-m col-12 cat-fields">
                                    <form action="ajax/updateCategory" method="POST" class="ajax noScroll">
                                        <div class="col-m col-12 ajax-loader"></div>
                                        <div class="col-m col-12 login-label">
                                            <div class="col-m col-12 box">
                                                <h4><?=Language::invokeOutput('addCategory/title');?></h4>
                                            </div>
                                            <div class="col-m col-12">
                                                <input type="text" name="title"  id="title" placeholder="<?=Language::invokeOutput('addCategory/placeholder1');?>" class="rad2" tabindex="1"/>
                                            </div>
                                        </div>
                                        <div class="col-m col-12 login-label">
                                            <div class="col-m col-12 box">
                                                <h4><?=Language::invokeOutput('addCategory/description');?></h4>
                                            </div>
                                            <div class="col-m col-12">
                                                <textarea name="desc" class='col-12' id="desc" rows="6" placeholder="<?=Language::invokeOutput('addCategory/placeholder2');?>" tabindex="2"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-m col-12 login-label">
                                            <div class="col-m col-12 box">
                                                <h4><?=Language::invokeOutput('addCategory/order');?></h4>
                                            </div>
                                            <div class="col-m col-12">
                                                <input type="text" name="order" id="order" placeholder="<?=Language::invokeOutput('addCategory/placeholder3');?>" class="rad2" tabindex="3"/>
                                            </div>
                                        </div>
                                        <div class="col-m col-12 login-label">
                                            <a href="#" class="formSubmit"><?=Language::invokeOutput('frequent/update');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                                            <input type="hidden" name="token" value="<?=$global['token'];?>" />
                                            <input type="hidden" name="id" id="cat_id" value="" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end - add new category -->
                        <!-- ########## -->
                    </div>
                </div>
                <!-- end display -->
                <!-- ###### -->