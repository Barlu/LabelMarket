        <?php
        if(strlen($error) !== 0){
        echo '
            <div>'.$error.'</div>';
        }?>
        <form action="index.php?page=registration" method="post"> 
            <div class='formWrap'>
            <fieldset>
                <legend>Admin Details</legend>
                <label for="firstName">First Name: </label><br/>
                <input type="text" name="firstName" value="<?php echo $contact->getFirstName();?>"/><br/>
                <label for="lastName">Last Name: </label><br/>
                <input type="text" name="lastName" value="<?php echo $contact->getLastName();?>"/><br/>
                <label for="email">Email: </label><br/>
                <input type="email" name="email" value="<?php echo $contact->getEmail();?>"/><br/>
                <label for="username">Username: </label><br/>
                <input type="text" name="username" value="<?php echo $admin->getUsername();?>"/><br/>
                <label for="password">Password: </label><br/>
                <input type="password" name="password"/><br/>
                <label for="passwordRepeat">Confirm Password: </label><br/>
                <input type="password" name="passwordRepeat"/><br/>
                <label for="portrait">Portrait: </label><br/>
                <input type="text" name="portrait" value="<?php echo $contact->getPortrait();?>"/>
            </fieldset>
            <fieldset>
                <legend>Label Details</legend>
                <label for="labelName">Label Name: </label><br/>
                <input type="text" name="labelName" value="<?php echo $label->getName();?>"/><br/>
                <label for="email">Email: </label><br/>
                <input type="email" name="labelEmail" value="<?php echo $label->getEmail();?>"/><br/>
                <label for="logo">Logo URL: </label><br/>
                <input type="text" name="logo" value="<?php echo $label->getLogo();?>"/><br/>
                <label for="cover">Cover Image URL: </label><br/>
                <input type="text" name="cover" value="<?php echo $label->getCover();?>"/><br/>
                <label for='genre'>Genre: </label><br/>
                <select name='genre'>
                    <?php
                    foreach ($genreArr as $genre) {
                        if ($genre === $label->getGenre()) {
                            echo '<option selected>' . $genre . '</option>';
                        } else {
                            echo '<option>' . $genre . '</option>';
                        }
                    }
                    ?>
                </select><br/>
                <label for="country">Country: </label><br/>
                <select name="country">
                    <option value="">Please select...</option>
                    <?php
                    foreach ($countryList as $country) {
                        if ($country === $label->getCountry()) {
                            echo '<option selected>' . $country . '</option>';
                        } else {
                            echo '<option>' . $country . '</option>';
                        }
                    }
                    ?>
                </select><br/>
                <label for="description">Description: </label><br/>
                <textarea name="description" rows='10' cols='50'><?php echo $label->getDescription();?></textarea><br/>
                
            </fieldset>
                
            <input type="submit" name="submit" value="Submit"/>
            </div>
        </form>


<!--<label for="phone">Phone: </label><br/>
                <input type="text" name="international" size="3"/>
                <input type="text" name="area" size="2"/>
                <input type="text" name="phone" size="9"/><br/>-->