<?php
if ($mix) {
    ?>
    <div>

        <a href="index.php?page=mixDetail&mixId=<?php echo $mix->getId() ?>"><h3><?php echo $mix->getName() ?></h3></a>
        <h4><?php echo $mix->getArtist() ?></h4>
        <div class="mixDetail">
            <?php echo Utils::createMixcloudLinkDetail($mix->getLink()); ?>
        </div>   
    </div>
    <?php
} else if ($_SESSION['role'] === 'admin') {
    echo '<a href="index.php?page=addEditMix">Upload new mix</a><br/>';
}
if ($albums) {
    ?>
    <div class="master">
        <?php
        if (count($albums !== 0)) {
            for ($i = 0; $i < 3 && $i < count($albums); $i++) {
                echo
                '<div class="albumWrap">
                    <div class="albumLinks">
                        <a href="index.php?page=albumDetail&albumId=' . $albums[$i]->getId() . '"><h3>' . $albums[$i]->getName() . '</h3></a>
                        <p><i>' . $albums[$i]->getGenre() . '</i></p>
                    </div>
                <div class="albumMaster" style="background-image:url(\'' . $albums[$i]->getImage() . '\');"> 
                </div>
            </div>';
            }
        }
        ?>
    </div>
    <?php
} else if ($_SESSION['role'] === 'admin') {
    echo '<a href="index.php?page=addEditAlbum">Upload new album</a>';
}
?>

