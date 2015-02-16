<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title><?php echo $title ?></title>

        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <meta name="keywords" content=""/>

        <link rel="stylesheet" type="text/css" href="css/normalize.css"/>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'/>
        <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'/>
        <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'/>
    </head>
    <body>
        <div id='wrapper'>

            <div class="cover">
                <img src="<?php echo $cover; ?>"/>
            </div>

            <div class="header">
                <h1 id="labelHeading"><?php echo $labelName; ?></h1>
            </div>


            <div id="navBackground">
                <ul id="nav">
                    <?php
                    if (array_key_exists('labelId', $_SESSION)) {
                        echo '
                        <li ><a href="index.php">Home</a></li>
                        <li ><a href="index.php?page=albumMaster">Music</a>
                        <ul>
                            <li ><a href="index.php?page=albumMaster">Albums</a></li>
                            <li ><a href="index.php?page=songMaster">Songs</a></li>
                            <li ><a href="index.php?page=mixMaster">Mixes</a></li>
                        </ul>
                        </li>';

                        if (array_key_exists('username', $_SESSION)) {
                            echo '  <li ><a href="#">Upload</a>
                                    <ul>
                                        <li ><a href="index.php?page=addEditAlbum">Album</a></li>
                                        <li ><a href="index.php?page=addEditMix">Mix</a></li>
                                    </ul>
                                    </li>
                                    <li ><a href="index.php?page=profile">' . ucfirst($_SESSION['username']) . '</a>
                                    <ul>
                                    <li ><a href="index.php?page=labelHome">Label Home</a></li>
                                    <li ><a href="index.php?page=profile">Profile</a></li>
                                    <li ><a href="index.php?page=logOut">Log Out</a></li>
                                    </ul>
                                    </li>';
                        } else {
                            echo '<li ><a href="#registrationModal" data-toggle="modal">Register</a></li>
                                <li ><a href="index.php?page=logIn">Log In</a></li>';
                        }
                    } else {
                        echo '
                        <li ><a href="index.php">Home</a></li>
                        <li ><a href="index.php?page=labelMaster">Browse</a></li>';
                        if (array_key_exists('username', $_SESSION)) {
                            echo '  <li ><a href="#">Upload</a>
                                    <ul>
                                        <li ><a href="index.php?page=addEditAlbum&labelId=' . $admin->getLabelId() . '">Album</a></li>
                                        <li ><a href="index.php?page=addEditMix&labelId=' . $admin->getLabelId() . '">Mix</a></li>
                                    </ul>
                                    </li>
                                    <li ><a href="index.php?page=profile">' . ucfirst($_SESSION['username']) . '</a>
                                    <ul>
                                    <li ><a href="index.php?page=labelHome&labelId=' . $admin->getLabelId() . '">Label Home</a></li>
                                    <li ><a href="index.php?page=profile">Profile</a></li>
                                    <li ><a href="index.php?page=logOut">Log Out</a></li>
                                    <ul>
                                    </li>
                                    ';
                        } else {
                            echo '<li ><a href="#registrationModal" data-toggle="modal" >Register</a></li>
                                    <li ><a href="index.php?page=logIn">Log In</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
            <?php
            if (array_key_exists('labelId', $_SESSION)) {
                echo '<div class="breadcrumbWrap" ><a class="breadcrumbs" href="index.php" >Home</a><p class="breadcrumbs"> > </p><a class="breadcrumbs" href="index.php?page=labelHome">Label Home</a></div>';
            }
            ?>

            <!--            REGISTRATION MODAL-->
            <div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id='form' action="index.php?page=registration" method="post" onSubmit="return validateRegistration()">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Registration</h3>
                            </div>
                            <div class="modal-body container-fluid">



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
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--            REGISTRATION END-->

            <div class='contentWrap'>
                <?php
                require $template
                ?>
            </div>
            <div class="footer">

            </div>    
        </div>
        <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>  
        <script type="text/javascript" src="js/bootstrap.min.js"></script>  
        <script type="text/javascript" src="js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="js/validation.js"></script> 
        <script type="text/javascript" src="js/main.js"></script>    
    </body>
</html>