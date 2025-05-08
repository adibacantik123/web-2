<?php
require_once __DIR__ . '/../models/User.php';

use models\User;

if (!isset($_GET['id'])) {
    header("Location: List-user.php");
    exit;
}

$User = User::find($_GET['id']);  // Ambil data user berdasarkan id

if (!$User) {
    header("Location: List-user.php");
    exit;
}

if (isset($_POST['submit'])) {
    // Memperbaiki nama variabel $_user menjadi $User
    $data = [
        'id' => $User['id'],  // Gantilah $_user menjadi $User
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'gender' => $_POST['gender'],
        'age' => $_POST['age'],
        'weight' => $_POST['weight'],
    ];

    // Panggil update method untuk mengubah data
    User::update($data);  
    header("Location: List-user.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Praktikum 06</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="dashboard.php">Praktikum 06</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Main Menu</div>
                        <a class="nav-link" href="List-user.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                            User
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit User</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="List-user.php">User</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Edit User
                    </div>
                    <div class="card-body">
                        <form action="edit-user.php?id=<?= $User['id'] ?>" method="POST">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $User['firstname'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $User['lastname'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label d-block">Gender</label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="gender" id="laki-laki" value="Laki-laki" <?= $User['gender'] === 'Laki-laki' ? 'checked' : '' ?>>
                                    <label for="laki-laki" class="form-check-label">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="gender" id="perempuan" value="Perempuan" <?= $User['gender'] === 'Perempuan' ? 'checked' : '' ?>>
                                    <label for="perempuan" class="form-check-label">Perempuan</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="age" class="form-label">Age</label>
                                <input type="text" class="form-control" id="age" name="age" min="0" max="100" value="<?= $User['age'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="weight" class="form-label">Weight</label>
                                <input type="text" class="form-control" id="weight" name="weight" min="0" max="100" value="<?= $User['weight'] ?>" required>
                            </div>
                            <a href="List-user.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>Back</a>
                            <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-save"></i>Update</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../public/js/scripts.js"></script>
</body>

</html>