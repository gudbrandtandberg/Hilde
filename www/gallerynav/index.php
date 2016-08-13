<?php
    include("../templates/header.php");
?>

<div class="container gallerynavcontainer">
    
        <div class="col-sm-4">
            <a href="../gallery/?page=horses" class="gallerynavbutton">
                <div class="gallerynavimage" style="background-image: url('../images/horses/1.jpg');" alt="Horses"></div>
                <div class="caption"><?=ucfirst(strtolower($horses));?></div>
            </a>
        </div>  
    
        <div class="col-sm-4">
            <a href="../gallery/?page=dogs" class="gallerynavbutton">
                <div class="gallerynavimage" style="background-image: url('../images/dogs/1.jpg');" alt="Dogs"></div>
                <div class="caption"><?=ucfirst(strtolower($dogs));?></div>
            </a>
        </div>
    
        <div class="col-sm-4">
            <a href="../gallery/?page=other" class="gallerynavbutton">
                <div class="gallerynavimage" style="background-image: url('../images/other/1.jpg');" alt="Other"></div>
                <div class="caption"><?=ucfirst(strtolower($other));?></div>
            </a>
        </div>
        
</div>

<?php
    include("../templates/footer.php");
?>
