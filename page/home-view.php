
<?php
if ($mix) {
    ?>

    <a href="index.php?page=mixDetail&mixId=<?php echo $mix->getId() ?>"><h3><?php echo $mix->getName() ?></h3></a>
    <a href="index.php?page=labelHome&labelId=<?php $label = $labelDao->findById($mix->getLabelId());
    echo $label->getId()
    ?>"><h4><?php echo $label->getName() ?></h4></a>
    <?php echo Utils::createMixcloudLinkDetail($mix->getLink()); ?>

    <?php
}
if ($albums) {
    ?>
    <div class='master'>
        <?php
        if (count($albums !== 0)) {
            for ($i = 0; $i < 3 && $i < count($albums); $i++) {
                $label = $labelDao->findById($albums[$i]->getLabelId());
                echo
                '<div class="albumWrap">
                    <div class="albumLinks">
                        <a href="index.php?page=albumDetail&albumId=' . $albums[$i]->getId() . '"><h3>' . $albums[$i]->getName() . '</h3></a>
                        <a href="index.php?page=labelHome&labelId=' . $albums[$i]->getLabelId() . '"><h4>' . $label->getName() . '</h4></a>
                        <p><i>' . $albums[$i]->getGenre() . '</i></p>
                    </div>
                <div class="albumMaster" style="background-image:url(\'' . $albums[$i]->getImage() . '\');"> 
                </div>
                </div>';
            }
        }
    }
    ?>
</div>