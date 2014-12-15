
    <?php
    if($albums){
    foreach ($albums as $album) {
        echo 
        '<div class="albumMaster">
            <a href="index.php?page=albumDetail&albumId='.$album->getId().'"><h3>'.$album->getName().'</h3></a>
            <h3>'.$album->getGenre().'</h3>
            <img src="'.$album->getImage().'"/>
        </div>';
    }
    }else{
        echo '<p>No albums yet!</p>';
        if(array_key_exists('role', $_SESSION) && $_SESSION['role'] === 'admin'){
            echo '<p>Click <a href="index.php?page=addEditAlbum">here</a> to add one</p>';
        }
    }
    ?>
