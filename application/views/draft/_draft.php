<!-- draft modal -->
<div class="col-m col-12 draft-modal center-sm">

    <h3>
    	<a href="draft/threads/<?=$draft->id;?>">
		<?php
	        if (!isset($draft->title[1]))
	            echo '<small>[ '.language::invokeOutput('frequent/unset').' ]</small>';
	        else
	            echo $draft->title;
		?>
		</a>
    </h3>
    <p>
        <?php
            if (!isset($draft->content[1]))
                echo '<small>[ '.language::invokeOutput('frequent/unset').' ]</small>';
            else
                echo trim(strip_tags($draft->content));
        ?>
    </p>
    <small><?=Language::invokeOutput('see/created').' '.$draft->date;?></small><br />
    <small><a href="#deletDraft" class="deleteDraft" data-content="id=<?=$draft->id;?>&token=<?=$global['token'];?>"><?=language::invokeOutput('see/delete');?></a></small>
</div>
<!-- end - draft modal -->