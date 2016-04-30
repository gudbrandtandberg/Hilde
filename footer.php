        </div><!--end wrapper-->
        
        <div id="footer" class="footer">
          <div class="container">
            <p class="bunntekst">
                <a class="toggle-lang" href="#">
                        <?php switch ($_SESSION["lang"]){
                                case "en":
                                echo "Se siden på norsk";
                                break;
                                case "no":
                                echo "View page in English";
                                break;
                                default:
                                echo "FAIL";
                                break;
                        }?>
                </a>
            </p>
            <p class="bunntekst">&copy Hilde Morris 2015. All rights reserved.</p>
          </div>
        </div>
        
    </body>
</html>
