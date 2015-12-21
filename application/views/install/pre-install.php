<div class="install-page">
    <div class="sub-wrapper">
        <div class="grid-section area">
            <div class="col-m col-12 a-center heading">
                <img src="<?=URL?>img/logo.png" alt="logo" class="x-100">
                <h3>bloodstone community V1 - beta</h3>
            </div>
            <div class="col-m col-12 steps check">
                <div class="col-m col-12">
                    <h2><?=language::invokeOutput('heading');?></h2>
                    <p class="section-desc"><?=language::invokeOutput('desc');?></p>
                </div>
                <div class="col-m col-12 ajax-result final"><img src="<?=URL?>img/loader.gif" alt="loader"></div>
                <form method="POST" class="col-m col-12">
                    <div class="col-m col-12 pre-group">
                        <h4><?=language::invokeOutput('version/heading');?>:</h4>
                        <p><?=language::invokeOutput('version/php');?> <span class="version-rsl"></span></p>
                    </div>
                    <div class="col-m col-12 pre-group">
                        <h4><?=language::invokeOutput('database/heading');?>:</h4>
                        <div class="col-m col-12 ajax-result db"><img src="<?=URL?>img/loader.gif" alt="loader"></div>
                        <div class="col-m col-12 v-middle">
                            <div class="v-col col-2"><?=language::invokeOutput('database/host');?></div>
                            <div class="v-col col-10">
                                <input type="text" name="host" placeholder="<?=language::invokeOutput('database/host');?>" class="col-8">
                            </div>
                        </div>
                        <div class="col-m col-12 v-middle">
                            <div class="v-col col-2"><?=language::invokeOutput('database/dbname');?></div>
                            <div class="v-col col-10">
                                <input type="text" name="db_name" placeholder="<?=language::invokeOutput('database/dbname');?>" class="col-8">
                            </div>
                        </div>
                        <div class="col-m col-12 v-middle">
                            <div class="v-col col-2"><?=language::invokeOutput('database/dbuser');?></div>
                            <div class="v-col col-10">
                                <input type="text" name="db_user" placeholder="<?=language::invokeOutput('database/dbuser');?>" class="col-8">
                            </div>
                        </div>
                        <div class="col-m col-12 v-middle">
                            <div class="v-col col-2"><?=language::invokeOutput('database/dbpass');?></div>
                            <div class="v-col col-10">
                                <input type="text" name="db_pass" placeholder="<?=language::invokeOutput('database/dbpass');?>" class="col-8">
                            </div>
                        </div>
                    </div>
                    <div class="col-m col-12 pre-group">
                        <h4><?=language::invokeOutput('email/heading');?>:</h4>
                        <div class="col-m col-12 ajax-result mail"><img src="<?=URL?>img/loader.gif" alt="loader"></div>
                        <div class="col-m col-12 v-middle">
                            <div class="v-col col-2"><?=language::invokeOutput('email/host');?></div>
                            <div class="v-col col-10">
                                <input type="text" name="smtp_host" placeholder="<?=language::invokeOutput('email/placeholder1');?>" class="col-8">
                            </div>
                        </div>
                        <div class="col-m col-12 v-middle">
                            <div class="v-col col-2"><?=language::invokeOutput('email/port');?></div>
                            <div class="v-col col-10">
                                <input type="text" name="smtp_port" placeholder="<?=language::invokeOutput('email/placeholder2');?>" class="col-8">
                            </div>
                        </div>
                        <div class="col-m col-12 v-middle">
                            <div class="v-col col-2"><?=language::invokeOutput('email/username');?></div>
                            <div class="v-col col-10">
                                <input type="text" name="smtp_user" placeholder="<?=language::invokeOutput('email/placeholder3');?>" class="col-8">
                            </div>
                        </div>
                        <div class="col-m col-12 v-middle">
                            <div class="v-col col-2"><?=language::invokeOutput('email/password');?></div>
                            <div class="v-col col-10">
                                <input type="text" name="smtp_pass" placeholder="<?=language::invokeOutput('email/placeholder4');?>" class="col-8">
                            </div>
                        </div>
                        <div class="col-m col-12 v-middle">
                            <div class="v-col col-2"><?=language::invokeOutput('email/noreply');?></div>
                            <div class="v-col col-10">
                                <input type="text" name="no_reply" placeholder="<?=language::invokeOutput('email/placeholder5');?>" class="col-8">
                            </div>
                        </div>
                    </div>
                    <div class="col-m col-12">
                        <div class="col-m col-2">&nbsp;</div>
                        <div class="col-m col-10">
                            <a href="" class="middle pre-installer"><?=language::invokeOutput('save');?></a>
                            <span class="next hidden-item">
                                 - <a href="install/step1"><?=language::invokeOutput('next');?></a>&nbsp;<i class="icon-<?=DIRECTION?>"></i>
                            </span>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>