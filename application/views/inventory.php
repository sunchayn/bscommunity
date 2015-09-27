<div class="page inventory-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12 content-heading">
                <h2><?=Language::invokeOutput('welcome');?></h2>
                <p class="section-desc"><?=Language::invokeOutput('descInv');?></p>
            </div>
            <div class="col-m col-12 inventory">
                <?php
                    if (!empty($data['items']))
                    {
                        foreach ($data['items'] as $inventory)
                            include('partials/_inventory.php');
                    }else{
                        echo '<div class="no-data">' . Language::invokeOutput('no-items') . '</div>';
                    }
                ?>
            </div>
            <!-- end - inventory core -->
            <!-- ####### -->
            <!-- # pagination # -->
            <?=$data['pages'];?>
            <!-- # pagination # -->
        </div>
    </div>
</div>