<div class="page profile profile-threads-page grid-section ">
    <div class="sub-wrapper area">
        <div class="sub-wrapper">
            <?php
                include_once('_header.php');
            ?>
            <div class="col-m col-12">
                <div class="col-m col-12 threads-heading split-rows">
                    <div class="col-m col-6">
                       <?=Language::invokeOutput('threads-p/see'). ' <strong>' . isset_get($data['user'], 'username') . '</strong> ' . Language::invokeOutput('threads-p/threads') . ' ' . isset_get($data, 'forum');?>
                    </div>
                    <div class="col-m col-6"><?=language::invokeOutput('select-forum');?>
                        <a href="#" class="middle" data-id="forums"></a>
                        <select class="page-swapper">
                            <option><?=isset_get($data, 'forum');?></option>
                            <?php
                            foreach ($data['categories'] as $cat)
                            {
                                if (!empty($cat->forums)){
                                    echo '<optgroup label="'. $cat->title .'">';
                                    foreach($cat->forums as $forum)
                                        echo "<option value='profile/threads/{$data['user']->id}?forum={$forum->id}'>{$forum->title}</option>";
                                    echo "</optgroup>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-m col-12 threads-body">
                    <div class="col-m col-12 thread caption v-middle hide-sm">
                        <div class="v-col col-6"><?=Language::invokeOutput('threads-p/title');?></div>
                        <div class="v-col col-2"><?=Language::invokeOutput('threads-p/date');?></div>
                        <div class="v-col col-4"><?=Language::invokeOutput('threads-p/forum');?></div>
                    </div>
                    <?php
                        if (!empty($data['threads']))
                        {
                            foreach($data['threads'] as $thread)
                                include('_thread.php');
                        }else{
                            echo "<div class='col-m col-12 no-data'>" . Language::invokeOutput('threads-p/no-threads') . "</div>";
                        }
                    ?>
                </div>
                <!-- ####### -->
                <!-- # pagination # -->
                <?=isset_get($data, 'pages')?>
                <!-- # pagination # -->
        </div>
    </div><!-- # end sub-wrapper # -->
</div><!-- # end user-page # -->
