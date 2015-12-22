<div class="page cat-page">
    <div class="sub-wrapper area">
        <div class="grid-section">
            <div class="col-m col-12 cat-heading">
                <div class="col-m col-12 content-heading">
                    <h2><?=isset_get($data['category'], 'title');?></h2>
                    <p class="section-desc"><?=isset_get($data['category'], 'desc');?></p>
                </div>
            </div>
            <div class="col-m col-12 split-dashed show-sm"></div>
            <div class="col-m col-12 cat-forums">
                <div class="col-m col-12 hide-md c-caption">
                    <div class="col-m col-8"><?=Language::invokeOutput('captions/title');?></div>
                    <div class="col-m col-1"><?=Language::invokeOutput('captions/threads');?></div>
                    <div class="col-m col-1"><?=Language::invokeOutput('captions/replies');?></div>
                    <div class="col-m col-2"><?=Language::invokeOutput('captions/options');?></div>
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