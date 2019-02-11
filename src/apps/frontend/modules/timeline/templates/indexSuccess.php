<a href="<?php echo url_for('post') ?>">now!</a>
<?php foreach ($tweets as $tweet): ?>
    <ul>
        <li><?php echo $tweet['body']; ?></li>
    </ul>
<?php endforeach; ?>