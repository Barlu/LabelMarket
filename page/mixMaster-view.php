
<div>
    <?php
    foreach ($mixes as $mix) {
        echo
        '<div class="mixMaster">
            <a href="index.php?page=mixDetail&mixId='.$mix->getId().'"><h3>' . $mix->getName() . '</h3></a>
            <h3>' . $mix->getArtist() . '</h3>
            ' . Utils::createMixcloudLinkMaster($mix->getLink()) . '
        </div>';
    }
    ?>
</div>

