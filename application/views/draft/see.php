<div class="page draft-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <!-- heading -->
            <div class="col-m col-12">
                <div class="col-m col-12 content-heading">
                    <h2><?=language::invokeOutput('see/header');?></h2>
                    <p class="section-desc"><?=language::invokeOutput('see/desc');?></p>
                </div>
            </div>
            <!-- end heading -->
            <div class="col-m col-12">
                <?php
                echo realpath('../partials/_draft.php');
                if (!empty($data['drafts']))
                {
                    echo '<div class="col-m col-12 notice">' . language::invokeOutput('draft-delay') . '</div>';
                    foreach($data['drafts'] as $draft)
                        include '_draft.php';
                }else
                    echo '<div class="col-m col-12 no-data">'.language::invokeOutput('see/no-draft').'</div>';
                ?>
            </div>
            <div class="col-m col-12 split-dashed show-sm"></div>
            <?=$data['pages'];?>
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>