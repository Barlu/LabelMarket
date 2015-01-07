<div class="songDetail">

    <h1><?php echo $song->getName(); ?></h1>
    <a href="index.php?page=albumDetail&albumId=<?php echo $album->getId(); ?>"><h2><?php echo $album->getName(); ?></h2></a>
    <h3><?php echo $song->getGenre(); ?></h3>
    <?php
    echo Utils::createSoundcloudLinkDetail($song->getLink());
    ?>
    <p><?php echo $song->getDescription(); ?></p>
    <?php
    if (array_key_exists('role', $_SESSION)) {
        if ($_SESSION['role'] === 'admin') {
            echo '<a class="edit" href="index.php?page=addEditSong&albumId=' . $song->getAlbumId() . '">Edit</a>';
        }
    }
    ?>
</div>
<div class='commentWrap'>
    <h3>Comments</h3>
    <?php
    if ($comments) {
        for ($i = 0; $i < count($comments); $i++) {
            if ($contacts[$i]->getPortrait()) {
                $portrait = $contacts[$i]->getPortrait();
            } else {
                $portrait = $defaultPortrait;
            }

            echo '
                    <div class="comment">
                        <div class="commentImageWrap">
                            <img src="' . $portrait . '">
                        </div>
                        <p class="commentStamp">' . Utils::convertTimestamp($comments[$i]->getUploadDate()) . '</p>
                        <h5>' . $users[$i]->getUsername() . '</h5>
                        <p>' . $comments[$i]->getComment() . '</p>
                    </div>';
        }
    } else {
        if(array_key_exists('username', $_SESSION)){
        echo '<p>Leave a comment...</p>';
        } else {
            echo '<p>Sign in to leave a comment...</p>';
        }
    }
    if(array_key_exists('username', $_SESSION)){?>
    <form action="index.php?page=songDetail&songId=<?php echo $song->getId(); ?>" method="post">
        <input type="text" name="comment"/><input type="submit" name="submit" value="Send"/>
    </form>
    <?php }?>
</div>

