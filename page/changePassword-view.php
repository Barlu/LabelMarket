<fieldset>
    <legend>Change Password</legend>
    <?php
    if($error){
        echo '<div>'.$error.'</div>';
    }
    ?>
    <form action="index.php?page=changePassword" method="post">
        <label for="oldPassword">Old password: </label><br/>
        <input type="password" name="oldPassword"/><br/>
        <label for="newPassword">New password: </label><br/>
        <input type="password" name="newPassword"/><br/>
        <label for="confirmPassword">Confirm Password: </label><br/>
        <input type="password" name="confirmPassword"/><br/>
        <input type="submit" value="Submit" name="submit"/>
    </form>
</fieldset>