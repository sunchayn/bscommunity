<div class="page report-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <!-- heading -->
            <div class="col-m col-12">
                <div class="col-m col-12 content-heading">
                    <h2><?=language::invokeOutput('view/header');?></h2>
                    <p class="section-desc"><?=language::invokeOutput('view/desc');?></p>
                </div>
            </div>
            <!-- end heading -->
            <div class="col-m col-12 box">
                <i class="icon-left"></i>&nbsp;<a href="report"><?=language::invokeOutput('back-to');?></a>
            </div>
            <div class="col-m col-12 box reported-item">
                <small class="col-m col-12"><?=Language::invokeOutput('view/hint');?></small>
                <div class="col-m col-12 box">
                    <span class="color-5">[<?=($data['report']->type == 0) ? Language::invokeOutput('thread') :  Language::invokeOutput('reply') ;?>] </span>
                    <h3 class="inline-b"><a href="thread/<?=$data['reported']->TID;?>"><?=$data['reported']->title;?></a></h3>
                    <p><?=strip_tags($data['reported']->content);?></p>
                    <?php
                        if ($data['report']->type == 1)
                            echo '<small><a href="reply/'. $data['report']->reported .'">' . language::invokeOutput('show-reply') . '</a></small>';
                    ?>
                </div>
            </div>
            <div class="col-m col-12 box">
                <h4><?=language::invokeOutput('reports');?></h4>
            </div>
            <div class="col-m col-12 reports">
                <?php
                foreach ($data['reports'] as $report)
                    include '_report.php';
                ?>
            </div>
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>