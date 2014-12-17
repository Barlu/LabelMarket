<form action='index.php?page=addEditAlbum' method='post' onsubmit='return validateAlbum()'>
    <fieldset>
        <legend>Album</legend>
        <label for='name'>*Name: </label><br/>
        <input type='text' name='name' id='name' onblur='checkEmpty(this.id);' value='<?php echo Utils::escape($album->getName()) ?>'/><br/>
        <div id='nameError'></div>
        <label for='genre'>*Genre: </label><br/>
        <select name="genre" id='genre'>    
            <option >Please select...</option>
            <?php
            foreach ($genreArr as $genre) {
                if ($genre === $album->getGenre()) {
                    echo '<option selected>' . $genre . '</option>';
                } else {
                    echo '<option>' . $genre . '</option>';
                }
            }
            ?>
        </select><br/>
        <div id='genreError'></div>
        <label for='image'>Artwork URL: </label><br/>
        <input type='text' name='image' value='<?php echo Utils::escape($album->getImage()) ?>'/><br/>
        <label for='description'>Description: </label><br/>
        <textarea type='textfield' name='description' rows='10' cols='50'><?php echo Utils::escape($album->getDescription()) ?></textarea><br/>
        <input type='submit' value='Save' name='albumSave'/><input type='submit' value='Delete' name='albumDelete'/>
    </fieldset>

</form>