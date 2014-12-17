
<form action="index.php?page=profile" method="post"> 
    <fieldset>
        <legend>Personal Details</legend>
        <img id="profileImage" src="<?php echo $portrait ?>"/>
        <div class="inputWrap">
            <label for="username">Username: </label><br/>
            <input type="text" name="username" value="<?php echo Utils::escape($admin->getUsername()); ?>"/><br/>
            <label for="firstName">First Name: </label><br/>
            <input type="text" name="firstName" value="<?php echo Utils::escape($contact->getFirstName()); ?>"/><br/>
            <label for="lastName">Last Name: </label><br/>
            <input type="text" name="lastName" value="<?php echo Utils::escape($contact->getLastName()); ?>"/><br/>
            <label for="email">Email: </label><br/>
            <input type="email" name="email" size='30' value="<?php echo Utils::escape($contact->getEmail()); ?>"/><br/>
            <label for="address">Address: </label><br/>
            <input type="text" name="address" size='30' value="<?php echo Utils::escape($contact->getAddress()); ?>"/><br/>
            <label for="phone">Phone: </label><br/>
            <input type="text" name="international" size="3" value="<?php echo Utils::escape($phoneArr[0]); ?>"/>
            <input type="text" name="area" size="2" value="<?php echo Utils::escape($phoneArr[1]); ?>"/>
            <input type="text" name="phone" size="9" value="<?php echo Utils::escape($phoneArr[2]); ?>"/><br/>
            <label for="portrait">Portrait: </label><br/>
            <input type="text" name="portrait" size='30' value="<?php echo Utils::escape($contact->getPortrait()); ?>"/><br/>
            <a href="index.php?page=changePassword">Change Password</a>
        </div>
    </fieldset>
    <fieldset>
        <legend>Label Details</legend>
        <label for="labelName">Label Name: </label><br/>
        <input type="text" name="labelName" value="<?php echo Utils::escape($label->getName()); ?>"/><br/>
        <label for="email">Email: </label><br/>
        <input type="email" name="labelEmail" size='30' value="<?php echo Utils::escape($label->getEmail()); ?>"/><br/>
        <label for="logo">Logo URL: </label><br/>
        <input type="text" name="logo" size='30' value="<?php echo Utils::escape($label->getLogo()); ?>"/><br/>
        <label for="cover">Cover Image URL: </label><br/>
        <input type="text" name="cover" size='30' value="<?php echo Utils::escape($label->getCover()); ?>"/><br/>
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
        <textarea name="description" rows='10' cols='50'><?php echo Utils::escape($label->getDescription()); ?></textarea><br/>

    </fieldset>
    <input type="submit" name="submit" value="Submit"/>
</form>

