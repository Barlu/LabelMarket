<div class="master">
    <?php
    if($songs){
    foreach ($songs as $song) {
        echo 
        '<div class="songMaster">
            <div class="songLinks">
<a href="index.php?page=songDetail&songId='.$song->getId().'"><h4>'.$song->getName().'</h4></a>
            <h5>'.$song->getGenre().'</h5>
            </div>'.
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