<?php
    require "inc/sessione.php";
    attivazione_sessione("nome_utente");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Contenitore di evento per i ricercatori</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       <?php include "inc/menu.php"; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800" style="text-align:center";>Eventi inseriti</h1>
                    <p class="mb-4" style="text-align: center";>Ecco la lista di tutti gli eventi inseriti da <?= $_SESSION['nome_utente']; ?>.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered"  width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background-color:aqua; color:black">
                                            <th>Immagine</th>
                                            <th>Titolo</th>
                                            <th>Descrizione</th>
                                            <th>Luogo svolgimento</th>
                                            <th>Data svolgimento</th>
                                            <th>Data creazione</th>                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody id="getEvent">
                                       
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

   <?php require "inc/logout_mod.php"; ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/notifica.js"></script>

    <script>

    function getAllArticles() {
        fetch('../api/backend')
            .then(response => response.json())
            .then(data => {
                console.log("Données reçues:", data); 
                const articles = data.eventi;

                if (!Array.isArray(articles)) {
                    throw new Error("I dati non sono ricevuti correttamente !");
                }
                const container = document.getElementById("getEvent");
                container.innerHTML = ""; 

                articles.forEach((article, index) => { 
                    const articleHTML = `
                        <tr>
                                                <td><img src="../img/${article.immagine}" style="width: 120px; height: 80px; border-radius: 8px; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);" alt="Aperçu de l'événement"></td>      
                                                <td>${article.titolo}</td>
                                                <td>${article.descrizione}</td>
                                                <td>${article.luogo_svolgimento}</td>
                                                <td>${article.data_svolgimento}</td>
                                                <td>${article.data_creazione}</td>
                                            </tr>
                    
                    `;

                    container.innerHTML += articleHTML;
                });
            })
            .catch(error => console.error("Errore:", error));
    }
        getAllArticles();

    setInterval(getAllArticles, 5000);

</script>


</body>

</html>