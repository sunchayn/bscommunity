<div class="install-page">
    <div class="sub-wrapper">
        <div class="grid-section area">
            <div class="col-m col-12 a-center heading">
                <img src="<?=URL?>img/logo.png" alt="logo" class="x-100">
                <h3>bloodstone community V1 - beta</h3>
            </div>
            <div class="col-m col-12 steps step2">
                <div class="col-m col-12">
                    <h2><?=language::invokeOutput('step2/heading');?></h2>
                    <p class="section-desc"><?=language::invokeOutput('step2/desc');?></p>
                </div>
                <form action="install/settings" method="POST" id="form" class="col-m col-12">
                    <!-- AJAX LOADER -->
                    <div class="ajax-loader" style="display:none;">
                        <img src="<?=URL;?>/img/loader.gif" alt="ajax-loader"/>
                    </div>
                    <!-- end -  AJAX LOADER -->
                    <div class="col-m col-12">
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <div class="col-m col-4">
                                <h4><?=Language::invokeOutput('labels/siteName');?></h4>
                                <small class="label-desc"><?=Language::invokeOutput('labels-desc/siteName');?></small>
                            </div>
                            <div class="col-m col-8">
                                <input type="text" name="site_name_ar" class="full-12" placeholder="<?=Language::invokeOutput('labels/siteName');?>">
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <div class="col-m col-4">
                                <h4><?=Language::invokeOutput('labels/siteName1');?></h4>
                                <small class="label-desc"><?=Language::invokeOutput('labels-desc/siteName1');?></small>
                            </div>
                            <div class="col-m col-8">
                                <input type="text" name="site_name_en" class="full-12" placeholder="<?=Language::invokeOutput('labels/siteName1');?>">
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <div class="col-m col-4">
                                <h4><?=Language::invokeOutput('labels/siteTag');?></h4>
                                <small class="label-desc"><?=Language::invokeOutput('labels-desc/siteTag');?></small>
                            </div>
                            <div class="col-m col-8">
                                <input type="text" name="site_tag_ar" class="full-12" placeholder="<?=Language::invokeOutput('labels/siteTag');?>">
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <div class="col-m col-4">
                                <h4><?=Language::invokeOutput('labels/siteTag1');?></h4>
                                <small class="label-desc"><?=Language::invokeOutput('labels-desc/siteTag1');?></small>
                            </div>
                            <div class="col-m col-8">
                                <input type="text" name="site_tag_en" class="full-12" placeholder="<?=Language::invokeOutput('labels/siteTag1');?>">
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <div class="col-m col-4">
                                <h4><?=Language::invokeOutput('labels/webmasterEmail');?></h4>
                                <small class="label-desc"><?=Language::invokeOutput('labels-desc/webmasterEmail');?></small>
                            </div>
                            <div class="col-m col-8">
                                <input type="text" name="webmaster_email" class="full-12" placeholder="<?=Language::invokeOutput('labels/webmasterEmail');?>">
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <div class="col-m col-4">
                                <h4><?=Language::invokeOutput('labels/siteDesc');?></h4>
                                <small class="label-desc"><?=Language::invokeOutput('labels-desc/siteDesc');?></small>
                            </div>
                            <div class="col-m col-8">
                                <textarea name="site_desc_ar" rows="4" class="col-12" placeholder="<?=Language::invokeOutput('labels/siteDesc');?>"></textarea>
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <div class="col-m col-4">
                                <h4><?=Language::invokeOutput('labels/siteDesc1');?></h4>
                                <small class="label-desc"><?=Language::invokeOutput('labels-desc/siteDesc1');?></small>
                            </div>
                            <div class="col-m col-8">
                                <textarea name="site_desc_en" rows="4" class="col-12" placeholder="<?=Language::invokeOutput('labels/siteDesc1');?>"></textarea>
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <div class="col-m col-4">
                                <h4><?=Language::invokeOutput('labels/keywords');?></h4>
                                <small class="label-desc"><?=Language::invokeOutput('labels-desc/keywords');?></small>
                            </div>
                            <div class="col-m col-8">
                                <input type="text" name="site_keywords" class="full-12" placeholder="<?=Language::invokeOutput('labels/keywords');?>">
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <div class="col-m col-4">
                                <h4><?=Language::invokeOutput('labels/logo');?></h4>
                                <small class="label-desc"><?=Language::invokeOutput('labels-desc/logo');?></small>
                            </div>
                            <div class="col-m col-8">
                                <input type="text" name="logo_url" class="full-12" placeholder="<?=Language::invokeOutput('labels/logo');?>">
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <div class="col-m col-4">
                                <h4><?=Language::invokeOutput('labels/favicon');?></h4>
                                <small class="label-desc"><?=Language::invokeOutput('labels-desc/favicon');?></small>
                            </div>
                            <div class="col-m col-8">
                                <input type="text" name="favicon_url" class="full-12" placeholder="<?=Language::invokeOutput('labels/favicon');?>">
                            </div>
                        </div>
                        <!-- end - one label -->
                    </div>
                    <div class="col-m col-12 links">
                        <div class="col-m col-4">&nbsp;</div>
                        <div class="col-m col-8">
                            <a href="#settings" class="save-data"><?=language::invokeOutput('step2/settings');?></a>
                            <span class="next hidden-item">
                                 - <a class="middle" href="install/step3"><?=language::invokeOutput('next');?></a>&nbsp;<i class="<?=language::invokeOutput('direction');?>"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>