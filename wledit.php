<?php
    // koneksi ke database
    require("auth.php");
    require("connection.php");

    $errors = ""; //declare variabel eror

    // mengambil works_id dari url
    $works_id = $_GET['works_id'];

    // ketika dideklarasikan maka akan membaca data dari tabel works
    if (isset($_GET['works_id'])) {
        $query = mysqli_query($conn, "SELECT * FROM works WHERE works_id = $works_id");
        $row = mysqli_fetch_array($query);
    } else {
        header('Location: wl.php');
    }

    // ketika dideklarasikan maka akan mengubah data dari tabel works
    if (isset($_POST['wl_simpan'])) { // biar simpan buttonnya work
        $wl_edit = $_POST['wl_edit'];
        if (empty($wl_edit)) {
            $errors = "Tugas tidak boleh kosong"; // kalo kosong bakal eror
        }
        else {
            mysqli_query($conn, "UPDATE `works` SET `wish_list_content` = '$wl_edit' WHERE `works`.`works_id` = $works_id;"); // nambah task
            header('Location: wl.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css"/>
    <title>Edit Wishlist</title>
</head>
<body>
        <nav>
            <h1 class="catatanmu">Catatanmu.id</h1>
            <ul class="nav_links">
                <li><a class="db_ref" href="dashboard.php">Dashboard</a></li>
                <li>    
                    <a class="userlogo" href="profile.php"> 
                        <img class="profilelogo" src="img/Avatar.svg" width="50em" href="profile.php">
                    </a>
                </li>
            </ul>
        </nav>

    <form class="tdlbox" action="" method="POST">
        <input class="tdlinput" type="text" name="wl_edit" value="<?php echo $row['wish_list_content']; ?>">
        <button class="simpan" type="submit" name="wl_simpan">Simpan</button>
    </form>

    <div>
        <?php if (isset($errors)) { ?>
        <p><?php echo $errors; ?></p>
        <?php } ?>
    </div>

</body>
</html>