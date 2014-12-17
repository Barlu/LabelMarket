<form action='index.php?page=addEditMix<?php echo $mixId;?>' method='post' >
    <fieldset>
        <legend>Mix</legend>
    <label for='link'>*Mixcloud Embed Link</label><br/>
    <input type='text' name='link' value='<?php echo Utils::createMixcloudLinkDetail($mix->getLink()); ?>'/><br/>
    <div class="linkError"></div>
    <label for='name'>*Name</label><br/>
    <input type='text' name='name' value='<?php echo $mix->getName(); ?>'/><br/>
    <div class="nameError"></div>
    <label for='artist'>Artist</label><br/>
    <input type='text' name='artist' value='<?php echo $mix->getArtist(); ?>'/><br/>
    <label for='description'>Description</label><br/>
    <textarea name='description' rows="5" cols="50"/><?php echo $mix->getDescription(); ?></textarea><br/>
    <input type='submit' value='Save' name='save'/><?php if($mixId){ ?><input type='submit' value='Delete' name='delete'/><?php } ?>
    </fieldset>
</form>
