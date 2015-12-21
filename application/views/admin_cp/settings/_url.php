<div class="col-m col-12 v-middle cf-list-row one-row">
    <div class="col-2 v-col"><?=$url->id;?></div>
    <div class="col-6 v-col"><?=$url->url;?></div>
    <div class="col-4 v-col">
		<?php
			if ((int)$url->is_black === 0)
				echo '<a href="#turnB" class="turnB" data-content="id='.$url->id.'&token='.$global['token'].'">'. language::invokeOutput('turnB') .'</a> - ';
			else
				echo '<a href="#turnW" class="turnW" data-content="id='.$url->id.'&token='.$global['token'].'">'. language::invokeOutput('turnW') .'</a> - ';
		?>
		<a href="#delete" class="deleteURL" data-content="id=<?=$url->id;?>&token=<?=$global['token'];?>"><?=language::invokeOutput('frequent/delete');?></a>
    </div>
</div>