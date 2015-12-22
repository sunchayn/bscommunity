<div class="page acount-mg-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12 content-heading">
                <h2><?=language::invokeOutput('resend/heading');?></h2>
                <p class="section-desc"><?=language::invokeOutput('resend/desc');?></p>
            </div>
            <div class="col-m col-12 box ver-result">
                <div class="col-m col-2"><?=language::invokeOutput('resend/result');?></div>
                <div class="col-m col-10">
                    <?php
                        if ($data['result'] === false)
                            echo '<span class="color-6">'. language::invokeOutput('resend/resend-fail') .'</span>';
                        else
                            echo '<span class="color-7">'. language::invokeOutput('resend/resend-succ') .'</span>' . ' <strong>'. $data['result']['username'] .'</strong>';
                    ?>
                </div>
            </div>
            <div class="col-m col-12 box">
                <h4 class="color-6"><strong><?=language::invokeOutput('verify/prob-heading');?></strong></h4>
                <a href="support"><?=language::invokeOutput('verify/prob-supp');?></a>
            </div>
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>