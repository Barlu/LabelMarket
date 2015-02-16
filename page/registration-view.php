<?php
if (strlen($error) !== 0) {
    echo '
            <div>' . $error . '</div>';
}
?>
<div class='container-fluid'>
    <form id='form' action="index.php?page=registration" method="post" onSubmit="return validateRegistration()"> 

        <fieldset>
            <legend>Admin Details</legend>

<!--            <div class='form-group col-xs-6'>
                <label for="firstName" class="control-label sr-only">First Name:</label>
                <input type="text" name="firstName" class="form-control input-lg" value="<?php echo Utils::escape($contact->getFirstName()); ?>" placeholder="First Name"/>
            </div>
            <div class='form-group col-xs-6'>

                <label for="lastName" class="control-label sr-only">Last Name:</label>
                <input type="text" name="lastName" class="form-control input-lg" value="<?php echo Utils::escape($contact->getLastName()); ?>" placeholder="Last Name"/>

            </div>-->

            <div class="form-group col-xs-12 has-feedback">
                <label for="username" class="control-label sr-only">Username:</label>
                <input type="text" name="username" id="username" class="form-control input-lg" onblur="Validator.element(this)" value="<?php echo Utils::escape($admin->getUsername()); ?>" placeholder="Username" data-toggle="tooltip"/>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
            <div class="form-group col-xs-12 has-feedback">
                <label for="email" class="control-label sr-only">Email:</label>
                <input type="email" name="email" id="email" class="form-control input-lg" onblur="Validator.element(this)" value="<?php echo Utils::escape($contact->getEmail()); ?>" placeholder="Email" data-toggle="tooltip"/>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group col-xs-6 has-feedback">
                <label for="password" class="control-label sr-only">Password: </label>
                <input type="password" name="password" id="password" class="form-control input-lg" onblur="Validator.element(this)" placeholder="Password" data-toggle="tooltip"/>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
            <div class="form-group col-xs-6 has-feedback">
                <label for="passwordRepeat" class="control-label sr-only">Confirm Password: </label>
                <input type="password" name="passwordRepeat" id="passwordRepeat" class="form-control input-lg" onblur="Validator.element(this)" placeholder="Confirm Password" data-toggle="tooltip"/>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
            <div class="form-group col-xs-12 text-right ">
                <label> Is this account for a label?&nbsp;&nbsp;</label>
                <input type="checkbox" id="labelAccount"> 
            </div>

            <!--            <div class="form-group">
                            <label for="portrait" class="control-label col-xs-3">Portrait: </label>
                            <input type="file" name="portrait" value="<?php echo Utils::escape($contact->getPortrait()); ?>"/>
                        </div>-->
        </fieldset>
        <fieldset>
            <legend>Label Details</legend>
            <div class="form-group col-xs-12 has-feedback">
                <label for="labelName" class="control-label sr-only">*Label Name: </label>
                <input type="text" name="labelName" id="labelName" onblur="Validator.element(this)" value="<?php echo Utils::escape($label->getName()); ?>" class="form-control input-lg" placeholder="Label Name"/>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
            <div class="form-group col-xs-12 has-feedback">
                <label for="email" class="control-label sr-only">Email: </label>
                <input type="email" name="labelEmail" id="labelEmail" onblur="Validator.element(this)" value="<?php echo Utils::escape($label->getEmail()); ?>" class="form-control input-lg" placeholder="Label Email"/>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
            <!--            <div class="form-group col-xs-6 has-feedback">
                            <label for="logo" class="control-label sr-only">Logo URL: </label>
                            <input type="text" name="logo" value="<?php echo Utils::escape($label->getLogo()); ?>" class="form-control input-lg" />
                        </div>
                        <div class="form-group col-xs-6 has-feedback">
                            <label for="cover" class="control-label sr-only">Cover Image URL: </label>
                            <input type="text" name="cover" value="<?php echo Utils::escape($label->getCover()); ?>" class="form-control input-lg"/>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>-->
            <div class="form-group col-xs-6 has-feedback">
                <label for='genre' class="control-label sr-only">Genre: </label>
                <select name='genre' id='genre' class="form-control input-lg">
                    <option value="">Genre...</option>
                    <?php
                    foreach ($genreArr as $genre) {
                        if ($genre === $label->getGenre()) {
                            echo '<option selected>' . $genre . '</option>';
                        } else {
                            echo '<option>' . $genre . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-xs-6 has-feedback">
                <label for="country" class="control-label sr-only">Country</label>
                <select name="country" id="country" class="form-control input-lg">
                    <option value="">Country...</option>
                    <?php
                    foreach ($countryList as $country) {
                        if ($country === $label->getCountry()) {
                            echo '<option selected>' . $country . '</option>';
                        } else {
                            echo '<option>' . $country . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-xs-12">
                <label for="description" class="sr-only">Description: </label>
                <textarea name="description" rows='5' class="form-control input-lg" placeholder="Description"><?php echo Utils::escape($label->getDescription()); ?></textarea><br/>
            </div>
        </fieldset>
        
        
        <input type="submit" name="submit" value="Submit"/>

    </form>

    <script>


    </script>
</div>