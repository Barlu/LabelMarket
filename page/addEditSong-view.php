
<div>
    <h2><?php echo $album->getName() ?></h2>
    <p><?php echo $album->getGenre() ?></p>
    <p><?php echo $album->getDescription() ?></p>
    <a href='index.php?page=addEditAlbum&albumId=<?php echo $_GET['albumId'] ?>'><p>Edit</p></a>
</div>
<fieldset>
<legend>Tracks</legend>
<?php
for ($i = 0; $i < count($songs); $i++) {
    echo "
        <form action='index.php?page=addEditSong&albumId=" . $_GET['albumId'] . "' method='post'>
        <fieldset>
        <legend>".$songs[$i]->getTrackNumber()."</legend>
        <div>
            <label for='name'>Name: </label>
            <input type='text' name='name' value='" . $songs[$i]->getName() . "'/>
            <label for='artist'>Artist: </label>
            <input type='text' name='artist' value='" . $songs[$i]->getArtist() . "'/>
            <label for='trackNumber'>Track Number: </label>
            <input type='text' name='trackNumber' size='3' value='" . $songs[$i]->getTrackNumber() . "'/>
            <label for='description'>Description: </label>
            <input type='textfield' name='description' value='" . $songs[$i]->getDescription() . "'/>
            <label for='link'>Song URL: </label>
            <input type='text' name='link' value='" . Utils::createSoundcloudLinkMaster($songs[$i]->getLink()) . "'/>
            <label for='releaseDate'>Release Date: </label>
            <input type='text' name='releaseDate' value='" . $songs[$i]->getReleaseDate() . "'/>
            <label for='genre'>Genre: </label>
            <select name='genre'>   
                <option >Please select...</option>";
    foreach ($genreArr as $genre) {
            if ($genre === $songs[$i]->getGenre()) {
                echo '<option selected>' . $genre . '</option>';
            } else {
                echo '<option>' . $genre . '</option>';
            }
    }
    echo "
            </select>            
            <input type='hidden' value='" . $songs[$i]->getId() . "' name='songId'/>
            <input type='submit' value='Save' name='saveSong'/><input type='submit' value='Delete' name='deleteSong'/>
        </div>
        </fieldset>
        </form>";
}
?>
<form action='index.php?page=addEditSong&albumId=<?php echo $_GET['albumId'] ?>' method='post'>
    <div>
        <label for='name'>Name: </label>
        <input type='text' name='name'/>
        <label for='artist'>Artist: </label>
        <input type='text' name='artist'/>
        <label for='genre'>Genre: </label>
        <select name='genre'>
            <?php
            foreach ($genreArr as $genre) {
                if ($genre === $album->getGenre()) {
                    echo '<option selected>' . $genre . '</option>';
                } else {
                    echo '<option>' . $genre . '</option>';
                }
            }
            ?>
        </select>
        <label for='trackNumber'>Track Number: </label>
        <input type='text' name='trackNumber' size='3'/>
        
        <label for='link'>Song URL: </label>
        <input type='text' name='link'/>
        <label for='releaseDate'>Release Date: </label>
        <input type='text' name='releaseDate'/>
        
        <label for='description'>Description: </label><br/>
        <textarea name='description' rows='3' cols='50'></textarea><br/>
        <input type='hidden' name='songId'/>
        <input type='submit' value='Save' name='saveSong'/><br/>
        <input type='submit' value='Finish' name='finish'/>
    </div>
    </fieldset>
</form>