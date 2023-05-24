<?php
$file_name = "Data\book.csv";
$targeted_id = $_GET["updateId"];
foreach (file($file_name) as $line) {
    $line_separated = explode(",", $line);
    if ($line_separated[0] == $targeted_id) {
        $targeted_line = $line;
        $target_separated = explode(",", $targeted_line);
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles\form.css">
    <title>Update Data Buku</title>
</head>

<body>
    <a href="index.php"><-Kembali ke Halaman Utama</a>
            <div class="form">
                <form method="post" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>Kode Buku</td>
                            <td><input type="text" name="code" value="<?php echo $target_separated[0] ?>"></td>
                        </tr>
                        <tr>
                            <td>Judul</td>
                            <td><input type="text" name="judul" value="<?php echo $target_separated[1] ?>"></td>
                        </tr>
                        <tr>
                            <td>Pengarang</td>
                            <td><input type="text" name="pengarang" value="<?php echo $target_separated[2] ?>"></td>
                        </tr>
                        <tr>
                            <td>Tahun Terbit</td>
                            <td><input type="text" name="thnterbit" value="<?php echo $target_separated[3] ?>"></td>
                        </tr>
                        <tr>
                            <td>Jumlah Halaman</td>
                            <td><input type="text" name="jmlhhalaman" value="<?php echo $target_separated[4] ?>"></td>
                        </tr>
                        <tr>
                            <td>Penerbit</td>
                            <td><input type="text" name="penerbit" value="<?php echo $target_separated[5] ?>"></td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td><input type="text" name="kategori" value="<?php echo $target_separated[6] ?>"></td>
                        </tr>
                        <tr>
                            <td>Cover Buku</td>
                            <td><input type="file" name="fileToUpload" id="fileToUpload"><span><?php echo $target_separated[7]; ?></span></td>
                        </tr>
                        <tr>
                            <td><button type="submit" name="submit" class="submitbtn">UPDATE</button></td>
                        </tr>
                    </table>
                </form>
            </div>
            <?php
            $file_name = "Data\book.csv";

            ?>
            <?php
            if (isset($_POST["submit"])) {
                $target_dir = "Data\Images\\";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $image_change = 1;

                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                }
                $content = $_POST["code"];
                $content .= ",";
                $content .= $_POST["judul"];
                $content .= ",";
                $content .= $_POST["pengarang"];
                $content .= ",";
                $content .= $_POST["thnterbit"];
                $content .= ",";
                $content .= $_POST["jmlhhalaman"];
                $content .= ",";
                $content .= $_POST["penerbit"];
                $content .= ",";
                $content .= $_POST["kategori"];
                $content .= ",";

                if ($_FILES['fileToUpload']['error'] == UPLOAD_ERR_OK) {
                    unlink($target_separated[7]);
                    $content .= $target_file;
                } else {
                    $content .= $target_separated[7];
                }
                $contents = file_get_contents($file_name);
                $contents = str_replace($targeted_line, $content, $contents);
                file_put_contents($file_name, $contents);
                header("location:index.php");
            }

            ?>
</body>

</html>