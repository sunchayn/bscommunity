<!-- # forum area # -->
<div class="page forum-page">
    <div class="sub-wrapper area">
        <div class="grid-section">
            <div class="col-m col-12">
                <div class="col-m col-12 forum-heading">
                    <p>
                        <?=Language::invokeOutput('rule/part-one').
                        " <a href='rules/". $data['forum']->id ."'>". Language::invokeOutput('rule/part-two') ."</a> "
                        .Language::invokeOutput('rule/part-three');?>
                    </p>
                </div>
                <div class="col-m col-12 forum-title v-middle">
                    <div class="v-col">
                        <img src="<?=isset_get($data['forum'], 'logo');?>" alt="logo" class="middle f-left x-50">
                    </div>
                    <div class="v-col no-margin">
                        <h3><?=$data['forum']->$global['curr_title'];?></h3>
                        <small><?=$data['forum']->$global['curr_desc'];?></small>
                    </div>
                </div>
                <!-- pagination -->
                <div class="col-m col-12 v-middle pagination box">
                    <div class="col-3 v-col">
                        <?php
                        if ($data['forum']->status == 0)
                            echo '<i class="icon-lock-1">&nbsp;</i>'.Language::invokeOutput('closed-forum');
                        else
                            echo '<i class="icon-doc-inv">&nbsp;</i><a href="create/thread/'.$data['forum']->id.'">'.Language::invokeOutput('new-thread').'</a>';
                        ?>
                    </div>
                    <div class="col-6 v-col a-center margin">
                        <?=Language::invokeOutput('order/sort');?>
                        <a href="forum/<?=$data['forum']->id;?>/?order=recent" <?=isset_get($data, 'recent', '');?>>
                            <?=Language::invokeOutput('order/recent');?>
                        </a> -
                        <a href="forum/<?=$data['forum']->id;?>/?order=active" <?=isset_get($data, 'active', '');?>>
                            <?=Language::invokeOutput('order/active');?>
                        </a> -
                        <a href="forum/<?=$data['forum']->id;?>/?order=popular" <?=isset_get($data, 'popular', '');?>>
                            <?=Language::invokeOutput('order/popular');?>
                        </a>
                    </div>
                    <div class="v-col col-3 a-right">
                        <select class="page-swapper" id="">
                            <option><?=Language::invokeOutput('forum-swapper');?></option>
                            <?php
                            foreach ($data['categories'] as $cat)
                            {
                                if (!empty($cat->forums)){
                                    echo '<optgroup label="'. $cat->$global['curr_title'] .'">';
                                    foreach($cat->forums as $forum)
                                        echo "<option value='forum/{$forum->id}'>{$forum->$global['curr_title']}</option>";
                                    echo "</optgroup>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!-- end - pagination -->
                <!-- ########## -->
                <div class="col-m col-12 caption v-middle hide-sm">
                    <div class="v-col col-6"><?=Language::invokeOutput('caption/title');?></div>
                    <div class="v-col col-1"><?=Language::invokeOutput('caption/replies');?></div>
                    <div class="v-col col-1"><?=Language::invokeOutput('caption/views');?></div>
                    <div class="v-col col-2"><?=Language::invokeOutput('caption/date');?></div>
                    <div class="v-col col-2"><?=Language::invokeOutput('caption/operation');?></div>
                </div>
                <!-- # show threads area # -->
                <div class="col-m col-12 body">
                    <?php if (!empty($data['pinned'])){ ?>
                        <div class="col-m col-12 pinned">
                            <?php
                            foreach($data['pinned'] as $thread)
                                include 'partials/_pinned.php';
                            ?>
                        </div>
                    <?php }
                    //end show pinned threads
                    if (!empty($data['threads']))
                    {
                        foreach($data['threads'] as $thread)
                            include 'partials/_unpinned.php';
                    } else {
                        echo "<div class='col-m col-12 no-data'>" . Language::invokeOutput('no-threads') . "</div>";
                    }
                ?>
                </div>
                <!-- # end - show threads area # -->
                <!-- ####### -->
                <!-- # pagination # -->
                <?=isset_get($data, 'pages')?>
                <!-- # pagination # -->
            </div>
        </div>
    </div><!-- # end sub-wrapper # -->
</div>
<!-- # end forum area # -->