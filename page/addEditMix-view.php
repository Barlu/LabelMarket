<form action='index.php?page=addEditMix<?php echo $mixId;?>' method='post' onsubmit="return validateMix();" >
    <fieldset>
        <legend>Mix</legend>
    <label for='link'>*Mixcloud Embed Link</label><br/>
    <input type='text' name='link' id='link' onblur='checkEmpty(this.id)' value='<?php echo Utils::escape(Utils::createMixcloudLinkDetail($mix->getLink())); ?>'/><br/>
    <div id="linkError"></div>
    <label for='name'>*Name</label><br/>
    <input type='text' name='name' id='name' onblur='checkEmpty(this.id)' value='<?php echo Utils::escape($mix->getName()); ?>'/><br/>
    <div id="nameError"></div>
    <label for='artist'>Artist</label><br/>
    <input type='text' name='artist' value='<?php echo Utils::escape($mix->getArtist()); ?>'/><br/>
    <label for='description'>Description</label><br/>
    <textarea name='description' rows="5" cols="50"/><?php echo Utils::escape($mix->getDescription()); ?></textarea><br/>
    <input type='submit' value='Save' name='save'/><?php if($mixId){ ?><input type='submit' value='Delete' name='delete'/><?php } ?>
    </fieldset>
</form>
