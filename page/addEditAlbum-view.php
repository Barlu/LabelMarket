<form action='index.php?page=addEditAlbum' method='post'>
    <fieldset>
        <legend>Album</legend>
        <label for='name'>Name: </label><br/>
        <input type='text' name='name' value='<?php echo $album->getName() ?>'/><br/>
        
        <label for='genre'>Genre: </label><br/>
        <select name="genre">    
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
        <label for='image'>Artwork URL: </label><br/>
        <input type='text' name='image' value='<?php echo $album->getImage() ?>'/><br/>
        <label for='description'>Description: </label><br/>
        <textarea type='textfield' name='description' rows='10' cols='50'><?php echo $album->getDescription() ?></textarea><br/>
        <input type='submit' value='Save' name='albumSave'/><input type='submit' value='Delete' name='albumDelete'/>
    </fieldset>

</form>