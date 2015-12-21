<div class="cp-index-page settings-page">
    <div class="sub-wrapper">
        <div class="grid-section">
            <div class="flexbox">
                <!-- start menu -->
                <?php include(__DIR__.DIRECTORY_SEPARATOR.'../_sidebar.php'); ?>
                <!-- end menu -->
                <!-- ###### -->
                <!-- start display -->
                <div class="col-m col-10 cp-display no-margin breads">
                    <div class="col-m col-12">
                        <a href="admin_cp"><?=language::invokeOutput('breads/cp');?></a>
                        <i class="icon-angle-<?=DIRECTION;?>"></i>
                        <a href="admin_cp/settings"><?=language::invokeOutput('breads/settings');?></a>
                        <i class="icon-angle-<?=DIRECTION;?>"></i>
                        <a href="admin_cp/settings?section=variables"><?=language::invokeOutput('breads/variables');?></a>
                    </div>
                    <!-- general settings -->
                    <div class="col-m col-12 settings">
                        <div class="col-m col-12 content-heading">
                            <h3><?=language::invokeOutput('section-heading/limits');?></h3>
                            <p class="section-desc"><?=language::invokeOutput('desc/limits');?></p>
                        </div>
                        <!-- one label -->
                        <div class="col-m col-12 field-label input-to-toggle-wrapper">
                            <div class="col-m col-4">
                                <h4><?=language::invokeOutput('labels/tpp');?></h4>
                                <small class="label-desc"><?=language::invokeOutput('labels-desc/tpp');?></small>
                            </div>
                            <div class="col-m col-7">
                                <div class="col-m col-12 input-to-toggle">
                                    <form action="ajax/updateVariables" method="POST" class="ajaxModal">
                                        <input type="text" name="threadPP" value="<?=isset_get($data, 'threadPP');?>">
                                        <input type="hidden" name="token" value="<?=$global['token'];?>">
                                        <input type="hidden" name="group" value="limit"><input type="hidden" name="token" value="<?=$global['token'];?>">
                                        <a class="icon-cancel toggle-back"></a>
                                    </form>
                                </div>
                                <?=isset_get($data, 'threadPP');?>
                            </div>
                            <div class="col-m col-1">
                                <a href="#" class="toggle-input"><?=Language::invokeOutput('edit-label');?></a>
                            </div>
                        </div>
                        <!-- end - one label -->
                        <!-- ###### -->
                        <div class="col-m col-12 split"></div>
                        <!-- one label -->
                        <div class="col-m col-12 field-label input-to-toggle-wrapper">
                            <div class="col-m col-4">
                                <h4><?=language::invokeOutput('labels/rpp');?></h4>
                                <small class="label-desc"><?=language::invokeOutput('labels-desc/rpp');?></small>
                            </div>
                            <div class="col-m col-7">
                                <div class="col-m col-12 input-to-toggle">
                                    <form action="ajax/updateVariables" method="POST" class="ajaxModal">
                                        <input type="text" name="replyPP" value="<?=isset_get($data, 'replyPP');?>">
                                        <input type="hidden" name="token" value="<?=$global['token'];?>">
                                        <input type="hidden" name="group" value="limit">
                                        <a class="icon-cancel toggle-back"></a>
                                    </form>
                                </div>
                                <?=isset_get($data, 'replyPP');?>
                            </div>
                            <div class="col-m col-1">
                                <a href="#" class="toggle-input"><?=Language::invokeOutput('edit-label');?></a>
                            </div>
                        </div>
                        <!-- end - one label -->
                        <!-- ###### -->
                        <div class="col-m col-12 split"></div>
                        <!-- one label -->
                        <div class="col-m col-12 field-label input-to-toggle-wrapper">
                            <div class="col-m col-4">
                                <h4><?=language::invokeOutput('labels/messagesLimit');?></h4>
                                <small class="label-desc"><?=language::invokeOutput('labels-desc/messagesLimit');?></small>
                            </div>
                            <div class="col-m col-7">
                                <div class="col-m col-12 input-to-toggle">
                                    <form action="ajax/updateVariables" method="POST" class="ajaxModal">
                                        <input type="text" name="messages" value="<?=isset_get($data, 'messages');?>">
                                        <input type="hidden" name="token" value="<?=$global['token'];?>">
                                        <input type="hidden" name="group" value="limit">
                                        <a class="icon-cancel toggle-back"></a>
                                    </form>
                                </div>
                                <?=isset_get($data, 'messages');?>
                            </div>
                            <div class="col-m col-1">
                                <a href="#" class="toggle-input"><?=Language::invokeOutput('edit-label');?></a>
                            </div>
                        </div>
                        <!-- end - one label -->
                        <!-- ###### -->
                        <div class="col-m col-12 split"></div>
                        <!-- one label -->
                        <div class="col-m col-12 field-label input-to-toggle-wrapper">
                            <div class="col-m col-4">
                                <h4><?=language::invokeOutput('labels/threadsLimit');?></h4>
                                <small class="label-desc"><?=language::invokeOutput('labels-desc/threadsLimit');?></small>
                            </div>
                            <div class="col-m col-7">
                                <div class="col-m col-12 input-to-toggle">
                                    <form action="ajax/updateVariables" method="POST" class="ajaxModal">
                                        <input type="text" name="threads" value="<?=isset_get($data, 'threads');?>">
                                        <input type="hidden" name="token" value="<?=$global['token'];?>">
                                        <input type="hidden" name="group" value="limit">
                                        <a class="icon-cancel toggle-back"></a>
                                    </form>
                                </div>
                                <?=isset_get($data, 'threads');?>
                            </div>
                            <div class="col-m col-1">
                                <a href="#" class="toggle-input"><?=Language::invokeOutput('edit-label');?></a>
                            </div>
                        </div>
                        <!-- end - one label -->
                        <!-- ###### -->
                        <div class="col-m col-12 split"></div>
                        <!-- one label -->
                        <div class="col-m col-12 field-label input-to-toggle-wrapper">
                            <div class="col-m col-4">
                                <h4><?=language::invokeOutput('labels/messagesPP');?></h4>
                                <small class="label-desc"><?=language::invokeOutput('labels-desc/messagesPP');?></small>
                            </div>
                            <div class="col-m col-7">
                                <div class="col-m col-12 input-to-toggle">
                                    <form action="ajax/updateVariables" method="POST" class="ajaxModal">
                                        <input type="text" name="msgPP" value="<?=isset_get($data, 'msgPP');?>">
                                        <input type="hidden" name="token" value="<?=$global['token'];?>">
                                        <input type="hidden" name="group" value="limit">
                                        <a class="icon-cancel toggle-back"></a>
                                    </form>
                                </div>
                                <?=isset_get($data, 'msgPP');?>
                            </div>
                            <div class="col-m col-1">
                                <a href="#" class="toggle-input"><?=Language::invokeOutput('edit-label');?></a>
                            </div>
                        </div>
                        <!-- end - one label -->
                        <div class="col-m col-12 split"></div>
                        <!-- one label -->
                        <div class="col-m col-12 field-label input-to-toggle-wrapper">
                            <div class="col-m col-4">
                                <h4><?=language::invokeOutput('labels/attachMaxSize');?></h4>
                                <small class="label-desc"><?=language::invokeOutput('labels-desc/attachMaxSize');?></small>
                            </div>
                            <div class="col-m col-7">
                                <div class="col-m col-12 input-to-toggle">
                                    <form action="ajax/updateVariables" method="POST" class="ajaxModal">
                                        <input type="text" name="attchSize" value="<?=isset_get($data, 'attchSize');?>">
                                        <input type="hidden" name="token" value="<?=$global['token'];?>">
                                        <input type="hidden" name="group" value="limit">
                                        <a class="icon-cancel toggle-back"></a>
                                    </form>
                                </div>
                                <?=Uploader::getReadableSize(isset_get($data, 'attchSize', 0) * 1024);?>
                            </div>
                            <div class="col-m col-1">
                                <a href="#" class="toggle-input"><?=Language::invokeOutput('edit-label');?></a>
                            </div>
                        </div>
                        <!-- end - one label -->
                        <div class="col-m col-12 split"></div>
                        <!-- ###### -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label input-to-toggle-wrapper">
                            <div class="col-m col-4">
                                <h4><?=language::invokeOutput('labels/attachMaxFiles');?></h4>
                                <small class="label-desc"><?=language::invokeOutput('labels-desc/attachMaxFiles');?></small>
                            </div>
                            <div class="col-m col-7">
                                <div class="col-m col-12 input-to-toggle">
                                    <form action="ajax/updateVariables" method="POST" class="ajaxModal">
                                        <input type="text" name="attachMaxFiles" value="<?=isset_get($data, 'attachMaxFiles');?>">
                                        <input type="hidden" name="token" value="<?=$global['token'];?>">
                                        <input type="hidden" name="group" value="limit">
                                        <a class="icon-cancel toggle-back"></a>
                                    </form>
                                </div>
                                <?=isset_get($data, 'attachMaxFiles');?>
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
                <!-- end display -->
                <!-- ###### -->
            </div>