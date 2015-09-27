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
                        <a href="admin_cp/settings?section=filter"><?=language::invokeOutput('breads/variables');?></a>
                    </div>
                    <div class="col-m col-12 content-wrapper">
                        <!-- words filter settings -->
                        <div class="col-m col-12 settings">
                            <div class="col-m col-12 content-heading">
                                <h3><?=Language::invokeOutput('section-heading/pre-filter');?></h3>
                                <p class="section-desc"><?=Language::invokeOutput('desc/pre-filter');?></p>
                            </div>
                            <!-- one label -->
                            <div class="col-m col-12 field-label">
                                <div class="col-m col-4">
                                    <h4><?=language::invokeOutput('labels/adult-filter');?></h4>
                                    <small class="label-desc"><?=language::invokeOutput('labels-desc/adult-filter');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <?=Language::invokeOutput('frequent/enabled');?>
                                </div>
                                <div class="col-m col-1">
                                    <a href="#" class="disabled"><?=Language::invokeOutput('frequent/disable');?></a>
                                </div>
                            </div>
                            <!-- end - one label -->
                            <!-- ###### -->
                            <div class="col-m col-12 split"></div>
                            <!-- one label -->
                            <div class="col-m col-12 field-label">
                                <div class="col-m col-4">
                                    <h4><?=language::invokeOutput('labels/external-filter');?></h4>
                                    <small class="label-desc"><?=language::invokeOutput('labels-desc/external-filter');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <?=($global['external'] == 0)? Language::invokeOutput('frequent/enabled') : Language::invokeOutput('frequent/disabled');?>
                                </div>
                                <div class="col-m col-1">
                                    <form action="ajax/updateSettings" method="POST" class="ajaxModal">
                                        <input type="hidden" name="external" value="<?=($global['external'] == 1) ? 0 : 1;?>">
                                        <input type="hidden" name="token" value="<?=$global['token'];?>">
                                        <a href="#external" class="disabled"><?=($global['external'] == 0)? Language::invokeOutput('frequent/disable') : Language::invokeOutput('frequent/enable');?></a>
                                    </form>
                                </div>
                            </div>
                            <!-- end - one label -->
                            <!-- ###### -->
                            <div class="col-m col-12 split"></div>
                            <!-- one label -->
                            <div class="col-m col-12 field-label">
                                <div class="col-m col-4">
                                    <h4><?=language::invokeOutput('labels/white-list');?></h4>
                                    <small class="label-desc"><?=language::invokeOutput('labels-desc/white-list');?></small>
                                </div>
                                <div class="col-m col-7"><?=language::invokeOutput('soon-label');?></div>
                                <div class="col-m col-1">
                                    <a href="#" class="disabled"><?=Language::invokeOutput('edit-label');?></a>
                                </div>
                            </div>
                            <!-- end - one label -->
                            <!-- ###### -->
                            <div class="col-m col-12 split"></div>
                            <!-- one label -->
                            <div class="col-m col-12 field-label">
                                <div class="col-m col-4">
                                    <h4><?=language::invokeOutput('labels/black-list');?></h4>
                                    <small class="label-desc"><?=language::invokeOutput('labels-desc/black-list');?></small>
                                </div>
                                <div class="col-m col-7"><?=language::invokeOutput('soon-label');?></div>
                                <div class="col-m col-1">
                                    <a href="#" class="disabled"><?=Language::invokeOutput('edit-label');?></a>
                                </div>
                            </div>
                            <!-- end - one label -->
                            <!-- ###### -->
                            <div class="col-m col-12 split-dashed"></div>
                            <div class="col-m col-12 content-heading">
                                <h3><?=Language::invokeOutput('section-heading/custom-filter');?></h3>
                                <p class="section-desc"><?=Language::invokeOutput('desc/custom-filter');?></p>
                            </div>
                            <!-- one label -->
                            <div class="col-m col-12 field-label">
                                <div class="col-m col-4">
                                    <h4><?=language::invokeOutput('labels/custom-words');?></h4>
                                    <small class="label-desc"><?=language::invokeOutput('labels-desc/custom-words');?></small>
                                </div>
                                <div class="col-m col-7"><?=language::invokeOutput('soon-label');?></div>
                                <div class="col-m col-1">
                                    <a href="#" class="disabled"><?=Language::invokeOutput('edit-label');?></a>
                                </div>
                            </div>
                            <!-- end - one label -->
                            <!-- ###### -->
                        </div>
                        <!-- end - Words filter settings -->
                        <!-- ####### -->
                    </div>
                </div>
                <!-- end display -->
                <!-- ###### -->
            </div>