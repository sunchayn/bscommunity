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
                        <a href="admin_cp/users?section=users"><?=language::invokeOutput('breads/username');?></a>
                    </div>
                    <div class="col-m col-12 content-wrapper">
                        <div class="col-m col-12">
                            <h4><?=language::invokeOutput('heading-username');?></h4>
                        </div>
                        <!-- ########## -->
                        <!-- users wrapper -->
                        <div class="col-m col-12 users-wrapper">
                            <?php
                            if (empty($data['username']))
                            {
                                echo '<div class="no-data">'. Language::invokeOutput('no-username') .'</div>';
                            }else{
                                ?>
                                <div class="col-m col-12 cf-list-cap v-middle">
                                    <div class="col-1 v-col"><?=language::invokeOutput('captions/id');?></div>
                                    <div class="col-3 v-col"><?=language::invokeOutput('captions/old-username');?></div>
                                    <div class="col-3 v-col"><?=language::invokeOutput('captions/new-username');?></div>
                                    <div class="col-3 v-col"><?=language::invokeOutput('captions/date');?></div>
                                    <div class="col-2 v-col"><?=language::invokeOutput('captions/options');?></div>
                                </div>
                                <?php foreach($data['username'] as $username)
                                    include('_username.php');
                            }
                            ?>
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