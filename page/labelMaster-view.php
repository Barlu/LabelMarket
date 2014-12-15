<div class='master'>
    <?php foreach ($labels as $label) {

echo '<div class="labelMaster" >
    <a href="index.php?page=labelHome&labelId='.$label->getId().'"><img src="'.$label->getLogo().'"/></a>
       <a href="index.php?page=labelHome&labelId='.$label->getId().'"><h3>'.$label->getName().'</h3></a>
       <a href="index.php?page=labelMaster&sortBy=genre"><h4>'.$label->getGenre().'</h4></a>
       <a href="index.php?page=labelMaster&sortBy=country"><h5>'.$label->getCountry().'</h5></a>
           </div>

';
        
 }
 ?>
</div>
<!--style="background-image:url(\''.$label->getLogo().'\');background-repeat:no-repeat;"-->