#!/bin/bash

# lite hjelpeskript som komprimerer jpg bilder i mappen man er i
# lite robust mhp. dynamisk kompresjon, men fin å ha. 

for file in *.jpg
do
	filename=$(basename "$file")
	extension="${filename##*.}"
	filename="${filename%.*}"
	convert -strip -interlace Plane -gaussian-blur 0.05 -quality 90% $file $file
done
