<!-- Generelle tips:
-Offer approval, return and refund policies
-Provide clear concise instructions on how to buy
-Provide adequate contact information
-Think seriously about accompanying each series or body of your work with its own explanation or introduction.
-Text explanations and introductions to your art are extremely important, but keep the word count to a minimum.
-->

<!-- NEWSFEED/HOME -->

<?php
    include("header.php");
?>

<div class="container">
    <div class="row newscontainter">
        
        <div class="col-md-12 newsitem">
            <h3>Dette er et news-item <small>Og dette er en dato</small></h3>
            <p>
                Et news-item MÅ ha en tittel og en tekst. Dato blir automatisk generert. Et newsitem KAN ha et bilde og bildet KAN ha en tekst. Du legger ganske enkelt nye news-items inn ved å gå <a href="nynewsfeed.php">hit</a> og følge instruksene.
                På den andre side - hvis du vil legge inn et nytt bilde til galleriet, så gjør du det <a href="nyttbilde.php">her</a>.
            </p>
        </div>
        
        <div class="col-md-12 newsitem">
            
            <h3>Jeg så et reinsdyr <small>11.1.2015</small></h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            
            <div>
                <img src="images/other/11.jpg" alt="bilde">
                <p>Liten kommentar til bildet...</p>
            </div>
        </div>
        
        
        <div class="col-md-12 newsitem">
            <h3>Ny utstilling! <small>7.1.2015</small></h3>
            <p>
                Det var gøy på Oslo Open i år. Klikk <a href="#">her</a> for å se mine bidrag. Det blir veldig spennende, og jeg håper jeg vinner masse premier! Hvis jeg gjør det så skal jeg kjøpe masse gaver til alle mine fettere som er så utrolig snille og søte (ikke Eirik og Magnus da...)
            </p>
    
        </div>
        
        <div class="col-md-12 newsitem">
            <h3>Jeg har bursdag! <small>1.1.2015</small></h3>
            <p>I dag har jeg bursdag. Send meg gaver til Nordahl Bruns gate 12.</p>
      
        </div>
        
    </div>
</div>

<?php
    include("footer.php");
?>