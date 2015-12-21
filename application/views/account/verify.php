<div class="page acount-mg-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12 content-heading">
                <h2><?=language::invokeOutput('verify/heading');?></h2>
                <p class="section-desc"><?=language::invokeOutput('verify/desc');?></p>
            </div>
            <div class="col-m col-12 box ver-result">
                <div class="col-m col-2"><?=language::invokeOutput('verify/result');?></div>
                <div class="col-m col-10">
                    <?php
                        if ($data['result'])
                            echo '<span class="color-7">'. language::invokeOutput('verify/ver-succ') .'</span>';
                        else
                            echo '<span class="color-6">'. language::invokeOutput('verify/ver-fail') .'</span>';
                    ?>
                </div>
            </div>
            <div class="col-m col-12 box">
                <h4 class="color-6"><strong><?=language::invokeOutput('verify/prob-heading');?></strong></h4>
                <a href="account/resend/<?=$data['id'];?>"><?=language::invokeOutput('verify/prob-resend');?></a> - 
                <a href="support"><?=language::invokeOutput('verify/prob-supp');?></a>
            </div>
        </div><!-- end - parent grid-section -->
    </div><!-- end - sub-wrapper -->
</div>