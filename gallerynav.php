<?php
    include("header.php");
?>

<div class="container gallerynavcontainer">
    
        
        <div class="col-sm-4">
            <a href="gallery.php?page=horses" class="gallerynavbutton">
                <div class="gallerynavimage" style="background-image: url('images/horses/1.jpg');" alt="Horses"></div>
                <div class="caption">Horses</div>
            </a>
        </div>  
    
        <div class="col-sm-4">
            <a href="gallery.php?page=dogs" class="gallerynavbutton">
                <div class="gallerynavimage" style="background-image: url('images/dogs/1.jpg');" alt="Dogs"></div>
                <div class="caption">Dogs</div>
            </a>
        </div>
    
        <div class="col-sm-4">
            <a href="gallery.php?page=other" class="gallerynavbutton">
                <div class="gallerynavimage" style="background-image: url('images/other/1.jpg');" alt="Other"></div>
                <div class="caption">Other</div>
            </a>
        </div>
        
    
</div>

<?php
    include("footer.php");
?>