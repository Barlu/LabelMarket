
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

