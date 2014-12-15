
<div>
    <div>
        <h3><?php echo $mix->getName() ?></h3>
        <h4><?php echo $mix->getArtist() ?></h4>
        <?php
        echo Utils::createMixcloudLinkDetail($mix->getLink());
        if (array_key_exists('role', $_SESSION)) {
            if ($_SESSION['role'] === 'admin') {
                echo '<a href="index.php?page=addEditMix&mixId=' . $mix->getId() . '">Edit</a>';
            }
        }
        ?>
    </div>
    <div>
        <p>
<?php echo $mix->getDescription() ?>
        </p>
    </div>
    <div class='commentWrap'>
        <h3>Comments</h3>
        <?php
        if ($comments) {
            foreach ($comments as $comment) {
                echo '<div class="comment">
                <p>' . $comment->getComment() . '</p>
               </div>
        ';
            }
        } else {
            echo '<p>Leave a comment...</p>';
        }
        ?>
        <form action="index.php?page=mixDetail&mixId=<?php echo $mix->getId(); ?>" method="post">
            <input type="text" name="comment"/><input type="submit" name="submit" value="Send"/>
        </form>
    </div>
</div>

