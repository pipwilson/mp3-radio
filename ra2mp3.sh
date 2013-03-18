#!
# convert all the .ra files in a directory to mp3
for i in *.ra; do ffmpeg -i $i -ab 128k ${i%.ra}.mp3; done
