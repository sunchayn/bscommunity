<div class="page store-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12 store-heading">
                <h2><?=$data['page-title'];?></h2>
                <p><?=Language::invokeOutput('store-desc');?></p>
            </div>
            <!-- end - store heading -->
            <!-- ############### -->
            <div class="col-m col-12">
                <div class="col-m col-6 items-search">
                    <h3><?=Language::invokeOutput('searchHeading');?></h3>
                    <small><?=Language::invokeOutput('searchHint');?></small>
                    <form action="store" method="GET" class="box">
                        <input type="text" name="search" value="<?php if (isset($data['search'])) echo $data['search'];?>" placeholder="<?=Language::invokeOutput('placeholder-store');?>">
                    </form>
                </div>
            </div>
            <!-- ############ -->
            <div class="col-m col-12">
                <div class="col-m col-8 store-pagination">
                    <?=$data['pages'];?>
                </div>
            </div>
            <div class="col-m col-12 store-body">
                <div class="col-m col-12 items-row">
                    <?php
                        if (!empty($data['items']))
                        {
                            $x = 1;
                            $count = count($data['items']);
                            foreach($data['items'] as $item)
                            {
                                include('partials/_items.php');
                                if ($x % 2 == 0 && $x != $count)
                                    echo '</div><div class="col-m col-12 items-row">';
                                $x++;
                            }
                        }else
                            echo '<span class="no-data">'. Language::invokeOutput('no-items') .'</span>';
                    ?>
                </div>
            </div><!-- end - store body -->
            <!-- ############### -->
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>