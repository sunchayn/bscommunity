<div class="install-page">
    <div class="sub-wrapper">
        <div class="grid-section area">
            <div class="col-m col-12 a-center heading">
                <img src="<?=URL?>img/logo.png" alt="logo" class="x-100">
                <h3>bloodstone community V1 - beta</h3>
            </div>
            <div class="col-m col-12 steps step3">
                <div class="col-m col-12">
                    <h2><?=language::invokeOutput('step3/heading');?></h2>
                    <p class="section-desc"><?=language::invokeOutput('step3/desc');?></p>
                </div>
                <form action="install/admin" method="POST" id="form" class="col-m col-12">
                    <!-- AJAX LOADER -->
                    <div class="ajax-loader" style="display:none;">
                        <img src="<?=URL;?>/img/loader.gif" alt="ajax-loader"/>
                    </div>
                    <!-- end -  AJAX LOADER -->
                    <div class="col-m col-12">
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <div class="col-m col-4">
                                <h4><?=Language::invokeOutput('labels/name');?></h4>
                                <small class="label-desc"><?=Language::invokeOutput('labels-desc/name');?></small>
                            </div>
                            <div class="col-m col-8">
                                <input type="text" name="fullName" class="full-12" placeholder="<?=Language::invokeOutput('labels/name');?>">
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <div class="col-m col-4">
                                <h4><?=Language::invokeOutput('labels/nickname');?></h4>
                                <small class="label-desc"><?=Language::invokeOutput('labels-desc/nickname');?></small>
                            </div>
                            <div class="col-m col-8">
                                <input type="text" name="username" class="full-12" placeholder="<?=Language::invokeOutput('labels/nickname');?>">
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <div class="col-m col-4">
                                <h4><?=Language::invokeOutput('labels/email');?></h4>
                                <small class="label-desc"><?=Language::invokeOutput('labels-desc/email');?></small>
                            </div>
                            <div class="col-m col-8">
                                <input type="text" name="email" class="full-12" placeholder="<?=Language::invokeOutput('labels/email');?>">
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <div class="col-m col-4">
                                <h4><?=Language::invokeOutput('labels/password');?></h4>
                                <small class="label-desc"><?=Language::invokeOutput('labels-desc/password');?></small>
                            </div>
                            <div class="col-m col-8">
                                <input type="password" name="password" class="full-12" placeholder="<?=Language::invokeOutput('labels/password');?>">
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <div class="col-m col-4">
                                <h4><?=Language::invokeOutput('labels/password-confirm');?></h4>
                                <small class="label-desc"><?=Language::invokeOutput('labels-desc/password-confirm');?></small>
                            </div>
                            <div class="col-m col-8">
                                <input type="password" name="rePassword" class="full-12" placeholder="<?=Language::invokeOutput('labels/password-confirm');?>">
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <div class="col-m col-4">
                                <h4><?=Language::invokeOutput('labels/birthday');?></h4>
                                <small class="label-desc"><?=Language::invokeOutput('labels-desc/birthday');?></small>
                            </div>
                            <div class="col-m col-8">
                                <input type="text" name="birthday" class="full-12" placeholder="<?=Language::invokeOutput('labels/birthday-placeholder');?>">
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <div class="col-m col-4">
                                <h4><?=Language::invokeOutput('labels/gender');?></h4>
                            </div>
                            <div class="col-m col-8">
                                <input type="radio" id="girl" value="1" name="sexe">
                                <label for="girl"><?=Language::invokeOutput('labels/genders/0');?></label>
                                <input type="radio" id="guy" value="2"  name="sexe">
                                <label for="guy"><?=Language::invokeOutput('labels/genders/1');?></label>
                                <input type="radio" id="unset" name="sexe" value="0" checked="checked">
                                <label for="unset"><?=Language::invokeOutput('labels/genders/2');?></label>
                            </div>
                        </div>
                        <!-- end - one label -->
                    </div>
                    <div class="col-m col-12 links">
                        <div class="col-m col-4">&nbsp;</div>
                        <div class="col-m col-8">
                            <a href="#settings" class="save-data"><?=language::invokeOutput('step3/create');?></a>
                            <span class="next hidden-item">
                                 - <a href="install/step4" class="middle"><?=language::invokeOutput('next');?></a>&nbsp;<i class="<?=language::invokeOutput('direction');?>"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>