<?php if(!empty($message['message'])){ ?>
<div class="alert alert-<?php echo $message['status'] ?>" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>
  <?php echo $message['message']; ?>  
</div>
<?php } ?>
