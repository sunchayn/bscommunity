<!-- end display -->
</div>
<div class="col-m col-12 copyright">
	<p>	
	    <?=language::invokeOutput('copyright/copyright');?>
	    <a href="https://www.facebook.com/Mazn.touati"><?=language::invokeOutput('copyright/name');?></a>.
	</p>
</div>
</div>
</div>
</div>
<!-- ? END Wrapper ? -->
<!-- bloostone community V1 beta -->
<!-- # Javascript Area # -->
<script src="<?=URL;?>js/min/adminReady.js"></script>
<?php
if ( isset_get($global, 'charts') === true )
{
    ?>
    <script src="<?=URL?>vendor/Chart.min.js"></script>
    <script src="<?=URL?>js/min/adminCharts.js"></script>
<?php  }  ?>
<!-- ? END Javascript Area ? -->
</body>
</html>