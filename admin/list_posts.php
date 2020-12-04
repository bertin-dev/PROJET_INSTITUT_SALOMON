<?php
require '../app/config/Config_Server.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Cards</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

      <!-- Sidebar -->
      <?php require 'sidebar.php';?>
      <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

          <!-- Topbar -->
          <?php require 'topbar.php';?>
          <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cards</h1>
          </div>

          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tasks Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">

            <div class="col-lg-6">

              <!-- Default Card Example -->
              <div class="card mb-4">
                <div class="card-header">
                  Details sur les categories
                </div>
                  <div class="card-body">

                      <?php
                      if(isset($_GET['updateCat'])){
                          foreach (App::getDB()->query('SELECT * FROM categories WHERE id='.$_GET['updateCat']) AS $cat):
                              ?>
                              <div class="alert alert-danger rapport" style="display:none;"></div>
                              <form class="user" role="form" id="form_update_categories" action="controllers/traitement.php?updateCategories=update" method="post">
                                  <input type="hidden" name="category" value="<?=$cat->id;?>">
                                  <div class="form-group">
                                      <label for="titre_categories"></label><input type="text" class="form-control" id="titre_categories" value="<?=$cat->title;?>" name="titre_categories" aria-describedby="titre_categories" placeholder="Titre Catégorie">
                                  </div>

                                  <div class="form-group">
                                      <label for="desc_categories"></label><textarea name="desc_categories" class="form-control" id="desc_categories" aria-describedby="desc_categories" cols="30" rows="5" placeholder="Description Catégorie"><?=$cat->description;?></textarea>
                                  </div>

                                  <div class="form-group">
                                      <input type="submit" class="btn btn-primary btn-user btn-block currentSend" value="Modifier"/>
                                      <center><img src="img/loader.gif" class="loader" style="display:none;" alt=""></center>
                                  </div>

                              </form>
                          <?php
                          endforeach;
                      } elseif (isset($_GET['delCat'])){
                          App::getDB()->delete('DELETE FROM categories WHERE id=:id', ['id' =>$_GET['delCat']]);
                          //header('Location: list_posts.php');
                      } else{

                      $result = App::getDB()->rowCount('SELECT id FROM categories');

                      // Si une erreur survient
                      if($result == 0 ) {
                          echo '<p>Votre liste de Catégories est vide</p>';
                      }
                      else {
                      ?>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Titre</th>
                                                    <th>Description</th>
                                                    <th>Modifier</th>
                                                    <th>Supprimer</th>
                                                    <th>Créee</th>
                                                    <th>Mise à jour</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Titre</th>
                                                    <th>Description</th>
                                                    <th>Modifier</th>
                                                    <th>Supprimer</th>
                                                    <th>Créee</th>
                                                    <th>Mise à jour</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>
                                                <?php
                                                foreach (App::getDB()->query('SELECT * FROM categories
                                                                                ORDER BY id DESC') AS $category):
                                                    echo '<tr>
                                                        <td title="ID">#'.$category->id.'</td>
                                                        <td title="Titre">'.$category->title.'</td> 
                                                        <td title="Description">'.$category->description.'</td>
                                                        <td title="Modifier"><a href="list_posts.php?updateCat='.$category->id.'">Modifier</a></td>
                                                        <td title="Supprimer"><a href="list_posts.php?delCat='.$category->id.'">Supprimer</a></td>
                                                        <td title="Créee">'.date('d/m/Y H:i:s', $category->created_at).'</td> 
                                                        <td title="Mise à jour">'.date('d/m/Y H:i:s', $category->updated_at).'</td> 
                                                        <tr>';
                                                endforeach;
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>


                      <?php
                      }
                      }
                      ?>
                        </div>
              </div>

              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Basic Card Example</h6>
                </div>
                <div class="card-body">
                  The styling for this basic card example is created by using default Bootstrap utility classes. By using utility classes, the style of the card component can be easily modified with no need for any custom CSS!
                </div>
              </div>

            </div>

            <div class="col-lg-6">

              <!-- Dropdown Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Details sur les Tags</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <!--<a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>-->
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">


                    <?php
                    if(isset($_GET['updateTag'])){
                        foreach (App::getDB()->query('SELECT * FROM tags WHERE id='.$_GET['updateTag']) AS $cat):
                            ?>
                            <div class="alert alert-danger rapport" style="display:none;"></div>
                            <form class="user" role="form" id="form_update_tag" action="controllers/traitement.php?updateTag=update" method="post">
                                <input type="hidden" name="tag_id" value="<?=$cat->id;?>">
                                <div class="form-group">
                                    <label for="titre_categories"></label><input type="text" class="form-control" id="titre_tag" value="<?=$cat->title;?>" name="titre_tag" aria-describedby="titre_tag" placeholder="Titre du Tag">
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-user btn-block currentSend" value="Modifier"/>
                                    <center><img src="img/loader.gif" class="loader" style="display:none;" alt=""></center>
                                </div>

                            </form>
                        <?php
                        endforeach;
                    } elseif (isset($_GET['delTag'])){
                        App::getDB()->delete('DELETE FROM tags WHERE id=:id', ['id' =>$_GET['delTag']]);
                        //header('Location: list_posts.php');
                    } else{

                        $result = App::getDB()->rowCount('SELECT id FROM tags');

                        // Si une erreur survient
                        if($result == 0 ) {
                            echo '<p>Votre liste de Tags est vide</p>';
                        }
                        else {
                            ?>
                            <!-- Begin Page Content -->
                            <div class="">
                                <!-- Page Heading -->

                                <!-- DataTales Example -->

                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Titre</th>
                                                    <th>Modifier</th>
                                                    <th>Supprimer</th>
                                                    <th>Créee</th>
                                                    <th>Mise à jour</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Titre</th>
                                                    <th>Modifier</th>
                                                    <th>Supprimer</th>
                                                    <th>Créee</th>
                                                    <th>Mise à jour</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>
                                                <?php
                                                foreach (App::getDB()->query('SELECT * FROM tags
                                                                                ORDER BY id DESC') AS $category):
                                                    echo '<tr>
                                                        <td title="ID">#'.$category->id.'</td>
                                                        <td title="Titre">'.$category->title.'</td> 
                                                        <td title="Modifier"><a href="list_posts.php?updateTag='.$category->id.'">Modifier</a></td>
                                                        <td title="Supprimer"><a href="list_posts.php?delTag='.$category->id.'">Supprimer</a></td>
                                                        <td title="Créee">'.date('d/m/Y H:i:s', $category->created_at).'</td> 
                                                        <td title="Mise à jour">'.date('d/m/Y H:i:s', $category->updated_at).'</td> 
                                                        <tr>';
                                                endforeach;
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>


                            </div>
                            <!-- /.container-fluid -->
                            <?php
                        }
                    }
                    ?>

                </div>
              </div>

              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                  <h6 class="m-0 font-weight-bold text-primary">Collapsable Card Example</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                  <div class="card-body">
                    This is a collapsable card example using Bootstrap's built in collapse functionality. <strong>Click on the card header</strong> to see the card body collapse and expand!
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

        <!-- Footer -->
        <?php require 'footer.php';?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <?php require 'allMyModal.php';?>
  <?php require 'required_js.php';?>

</body>

</html>
