<?php

// END BOTH PATHS IN A /
// path from script to tunez
$rootpath = "/home/pip/mp3-radio/";
// url to this script
$feedpath = "http://philwilson.org/mp3-radio/mp3rss.php?dir=";

header('Content-type: application/xml');

$xml = new XmlWriter();
$xml->openMemory();
$xml->startDocument('1.0', 'UTF-8');

$xml->startElement('opml');
$xml->writeAttribute('version', '1.1');

$xml->startElement('head');
$title = "mp3-radio";
$xml->writeElement('title', $title);
$xml->endElement(); // </head>

$xml->startElement('body');

$dir = @opendir($rootpath) or die("Unable to open $rootpath");
while ($p = readdir($dir)) {

    if (is_file($p) == FALSE && $p != "." && $p != ".." && $p != "getid3") {

        $xml->startElement('outline');
        $xml->writeAttribute('type', "rss");
        $xml->writeAttribute('text', $p);
        $xml->writeAttribute('title', $p);
        $feed = $feedpath . $p;
        $xml->writeAttribute('xmlUrl', $feed);

        $xml->endElement(); // </outline>

    }

}
closedir($dir);

$xml->endElement(); // </body>
$xml->endElement(); // </opml>

#$f = "music.opml";
#$fh = fopen($f, 'w') or die ("can't open file ".$f);
#fwrite($fh, $xml->outputMemory(true));
#fclose($fh);
echo $xml->outputMemory(true);

#echo "<br>";
#echo "Done!";

?>
