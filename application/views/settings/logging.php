<div class="page account-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12">
                <?php include_once '_side.php'; ?>
                <div class="col-m col-9 content">
                    <!-- sign-in settings -->
                    <div class="col-m col-12 content-heading">
                        <h2><?=language::invokeOutput('heading/logging');?></h2>
                        <p class="section-desc"><?=language::invokeOutput('desc/logging');?></p>
                    </div>
                    <div class="col-m col-12 content-body">
                        <!-- one label -->
                        <div class="col-m col-12 field-label input-to-toggle-wrapper">
                            <div class="col-m col-4">
                                <h5><?=language::invokeOutput('labels/email');?></h5>
                                <small class="label-desc"><?=language::invokeOutput('label-desc/email');?></small>
                            </div>
                            <div class="col-m col-7">
                                <div class="col-m col-12 input-to-toggle">
                                    <form action="ajax/updateUser" method="POST" class="ajaxModal">
                                        <input type="text" name ="email" value="<?=isset_get($data['user'], 'email');?>">
                                        <input type="hidden" name="token" value="<?=$global['token'];?>">
                                        <a class="icon-cancel toggle-back"></a>
                                    </form>
                                </div>
                                <?=isset_get($data['user'], 'email');?>
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
                                <h5><?=language::invokeOutput('labels/nickname');?></h5>
                                <small class="label-desc"><?=language::invokeOutput('label-desc/nickname');?></small>
                            </div>
                            <div class="col-m col-7">
                                <div class="col-m col-12 input-to-toggle">
                                    <form action="ajax/updateUser" method="POST" class="ajaxModal">
                                        <input type="text" name ="username" value="<?=isset_get($data['user'], 'username');?>">
                                        <input type="hidden" name="token" value="<?=$global['token'];?>">
                                        <a class="icon-cancel toggle-back"></a>
                                    </form>
                                </div>
                                <?=isset_get($data['user'], 'username');?>
                            </div>
                            <div class="col-m col-1">
                                <a href="#" class="toggle-input"><?=Language::invokeOutput('edit-label');?></a>
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- ########## -->
                        <!-- one label -->
                        <form action="ajax/updateUser" method="POST" class="ajaxModal">
                            <div class="col-m col-12 field-label input-to-toggle-wrapper">
                                <div class="col-m col-4">
                                    <h5><?=language::invokeOutput('labels/password');?></h5>
                                    <small class="label-desc"><?=language::invokeOutput('label-desc/password');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <div class="col-m col-12 input-to-toggle">
                                            <input type="password" name="password" placeholder="<?=Language::invokeOutput('placeholders/newPass');?>" tabindex="1" />
                                            <input type="hidden" name="token" value="<?=$global['token'];?>">
                                            <a class="icon-cancel toggle-back"></a>
                                    </div>
                                    <?=Language::invokeOutput('passwordPH');?>
                                </div>
                                <div class="col-m col-1">
                                    <a href="#" class="toggle-input"><?=Language::invokeOutput('edit-label');?></a>
                                </div>
                            </div>
                            <div class="col-m col-12 additional-input">
                                <div class="col-m col-12 field-label input-holder">
                                    <input type="password" name="curr-password" placeholder="<?=Language::invokeOutput('placeholders/currPass');?>" tabindex="2" />
                                </div>
                                <div class="col-m col-12 box">
                                    <a href="#password" class="formSubmit"><?=language::invokeOutput('change-label');?></a>
                                </div>
                            </div>
                        </form>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- ########## -->
                        <div class="col-m col-12">
                            <a href="#deactivate-acc" id="desactivate-acc" data-token="<?=$global['token'];?>"><?=Language::invokeOutput('deactivate');?></a>
                        </div>
                    </div>
                    <!-- end -  sign-in settings -->
                    <!-- ########## -->
                </div>
            </div>
        </div>
    </div>
</div>
