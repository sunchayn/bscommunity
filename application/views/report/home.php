<div class="page report-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <!-- heading -->
            <div class="col-m col-12">
                <div class="col-m col-12 content-heading">
                    <h2><?=language::invokeOutput('header');?></h2>
                    <p class="section-desc"><?=language::invokeOutput('desc');?></p>
                </div>
            </div>
            <!-- end heading -->
            <div class="col-m col-12 box">
                <?=Language::invokeOutput('order/sort');?> <a href="report<?=$data['url'];?>order=recent" <?=isset_get($data, 'recent', '');?>><?=Language::invokeOutput('order/recent');?></a> - <a href="report<?=$data['url'];?>order=nor" <?=isset_get($data, 'nor', '');?>><?=Language::invokeOutput('order/nor');?></a>
            </div>
            <div class="col-m col-12 caption hide-sm">
                <div class="col-m col-6"><?=Language::invokeOutput('caption/reported');?></div>
                <div class="col-m col-2"><?=Language::invokeOutput('caption/reports');?></div>
                <div class="col-m col-2"><?=Language::invokeOutput('caption/date');?></div>
                <div class="col-m col-2"><?=Language::invokeOutput('caption/status');?></div>
            </div>
            <div class="col-m col-12 reports">
                <?php
                    if (!empty($data['reports']))
                    {
                        foreach ($data['reports'] as $report)
                            include __DIR__.DIRECTORY_SEPARATOR.'../partials/_report.php';
                    }else{
                        echo '<div class="no-data">'. Language::invokeOutput('no-reports') .'</div>';
                    }
                ?>
            </div>
            <!-- # pagination # -->
            <?=isset_get($data, 'pages');?>
            <!-- # pagination # -->
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>