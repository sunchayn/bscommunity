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
                        <a href="admin_cp/categories?section=forums"><?=language::invokeOutput('breads/forums');?></a>
                        <i class="icon-angle-<?=DIRECTION;?>"></i>
                        <a href="#add-forum" class="disabled"><?=language::invokeOutput('breads/addForum');?></a>
                    </div>
                    <div class="col-m col-12 content-wrapper">
                        <form action="ajax/addForum" method="POST" class="ajax noScroll">
                            <div class="col-m col-12 ajax-loader"></div>
                            <div class="col-m col-12 box">
                                <div class="col-m col-12 box">
                                    <h4><?=Language::invokeOutput('addForum/title_ar');?></h4>
                                </div>
                                <div class="col-m col-12">
                                    <input type="text" name="title_ar" placeholder="<?=Language::invokeOutput('addForum/placeholder1');?>" class="rad2" tabindex="1"/>
                                </div>
                            </div>
                            <div class="col-m col-12 box">
                                <div class="col-m col-12 box">
                                    <h4><?=Language::invokeOutput('addForum/title_en');?></h4>
                                </div>
                                <div class="col-m col-12">
                                    <input type="text" name="title_en" placeholder="<?=Language::invokeOutput('addForum/placeholder1-1');?>" class="rad2" tabindex="1"/>
                                </div>
                            </div>
                            <div class="col-m col-12 box">
                                <div class="col-m col-12 box">
                                    <h4><?=Language::invokeOutput('addForum/logo');?></h4>
                                </div>
                                <div class="col-m col-12">
                                    <input type="text" name="logo" placeholder="<?=Language::invokeOutput('addForum/placeholder3');?>" class="rad2 col-8"" tabindex="2"/>
                                </div>
                            </div>
                            <div class="col-m col-12 box">
                                <div class="col-m col-12 box">
                                    <h4><?=Language::invokeOutput('addForum/desc_ar');?></h4>
                                </div>
                                <div class="col-m col-12">
                                    <textarea name="desc_ar" class='col-12' rows="6" placeholder="<?=Language::invokeOutput('addForum/placeholder2');?>" tabindex="3"></textarea>
                                </div>
                            </div>
                            <div class="col-m col-12 box">
                                <div class="col-m col-12 box">
                                    <h4><?=Language::invokeOutput('addForum/desc_en');?></h4>
                                </div>
                                <div class="col-m col-12">
                                    <textarea name="desc_en" class='col-12' rows="6" placeholder="<?=Language::invokeOutput('addForum/placeholder2-2');?>" tabindex="3"></textarea>
                                </div>
                            </div>
                            <div class="col-m col-12 login-label">
                                <a href="#" class="formSubmit"><?=Language::invokeOutput('submit-label');?></a> - 
                                <a href="admin_cp/categories?section=forums"><?=Language::invokeOutput('back2');?></a>
                                <input type="hidden" name="cat_id" value="<?=$data['cat_id'];?>" />
                                <input type="hidden" name="token" value="<?=$global['token'];?>" />
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end display -->
                <!-- ###### -->