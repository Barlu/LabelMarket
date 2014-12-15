<div>
    <?php
    if($songs){
    foreach ($songs as $song) {
        echo 
        '<div class="songMaster">
            <a href="index.php?page=songDetail&songId='.$song->getId().'"><h3>'.$song->getName().'</h3></a>
            <h3>'.$song->getGenre().'</h3>'.
            Utils::createSoundcloudLinkMaster($song->getLink()).'
        </div>';
    }
    }else{
    echo '<p>No songs yet!</p>';
        if(array_key_exists('role', $_SESSION) && $_SESSION['role'] === 'admin'){
            echo '<p>Click <a href="index.php?page=addEditAlbum">here</a> to add one</p>';
        }
    }
    ?>
    
</div>