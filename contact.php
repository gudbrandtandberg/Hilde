<?php
    include("header.php");
?>

<style>
    .big {
        text-align: center;
        font-size: 30px;
        margin: 0 auto;
    }
    .quitebig{
        font-size: 20px;
        padding: 60px 15%;
    }
</style>

<div class="container">
    
    <p class="quitebig" style="text-align: center;">
        <?=$contacttext;?>
    </p>
    <table class="big">
        <tr>
            <td>
                <span style="color: black;" class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <a href="mailto:hilde@hildemorris.com">hilde@hildemorris.com</a>
            </td>
        </tr>
        <tr>
            <td>
                <span><img src="images/diverse/facebook_icon.png" /> <a href="https://www.facebook.com/pages/Hilde-Morris-Horse-Dog-Portraiture/440544189448080"><?=$fb;?></a></span>
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: black;" class="glyphicon glyphicon-phone" aria-hidden="true"></span> (+47) 92298921
            </td>
        </tr>
    </table>
    
</div>

<?php
    include("footer.php");
?>
