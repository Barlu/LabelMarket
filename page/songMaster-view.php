<select class="sortBy" onchange="updateQueryString('sortBy', this.options[this.selectedIndex].value);">
    
    <?php 
    foreach ($musicSortByArr as $valueArr){
    
            if(array_key_exists('sortBy', $_GET) && $_GET['sortBy'] === $valueArr[1]){
                echo '<option value="'.$valueArr[1].'" selected>'.$valueArr[0].'</option>';
            }else{
                echo '<option value="'.$valueArr[1].'">'.$valueArr[0].'</option>';
            }
      
} ?>
</select>
<label class="sortBy" for="sortBy">Sort By: </label>
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