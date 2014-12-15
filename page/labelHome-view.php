<?php 
if($mix){
    ?>
<div>
    <a href="index.php?page=mixMaster&sortBy=mostRecent"><h2>Recent Mixes</h2></a>
    <div class="mixMaster">
        <a href="index.php?page=mixDetail&mixId=<?php echo $mix->getId() ?>"><h3><?php echo $mix->getName() ?></h3></a>
        <h4><?php echo $mix->getArtist() ?></h4>
        <?php echo Utils::createMixcloudLinkDetail($mix->getLink()); ?>
    </div>
</div>
<?php 
} else if($_SESSION['role'] === 'admin'){
    echo '<a href="index.php?page=addEditMix">Upload new mix</a>';
}
if($albums){?>
<div>
    <a href="index.php?page=albumMaster&sortBy=mostRecent"><h2>Recent Albums</h2></a>
    <?php
    if (count($albums !== 0)) {
        for ($i = 0; $i < 3 && $i < count($albums); $i++) {
            echo
            '<div class="albumMaster">
            <a href="index.php?page=albumDetail&albumId=' . $albums[$i]->getId() . '"><h3>' . $albums[$i]->getName() . '</h3></a>
            <h3>' . $albums[$i]->getGenre() . '</h3>
            <img src="' . $albums[$i]->getImage() . '"/>
         </div>';
        }
    }
    ?>
</div>
<?php 
} else if($_SESSION['role'] === 'admin'){
    echo '<a href="index.php?page=addEditAlbum">Upload new album</a>';
}?>

