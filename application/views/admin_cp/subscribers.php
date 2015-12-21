<div class="cp-index-page newsletter-page">
    <div class="sub-wrapper">
        <div class="grid-section">
            <div class="flexbox">
                <?php include('_sidebar.php');?>
                <!-- ###### -->
                <!-- start display -->
                <div class="col-m col-10 cp-display no-margin breads">
                    <div class="col-m col-12">
                        <a href="admin_cp"><?=Language::invokeOutput('breads/cp');?></a>
                        <i class="icon-angle-<?=DIRECTION;?>"></i>
                        <a href="admin_cp/subscribers"><?=Language::invokeOutput('breads/subscribers');?></a>
                    </div>
                    <div class="content-wrapper">
                        <div class="col-m col-12 content-heading">
                            <h3><?=Language::invokeOutput('heading-sub');?></h3>
                            <p class="section-desc"><?=Language::invokeOutput('desc');?></p>
                        </div>
                        <div class="col-m col-12">
                            <p><?=Language::invokeOutput('cont1');?></p>
                            <span class="URL col-m col-12 en">__YOU_SITE_URL_/application/cron/newsletter</span>
                            <small></small>
                        </div>
                        <div class="col-m col-12 box">
                            <h4><?=Language::invokeOutput('ques');?></h4>
                            <p><?=Language::invokeOutput('cont2');?></p>
                            <a href="#" class="send-btn newsletterTrigger middle" data-token="token=<?=$global['token'];?>"><?=Language::invokeOutput('btn');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i><br />
                            <small><?=Language::invokeOutput('des2');?></small>
                        </div>
                        <div class="col-m col-12 send-result"></div>
                    </div>
                    <!-- ######### -->
                </div>
                <!-- end display -->
                <!-- ###### -->