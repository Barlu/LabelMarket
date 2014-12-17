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
    foreach ($mixes as $mix) {
        echo
        '<div class="mixMaster">
            <div class="mixLinks">
            <a href="index.php?page=mixDetail&mixId='.$mix->getId().'"><h4>' . $mix->getName() . '</h4></a>
            <h5>' . $mix->getArtist() . '</h5>
            </div>
            ' . Utils::createMixcloudLinkMaster($mix->getLink()) . '
        </div>';
    }
    ?>
</div>

