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
                                <a href="http://www.facebook.com/<?=isset_get($data, 'facebook', '');?>" id="facebook" class="social-circle"><i class="icon-facebook"></i></a>
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
                                        <a href="?lang=ar"><?=language::invokeOutput('lang/ar');?></a>
                                        <a href="?lang=en"><?=language::invokeOutput('lang/en');?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-m col-12 letter-sub">
                            <h3><?=Language::invokeOutput('footer/subscribe');?></h3>
                            <p><?=Language::invokeOutput('footer/subscribe-desc');?></p>
                            <div class="col-m col-12 v-middle">
                                <div class="col-12 v-col inner-button-field no-margin lettre-sub-field">
                                    <input type="text" placeholder="<?=Language::invokeOutput('input-placeholder/email');?>" class="f-left inner-field full-md" />
                                    <a href="#soon" class="f-left btn btn-color2 a-center disabled full-md"><?=Language::invokeOutput('footer/subscribe-btn');?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-m col-12 split-dashed show-sm"></div>
                    <div class="col-m col-3">
                        <h3><?=Language::invokeOutput('footer/helpSupport');?></h3>
                        <ul>
                            <li><i class="icon-angle-<?=DIRECTION;?>"></i>&nbsp;<a href="FAQ"><?=Language::invokeOutput('footer/help-menu/FAQ');?></a></li>
                            <li><i class="icon-angle-<?=DIRECTION;?>"></i>&nbsp;<a href="term"><?=Language::invokeOutput('footer/help-menu/term');?></a></li>
                            <li><i class="icon-angle-<?=DIRECTION;?>"></i>&nbsp;<a href="support"><?=Language::invokeOutput('footer/help-menu/help');?></a></li>
                            <div class="clear"></div>
                        </ul>
                    </div>
                    <div class="col-m col-12 split-dashed show-sm"></div>
                    <div class="col-m col-3">
                        <h3><?=Language::invokeOutput('footer/about');?></h3>
                        <p><?=isset_get($global, 'site_desc');?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- # copyright area # -->
        <div class="copyright grid-section">
            <div class="sub-wrapper">
                <div class="col-m col-12 v-middle">
                    <span class="v-col col-10">
                        <?=language::invokeOutput('copyright/copyright');?><a href="https://www.facebook.com/Mazn.touati"><?=language::invokeOutput('copyright/name');?></a>.
                    </span>
                    <span class="v-col col-2 a-right">
                        <a href="https://www.facebook.com/MazenDesignes"><img src="<?=URL?>img/mazendesigns-logo.png" alt="mazen designs logo" height="25" width="40"></a>
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
    <script src="<?=URL?>js/min/all.js"></script>
    <?php
    if ( isset_get($global, 'addEditor') === true )
    {
        ?>
        <script src="<?=URL?>js/editor.js"></script>
        <script>
            $("#bseContentHolder").jqte({outdent: false, indent: false, ol: false, remove: false, source: false});
            $("#submit-editor").on("click", function(){
                var content = $("#bseContentHolder").getValue();
                $("#bseContentHolder").val(content);
            });
        </script>
    <?php }
        if ( isset_get($global, 'charts') === true )
        {
            ?>
            <script src="<?=URL?>vendor/Chart.min.js"></script>
            <script src="<?=URL?>js/charts.js"></script>
    <?php  }  ?>
    <!-- √ END Javascript Area √ -->
</body>
</html>