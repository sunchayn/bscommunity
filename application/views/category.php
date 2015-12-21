<div class="page cat-page">
    <div class="sub-wrapper area">
        <div class="grid-section">
            <div class="col-m col-12 cat-heading">
                <div class="col-m col-12 content-heading">
                    <h3><?=$data['category'][$global['curr_title']];?></h3>
                    <p class="section-desc"><?=$data['category'][$global['curr_desc']];?></p>
                </div>
            </div>
            <div class="col-m col-12 split-dashed show-sm"></div>
            <div class="col-m col-12 cat-forums">
                <div class="col-m col-12 hide-md c-caption v-middle">
                    <div class="v-col col-8"><?=Language::invokeOutput('captions/title');?></div>
                    <div class="v-col col-1"><?=Language::invokeOutput('captions/threads');?></div>
                    <div class="v-col col-1"><?=Language::invokeOutput('captions/replies');?></div>
                    <div class="v-col col-2"><?=Language::invokeOutput('captions/options');?></div>
                </div>
                <!-- # cat body # -->
                <div class="col-m col-12 c-body">
                    <?php
                    if (!empty($data['forums']))
                    {
                        foreach($data['forums'] as $forum)
                            include 'partials/_forums.php';
                    }else{
                        echo '<div class="no-data">'. Language::invokeOutput('no-forums') .'</div>';
                    }
                    ?>
                </div>
                <!-- # end cat forums section body # -->
            </div> <!-- # end - cat forums section # -->
        </div>
    </div><!-- # end sub-wrapper # -->
</div><!-- # end cat-page # -->