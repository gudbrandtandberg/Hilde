#!/bin/bash

for file in *.jpg
do
	filename=$(basename "$file")
	extension="${filename##*.}"
	filename="${filename%.*}"
	convert -strip -interlace Plane -gaussian-blur 0.05 -quality 90% $file $file
done
