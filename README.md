#Hilde sin hjemmeside!

I dette dokumentet forklares filosofien og strukturen til siden hildemorris.com
laget av Duff Development 2015. 

## Contents

  - about.php, contact.php, process.php, gallery.php: simple pages with static
	content 
  - header.php, footer.php: just that - included in every page shown
  - horses.php, dogs.php, other.php -should be one file! Show grid of 
	thumbnails and includes a js imageviewer 
	(instead use gallery.php?page=horses/dogs/other)
  - nynewsfeed.php and nyttbilde.php: Hilde's interface to upload new feeditems/paintings
	corresponding server-side scripts in 'scripts'
  - model/newsfeed.json and model/paintings.json: 'snapshots' of what should
	be shown. A programatic handles to the content. Can be read/written to
	by both php and js. 
  - bootstrap and style.css: general styling and bootstrap css/fonts/js



Foreløpig bare noen drodlinger...:

## Model

var paintings = json_decode(paintings.json);

paintings.horses[i].src
paintings.horses[i].text