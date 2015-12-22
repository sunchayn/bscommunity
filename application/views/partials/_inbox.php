<div class="col-m col-12 msg-model v-middle ticket <?=$class;?>">
    <div class="col-1 v-col">
        <input type="checkbox" class="middle checkboxTickets" name="select[]" value="<?=$message->id;?>" id="msg<?=$message->id;?>">
        <label for="msg<?=$message->id;?>"></label>
    </div>
    <a href="message/<?=$message->id;?>" class="col-11 v-col">
        <div class="col-m col-12 v-middle">
            <div class="col-2 v-col">
                <?php
                if ($message->sender === '0')
                    echo Language::invokeOutput('frequent/administration');
                else
                    echo $message->username;
                ?>
            </div>
            <div class="col-7 v-col">
                <?=$prefix;?>
                <h3 class="inline-b">
                    <?php
                        if (mb_strlen($message->title, 'UTF-8') > 30)
                            echo $message->title = mb_substr($message->title, 0, 30, 'UTF-8') . '...';
                        else
                            echo $message->title;
                    ?>
                </h3>
                <small> -
                    <?php
                        if (mb_strlen($message->content, 'UTF-8') > 70)
                            echo mb_substr($message->content, 0, 50, 'UTF-8') . '...';
                        else
                            echo $message->content;
                    ?>
                </small>
            </div>
            <div class="col-3 v-col a-right left-sm"><?=General::getFormedTime($message->date);?></div>
        </div>
    </a>
</div>