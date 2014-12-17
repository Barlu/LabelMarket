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
                            echo '<li ><a href="index.php?page=registration">Register</a></li>
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
                            echo '<li ><a href="index.php?page=registration">Register</a></li>
                                    <li ><a href="index.php?page=logIn">Log In</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
            <?php
            if(array_key_exists('labelId', $_SESSION)){
                echo '<div class="breadcrumbWrap" ><a class="breadcrumbs" href="index.php" >Home</a><p class="breadcrumbs"> > </p><a class="breadcrumbs" href="index.php?page=labelHome">Label Home</a></div>'; 
            }           
            
            ?>
            <div class='contentWrap'>
                <?php
                require $template
                ?>
            </div>
            <div class="footer">

            </div>    
        </div>

        <script type="text/javascript" src="js/main.js"></script>    
    </body>
</html>