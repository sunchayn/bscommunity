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
                        <a href="admin_cp/categories?section=rules"><?=language::invokeOutput('breads/rules');?></a>
                    </div>
                    <div class="col-m col-12 content-wrapper">
                        <div class="col-m col-12">
                            <h3><?=Language::invokeOutput('heading-forums');?></h3>
                        </div>
                        <div class="col-m col-12">
                            <?=language::invokeOutput('sel-forum') . ' : ';?>
                            <select class="page-swapper">
                                <option value="admin_cp/categories?section=rules&forum_id=<?=$data['curr_forum']->id;?>"><?=$data['curr_forum']->$data['Ftitle'];?></option>
                                <?php
                                foreach ($data['forums'] as $forum)
                                    if ($forum->id != $data['curr_forum']->id)
                                        echo '<option value="admin_cp/categories?section=rules&forum_id='. $forum->id .'">'. $forum->$data['Ftitle']. '</option>';
                                ?>
                            </select>
                        </div>
                        <!-- ########## -->
                        <!-- forums / categories wrapper -->
                        <div class="col-m col-12 categories-wrapper">
                            <!-- #### -->
                            <?php
                            if (empty($data['rules']))
                            {
                                echo '<div class="no-data">'. Language::invokeOutput('no-rules') .'</div>';
                            }else{
                                foreach($data['rules'] as $rule)
                                    include('_rule.php');
                            }
                            ?>
                            <!-- #### -->
                        </div>
                        <!-- end - forums / categories wrapper -->
                        <!-- ###### -->
                        <!-- add new rule -->
                        <div class="col-m col-12">
                            <h4><a href="admin_cp/categories?section=addRule&forum_id=<?=$data['curr_forum']->id;?>"><?=Language::invokeOutput('newRule');?></a></h4>
                        </div>
                    </div>
                </div>
                <!-- end display -->
                <!-- ###### -->