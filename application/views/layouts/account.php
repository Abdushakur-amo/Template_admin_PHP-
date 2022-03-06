<?php include 'application/add/top.php'; ?>
<div class="box_load"><div class="loader-box"><div class="loader-7"></div></div></div>
<style>.box_load {position: absolute;top: 0;left: 0;right: 0;bottom: 0;display: flex;align-items: center;justify-content: center;z-index: -1;transition: all 500ms;background: #ffffffcc;opacity: 0;}.box_load.active{z-index: 1001;opacity: 1;}</style>
<?php echo $content; ?>

<?php include 'application/add/footer.php'; ?>
