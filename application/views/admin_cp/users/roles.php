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
                    </div>
                    <div class="col-m col-12 content-wrapper">
                        <div class="col-m col-12">
                            <h4><?=language::invokeOutput('heading-roles');?></h4>
                            <small><?=language::invokeOutput('role-hint');?></small>
                        </div>
                        <!-- ########## -->
                        <!-- roles wrapper -->
                        <div class="col-m col-12 users-wrapper">
                            <!-- roles heading -->
                            <div class="col-m col-12 cf-list-cap v-middle">
                                <div class="col-1 v-col"><?=language::invokeOutput('captions/id');?></div>
                                <div class="col-2 v-col"><?=language::invokeOutput('captions/role-name');?></div>
                                <div class="col-6 v-col"><?=language::invokeOutput('captions/role-access');?></div>
                                <div class="col-3 v-col"><?=language::invokeOutput('captions/options');?></div>
                            </div>
                            <!-- end - roles heading -->
                            <!-- #### -->
                            <?php
                                foreach($data['roles'] as $role)
                                    include('_role.php');
                            ?>
                            <!-- #### -->
                        </div>
                        <!-- end - roles wrapper -->
                        <!-- ########## -->
                        <!-- add new role -->
                        <div class="col-m col-12 add-role">
                            <h4><a href="admin_cp/users?section=addRole"><?=language::invokeOutput('new-role');?></a></h4>
                        </div>
                        <!-- end - add new role -->
                        <!-- ########## -->
                        <!-- update role -->
                        <div class="panel" id="edit-role">
                            <div class="panel-head">
                                <a href="#" class="icon-cancel cancel f-right"></a>
                            </div>
                            <div class="panel-content grid-section">
                                <div class="col-m col-12">
                                    <h2 class="content-heading"><?=Language::invokeOutput('editRole/heading');?></h2>
                                    <p class="section-desc"><?=Language::invokeOutput('editRole/desc');?></p>
                                </div>
                                <form action="ajax/editRole" method="POST" class="ajax noScroll">
                                    <div class="col-m col-12 ajax-loader"></div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addRole/name_ar');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <input type="text" name="name_ar" id="name_ar" placeholder="<?=Language::invokeOutput('addRole/placeholder1');?>" class="rad2" tabindex="1"/>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addRole/name_en');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <input type="text" name="name_en" id="name_en" placeholder="<?=Language::invokeOutput('addRole/placeholder2');?>" class="rad2" tabindex="2"/>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <div class="col-m col-12 box">
                                            <h4><?=Language::invokeOutput('addRole/permission');?></h4>
                                        </div>
                                        <div class="col-m col-12">
                                            <input type="checkbox" name="access[edit-threads]" id="edit-threads">
                                            <label for="edit-threads"><?=Language::invokeOutput('addRole/edit-threads');?></label>
                                            <br />
                                            <input type="checkbox" name="access[edit-replies]" id="edit-replies">
                                            <label for="edit-replies"><?=Language::invokeOutput('addRole/edit-replies');?></label>
                                            <br />
                                            <input type="checkbox" name="access[remove-threads]" id="remove-threads">
                                            <label for="remove-threads"><?=Language::invokeOutput('addRole/remove-threads');?></label>
                                            <br />
                                            <input type="checkbox" name="access[remove-replies]" id="remove-replies">
                                            <label for="remove-replies"><?=Language::invokeOutput('addRole/remove-replies');?></label>
                                            <br />
                                            <input type="checkbox" name="access[report-center]" id="report-center">
                                            <label for="report-center"><?=Language::invokeOutput('addRole/report-center');?></label>
                                        </div>
                                    </div>
                                    <div class="col-m col-12 login-label">
                                        <a href="#" class="formSubmit"><?=Language::invokeOutput('submit-label');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                                        <input type="hidden" name="id" id="id" value="" />
                                        <input type="hidden" name="token" value="<?=$global['token'];?>" />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end - update role -->
                        <!-- ########## -->
                    </div>
                </div>
                <!-- end display -->
                <!-- ###### -->
            </div>