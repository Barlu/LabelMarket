<div>
    <div>
        <h1><?php echo $album->getName();?></h1>
        <h3><?php echo $album->getGenre();?></h3>
        <p><?php echo $album->getDescription();?></p>
        <img src='<?php echo $album->getImage();?>'/>
        <?php
        if(array_key_exists('role', $_SESSION)){
            if($_SESSION['role'] === 'admin'){
                echo '<a href="index.php?page=addEditAlbum&albumId='.$album->getId().'">Edit</a>';
            }
        } 
        ?>
    </div>
    <div>
        <?php
        foreach ($songs as $song){
        echo '
            <div>
                <a href="index.php?page=songDetail&songId='.$song->getId().'"><h3>'.$song->getName().'</h3></a>
                <h4>'.$song->getArtist().'</h4>'.Utils::createSoundcloudLinkMaster($song->getLink()).'</div>';
        }
        ?>
    </div>
</div>