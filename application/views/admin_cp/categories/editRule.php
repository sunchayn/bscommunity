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
                        <i class="icon-angle-<?=DIRECTION;?>"></i>
                        <a href="#add-rule" class="disabled"><?=language::invokeOutput('breads/editRule');?></a>
                    </div>
                    <div class="col-m col-12 content-wrapper">
                              <form action="ajax/editRule" method="POST" class="ajax noScroll">
                                    <div class="col-m col-12 ajax-loader"></div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addRule/title_ar');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <input type="text" name="title_ar" id="title_ar" placeholder="<?=Language::invokeOutput('addRule/placeholder1');?>" class="rad2" value="<?=$data['rule']->title_ar;?>" tabindex="1"/>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addRule/title_en');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <input type="text" name="title_en" id="title_en" placeholder="<?=Language::invokeOutput('addRule/placeholder1-1');?>" class="rad2" value="<?=$data['rule']->title_en;?>" tabindex="1"/>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addRule/description_ar');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <textarea name="description_ar" class='col-12' rows="3" id="description_ar" placeholder="<?=Language::invokeOutput('addRule/placeholder2');?>" tabindex="3"><?=$data['rule']->description_ar;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addRule/description_en');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <textarea name="description_en" class='col-12' rows="3" id="description_en" placeholder="<?=Language::invokeOutput('addRule/placeholder2-2');?>" tabindex="3"><?=$data['rule']->description_en;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <a href="#" class="formSubmit"><?=Language::invokeOutput('submit-label');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                                        <input type="hidden" name="id" id="id" value="<?=$data['rule']->id;?>" />
                                        <input type="hidden" name="token" value="<?=$global['token'];?>" />
                                    </div>
                                </form>
                    </div>
                </div>
                <!-- end display -->
                <!-- ###### -->