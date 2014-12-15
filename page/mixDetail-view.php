
<div>
    <div>
        <h3><?php echo $mix->getName() ?></h3>
        <h4><?php echo $mix->getArtist() ?></h4>
        <?php echo Utils::createMixcloudLinkDetail($mix->getLink()); ?>
        <a href="index.php?page=addEditMix&mixId=<?php echo $mix->getId();?>">Edit</a>
    </div>
    <div>
        <p>
            <?php echo $mix->getDescription() ?>
        </p>
    </div>
</div>

