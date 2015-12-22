<!-- end display -->
</div>
<div class="col-m col-12 copyright">
    <?=language::invokeOutput('copyright/copyright');?>
    <a href="https://www.facebook.com/Mazn.touati"><?=language::invokeOutput('copyright/name');?></a>.
</div>
</div>
</div>
</div>
<!-- ? END Wrapper ? -->
<!-- bloostone community V1 beta -->
<!-- # Javascript Area # -->
<script src="<?=URL?>js/min/basic.js"></script>
<script src="<?=URL?>js/min/admin_cp.min.js"></script>
<?php
if ( isset_get($global, 'charts') === true )
{
    ?>
    <script src="<?=URL?>vendor/Chart.min.js"></script>
    <script src="<?=URL?>js/min/charts_admin.min.js"></script>
<?php  }  ?>
<!-- ? END Javascript Area ? -->
</body>
</html>