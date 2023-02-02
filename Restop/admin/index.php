<?php
require_once('../DBConnection.php');
$base=new DBConnection();
$conn=$base->connect();
if(!isset($_SESSION['admin_id'])){
    header("Location:./inc/login.php");
    exit;
}
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo ucwords(str_replace('_','',$page)) ?> | Restop </title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/fontawesome-free1/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../Font-Awesome-master/css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../select2/css/select2.min.css">
    <link rel="stylesheet" href="../summernote/summernote-lite.css">
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../DataTables/datatables.min.css">
    <script src="../DataTables/datatables.min.js"></script>
    <script src="../Font-Awesome-master/js/all.min.js"></script>
    <script src="../select2/js/select2.min.js"></script>
    <script src="../summernote/summernote-lite.js"></script>
    <script src="../js/script.js"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./../">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Restop<sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="./">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-bell-concierge"></i>
                    <span>Reservations</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="./?page=reservation">Reservations Liste</a>
                        <a class="collapse-item" href="./?page=table_list">Tables Liste</a>
                        <a class="collapse-item" href="./?page=salle_list">Salles Liste</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCommande"
                    aria-expanded="true" aria-controls="collapseCommande">
                    <i class="fa-solid fa-basket-shopping"></i>
                    <span>Commandes</span>
                </a>
                <div id="collapseCommande" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="./?page=Commandes&E=Enregistrer">Nouveau</a>
                        <a class="collapse-item" href="./?page=Commandes&E=Confirmer">Confirmer</a>
                        <a class="collapse-item" href="./?page=Commandes&E=En cours Preparation">En cours Preparation</a>
                        <a class="collapse-item" href="./?page=Commandes&E=En cours livraison">En cours livraison</a>
                        <a class="collapse-item" href="./?page=Commandes&E=livree">livree</a>
                        <a class="collapse-item" href="./?page=Commandes&E=Annuler">Annuler</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePlats"
                    aria-expanded="true" aria-controls="collapsePlats">
                    <i class="fa-solid fa-pizza-slice"></i>
                    <span>Plats</span>
                </a>
                <div id="collapsePlats" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="./?page=Plats">Liste Plat</a>
                        <a class="collapse-item" href="./?page=Menujour">Menu De Jour</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <?php
            if(isset($_SESSION['status']) && $_SESSION['status']==0 ){
             ?>
            <!-- Heading -->
            <div class="sidebar-heading">
                Gestion Site web
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="./?page=statistics">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Statistics</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./?page=admin">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Gestion des Comptes</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./?page=maintenance">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Plan de restaurant</span></a>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Contenu de site</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="./?page=apropos">A Propos</a>
                        <a class="collapse-item" href="./?page=Experts">Expert</a>
                        <a class="collapse-item" href="./?page=Avis">Avis Client</a>
                        <div class="collapse-divider"></div>
                        <a class="collapse-item" href="./?page=contact">Contact</a>
                        <a class="collapse-item" href="./?page=emails">Emails</a>
                    </div>
                </div>
            </li>

<?php } ?>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item ">
                            <a class="nav-link " href="./?page=Commandes&E=Enregistrer" id="alertsDropdown" role="button"
                                >
                                <i class="fa-solid fa-basket-shopping"></i>
                                <!-- Counter - Alerts -->
                                <?php
                                $check=0;
                                @$result= $conn->query("SELECT DISTINCT id_commande FROM commande where Etat='Enregistrer'");
                                while($row = mysqli_fetch_array($result)) {
                                    $check+=1;
                                }
                                ?>
                                <span class="badge badge-danger badge-counter"><?php echo $check; ?></span>
                            </a>

                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item ">
                            <a class="nav-link " href="./?page=reservation" id="messagesDropdown" role="button"
                                >
                                <i class="fa-solid fa-bell-concierge"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>

                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['fullname'] ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Deconnecter
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <div class="container py-3" id="page-container">
                        <?php
                            if(isset($_SESSION['flashdata'])):
                        ?>
                        <div class="dynamic_alert alert alert-<?php echo $_SESSION['flashdata']['type'] ?>">
                        <div class="float-end"><a href="javascript:void(0)" class="text-dark text-decoration-none" onclick="$(this).closest('.dynamic_alert').hide('slow').remove()">x</a></div>
                            <?php echo $_SESSION['flashdata']['msg'] ?>
                        </div>
                        <?php unset($_SESSION['flashdata']) ?>
                        <?php endif; ?>
                        <?php
                            include 'inc/'.$page.'.php';
                        ?>
                    </div>
                    <!-- Content Row -->

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Restop 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
        <div class="modal fade" id="uni_modal" role='dialog' data-bs-backdrop="static" data-bs-keyboard="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer py-1">
                <button type="button" class="btn btn-sm rounded-0 btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
                <button type="button" class="btn btn-sm rounded-0 btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
        </div>
        <div class="modal fade" id="uni_modal_secondary" role='dialog' data-bs-backdrop="static" data-bs-keyboard="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer py-1">
                <button type="button" class="btn btn-sm rounded-0 btn-primary" id='submit' onclick="$('#uni_modal_secondary form').submit()">Save</button>
                <button type="button" class="btn btn-sm rounded-0 btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
        </div>
        <div class="modal fade" id="confirm_modal" role='dialog'>
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-header py-2">
                <h5 class="modal-title">Confirmation</h5>
            </div>
            <div class="modal-body">
                <div id="delete_content"></div>
            </div>
            <div class="modal-footer py-1">
                <button type="button" class="btn btn-primary btn-sm rounded-0" id='confirm' onclick="">Continue</button>
                <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
        </div>
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Se Deconnecter</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Voulez Vous se deconnecter ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                    <a class="btn btn-primary" href="../Actions.php?a=logout">Deconnecter</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->


</body>

</html>
