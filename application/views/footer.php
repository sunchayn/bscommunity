    <!-- footer -->
    <div id="spliter"></div>
    <footer>
        <div class="level1 sub-wrapper">
            <div class="grid-section">
                <div class="col-m col-12 heading">
                    <h2 class="inline-b">
                        <img src="<?=isset_get($global, 'logo_url');?>" alt="logo" height="50" width="50" class="middle">&nbsp;
                        <bdo dir="auto"><?=isset_get($global, 'site_name');?></bdo>
                        <small>, <?=isset_get($global, 'site_tag');?></small>
                    </h2>
                </div>
                <div class="col-m col-12">
                    <div class="col-m col-5">
                        <div class="col-m col-12">
                            <h3><?=Language::invokeOutput('footer/follow');?></h3>
                            <div class="social-links box">
                                <a target="_blanc" href="http://www.facebook.com/<?=isset_get($global['social'], 'facebook', '');?>" id="facebook" class="icon-facebook social-circle"></a>
                                <a target="_blanc" href="http://www.twitter.com/<?=isset_get($global['social'], 'twitter', '');?>" id="twitter" class="icon-twitter social-circle"></a>
                                <a target="_blanc" href="http://www.youtube.com/<?=isset_get($global['social'], 'youtube', '');?>" id="youtube" class="icon-youtube social-circle"></a>
                            </div>
                        </div>
                        <div class="col-m col-12">
                            <a href="#select-country" class="disabled"><?=Language::invokeOutput('footer/country');?></a> /
                            <a href="#select-language" class="triggerPanel" data-panel="language-sel"><?=Language::invokeOutput('footer/language');?></a>
                            <div class="panel language-selector" id="language-sel">
                                <div class="panel-head">
                                    <a href="#" class="icon-cancel cancel f-right"></a>
                                    <div class="clear"></div>
                                </div>
                                <div class="panel-content grid-section">
                                    <div class="col-m col-12 langs">
                                        <a href="?lang=ar" class="col-6 scale-sm"><?=language::invokeOutput('lang/ar');?></a>
                                        <a href="?lang=en" class="col-6 scale-sm"><?=language::invokeOutput('lang/en');?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-m col-12 letter-sub">
                            <form action="ajax/subscribe" class="ajaxModal" method="POST">
                                <h3><?=Language::invokeOutput('footer/subscribe');?></h3>
                                <p><?=Language::invokeOutput('footer/subscribe-desc');?></p>
                                <div class="col-m col-12">
                                    <div class="col-m col-12 inner-button-field no-margin lettre-sub-field">
                                        <input type="text" name="email" placeholder="<?=Language::invokeOutput('input-placeholder/email');?>" class="col-m inner-field full-md col-9" />
                                        <a href="#subscribe" class="btn btn-color2 col-m a-center formSubmit full-md col-3"><?=Language::invokeOutput('footer/subscribe-btn');?></a>
                                    </div>
                                </div>
                                <input type="hidden" name="token" value="<?=$global['token'];?>">
                            </form>
                        </div>
                    </div>
                    <div class="col-m col-12 split-dashed show-sm"></div>
                    <div class="col-m col-7">
                        <div class="col-m col-5 scale-sm">
                            <h3><?=Language::invokeOutput('footer/helpSupport');?></h3>
                            <ul>
                                <li><i class="icon-angle-<?=DIRECTION;?>"></i>&nbsp;<a href="FAQ"><?=Language::invokeOutput('footer/help-menu/FAQ');?></a></li>
                                <li><i class="icon-angle-<?=DIRECTION;?>"></i>&nbsp;<a href="term"><?=Language::invokeOutput('footer/help-menu/term');?></a></li>
                                <li><i class="icon-angle-<?=DIRECTION;?>"></i>&nbsp;<a href="support"><?=Language::invokeOutput('footer/help-menu/help');?></a></li>
                                <div class="clear"></div>
                            </ul>
                        </div>
                        <div class="col-m col-12 split-dashed show-sm"></div>
                        <div class="col-m col-7 scale-sm">
                            <h3><?=Language::invokeOutput('footer/about');?></h3>
                            <p><?=isset_get($global, 'site_desc');?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- # copyright area # -->
        <div class="copyright grid-section">
            <div class="sub-wrapper">
                <div class="col-m col-12 v-middle">
                    <span class="v-col col-10">
                        <?=language::invokeOutput('copyright/copyright');?> <a href="https://www.facebook.com/Mazn.touati"><?=language::invokeOutput('copyright/name');?></a>.
                    </span>
                    <span class="v-col col-2 a-right md">
                        <a href="https://www.facebook.com/MazenDesignes" class="inline-b"><img src="<?=URL?>img/mazendesigns-logo.png" alt="mazen designs logo" height="25" width="40" class="inline-b"></a>
                    </span>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
        <div class="scroll-up hide-sm"><i class="icon-angle-up"></i></div>
        <div class="scroll-up-res"><i class="icon-angle-up"></i></div>
        <div class="confirm-modal" id="create-link">
            <div class="cf-modal-content"></div>
            <div class="modal-buttons grid-section">
                <a href="#confirm" class="c-confirm"><?=language::invokeOutput('frequent/confirm');?></a>
                <a href="#cancel" class="c-cancel"><?=language::invokeOutput('frequent/cancel');?></a>
                <div class="clear"></div>
            </div>
        </div>
        <div class="result-modal"></div>
    </footer>
    <!-- # end footer # -->
    </div>
    <!-- √ END Wrapper √ -->
    <!-- bloostone community V1 beta -->
    <!-- # Javascript Area # -->
    <script src="<?=URL?>js/min/globalReady.js"></script>
    <?php
    if ( isset_get($global, 'addEditor') === true )
    {
        ?>
        <script src="<?=URL;?>public/vendor/ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'bseContentHolder', {
                language: <?=' \' '.LANGUAGE_CODE.' \' ';?>
            });
            $("#submit-editor").on("click", function(e){
                e.preventDefault();
                var content = CKEDITOR.instances.bseContentHolder.getData();
                $("#bseContentHolder").html(content);
                $('form.editor').submit();
            });
        </script>
    <?php }
        if ( isset_get($global, 'charts') === true )
        {
            ?>
            <script src="<?=URL?>vendor/Chart.min.js"></script>
            <script src="<?=URL?>js/charts.js"></script>
    <?php  }

        if ( isset_get($global, 'draftVariable') === true)
        {
            if (isset_get($global, 'addEditor') === true)
                echo '<script>var isThread = true;</script>';
            ?>
            <script src="<?=URL?>js/min/draft.js"></script>
    <?php  }  ?>
    <!-- √ END Javascript Area √ -->
</body>
</html>
