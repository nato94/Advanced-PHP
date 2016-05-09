<?php if ( isset($ErrorMessage) && is_array($ErrorMessage) && count($ErrorMessage) > 0 ) : ?>

<ul>
<?php foreach( $ErrorMessage as $message ) : ?>
    <li class="bg-danger"><?php echo $message; ?> </li>
<?php endforeach; ?>
</ul>
<?php endif; ?>

