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
                        <a href="admin_cp/users?section=users"><?=language::invokeOutput('breads/mUsers');?></a>
                    </div>
                    <div class="col-m col-12 content-wrapper">
                        <div class="col-m col-12">
                            <h4><?=language::invokeOutput('heading-users');?></h4>
                        </div>
                        <div class="col-m col-12">
                            <?=language::invokeOutput('search-users');?>
                            <form class="inline-b middle" action="admin_cp/users" method="GET">
                                <input type="text" name="search" placeholder="<?=language::invokeOutput('username');?>" value="<?=$data['search'];?>">
                            </form>
                        </div>
                        <!-- ########## -->
                        <!-- users wrapper -->
                        <div class="col-m col-12 users-wrapper">
                            <?php
                            if (empty($data['users']))
                            {
                                echo '<div class="no-data">'. Language::invokeOutput('no-user') .'</div>';
                            }else{
                                ?>
                                <div class="col-m col-12 cf-list-cap v-middle">
                                    <div class="col-1 v-col"><?=language::invokeOutput('captions/id');?></div>
                                    <div class="col-2 v-col"><?=language::invokeOutput('captions/username');?></div>
                                    <div class="col-2 v-col"><?=language::invokeOutput('captions/role');?></div>
                                    <div class="col-1 v-col"><?=language::invokeOutput('captions/posts');?></div>
                                    <div class="col-3 v-col"><?=language::invokeOutput('captions/register');?></div>
                                    <div class="col-3 v-col"><?=language::invokeOutput('captions/options');?></div>
                                </div>
                            <?php foreach($data['users'] as $user)
                                    include('_user.php');
                            }
                            ?>

                            <div class="panel" id="change-role">
                                <div class="panel-head">
                                    <a href="#" class="icon-cancel cancel f-right"></a>
                                </div>
                                <div class="panel-content grid-section">
                                    <div class="col-m col-12">
                                        <h2 class="content-heading"><?=Language::invokeOutput('changeRole/heading');?></h2>
                                        <p class="section-desc"><?=Language::invokeOutput('changeRole/desc');?></p>
                                    </div>
                                    <form action="ajax/changeRole" method="POST" class="ajax col-m col-12 noScroll fields">
                                        <div class="col-m col-12 ajax-loader box"></div>
                                        <div class="col-m col-12 login-label box">
                                            <div class="col-m col-12">
                                                <span><?=Language::invokeOutput('select-role')?></span> : <select name="role" id="role">
                                                <?php
                                                    foreach($data['roles'] as $role)
                                                        echo '<option value="'. $role->id .'" id="role'. $role->id .'">'. $role->$data['name'] .'</option>';
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-m col-12 login-label">
                                            <a href="#" class="formSubmit"><?=Language::invokeOutput('submit-label');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                                            <input type="hidden" name="token" value="<?=$global['token'];?>" />
                                            <input type="hidden" name="id" id="id" value="" />
                                        </div>
                                    </form>
                                    <div class="col-m col-12 no-data hidden-item"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end - users wrapper -->
                        <!-- ###### -->
                        <!-- # pagination # -->
                        <?=$data['pages'];?>
                        <!-- # pagination # -->
                        <!-- ########## -->
                    </div>
                </div>
                <!-- end display -->
                <!-- ###### -->
            </div>