<!-- # register page # -->
<div class="page register-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <!-- heading -->
            <div class="col-m col-12 content-heading">
                <h2><?=Language::invokeOutput('form-header');?></h2>
                <p class="section-desc"><?=Language::invokeOutput('form-desc');?></p>
            </div>
            <!-- end - heading -->
            <!-- ########## -->
            <!-- registration form -->
            <form action="ajax/join" method="POST" class="col-m col-12 ajax">
                <!-- AJAX LOADER -->
                <div class="ajax-loader" style="display:none;">
                    <img src="<?=URL;?>/img/loader.gif" alt="ajax-loader"/>
                </div>
                <!-- end -  AJAX LOADER -->
                <!-- one label -->
                <div class="col-m col-12 field-label">
                    <div class="col-m col-4">
                        <h4><?=Language::invokeOutput('inp-header/name');?></h4>
                        <small class="label-desc">
                            <?=Language::invokeOutput('inp-desc/name');?>
                        </small>
                    </div>
                    <div class="col-m col-6">
                        <input type="text" name="fullName" class="full-12" placeholder="<?=Language::invokeOutput('input-placeholder/fullName');?>">
                        <div class="col-12">
                            <ul class="input-rules have-arrow">
                                <li><?=Language::invokeOutput('inp-rules/name/0');?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-m col-12 split"></div>
                <!-- end - one label -->
                <!-- ########## -->
                <!-- one label -->
                <div class="col-m col-12 field-label">
                    <div class="col-m col-4">
                        <h4><?=Language::invokeOutput('inp-header/nickname');?></h4>
                        <small class="label-desc">
                            <?=Language::invokeOutput('inp-desc/nickname');?>
                        </small>
                    </div>
                    <div class="col-m col-6">
                        <input type="text" name="username" class="full-12" placeholder="<?=Language::invokeOutput('input-placeholder/username');?>">
                        <div class="col-12">
                            <ul class="input-rules have-arrow">
                                <li><?=Language::invokeOutput('inp-rules/nickname/0');?></li>
                                <li><?=Language::invokeOutput('inp-rules/nickname/1');?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-m col-12 split"></div>
                <!-- end - one label -->
                <!-- ########## -->
                <!-- one label -->
                <div class="col-m col-12 field-label">
                    <div class="col-m col-4">
                        <h4><?=Language::invokeOutput('inp-header/email');?></h4>
                        <small class="label-desc">
                            <?=Language::invokeOutput('inp-desc/email');?>
                        </small>
                    </div>
                    <div class="col-m col-6">
                        <input type="text" name="email" class="full-12" placeholder="<?=Language::invokeOutput('input-placeholder/email');?>">
                        <div class="col-12">
                            <ul class="input-rules have-arrow">
                                <li><?=Language::invokeOutput('inp-rules/email/0');?></li>
                                <li><?=Language::invokeOutput('inp-rules/email/1');?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-m col-12 split"></div>
                <!-- end - one label -->
                <!-- ########## -->
                <!-- one label -->
                <div class="col-m col-12 field-label">
                    <div class="col-m col-4">
                        <h4><?=Language::invokeOutput('inp-header/password');?></h4>
                        <small class="label-desc">
                            <?=Language::invokeOutput('inp-desc/password');?>
                        </small>
                    </div>
                    <div class="col-m col-6">
                        <input type="password" name="password" class="full-12" placeholder="<?=Language::invokeOutput('input-placeholder/password');?>">
                        <div class="col-12">
                            <ul class="input-rules have-arrow">
                                <li><?=Language::invokeOutput('inp-rules/password/0');?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-m col-12 split"></div>
                <!-- end - one label -->
                <!-- ########## -->
                <!-- one label -->
                <div class="col-m col-12 field-label">
                    <div class="col-m col-4">
                        <h4><?=Language::invokeOutput('inp-header/password-confirm');?></h4>
                        <small class="label-desc">
                            <?=Language::invokeOutput('inp-desc/password-confirm');?>
                        </small>
                    </div>
                    <div class="col-m col-6">
                        <input type="password" name="rePassword" class="full-12" placeholder="<?=Language::invokeOutput('input-placeholder/rePassword');?>">
                        <div class="col-12">
                            <ul class="input-rules have-arrow">
                                <li><?=Language::invokeOutput('inp-rules/password-confirm/0');?> .</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-m col-12 split"></div>
                <!-- end - one label -->
                <!-- ########## -->
                <!-- end - one label -->
                <!-- ########## -->
                <!-- one label -->
                <div class="col-m col-12 field-label">
                    <div class="col-m col-4">
                        <h4><?=Language::invokeOutput('inp-header/birthday');?></h4>
                        <small class="label-desc">
                            <?=Language::invokeOutput('inp-desc/birthday');?>
                        </small>
                    </div>
                    <div class="col-m col-6">
                        <input type="text" name="birthday" class="full-12" placeholder="<?=Language::invokeOutput('input-placeholder/birthday');?>">
                        <div class="col-12">
                            <ul class="input-rules have-arrow">
                                <li><?=Language::invokeOutput('inp-rules/birthday/0');?> .</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-m col-12 split"></div>
                <!-- end - one label -->
                <!-- ########## -->
                <!-- one label -->
                <div class="col-m col-12 field-label">
                    <div class="col-m col-4">
                        <h4><?=Language::invokeOutput('inp-header/gender');?></h4>
                    </div>
                    <div class="col-m col-6">
                        <input type="radio" id="girl" value="1" name="sexe">
                        <label for="girl"><?=Language::invokeOutput('inp-rules/gender/0');?></label>
                        <input type="radio" id="guy" value="2"  name="sexe">
                        <label for="guy"><?=Language::invokeOutput('inp-rules/gender/1');?></label>
                        <input type="radio" id="unset" name="sexe" value="0" checked="checked">
                        <label for="unset"><?=Language::invokeOutput('inp-rules/gender/2');?></label>
                    </div>
                </div>
                <!-- end - one label -->
                <!-- ########## -->
                <div class="col-m col-12">
                    <input type="submit" class="btn btn-color7 rad" value="<?=language::invokeOutput('submit-label');?>">
                    <input type="hidden" name="token" value="<?=$global['token'];?>">
                </div>
            </form>
            <!-- end - registration form -->
            <!-- ########## -->
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>
<!-- # end register page # -->