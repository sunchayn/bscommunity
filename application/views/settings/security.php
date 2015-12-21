<div class="page account-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12">
                <?php include_once '_side.php'; ?>
                <div class="col-m col-9 content">
                    <!-- security settings -->
                    <div class="col-m col-12 content-heading">
                        <h2><?=language::invokeOutput('heading/security');?></h2>
                        <p class="section-desc"><?=language::invokeOutput('desc/security');?></p>
                    </div>
                    <div class="col-m col-12 split"></div>
                    <div class="col-m col-12 content-body">
                        <!-- one label -->
                        <div class="col-m col-12 field-label input-to-toggle-wrapper">
                            <div class="col-m col-4">
                                <h5><?=language::invokeOutput('labels/recovery');?></h5>
                                <small class="label-desc"><?=language::invokeOutput('label-desc/recovery');?></small>
                            </div>
                            <div class="col-m col-7">
                                <div class="col-m col-12 input-to-toggle">
                                    <form action="ajax/updatePref" method="POST" class="ajaxModal">
                                        <input type="text" name="recovery" value="<?=isset_get($data['preferences'], 'recovery');?>">
                                        <input type="hidden" name="token" value="<?=$global['token'];?>">
                                        <a class="icon-cancel toggle-back"></a>
                                    </form>
                                </div>
                                <?=isset_get($data['preferences'], 'recovery');?>
                            </div>
                            <div class="col-m col-1">
                                <a href="#" class="toggle-input"><?=Language::invokeOutput('edit-label');?></a>
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- ########## -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <div class="col-m col-4">
                                <h5><?=language::invokeOutput('labels/machine-pass');?></h5>
                                <small class="label-desc"><?=language::invokeOutput('label-desc/machine-pass');?></small>
                            </div>
			                <div class="col-m col-7"><?=language::invokeOutput('soon-label');?></div>
                            <div class="col-m col-1">
                                <a href="#" class="disabled"><?=Language::invokeOutput('edit-label');?></a>
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- ########## -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <div class="col-m col-4">
                                <h5><?=language::invokeOutput('labels/trust');?></h5>
                                <small class="label-desc"><?=language::invokeOutput('label-desc/trust');?></small>
                            </div>
			                <div class="col-m col-7"><?=language::invokeOutput('soon-label');?></div>
                            <div class="col-m col-1">
                                <a href="#" class="disabled"><?=Language::invokeOutput('edit-label');?></a>
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- ########## -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <form action="ajax/updatePref" method="post" class="ajaxModal">
                                <div class="col-m col-4">
                                    <h5><?=language::invokeOutput('labels/alert-external');?></h5>
                                    <small class="label-desc"><?=language::invokeOutput('label-desc/alert-external');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <input type="radio" value="1" name="external" id="set" <?=isset_get($data, 'setExternal', '');?> >
                                    <label for="set"><?=language::invokeOutput('enable-label');?></label>
                                    <input type="radio" value="0" name="external" id="unset" <?=isset_get($data, 'unsetExternal', '');?>>
                                    <label for="unset"><?=language::invokeOutput('disable-label');?></label>
                                    <input type="hidden" name="token" value="<?=$global["token"];?>">
                                </div>
                                <div class="col-m col-1 a-right">
                                    <a class='formSubmit' href='#change'><?=Language::invokeOutput('change-label');?></a>
                                </div>
                            </form>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- ########## -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <div class="col-m col-4">
                                <h5><?=language::invokeOutput('labels/facebook-link');?></h5>
                                <small class="label-desc"><?=language::invokeOutput('label-desc/facebook-link');?></small>
                            </div>
                            <div class="col-m col-7"><?=language::invokeOutput('soon-label');?></div>
                            <div class="col-m col-1">
                                <a href="#" class="disabled"><?=Language::invokeOutput('edit-label');?></a>
                            </div>
                        </div>
                        <!-- end - one label -->
                        <!-- ########## -->
                    </div>
                    <!-- end -  security settings -->
                    <!-- ########## -->
                </div>
            </div>
        </div>
    </div>
</div>
