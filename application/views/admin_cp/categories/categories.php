<div class="cp-index-page categories-page">
    <div class="sub-wrapper">
        <div class="grid-section">
            <div class="flexbox">
                <?php include(__DIR__.DIRECTORY_SEPARATOR.'../_sidebar.php');?>
                <!-- ###### -->
                <!-- start display -->
                <div class="col-m col-10 cp-display no-margin breads">
                    <div class="col-m col-12">
                        <a href="admin_cp"><?=language::invokeOutput('breads/cp');?></a>
                        <i class="icon-angle-<?=DIRECTION;?>"></i>
                        <a href="admin_cp/categories"><?=language::invokeOutput('breads/categories');?></a>
                        <i class="icon-angle-<?=DIRECTION;?>"></i>
                        <a href="admin_cp/categories?section=categories"><?=language::invokeOutput('breads/mCategories');?></a>
                    </div>
                    <div class="col-m col-12 content-wrapper">
                        <div class="col-m col-12">
                            <h3><?=Language::invokeOutput('heading-cat');?></h3>
                        </div>
                        <!-- ########## -->
                        <!-- forums / categories wrapper -->
                        <div class="col-m col-12 categories-wrapper">
                            <!-- end - forums / categories heading -->
                            <!-- #### -->
                            <?php
                                if (empty($data['categories']))
                                {
                                    echo '<div class="no-data">'. Language::invokeOutput('no-categories') .'</div>';
                                }else{
                                    foreach($data['categories'] as $cat)
                                        include('_category.php');
                                }
                            ?>
                            <!-- #### -->
                        </div>
                        <!-- end - forums / categories wrapper -->
                        <!-- ###### -->
                        <!-- add new category -->
                        <div class="col-m col-12">
                            <h4><a href="admin_cp/categories?section=addCategory"><?=Language::invokeOutput('new');?></a></h4>
                        </div>                            
                    </div>
                </div>
                <!-- end display -->
                <!-- ###### -->