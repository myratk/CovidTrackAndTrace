<?php
require 'server.php';
global $errors;

if (count($errors) > 0) : ?>
    <div>
        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>
