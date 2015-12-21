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
                        <a href="#edit-cat" class="disabled"><?=language::invokeOutput('breads/addCategory');?></a>
                    </div>
                    <div class="col-m col-12 content-wrapper">
                        <form action="ajax/addCategory" method="POST" class="ajax noScroll">
                            <div class="col-m col-12 ajax-loader"></div>
                            <div class="col-m col-12 box">
                                <div class="col-m col-12 box">
                                    <h4><?=Language::invokeOutput('addCategory/title_ar');?></h4>
                                </div>
                                <div class="col-m col-12">
                                    <input type="text" name="title_ar" placeholder="<?=Language::invokeOutput('addCategory/placeholder1');?>" class="rad2" tabindex="1"/>
                                </div>
                            </div>
                            <div class="col-m col-12 box">
                                <div class="col-m col-12 box">
                                    <h4><?=Language::invokeOutput('addCategory/title_en');?></h4>
                                </div>
                                <div class="col-m col-12">
                                    <input type="text" name="title_en" placeholder="<?=Language::invokeOutput('addCategory/placeholder1-1');?>" class="rad2" tabindex="1"/>
                                </div>
                            </div>
                            <div class="col-m col-12 box">
                                <div class="col-m col-12 box">
                                    <h4><?=Language::invokeOutput('addCategory/description_ar');?></h4>
                                </div>
                                <div class="col-m col-12">
                                    <textarea name="desc_ar" class='col-12' rows="5" placeholder="<?=Language::invokeOutput('addCategory/placeholder2');?>" tabindex="2"></textarea>
                                </div>
                            </div>
                            <div class="col-m col-12 box">
                                <div class="col-m col-12 box">
                                    <h4><?=Language::invokeOutput('addCategory/description_en');?></h4>
                                </div>
                                <div class="col-m col-12">
                                    <textarea name="desc_en" class='col-12' rows="5" placeholder="<?=Language::invokeOutput('addCategory/placeholder2-2');?>" tabindex="2"></textarea>
                                </div>
                            </div>
                            <div class="col-m col-12 box">
                                <div class="col-m col-12 box">
                                    <h4><?=Language::invokeOutput('addCategory/order');?></h4>
                                </div>
                                <div class="col-m col-12">
                                    <input type="text" name="order" placeholder="<?=Language::invokeOutput('addCategory/placeholder3');?>" class="rad2" tabindex="3"/>
                                </div>
                            </div>
                            <div class="col-m col-12 box">
                                <a href="#" class="formSubmit"><?=Language::invokeOutput('submit-label');?></a> - 
                                <a href="admin_cp/categories"><?=Language::invokeOutput('back');?></a>
                                <input type="hidden" name="token" value="<?=$global['token'];?>" />
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end display -->
                <!-- ###### -->