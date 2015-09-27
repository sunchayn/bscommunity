<div class="page account-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12">
                <?php include_once '_side.php'; ?>
                <div class="col-m col-9 content">
                    <!-- Privacy settings -->
                    <div class="col-m col-12 content-heading">
                        <h2><?=Language::invokeOutput('heading/privacy');?></h2>
                        <p class="section-desc"><?=Language::invokeOutput('desc/privacy');?></p>
                    </div>
                    <div class="col-m col-12 content-body">
                        <!-- one label -->
                        <div class="col-m col-12 field-label">
                            <form action="ajax/updatePref" method="post" class="ajaxModal">
                                <div class="col-m col-4">
                                    <h5><?=Language::invokeOutput('labels/birthday');?></h5>
                                    <small class="label-desc"><?=Language::invokeOutput('label-desc/birthday-v');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <input type="radio" value="1" name="bd_visibility" id="visible" <?=isset_get($data, 'bd_visible', '');?> >
                                    <label for="visible"><?=language::invokeOutput('anyone');?></label>
                                    <input type="radio" value="0" name="bd_visibility" id="invisible" <?=isset_get($data, 'bd_invisible', '');?>>
                                    <label for="invisible"><?=language::invokeOutput('only');?></label>
                                    <input type="hidden" name="token" value="<?=$global["token"];?>">
                                </div>
                                <div class="col-m col-1">
                                    <a class='formSubmit' href='#change'><?=language::invokeOutput('change-label');?></a>
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
                                    <h5><?=Language::invokeOutput('labels/following');?></h5>
                                    <small class="label-desc"><?=Language::invokeOutput('label-desc/following');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <input type="radio" value="1" name="is_follow" id="enableF" <?=isset_get($data, 'canFollow', '');?> >
                                    <label for="enableF"><?=language::invokeOutput('enable-label');?></label>
                                    <input type="radio" value="0" name="is_follow" id="disableF" <?=isset_get($data, 'cantFollow', '');?>>
                                    <label for="disableF"><?=language::invokeOutput('disable-label');?></label>
                                    <input type="hidden" name="token" value="<?=$global["token"];?>">
                                </div>
                                <div class="col-m col-1">
                                    <a class='formSubmit' href='#change'><?=language::invokeOutput('change-label');?></a>
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
                                    <h5><?=Language::invokeOutput('labels/profile');?></h5>
                                    <small class="label-desc"><?=Language::invokeOutput('label-desc/profile');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <input type="radio" value="1" name="profile_visibility" id="visibleP" <?=isset_get($data, 'profileVisible', '');?> >
                                    <label for="visibleP"><?=language::invokeOutput('profile-all');?></label>
                                    <input type="radio" value="0" name="profile_visibility" id="invisibleP" <?=isset_get($data, 'profileInvisible', '');?>>
                                    <label for="invisibleP"><?=language::invokeOutput('profile-mem');?></label>
                                    <input type="hidden" name="token" value="<?=$global["token"];?>">
                                </div>
                                <div class="col-m col-1">
                                    <a class='formSubmit' href='#change'><?=language::invokeOutput('change-label');?></a>
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
                                    <h5><?=Language::invokeOutput('labels/messages');?></h5>
                                    <small class="label-desc"><?=Language::invokeOutput('label-desc/messages');?></small>
                                </div>
                                <div class="col-m col-7">
                                    <input type="radio" value="1" name="messages" id="allowMsg" <?=isset_get($data, 'allowedMsg', '');?> >
                                    <label for="allowMsg"><?=language::invokeOutput('anyone');?></label>
                                    <input type="radio" value="0" name="messages" id="disallowMsg" <?=isset_get($data, 'disallowedMsg', '');?>>
                                    <label for="disallowMsg"><?=language::invokeOutput('msg-adm');?></label>
                                    <input type="hidden" name="token" value="<?=$global["token"];?>">
                                </div>
                                <div class="col-m col-1">
                                    <a class='formSubmit' href='#change'><?=language::invokeOutput('change-label');?></a>
                                </div>
                            </form>
                        </div>
                        <!-- end - one label -->
                    </div>
                    <!-- end -  privacy settings -->
                    <!-- ########## -->
                </div>
            </div>
        </div>
    </div>
</div>
