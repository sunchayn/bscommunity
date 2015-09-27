<div class="page account-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12">
                <?php include_once '_side.php'; ?>
                <div class="col-m col-9 content">
                    <!-- notification center -->
                    <div class="col-m col-12 content-heading">
                        <h2><?=language::invokeOutput('heading/notification');?></h2>
                        <p class="section-desc"><?=language::invokeOutput('desc/notification');?></p>
                    </div>
                    <div class="col-m col-12 content-body">
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <form action="ajax/updatePref" method="post" class="ajaxModal">
                                <div class="col-m col-4">
                                    <h5><?=language::invokeOutput('labels/pinned');?></h5>
                                    <small class="label-desc"><?=language::invokeOutput('label-desc/pinned');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <input type="radio" value="1" name="notify_pinned" id="pinnedEnable" <?=isset_get($data, 'pinEnabled', '');?> >
                                    <label for="pinnedEnable"><?=language::invokeOutput('enable-label');?></label>
                                    <input type="radio" value="0" name="notify_pinned" id="pinnedDisable" <?=isset_get($data, 'pinDisabled', '');?>>
                                    <label for="pinnedDisable"><?=language::invokeOutput('disable-label');?></label>
                                    <input type="hidden" name="token" value="<?=$global["token"];?>">
                                </div>
                                <div class="col-m col-1">
                                    <a class='formSubmit' href='#change'><?=Language::invokeOutput('change-label');?></a>
                                </div>
                            </form>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- ########## -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <form action="ajax/updatePref" method="post" class="ajaxModal">
                                <div class="col-m col-4">
                                    <h5><?=language::invokeOutput('labels/followThread');?></h5>
                                    <small class="label-desc"><?=language::invokeOutput('label-desc/followThread');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <input type="radio" value="1" name="notify_threads" id="threadEnable" <?=isset_get($data, 'threadEnabled', '');?> >
                                    <label for="threadEnable"><?=language::invokeOutput('enable-label');?></label>
                                    <input type="radio" value="0" name="notify_threads" id="threadDisable" <?=isset_get($data, 'threadDisabled', '');?>>
                                    <label for="threadDisable"><?=language::invokeOutput('disable-label');?></label>
                                    <input type="hidden" name="token" value="<?=$global["token"];?>">
                                </div>
                                <div class="col-m col-1">
                                    <a class='formSubmit' href='#change'><?=Language::invokeOutput('change-label');?></a>
                                </div>
                            </form>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- ########## -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <form action="ajax/updatePref" method="post" class="ajaxModal">
                                <div class="col-m col-4">
                                    <h5><?=language::invokeOutput('labels/replies');?></h5>
                                    <small class="label-desc"><?=language::invokeOutput('label-desc/replies');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <input type="radio" value="1" name="notify_replies" id="replyEnable" <?=isset_get($data, 'replyEnabled', '');?> >
                                    <label for="replyEnable"><?=language::invokeOutput('enable-label');?></label>
                                    <input type="radio" value="0" name="notify_replies" id="replyDisable" <?=isset_get($data, 'replyDisabled', '');?>>
                                    <label for="replyDisable"><?=language::invokeOutput('disable-label');?></label>
                                    <input type="hidden" name="token" value="<?=$global["token"];?>">
                                </div>
                                <div class="col-m col-1">
                                    <a class='formSubmit' href='#change'><?=Language::invokeOutput('change-label');?></a>
                                </div>
                            </form>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- ########## -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <form action="ajax/updatePref" method="post" class="ajaxModal">
                                <div class="col-m col-4">
                                    <h5><?=language::invokeOutput('labels/thanks');?></h5>
                                    <small class="label-desc"><?=language::invokeOutput('label-desc/thanks');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <input type="radio" value="1" name="notify_thanks" id="thanksEnable" <?=isset_get($data, 'thanksEnabled', '');?> >
                                    <label for="thanksEnable"><?=language::invokeOutput('enable-label');?></label>
                                    <input type="radio" value="0" name="notify_thanks" id="thanksDisable" <?=isset_get($data, 'thanksDisabled', '');?>>
                                    <label for="thanksDisable"><?=language::invokeOutput('disable-label');?></label>
                                    <input type="hidden" name="token" value="<?=$global["token"];?>">
                                </div>
                                <div class="col-m col-1">
                                    <a class='formSubmit' href='#change'><?=Language::invokeOutput('change-label');?></a>
                                </div>
                            </form>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- ########## -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <form action="ajax/updatePref" method="post" class="ajaxModal">
                                <div class="col-m col-4">
                                    <h5><?=language::invokeOutput('labels/followers');?></h5>
                                    <small class="label-desc"><?=language::invokeOutput('label-desc/followers');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <input type="radio" value="1" name="notify_follow" id="followEnable" <?=isset_get($data, 'followEnabled', '');?> >
                                    <label for="followEnable"><?=language::invokeOutput('enable-label');?></label>
                                    <input type="radio" value="0" name="notify_follow" id="followDisable" <?=isset_get($data, 'followDisabled', '');?>>
                                    <label for="followDisable"><?=language::invokeOutput('disable-label');?></label>
                                    <input type="hidden" name="token" value="<?=$global["token"];?>">
                                </div>
                                <div class="col-m col-1">
                                    <a class='formSubmit' href='#change'><?=Language::invokeOutput('change-label');?></a>
                                </div>
                            </form>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- ########## -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <form action="ajax/updatePref" method="post" class="ajaxModal">
                                <div class="col-m col-4">
                                    <h5><?=language::invokeOutput('labels/achievement');?></h5>
                                    <small class="label-desc"><?=language::invokeOutput('label-desc/achievement');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <input type="radio" value="1" name="notify_achievement" id="achEnabled" <?=isset_get($data, 'achievementEnabled', '');?> >
                                    <label for="achEnabled"><?=language::invokeOutput('enable-label');?></label>
                                    <input type="radio" value="0" name="notify_achievement" id="achDisabled" <?=isset_get($data, 'achievementDisabled', '');?>>
                                    <label for="achDisabled"><?=language::invokeOutput('disable-label');?></label>
                                    <input type="hidden" name="token" value="<?=$global["token"];?>">
                                </div>
                                <div class="col-m col-1">
                                    <a class='formSubmit' href='#change'><?=Language::invokeOutput('change-label');?></a>
                                </div>
                            </form>
                        </div>
                        <!-- end - one label -->
                        <!-- ########## -->
                    </div>
                    <!-- end -  notification center -->
                    <!-- ########## -->
                </div>
            </div>
        </div>
    </div>
</div>
