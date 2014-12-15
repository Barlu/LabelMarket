
<div>
    <div>
        <h3><?php echo $mix->getName() ?></h3>
        <h4><?php echo $mix->getArtist() ?></h4>
        <?php echo Utils::createMixcloudLinkDetail($mix->getLink()); ?>
        <a href="index.php?page=addEditMix&mixId=<?php echo $mix->getId();?>">Edit</a>
    </div>
    <div>
        <p>
            <?php echo $mix->getDescription() ?>
        </p>
    </div>
    <div>
        <?php
        if ($comments) {
            foreach ($comments as $comment) {
                echo '<div class="comment">
                <p>' . $comment->getComment() . '</p>
               <div>
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

