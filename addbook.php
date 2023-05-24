<?php
$file_name = "Data\book.csv";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles\form.css">
    <title>Buku</title>
</head>

<body>
    <a href="index.php"><-Kembali ke Halaman Utama</a>
            <div class="form">
                <form method="post" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>Kode Buku</td>
                            <td><input type="text" name="code"></td>
                        </tr>
                        <tr>
                            <td>Judul</td>
                            <td><input type="text" name="judul"></td>
                        </tr>
                        <tr>
                            <td>Pengarang</td>
                            <td><input type="text" name="pengarang"></td>
                        </tr>
                        <tr>
                            <td>Tahun Terbit</td>
                            <td><input type="text" name="thnterbit"></td>
                        </tr>
                        <tr>
                            <td>Jumlah Halaman</td>
                            <td><input type="text" name="jmlhhalaman"></td>
                        </tr>
                        <tr>
                            <td>Penerbit</td>
                            <td><input type="text" name="penerbit"></td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td><input type="text" name="kategori"></td>
                        </tr>
                        <tr>
                            <td>Cover Buku</td>
                            <td><input type="file" name="fileToUpload" id="fileToUpload"></td>
                        </tr>
                        <tr>
                            <td><button type="submit" name="submit" class="submitbtn">Tambah Buku</button></td>
                        </tr>
                    </table>
                </form>
            </div>
            <?php
            if (isset($_POST["submit"])) {
                $target_dir = "Data\Images\\";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $same_code = 1;
                foreach (file($file_name) as $line) {
                    $line_separated = explode(",", $line);
                    if ($_POST["code"] == $line_separated[0]) {
                        $same_code = 1;
                        break;
                    } else {
                        $same_code = 0;
                    }
                }
                if ($same_code == 0) {
                    if (file_exists($target_file)) {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                    } else {
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
                        $content .= $target_file;
                        $content .= "\n";
                        $handler = fopen($file_name, "a+");
                        if (fwrite($handler, $content)) {
                            echo "Data berhasil dimasukkan";
                        } else {
                            echo "Data gagal dimasukkan";
                        }
                        fclose($handler);
                    }
                } else {
                    echo "Gagal mengisi data, Terdapat Kode Buku yang sama";
                }
            }
            ?>
</body>

</html>