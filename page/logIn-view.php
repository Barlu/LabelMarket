<form action='index.php?page=logIn' method='post'>
    <fieldset>
        <legend>Log In</legend>
    <label for='username'>Username: </label><br/>
    <input type='text' name='username' value="<?php if(array_key_exists('submit', $_POST)){ echo Utils::escape($_POST['username']);}?>"/><br/>
    <label for='password'>Password: </label><br/>
    <input type='password' name='password'/><br/>
    <input type='hidden'/>
    <input type='submit' value='Submit' name='submit'/>
    </fieldset>
</form>
<div>
    <?php 
        echo $error;
    ?>
</div>
