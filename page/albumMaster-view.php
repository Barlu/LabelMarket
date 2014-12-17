
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

if ($albums) {
    foreach ($albums as $album) {
        echo
        '<div class="albumWrap">
                    <div class="albumLinks">
                        <a href="index.php?page=albumDetail&albumId=' . $album->getId() . '"><h3>' . $album->getName() . '</h3></a>
                        <p><i>' . $album->getGenre() . '</i></p>
                    </div>
                <div class="albumMaster" style="background-image:url(\'' . $album->getImage() . '\');"> 
                </div>
            </div>';
    }
} else {
    echo '<p>No albums yet!</p>';
    if (array_key_exists('role', $_SESSION) && $_SESSION['role'] === 'admin') {
        echo '<p>Click <a href="index.php?page=addEditAlbum">here</a> to add one</p>';
    }
}
?>
</div>
