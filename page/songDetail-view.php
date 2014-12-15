<div>

    <h1><?php echo $song->getName(); ?></h1>
    <a href="index.php?page=albumDetail&albumId=<?php echo $album->getId(); ?>"><h2><?php echo $album->getName(); ?></h2></a>
    <h3><?php echo $song->getGenre(); ?></h3>
    <?php
    echo Utils::createSoundcloudLinkDetail($song->getLink());
    if (array_key_exists('role', $_SESSION)) {
        if ($_SESSION['role'] === 'admin') {
            echo '<a href="index.php?page=addEditSong&albumId=' . $song->getAlbumId() . '">Edit</a>';
        }
    }
    ?>
    <p><?php echo $song->getDescription(); ?></p>
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
        <form action="index.php?page=songDetail&songId=<?php echo $song->getId(); ?>" method="post">
            <input type="text" name="comment"/><input type="submit" name="submit" value="Send"/>
        </form>
    </div>
</div>
