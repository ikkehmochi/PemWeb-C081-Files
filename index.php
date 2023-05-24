<?php
$file_name = "Data\book.csv";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles\index.css">
    <title>Buku</title>
</head>

<body>
    <a href="addbook.php"><button class="addbtn">Tambah Buku</button></a>
    <table border="1">
        <?php
        $datarow = 0;
        foreach (file($file_name) as $line) {
            if ($datarow == 0) {
                echo "<tr>";
                $line_separated = explode(",", $line);
                foreach ($line_separated as $data) {
                    echo "<th>" . $data . "</th>";
                }
                echo "</tr>";
                $datarow += 1;
            } else {
                echo "<tr>";
                $line_separated = explode(",", $line);
                $fields = 0;
                foreach ($line_separated as $data) {

                    if ($fields == 7) {
                        echo '<td><img class="cover" src="' . $data . '"></td>';
                    } else {
                        echo "<td>" . $data . "</td>";
                    }

                    $fields += 1;
                }
                echo   '<td>
                <button class="updatebtn"><a href="updatebook.php?updateId=' . $line_separated[0] . '" class="btntxt">UPDATE</a></button>
                <button class="deletebtn"><a href="deletebook.php?deleteId=' . $line_separated[0]  . '" class="btntxt">DELETE</a></button>
            </td></tr>';
            }
        }
        ?>
    </table>
</body>

</html>