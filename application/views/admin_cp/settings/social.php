<div class="cp-index-page settings-page">
    <div class="sub-wrapper">
        <div class="grid-section">
            <div class="flexbox">
                <!-- start menu -->
                <?php include(__DIR__.DIRECTORY_SEPARATOR.'../_sidebar.php') ;?>
                <!-- end menu -->
                <!-- ###### -->
                <!-- start display -->
                <div class="col-m col-10 cp-display no-margin breads">
                    <div class="col-m col-12">
                        <a href="admin_cp"><?=language::invokeOutput('breads/cp');?></a>
                        <i class="icon-angle-<?=DIRECTION;?>"></i>
                        <a href="admin_cp/settings"><?=language::invokeOutput('breads/settings');?></a>
                        <i class="icon-angle-<?=DIRECTION;?>"></i>
                        <a href="admin_cp/settings?section=social"><?=language::invokeOutput('breads/social');?></a>
                    </div>
                    <div class="col-m col-12 content-wrapper">
                        <div class="col-m col-12 content-heading">
                            <h3><?=Language::invokeOutput('section-heading/social');?></h3>
                            <p class="section-desc"><?=Language::invokeOutput('desc/social');?></p>
                        </div>
                        <!-- social links settings -->
                        <form action="ajax/saveSocials" class="col-m col-12 settings ajax" method="POST">
                            <div class="col-m col-12 ajax-loader"></div>
                            <div class="col-m col-12 box">
                                <div class="col-m col-2"><?=language::invokeOutput('socials/facebook');?></div>
                                <div class="col-m col-10">
                                    <input type="text" name="facebook" placeholder="<?=language::invokeOutput('socials/facebook');?>" class="col-12" value="facebook/<?=isset_get($data['social'], 'facebook', '');?>">
                                </div>
                            </div>
                            <div class="col-m col-12 box">
                                <div class="col-m col-2"><?=language::invokeOutput('socials/twitter');?></div>
                                <div class="col-m col-10">
                                    <input type="text" name="twitter" placeholder="<?=language::invokeOutput('socials/twitter');?>" class="col-12" value="twitter/<?=isset_get($data['social'], 'twitter', '');?>">
                                </div>
                            </div>
                            <div class="col-m col-12 box">
                                <div class="col-m col-2"><?=language::invokeOutput('socials/youtube');?></div>
                                <div class="col-m col-10">
                                    <input type="text" name="youtube" placeholder="<?=language::invokeOutput('socials/youtube');?>" class="col-12" value="youtube/<?=isset_get($data['social'], 'youtube', '');?>">
                                </div>
                            </div>
                            <div class="col-m col-12 box">
                                <input type="hidden" name="token" value="<?=$global['token'];?>">
                                <a href="#save-social" class="formSubmit"><?=language::invokeOutput('socials/save');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                            </div>
                        </form>
                        <!-- end - social links settings -->
                        <!-- ####### -->
                    </div>
                </div>
                <!-- end display -->
                <!-- ###### -->
            </div>