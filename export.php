<?php
require('lib/Exporter.php');
date_default_timezone_set('Europe/Berlin');

$exporter = new Exporter($_GET);
$file = $exporter->generate();

// reset the file pointer to the start of the file
fseek($file, 0);
// tell the browser it's going to be a csv file
header('Content-Type: ' . $exporter->getContentType());
// tell the browser we want to save it instead of displaying it
header('Content-Disposition: attachment; filename="' . $exporter->getFilename() . '";');
// make php send the generated csv lines to the browser
fpassthru($file);

exit;