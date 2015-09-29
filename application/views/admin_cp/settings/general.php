<div class="cp-index-page settings-page">
    <div class="sub-wrapper">
        <div class="grid-section">
            <div class="flexbox">
                <!-- start menu -->
                <?php
                //echo();
                include(__DIR__.DIRECTORY_SEPARATOR.'../_sidebar.php')
                ;?>
                <!-- end menu -->
                <!-- ###### -->
                <!-- start display -->
                <div class="col-m col-10 cp-display no-margin breads">
                    <div class="col-m col-12">
                        <a href="admin_cp"><?=language::invokeOutput('breads/cp');?></a>
                        <i class="icon-angle-<?=DIRECTION;?>"></i>
                        <a href="admin_cp/settings"><?=language::invokeOutput('breads/settings');?></a>
                        <i class="icon-angle-<?=DIRECTION;?>"></i>
                        <a href="admin_cp/settings?section=general"><?=language::invokeOutput('breads/general');?></a>
                    </div>
                    <div class="col-m col-12 content-wrapper">
                        <!-- general settings -->
                        <div class="col-m col-12 content-heading">
                            <h3><?=language::invokeOutput('section-heading/general');?></h3>
                            <p class="section-desc"><?=language::invokeOutput('desc/general');?></p>
                        </div>
                        <div class="col-m col-12 settings">
                            <!-- one label -->
                            <div class="col-m col-12 field-label input-to-toggle-wrapper">
                                <div class="col-m col-4">
                                    <h4><?=language::invokeOutput('labels/siteName');?></h4>
                                    <small class="label-desc"><?=language::invokeOutput('labels-desc/siteName');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <div class="col-m col-12 input-to-toggle">
                                        <form action="ajax/updateSettings" method="POST" class="ajaxModal">
                                            <input type="text" name="site_name" value="<?=isset_get($global, 'site_name', '');?>">
                                            <input type="hidden" name="token" value="<?=$global['token'];?>">
                                            <a class="icon-cancel toggle-back"></a>
                                        </form>
                                    </div>
                                    <?=isset_get($global, 'site_name');?>
                                </div>
                                <div class="col-m col-1">
                                    <a href="#" class="toggle-input"><?=Language::invokeOutput('edit-label');?></a>
                                </div>
                            </div>
                            <div class="col-m col-12 split"></div>
                            <!-- end - one label -->
                            <!-- one label -->
                            <div class="col-m col-12 field-label input-to-toggle-wrapper">
                                <div class="col-m col-4">
                                    <h4><?=language::invokeOutput('labels/siteTag');?></h4>
                                    <small class="label-desc"><?=language::invokeOutput('labels-desc/siteTag');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <div class="col-m col-12 input-to-toggle">
                                        <form action="ajax/updateSettings" method="POST" class="ajaxModal">
                                            <input type="text" name="site_tag" value="<?=isset_get($global, 'site_tag', '');?>">
                                            <input type="hidden" name="token" value="<?=$global['token'];?>">
                                            <a class="icon-cancel toggle-back"></a>
                                        </form>
                                    </div>
                                    <?=isset_get($global, 'site_tag');?>
                                </div>
                                <div class="col-m col-1">
                                    <a href="#" class="toggle-input"><?=Language::invokeOutput('edit-label');?></a>
                                </div>
                            </div>
                            <div class="col-m col-12 split"></div>
                            <!-- end - one label -->
                            <!-- ###### -->
                            <!-- one label -->
                            <div class="col-m col-12 field-label input-to-toggle-wrapper">
                                <div class="col-m col-4">
                                    <h4><?=language::invokeOutput('labels/webmasterEmail');?></h4>
                                    <small class="label-desc"><?=language::invokeOutput('labels-desc/webmasterEmail');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <div class="col-m col-12 input-to-toggle">
                                        <form action="ajax/updateSettings" method="POST" class="ajaxModal">
                                            <input type="text" name="webmaster_email" value="<?=isset_get($global, 'webmaster_email', '');?>">
                                            <input type="hidden" name="token" value="<?=$global['token'];?>">
                                            <a class="icon-cancel toggle-back"></a>
                                        </form>
                                    </div>
                                    <?=isset_get($global, 'webmaster_email');?>
                                </div>
                                <div class="col-m col-1">
                                    <a href="#" class="toggle-input"><?=Language::invokeOutput('edit-label');?></a>
                                </div>
                            </div>
                            <div class="col-m col-12 split"></div>
                            <!-- end - one label -->
                            <!-- ###### -->
                            <!-- one label -->
                            <div class="col-m col-12 field-label input-to-toggle-wrapper">
                                <div class="col-m col-4">
                                    <h4><?=language::invokeOutput('labels/siteDesc');?></h4>
                                    <small class="label-desc"><?=language::invokeOutput('labels-desc/siteDesc');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <?=(isset($global['site_desc'][70])) ? mb_substr($global['site_desc'], 0, 70, 'UTF-8') . '...' : $global['site_desc']; ?>
                                </div>
                                <div class="col-m col-1">
                                    <a href="#siteDesc" class="triggerPanel" data-panel="desc-change"><?=Language::invokeOutput('edit-label');?></a>
                                </div>
                            </div>
                            <div class="col-m col-12 split"></div>
                            <div class="panel" id="desc-change">
                                <div class="panel-head">
                                    <a href="#" class="icon-cancel cancel f-right"></a>
                                </div>
                                <div class="panel-content grid-section">
                                    <div class="col-m col-12">
                                        <h2 class="content-heading"><?=Language::invokeOutput('updateDesc');?></h2>
                                        <p class="section-desc"><?=Language::invokeOutput('labels-desc/siteDesc');?></p>
                                    </div>
                                    <form action="ajax/updateSettings" method="POST" class="ajaxModal">
                                        <div class="col-m col-12 ajax-loader"></div>
                                        <div class="col-m col-12 login-label">
                                            <textarea name="site_desc" id="" class="col-12 rad2" rows="10"><?=$global['site_desc'];?></textarea>
                                            <input type="hidden" name="token" value="<?=$global['token'];?>" />
                                            <a href="#submit" class="formSubmit"><?=Language::invokeOutput('submit-label');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end - one label -->
                            <!-- ###### -->
                            <!-- one label -->
                            <div class="col-m col-12 field-label input-to-toggle-wrapper">
                                <div class="col-m col-4">
                                    <h4><?=language::invokeOutput('labels/keywords');?></h4>
                                    <small class="label-desc"><?=language::invokeOutput('labels-desc/keywords');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <div class="col-m col-12 input-to-toggle">
                                        <form action="ajax/updateSettings" method="POST" class="ajaxModal">
                                            <input type="text" name="site_keywords" value="<?=isset_get($global, 'site_keywords', '');?>">
                                            <input type="hidden" name="token" value="<?=$global['token'];?>">
                                            <a class="icon-cancel toggle-back"></a>
                                        </form>
                                    </div>
                                    <?=isset_get($global, 'site_keywords');?>
                                </div>
                                <div class="col-m col-1">
                                    <a href="#" class="toggle-input"><?=Language::invokeOutput('edit-label');?></a>
                                </div>
                            </div>
                            <div class="col-m col-12 split"></div>
                            <!-- end - one label -->
                            <!-- ###### -->
                            <!-- one label -->
                            <div class="col-m col-12 field-label input-to-toggle-wrapper">
                                <div class="col-m col-4">
                                    <h4><?=language::invokeOutput('labels/logo');?></h4>
                                    <small class="label-desc"><?=language::invokeOutput('labels-desc/logo');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <div class="col-m col-12 input-to-toggle">
                                        <form action="ajax/updateSettings" method="POST" class="ajaxModal">
                                            <input type="text" name="logo_url" value="<?=isset_get($global, 'logo_url', '');?>">
                                            <input type="hidden" name="token" value="<?=$global['token'];?>">
                                            <a class="icon-cancel toggle-back"></a>
                                        </form>
                                    </div>
                                    <?=isset_get($global, 'logo_url');?>
                                </div>
                                <div class="col-m col-1">
                                    <a href="#" class="toggle-input"><?=Language::invokeOutput('edit-label');?></a>
                                </div>
                            </div>
                            <div class="col-m col-12 split"></div>
                            <!-- end - one label -->
                            <!-- ###### -->
                            <!-- one label -->
                            <div class="col-m col-12 field-label input-to-toggle-wrapper">
                                <div class="col-m col-4">
                                    <h4><?=language::invokeOutput('labels/favicon');?></h4>
                                    <small class="label-desc"><?=language::invokeOutput('labels-desc/favicon');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <div class="col-m col-12 input-to-toggle">
                                        <form action="ajax/updateSettings" method="POST" class="ajaxModal">
                                            <input type="text" name="favicon_url" value="<?=isset_get($global, 'favicon_url', '');?>">
                                            <input type="hidden" name="token" value="<?=$global['token'];?>">
                                            <a class="icon-cancel toggle-back"></a>
                                        </form>
                                    </div>
                                    <?=isset_get($global, 'favicon_url');?>
                                </div>
                                <div class="col-m col-1">
                                    <a href="#" class="toggle-input"><?=Language::invokeOutput('edit-label');?></a>
                                </div>
                            </div>
                            <div class="col-m col-12 split"></div>
                            <!-- end - one label -->
                            <!-- ###### -->
                            <!-- one label -->
                            <div class="col-m col-12 field-label">
                                <div class="col-m col-4">
                                    <h4><?=language::invokeOutput('labels/isClose');?></h4>
                                    <small class="label-desc"><?=language::invokeOutput('labels-desc/isClose');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <?=($global['is_close'] == 0)? Language::invokeOutput('opened') : Language::invokeOutput('closed');?>
                                </div>
                                <div class="col-m col-1">
                                    <form action="ajax/updateSettings" method="POST" class="ajaxModal">
                                        <input type="hidden" name="is_close" value="<?=($global['is_close'] == 1) ? 0 : 1;?>">
                                        <input type="hidden" name="token" value="<?=$global['token'];?>">
                                        <a href="#open-close" class="formSubmit"><?=($global['is_close'] == 0)? Language::invokeOutput('close') : Language::invokeOutput('open');?></a>
                                    </form>
                                </div>
                            </div>
                            <div class="col-m col-12 split"></div>
                            <!-- end - one label -->
                            <!-- ###### -->
                            <!-- one label -->
                            <div class="col-m col-12 field-label input-to-toggle-wrapper">
                                <div class="col-m col-4">
                                    <h4><?=language::invokeOutput('labels/closeMsg');?></h4>
                                    <small class="label-desc"><?=language::invokeOutput('labels-desc/closeMsg');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <div class="col-m col-12 input-to-toggle">
                                        <form action="ajax/updateSettings" method="POST" class="ajaxModal">
                                            <input type="text" name="close_msg" value="<?=isset_get($global, 'close_msg', '');?>">
                                            <input type="hidden" name="token" value="<?=$global['token'];?>">
                                            <a class="icon-cancel toggle-back"></a>
                                        </form>
                                    </div>
                                    <?=isset_get($global, 'close_msg');?>
                                </div>
                                <div class="col-m col-1">
                                    <a href="#" class="toggle-input"><?=Language::invokeOutput('edit-label');?></a>
                                </div>
                            </div>
                            <!-- end - one label -->
                            <!-- ###### -->
                        </div>
                        <!-- end - general settings -->
                        <!-- ####### -->
                    </div>
                </div>
                <!-- end display -->
                <!-- ###### -->
            </div>