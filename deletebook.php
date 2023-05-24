<?php
$file_name = "Data\book.csv";
if (isset($_GET["deleteId"])) {
    $targeted_id = $_GET["deleteId"];
    foreach (file($file_name) as $line) {
        $line_separated = explode(",", $line);
        if ($line_separated[0] == $targeted_id) {
            $image_path = substr(end($line_separated), 0, -1);
            $targeted_line = $line;
            break;
        }
    }
    unlink($image_path);
    $contents = file_get_contents($file_name);
    $contents = str_replace($targeted_line, '', $contents);
    file_put_contents($file_name, $contents);
    header("location:index.php");
}
