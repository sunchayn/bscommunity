<div class="page account-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12">
                <?php include_once '_side.php'; ?>
                <div class="col-m col-9 content">
                    <!-- contact settings -->
                    <div class="col-m col-12 content-heading">
                        <h2><?=language::invokeOutput('heading/contact');?></h2>
                        <p class="section-desc"><?=language::invokeOutput('desc/contact');?></p>
                    </div>
                    <div class="col-m col-12 content-body">
                        <form action="ajax/saveUserSocials" class="col-m col-12 settings ajax" method="POST">
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
                    </div>
                    <!-- end -  contact settings -->
                    <!-- ########## -->
                </div>
            </div>
        </div>
    </div>
</div>
