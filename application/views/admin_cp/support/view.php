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
                        <i class="icon-angle-<?=DIRECTION;?>"></i>
                        <a href="admin_cp/support/<?=$data['ticket']->id;?>"><?=$data['ticket']->title;?></a>
                    </div>
                    <div class="col-m col-12 content-wrapper">
                        <!-- support center -->
                        <div class="col-m col-12 content-heading">
                            <h3><?=Language::invokeOutput('view/heading');?></h3>
                            <p class="section-desc"><?=Language::invokeOutput('view/desc');?></p>
                        </div>
                        <!-- ########## -->
                        <div class="col-m col-12 box ticket-core">
                            <div class="col-m col-12 v-middle box ticket-heading">
                                <div class="v-col">
                                    <img src="<?=$data['ticket']->profile_picture;?>" alt="profile_picture" class="x-50 img-circel">
                                </div>
                                <div class="v-col">
                                    <h3><a href="profile/<?=$data['ticket']->sender;?>"><?=$data['ticket']->username;?></a></h3>
                                    <small><?=Language::invokeOutput('frequent/level'). ' ' .$data['ticket']->level;?></small>
                                </div>
                            </div>
                            <div class="col-m col-12 ticket-content">
                                <p><?=$data['ticket']->content;?></p>
                            </div>
                        </div>
                        <form class="col-m col-12 ticket-response ajax noScroll" action="ajax/responseTicket" method="POST">
                            <div class="col-m col-12"><h4><?=Language::invokeOutput('view/response');?></h4></div>
                            <!-- AJAX LOADER -->
                            <div class="ajax-loader col-m col-12"></div>
                            <!-- end -  AJAX LOADER -->
                            <div class="col-m col-12 box">
                                <textarea rows="7" class="col-12" placeholder="<?=Language::invokeOutput('view/placeholder');?>" name="content"></textarea>
                            </div>
                            <div class="col-m col-12">
                                <input type="hidden" name="token" value="<?=$global['token'];?>">
                                <input type="hidden" name="id" value="<?=$data['ticket']->id;?>">
                                <a href="#" class="formSubmit"><?=Language::invokeOutput('submit-label');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                            </div>
                        </form>
                        <!-- end - support center -->
                        <!-- ###### -->
                    </div>
                </div>
                <!-- end display -->
                <!-- ###### -->