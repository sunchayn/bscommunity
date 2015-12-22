<div class="cp-index-page users-page">
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
                        <a href="admin_cp/users"><?=language::invokeOutput('breads/users');?></a>
                        <i class="icon-angle-<?=DIRECTION;?>"></i>
                        <a href="admin_cp/users?section=users"><?=language::invokeOutput('breads/mRoles');?></a>
                        <i class="icon-angle-<?=DIRECTION;?>"></i>
                        <a href="#add-role" class="disabled"><?=language::invokeOutput('breads/addRole');?></a>
                    </div>
                    <div class="col-m col-12 content-wrapper">
                        <form action="ajax/addRole" method="POST" class="ajax noScroll">
                            <div class="col-m col-12 ajax-loader"></div>
                            <div class="col-m col-12 box">
                                <div class="col-m col-12 box">
                                    <h4><?=Language::invokeOutput('addRole/name_ar');?></h4>
                                </div>
                                <div class="col-m col-12">
                                    <input type="text" name="name_ar" placeholder="<?=Language::invokeOutput('addRole/placeholder1');?>" class="rad2" tabindex="1"/>
                                </div>
                            </div>
                            <div class="col-m col-12 box">
                                <div class="col-m col-12 box">
                                    <h4><?=Language::invokeOutput('addRole/name_en');?></h4>
                                </div>
                                <div class="col-m col-12">
                                    <input type="text" name="name_en" placeholder="<?=Language::invokeOutput('addRole/placeholder2');?>" class="rad2" tabindex="2"/>
                                </div>
                            </div>
                            <div class="col-m col-12 box">
                                <div class="col-m col-12 box">
                                    <h4><?=Language::invokeOutput('addRole/permission');?></h4>
                                </div>
                                <div class="col-m col-12">
                                    <input type="checkbox" name="access[edit-threads]" id="r1">
                                    <label for="r1"><?=Language::invokeOutput('addRole/edit-threads');?></label>
                                    <br />
                                    <input type="checkbox" name="access[edit-replies]" id="r2">
                                    <label for="r2"><?=Language::invokeOutput('addRole/edit-replies');?></label>
                                    <br />
                                    <input type="checkbox" name="access[remove-threads]" id="r3">
                                    <label for="r3"><?=Language::invokeOutput('addRole/remove-threads');?></label>
                                    <br />
                                    <input type="checkbox" name="access[remove-replies]" id="r4">
                                    <label for="r4"><?=Language::invokeOutput('addRole/remove-replies');?></label>
                                    <br />
                                    <input type="checkbox" name="access[report-center]" id="r5">
                                    <label for="r5"><?=Language::invokeOutput('addRole/report-center');?></label>
                                    <br />
                                    <input type="checkbox" name="access[pin-threads]" id="r6">
                                    <label for="r6"><?=Language::invokeOutput('addRole/pin-threads');?></label>
                                </div>
                            </div>
                            <div class="col-m col-12 box">
                                <a href="#" class="formSubmit"><?=Language::invokeOutput('submit-label');?></a> - 
                                <a href="admin_cp/users?section=roles"><?=Language::invokeOutput('back-to-list');?></a>
                                <input type="hidden" name="token" value="<?=$global['token'];?>" />
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end display -->
                <!-- ###### -->
            </div>