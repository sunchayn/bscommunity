<div class="page account-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12">
                <?php include_once '_side.php'; ?>
                <div class="col-m col-9 content">
                    <!-- general settings -->
                    <div class="col-m col-12 content-heading">
                        <h2><?=Language::invokeOutput('heading/general');?></h2>
                        <p class="section-desc"><?=Language::invokeOutput('desc/general');?></p>
                    </div>
                    <div class="col-m col-12 content-body">
                        <!-- one label -->
                        <div class="col-m col-12 field-label input-to-toggle-wrapper">
                            <div class="col-m col-4">
                                <h5><?=Language::invokeOutput('labels/name');?></h5>
                                <small class="label-desc">
                                   <?=Language::invokeOutput('label-desc/name');?>
                                </small>
                            </div>
                            <div class="col-m col-7">
                                <div class="col-m col-12 input-to-toggle">
                                    <form action="ajax/updateUser" method="POST" class="ajaxModal">
                                        <input type="text" name ="fullName" value="<?=isset_get($data['user'], 'first_name', '') . ' ' . isset_get($data['user'], 'last_name', '');?>">
                                        <input type="hidden" name="token" value="<?=$global['token'];?>">
                                        <a class="icon-cancel toggle-back"></a>
                                    </form>
                                </div>
                                <?=isset_get($data['user'], 'first_name') . ' ' . isset_get($data['user'], 'last_name');?>
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
                                <h5><?=Language::invokeOutput('labels/birthday');?></h5>
                                <small class="label-desc"><?=Language::invokeOutput('label-desc/birthday');?></small>
                            </div>
                            <div class="col-m col-7">
                                <?=isset_get($data['user'], 'birthday');?>
                            </div>
                            <div class="col-m col-1">
                                <a href="#" class="disabled"><?=Language::invokeOutput('edit-label');?></a>
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <!-- ########## -->
                        <!-- one label -->
                        <div class="col-m col-12 field-label input-to-toggle-wrapper">
                            <div class="col-m col-4">
                                <h5><?=Language::invokeOutput('labels/country');?></h5>
                                <small class="label-desc"><?=Language::invokeOutput('label-desc/country');?></small>
                            </div>
                            <div class="col-m col-7">
                                <div class="col-m col-12 input-to-toggle">
                                    <form action="ajax/updateUser" method="POST" class="ajaxModal">
                                        <input type="text" name ="country" value="<?=isset_get($data['user'], 'country', '');?>">
                                        <input type="hidden" name="token" value="<?=$global['token'];?>">
                                        <a class="icon-cancel toggle-back"></a>
                                    </form>
                                </div>
                                <?=isset_get($data['user'], 'country');?>
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
                                <h5><?=Language::invokeOutput('labels/gender');?></h5>
                                <small class="label-desc"><?=Language::invokeOutput('label-desc/gender');?></small>
                            </div>
                            <div class="col-m col-7">
                               <?=usersAPI::getGender(isset_get($data['user'], 'sexe'));?>
                            </div>
                            <div class="col-m col-1">
                                <a href="#" class="disabled"><?=Language::invokeOutput('edit-label');?></a>
                            </div>
                        </div>
                        <div class="col-m col-12 split"></div>
                        <!-- end - one label -->
                        <div class="col-m col-12 field-label input-to-toggle-wrapper">
                            <div class="col-m col-4">
                                <h5><?=Language::invokeOutput('labels/picture');?></h5>
                                <small class="label-desc"><?=Language::invokeOutput('label-desc/picture');?></small>
                            </div>
                            <div class="col-m col-7 box">
                                <img src="<?=isset_get($data['user'], 'profile_picture', 'notfound');?>" alt="current-profile-picture" height="100" width="100" class="prof-pic triggerPanel" data-panel="picture-change">
                            </div>
                            <div>&nbsp;</div>
                        </div>
                        <!-- end - profile-picture -->
                        <!-- ########## -->
                        <div class="overlay hide-sm"></div>
                        <div class="panel profile-picture" id="picture-change">
                            <div class="panel-head">
                                <a href="#" class="icon-cancel cancel f-right"></a>
                            </div>
                            <div class="panel-content grid-section">
                                <div class="col-m col-12">
                                    <h2 class="content-heading"><?=Language::invokeOutput('profile-picture/heading');?></h2>
                                    <p class="section-desc"><?=Language::invokeOutput('profile-picture/desc');?></p>
                                </div>
                                <form action="ajax/updateUserPicture" method="POST" class="ajax noScroll">
                                    <div class="col-m col-12 ajax-loader"></div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('profile-picture/label');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <input type="text" name="profile_picture" value="<?=isset_get($data['user'], 'profile_picture', '');?>" class="rad2" tabindex="1"/>
                                            <input type="hidden" name="token" value="<?=$global['token'];?>" />
                                            <small><?=Language::invokeOutput('profile-picture/update');?></small>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- ########## -->
                        <!-- profile-picture -->
                    </div>
                    <!-- end - general settings -->
                    <!-- ########## -->
                </div>
            </div>
        </div>
    </div>
</div>
