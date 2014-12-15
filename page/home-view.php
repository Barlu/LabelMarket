
<?php
if ($mix) {
    ?>
    <div>
        <a href="index.php?page=mixMaster&sortBy=mostRecent"><h2>Recent Mixes</h2></a>
        <div class="mixMaster">
            <a href="index.php?page=labelHome&labelId=<?php $label = $labelDao->findById($mix->getLabelId()); echo $label->getId() ?>"><h3><?php echo $label->getName() ?></h3></a>
            <a href="index.php?page=mixDetail&mixId=<?php echo $mix->getId() ?>"><h3><?php echo $mix->getName() ?></h3></a>
            <?php echo Utils::createMixcloudLinkDetail($mix->getLink()); ?>
        </div>
    </div>
<?php } 
if ($albums) { ?>
        <div>
            <a href="index.php?page=albumMaster&sortBy=mostRecent"><h2>Recent Albums</h2></a>
            <?php
            if (count($albums !== 0)) {
                for ($i = 0; $i < 3 && $i < count($albums); $i++) {
                    $label = $labelDao->findById($albums[$i]->getLabelId());
                    echo
                    '
                    <div class="albumMaster">
                    <img src="' . $albums[$i]->getImage() . '"/>
                    <a href="index.php?page=albumDetail&albumId=' . $albums[$i]->getId() . '"><h3>' . $albums[$i]->getName() . '</h3></a>
                    <a href="index.php?page=labelHome&labelId='.$albums[$i]->getLabelId().'"><h3>' .  $label->getName() . '</h3></a>
                    <h4>' . $albums[$i]->getGenre() . '</h4>
                    </div>';
                }
            }
}    ?>
</div>