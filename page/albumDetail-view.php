<div>
    <div class="albumDetail">
        <img src='<?php echo $album->getImage();?>'/>
        <h1><?php echo $album->getName();?></h1>
        <h3><?php echo $album->getGenre();?></h3>
        <p><?php echo $album->getDescription();?></p>
        
        <?php
        if(array_key_exists('role', $_SESSION)){
            if($_SESSION['role'] === 'admin'){
                echo '<a class="edit" href="index.php?page=addEditAlbum&albumId='.$album->getId().'">Edit</a>';
            }
        } 
        ?>
        <div class="clear"></div>
    </div>
    <div class="master">
        <?php
        foreach ($songs as $song){
        echo '
            <div class="songMaster">
                <div class="songLinks">
                    <a href="index.php?page=songDetail&songId='.$song->getId().'"><h4>'.$song->getName().'</h4></a>
                    <h5>'.$song->getArtist().'</h5>
                </div>
                '.Utils::createSoundcloudLinkMaster($song->getLink()).'
            </div>';
        }
        ?>
    </div>
</div>