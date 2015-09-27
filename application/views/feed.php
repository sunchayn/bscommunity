<div class="page feed-page">
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
            <div class="col-m col-12 feed-body">
                <?php
                if (!empty($data['following']))
                {
                    foreach($data['following'] as $following)
                        include 'partials/_feed.php';
                }else
                    echo '<div class="col-m col-12 no-data">'.language::invokeOutput('no-feed').'</div>';
                ?>
            </div>
            <div class="col-m col-12 split-dashed show-sm"></div>
            <?=$data['pages'];?>
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>