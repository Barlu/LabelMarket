
<div>
    <h2><?php echo Utils::escape($album->getName()) ?></h2>
    <p><?php echo Utils::escape($album->getGenre()) ?></p>
    <p><?php echo Utils::escape($album->getDescription()) ?></p>
    <a href='index.php?page=addEditAlbum&albumId=<?php echo Utils::escape($_GET['albumId']) ?>'><p>Edit</p></a>
</div>
<fieldset>
    <legend>Tracks</legend>
    <?php
    for ($i = 0; $i < count($songs); $i++) {
        echo "
        <form action='index.php?page=addEditSong&albumId=" . Utils::escape($_GET['albumId']) . "' method='post' onsubmit='return validateSong(".$songs[$i]->getId().");'>
            <fieldset>
            <legend>" . Utils::escape($songs[$i]->getTrackNumber()) . "</legend>
                <div id='name" . $songs[$i]->getId() . "Error'></div><div id='artist" . $songs[$i]->getId() . "Error'></div><div id='link" . $songs[$i]->getId() . "Error'></div><div id='genre" . $songs[$i]->getId() . "Error'></div>
                <label for='name'>*Name: </label>
                <input type='text' name='name' id='name" . $songs[$i]->getId() . "' onblur='checkEmpty(this.id)' value='" . Utils::escape($songs[$i]->getName()) . "'/>

                <label for='artist'>Artist: </label>
                <input type='text' name='artist' id='artist" . $songs[$i]->getId() . "' onblur='checkEmpty(this.id)' value='" . Utils::escape($songs[$i]->getArtist()) . "'/>

                <label for='trackNumber'>Track Number: </label>
                <input type='text' name='trackNumber' size='3' value='" . Utils::escape($songs[$i]->getTrackNumber()) . "'/>

                <label for='link'>Song URL: </label>
                <input type='text' name='link' id='link" . $songs[$i]->getId() . "' onblur='checkEmpty(this.id)' value='" . Utils::escape(Utils::createSoundcloudLinkMaster($songs[$i]->getLink())) . "'/>

                <label for='releaseDate'>Release Date: </label>
                <input type='text' name='releaseDate' id='link" . $songs[$i]->getId() . "' onblur='checkDate(this.id)' size='10' value='" . Utils::convertTimestampDateOnly($songs[$i]->getReleaseDate()) . "' placeholer='dd/mm/yyyy'/>
                <label for='genre'>Genre: </label>
                <select name='genre' id='genre" . $songs[$i]->getId() . "'>
                    <option >Please select...</option>";
            foreach ($genreArr as $genre) {
                if ($genre === $songs[$i]->getGenre()) {
                    echo '<option selected>' . $genre . '</option>';
                } else {
                    echo '<option>' . $genre . '</option>';
                }
            }
            echo "
                </select><br/>
                <label for='description'>Description: </label><br/>
                <textarea name='description' rows='3' cols='50'>" . Utils::escape($songs[$i]->getDescription()) . "</textarea><br/>
                <input type='hidden' value='" . Utils::escape($songs[$i]->getId()) . "' name='songId'/>
                <input type='submit' value='Save' name='saveSong'/><input type='submit' value='Delete' name='deleteSong' onclick='setDelete()'/>
            </fieldset>
        </form>";
    }
    ?>
    <form action='index.php?page=addEditSong&albumId=<?php echo $_GET['albumId']; ?>' method='post' onsubmit='return validateSong()'>
        <fieldset> 
            <legend>Add Track</legend>
            <div>
                <div id='nameError'></div><div id='artistError'></div><div id='genreError'></div><div id='linkError'></div><div id='releaseDateError'></div>
                <label for='name'>Name: </label>
                <input type='text' name='name' id='name' onblur='checkEmpty(this.id)'/>

                <label for='artist'>Artist: </label>
                <input type='text' name='artist' id='artist' onblur='checkEmpty(this.id)'/>

                <label for='genre'>Genre: </label>
                <select name='genre' id='genre'>
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
                <input type='text' name='trackNumber' size='2'/>
                <label for='link'>Souncloud Embed Link: </label>
                <input type='text' name='link' id='link' onblur='checkEmpty(this.id)'/>
                <label for='releaseDate'>Release Date: </label>
                <input type='text' name='releaseDate' id='releaseDate' size='10' onblur='checkDate(this.id, this.value)' placeholder='dd/mm/yyyy'/>
                <label for='description'>Description: </label><br/>
                <textarea name='description' rows='3' cols='50'></textarea><br/>
                <input type='hidden' name='songId'/>
                <input type='submit' value='Save' name='saveSong'/><br/>
                <input type='submit' value='Finish' name='finish' onclick='setDelete()'/>
            </div>
        </fieldset>
    </form>