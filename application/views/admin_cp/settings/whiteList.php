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
                        <a href="admin_cp/settings?section=filter"><?=language::invokeOutput('breads/filter');?></a>
                        <i class="icon-angle-<?=DIRECTION;?>"></i>
                        <a href="#whiteList" class="disabled"><?=language::invokeOutput('breads/whitelist');?></a>
                    </div>
                    <div class="col-m col-12 content-wrapper">
                        <div class="col-m col-12">
                            <h4><?=Language::invokeOutput('addWhite');?></h4>
                        </div>
                        <div class="col-m col-12">
                            <form action="ajax/addWhiteURL" method="POST" class="ajax noScroll">
                                <div class="col-m col-12 ajax-loader"></div>
                                <div class="col-m col-12">
                                    <input type="text" name="url" class="col-8 rad2" placeholder="<?=Language::invokeOutput('url');?>">
                                </div>
                                <div class="col-m col-12 box">
                                    <input type="hidden" name="token" value="<?=$global['token'];?>" />
                                    <a href="#add-url" class="formSubmit"><?=Language::invokeOutput('submit-label');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-m col-12 url-wrapper">
                            <!-- whitelist heading -->
                            <div class="col-m col-12 cf-list-cap v-middle hide-sm">
                                <div class="col-2 v-col"><?=language::invokeOutput('captions/id');?></div>
                                <div class="col-6 v-col"><?=language::invokeOutput('captions/url');?></div>
                                <div class="col-4 v-col"><?=language::invokeOutput('captions/operation');?></div>
                            </div>
                            <!-- end - whitelist heading -->
                            <!-- #### -->
                            <?php
                            if (!empty($data['whiteURL']))
                            {
                                foreach($data['whiteURL'] as $url)
                                include('_URL.php');
                            }else{
                                echo '<div class="col-m col-12 no-data">"'. language::invokeOutput('no-urls') .'</div>';
                            }

                            ?>
                            <!-- #### -->
                    </div>
                    <!-- # pagination # -->
                    <?=$data['pages'];?>
                    <!-- # pagination # -->
                </div>
                <!-- end display -->
                <!-- ###### -->
            </div>