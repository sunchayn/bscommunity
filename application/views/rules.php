<div class="page rules-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12">
                <h3><?=$data['forum']->$global['curr_title'];?> :</h3>
                <p class="section-desc"><?=$data['forum']->$global['curr_desc'];?></p>
            </div>
            <div class="col-m col-12">
                <?php
                    if (!empty($data['rules']))
                    {
                        $x = 1;
                        foreach($data['rules'] as $rule)
                            include 'partials/_rule.php';
                    }else
                        echo '<div class="no-data">' . language::invokeOutput('no-rules') . '</div>';
                ?>
            </div>
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>