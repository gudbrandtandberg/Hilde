<?php
    include("../templates/header.php");
?>

<style>
    .big {
        text-align: center;
        font-size: 30px;
        margin: 0 auto;
    }
    .quitebig{
        font-size: 20px;
        padding-top: 50px;
        padding-bottom: 30px;
        padding-left: 15%;
        padding-right: 15%;
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
                <span><img src="../images/diverse/facebook_icon.png" /> <a href="https://www.facebook.com/pages/Hilde-Morris-Horse-Dog-Portraiture/440544189448080"><?=$fb;?></a></span>
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: black;" class="glyphicon glyphicon-phone" aria-hidden="true"></span> (+47) 92298921
            </td>
        </tr>
    </table>
    

<p style="text-align: center; font-size: x-large; padding-top: 20px; padding-bottom: 20px;">
    <?=$locationtext;?>

</p>

<?=$locations;?>

</div>

<?php
    include("../templates/footer.php");
?>
