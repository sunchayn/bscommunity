<div class="cp-index-page support-page">
    <div class="sub-wrapper">
        <div class="grid-section">
            <div class="flexbox">
                <?php include(__DIR__.DIRECTORY_SEPARATOR.'../_sidebar.php') ;?>
                <!-- ###### -->
                <!-- start display -->
                <div class="col-m col-10 cp-display breads no-margin">
                    <div class="col-m col-12">
                        <a href="admin_cp"><?=Language::invokeOutput('breads/cp');?></a>
                        <i class="icon-angle-<?=DIRECTION;?>"></i>
                        <a href="admin_cp/support"><?=Language::invokeOutput('breads/support');?></a>
                    </div>
                    <div class="col-m col-12 content-wrapper">
                        <!-- support center -->
                        <div class="col-m col-12 content-heading">
                            <h3><?=Language::invokeOutput('heading-supp');?></h3>
                            <p class="section-desc"><?=Language::invokeOutput('desc');?></p>
                        </div>
                        <!-- ########## -->
                        <form action="ajax/deleteTickets" method="POST" class="col-m col-12 delete-tickets">
                            <input type="hidden" name="token" value="<?=$global['token'];?>">
                            <div class="col-m col-12 box">
                                <a href="#deleteSelected" class="formSubmit"><?=language::invokeOutput('delete-se');?></a>
                            </div>
                            <!-- tickets wrapper -->
                            <div class="col-m col-12 ticket-wrapper">
                                <div class="col-m col-12 show-sm">
                                    <input type="checkbox" id="selectAll" class="selectAll">
                                    <label for="selectAll"><?=language::invokeOutput('sel-all');?></label>
                                </div>
                                <div class="col-m col-12 v-middle cf-list-cap hide-md">
                                    <div class="col-2 v-col">
                                        <input type="checkbox" id="selectAll" class="selectAll">
                                        <label for="selectAll"></label>
                                        <?=language::invokeOutput('captions/sender');?>
                                    </div>
                                    <div class="col-6 v-col"><?=language::invokeOutput('captions/title');?></div>
                                    <div class="col-2 v-col"><?=language::invokeOutput('captions/status');?></div>
                                    <div class="col-2 v-col"><?=language::invokeOutput('captions/date');?></div>
                                </div>
                                <?php
                                    if (!empty($data['tickets']))
                                    {
                                        $x = 1;
                                        foreach ($data['tickets'] as $ticket)
                                            include '_ticket.php';
                                    }else
                                        echo '<div class="no-data">' . Language::invokeOutput('no-tickets') . '</div>';
                                ?>
                            </div>
                        </form>
                        <!-- end - tickets wrapper -->
                        <!-- ###### -->
                        <!-- # pagination # -->
                        <?=$data['pages'];?>
                        <!-- # pagination # -->
                        <!-- ########## -->
                        <!-- end - support center -->
                        <!-- ###### -->
                    </div>
                </div>
                <!-- end display -->
                <!-- ###### -->