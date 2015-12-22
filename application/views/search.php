<div class="page search-page">
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
                <form action="search" method="get">
                    <input type="text" name="q" value="<?=isset_get($data, 'search', '');?>" placeholder="<?=language::invokeOutput('input-search');?>" class="full-6 rad2">
                    <a href="#submit" class="formSubmit"><?=language::invokeOutput('search-submit');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                </form>
            </div>
            <!-- end - search field -->
            <!-- ############ -->
            <!-- # pagination # -->
            <div class="col-m col-12 box"><?=isset_get($data, 'pages', '')?></div>
            <!-- # pagination # -->
            <!-- ########## -->
            <!-- members list -->
            <div class="col-m col-12 search-result">
                <!-- members row -->
                <div class="col-m col-12 members-row">
                    <?php
                        if ($data['results'] === false)
                        {
                            echo '<div class="search-hint">'. Language::invokeOutput('search-hint') .'</div>';
                        }else {
                            echo '<div class="col-m col-12 search-member"><a href="members?search='. $data['search'] .'">'. Language::invokeOutput('member-result') .'</a></div>';
                            if (empty($data['results'])) {
                                echo '<div class="no-data">' . Language::invokeOutput('no-result') . '</div>';
                            } else {
                                foreach ($data['results'] as $result)
                                    include 'partials/_search.php';
                            }
                        }
                    ?>
                </div>
            </div>
            <!-- members list -->
            <!-- ########### -->
            <!-- # pagination # -->
            <?=isset_get($data, 'pages', '');?>
            <!-- # pagination # -->
            <!-- ########## -->
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>