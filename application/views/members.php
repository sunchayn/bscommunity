<div class="page members-page">
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
            <div class="col-m col-12 box v-middle">
                <div class="col-2 v-col"><?=language::invokeOutput('search');?></div>
                <div class="col-10 v-col member-search center-sm">
                    <form action="members" method="get">
                        <input type="text" name="search" value="<?=isset_get($data, 'search', '');?>" placeholder="<?=language::invokeOutput('input-place');?>" class="full-6 rad2">
                        <a href="#submit" class="formSubmit"><?=language::invokeOutput('submit-input');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                    </form>
                </div>
            </div>
            <!-- end - search field -->
            <!-- ########## -->
            <!-- members list -->
            <div class="col-m col-12 members-list">
                <!-- members row -->
                <div class="col-m col-12 members-row">
                <?php
                if (!empty($data['users']))
                {
                    $x = 0;
                    $count = count($data['users']);
                    foreach($data['users'] as $user)
                    {
                        include('partials/_member.php');
                        //var_dump($x);
                        if (++$x % 3 == 0 && $x != $count)
                            echo '</div><div class="col-m col-12 members-row">';
                    }
                }else{
                    echo '<div class="no-data">' . Language::invokeOutput('no-users') . '</div>';
                }
                ?>
                </div>
            </div>
            <!-- members list -->
            <!-- ########### -->
            <!-- # pagination # -->
            <?=isset_get($data, 'pages');?>
            <!-- # pagination # -->
            <!-- ########## -->
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>