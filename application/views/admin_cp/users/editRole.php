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
                        <a href="#edit-role" class="disabled"><?=language::invokeOutput('breads/editRole');?></a>
                    </div>
                    <div class="col-m col-12 content-wrapper">
                        <form action="ajax/editRole" method="POST" class="ajax noScroll">
                            <div class="col-m col-12 ajax-loader"></div>
                            <div class="col-m col-12 box">
                                <div class="col-m col-12 box">
                                    <h4><?=Language::invokeOutput('addRole/name_ar');?></h4>
                                </div>
                                <div class="col-m col-12">
                                    <input type="text" name="name_ar" id="name_ar" placeholder="<?=Language::invokeOutput('addRole/placeholder1');?>" class="rad2" value="<?=$data['role']->name_ar;?>" tabindex="1"/>
                                </div>
                            </div>
                            <div class="col-m col-12 box">
                                <div class="col-m col-12 box">
                                    <h4><?=Language::invokeOutput('addRole/name_en');?></h4>
                                </div>
                                <div class="col-m col-12">
                                    <input type="text" name="name_en" id="name_en" placeholder="<?=Language::invokeOutput('addRole/placeholder2');?>" class="rad2" value="<?=$data['role']->name_en;?>" tabindex="2"/>
                                </div>
                            </div>
                            <div class="col-m col-12 box">
                                <div class="col-m col-12">
                                    <h4><?=Language::invokeOutput('addRole/permission');?></h4>
                                </div>
                                <div class="col-m col-12 box">
                                    <input type="checkbox" name="access[edit-threads]" id="edit-threads"<?=isset_get($data['checked-acc'], 'edit-threads', '');?>>
                                    <label for="edit-threads"><?=Language::invokeOutput('addRole/edit-threads');?></label>
                                    <br />
                                    <input type="checkbox" name="access[edit-replies]" id="edit-replies"<?=isset_get($data['checked-acc'], 'edit-replies', '');?>>
                                    <label for="edit-replies"><?=Language::invokeOutput('addRole/edit-replies');?></label>
                                    <br />
                                    <input type="checkbox" name="access[remove-threads]" id="remove-threads"<?=isset_get($data['checked-acc'], 'remove-threads', '');?>>
                                    <label for="remove-threads"><?=Language::invokeOutput('addRole/remove-threads');?></label>
                                    <br />
                                    <input type="checkbox" name="access[remove-replies]" id="remove-replies"<?=isset_get($data['checked-acc'], 'remove-replies', '');?>>
                                    <label for="remove-replies"><?=Language::invokeOutput('addRole/remove-replies');?></label>
                                    <br />
                                    <input type="checkbox" name="access[report-center]" id="report-center"<?=isset_get($data['checked-acc'], 'report-center', '');?>>
                                    <label for="report-center"><?=Language::invokeOutput('addRole/report-center');?></label>
                                </div>
                            </div>
                            <div class="col-m col-12 login-label">
                                <a href="#" class="formSubmit"><?=Language::invokeOutput('submit-label');?></a> - 
                                <a href="admin_cp/users?section=roles"><?=Language::invokeOutput('back-to-list');?></a>
                                <input type="hidden" name="id" id="id" value="<?=$data['role']->id;?>" />
                                <input type="hidden" name="token" value="<?=$global['token'];?>" />
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end display -->
                <!-- ###### -->
            </div>