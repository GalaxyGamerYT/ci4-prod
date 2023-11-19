<?php

use App\Models\PrivilegesModel;

$loggedIn = False;

$privileges = [];
$db = db_connect();
$fields = $db->getFieldNames('privileges');

foreach ($fields as $field) {
    if ($field != "privilege_id" and $field != "user_id"){
        $privileges[$field] = Null;
    }
}

if(isset($_SESSION['isLoggedIn'])){
    $loggedIn = True;
    $privilegesModel = new PrivilegesModel();
    $user_privileges = $privilegesModel->where('privilege_id', session('privilege_id'))->first();
    foreach ($user_privileges as $privilege => $value) {
        if($privilege != "privilege_id" and $privilege != "user_id"){
            $privileges[$privilege] = $value;
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>CodeIgniter Login and Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="<?php echo base_url('/dashboard'); ?>">Dashboard</a>
                        <div class="d-flex">
                            <ul class="navbar-nav">
                                <?php if($loggedIn==True):?>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="<?php echo base_url('/logout'); ?>">Logout</a>
                                    </li>
                                <?php endif;?>
                                <?php if($loggedIn==False):?>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="<?php echo base_url('/login'); ?>">Login</a>
                                    </li>
                                <?php endif;?>
                                <?php if($loggedIn==True):?>
                                    <?php if($privileges['admin']=="1"):?>
                                        <li class="nav-item">
                                            <a class="nav-link" aria-current="page" href="<?php echo base_url('/admin'); ?>"><i class="bi bi-shield-lock-fill"></i></a>
                                        </li>
                                    <?php endif;?>
                                <?php endif;?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="<?php echo base_url('/preferences'); ?>"><i class="bi bi-sliders2"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <?= $this->renderSection("heading"); ?>
            </div>
        <?= $this->renderSection("content"); ?>
    </div>
</div>
</body>
</html>