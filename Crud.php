<?php  
// INSERT INTO `dbyash`.`trees` (`sno`, `title`, `description`, `tstamps`) VALUES (NULL, 'buy books please buy books ', '123', '2023-06-20 00:00:00');
//  Connect to the Database 
$insert = false;
$update = false;
$delete = false;
$servername = "localhost";
$username = "root";
$password = "";
$database = "dbyash";
 
// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}

if (isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `dbyash` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (isset( $_POST["snoEdit"])){
    // Update the record
    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $description = $_POST["descriptionEdit"];

// Sql query to be executed 
$sql = "UPDATE `dbyash`.`trees` SET `title` = '$title' , `description` = '$description'  WHERE `trees`.`sno` = $sno;";
$result = mysqli_query($conn, $sql);
if($result){
  $update = true;
}
else{
  echo "We could not update record successfully";
}
  }
  else{
  $title = $_POST["title"];
  $description = $_POST["description"];

// Sql query to be executed 
$sql = "INSERT INTO `trees` (`title`, `description`) VALUES ('$title', '$description')";
$result = mysqli_query($conn, $sql);

if($result){ 
    // echo "The record has been inserted successfully ! ";
    $insert = true;
}
else{
    echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
} 
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>iNotes - Informative Data</title>

  <!-- javascript here -->
  <!-- <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element)=> {
      element.addEventListener("click", (e) => {
        console.log("edit", e);
      })
    })
  </script> -->

  <!-- CSS is here -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

</head>

<body>

  <!-- Button trigger modal -->
  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Edit Modal
  </button> -->

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5" id="editModalLabel">Edit This Note</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <!-- <span aria-hidden="true">&times;</span> -->
          </button>
        </div>
        <form action="/crud/crud.php" method="POST">
        <div class="modal-body">

          <input type="hidden" name="snoEdit" id="snoEdit">
      <div class="mb-3">
        <label for="title">Note Title</label>
        <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="desc" class="form-label">Note Description</label>
        <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
      </div>
      <!-- <button type="submit" class="btn btn-primary">Update note</button> -->
      
    </div>
    <div class="modal-footer d-block mr-auto">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
  </form>
  </div>
</div>
</div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDHdyUxUfN6bsREtzKOJ761eQp42zAuqrLMw&usqp=CAU" height="30px" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <?php
      if($insert){
        echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Scuccess</strong> Your note has been inserted successfully. 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
      ?>
  <?php
      if($delete){
        echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Scuccess</strong> Your note has been deleted successfully. 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
      ?>
  <?php
      if($update){
        echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Scuccess</strong> Your note has been updated successfully. 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
      ?>


  <div class="container my-4">
    <h2>Add a Note</h2>
    <form action="/crud/crud.php?" method="POST">
      <div class="mb-3">
        <label for="title">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="desc" class="form-label">Note Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add note</button>
    </form>
  </div>
  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $sql = "SELECT * FROM `trees`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while($row = mysqli_fetch_assoc($result)){
          $sno = $sno + 1;
          echo "<tr>
          <th scope='row'>". $sno ."</th>
          <td>". $row['title'] ."</td>
          <td>". $row['description'] . "</td>
          <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button> </td>
        </tr>";
        }
        ?>

      </tbody>
    </table>
  </div>
  <hr>

  <!-- Javascript is here -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous">
    </script>

  <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script>
    let table = new DataTable('#myTable');
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element)=> {
      element.addEventListener("click", (e) => {
        console.log("edit", );
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title , description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element)=> {
      element.addEventListener("click", (e) => {
        console.log("edit", );
        sno = e.target.id.substr(1,)

        if(confirm("Are you sure you want to delete this note!")){
          console.log("yes")
          window.location = `/crud/crud.php?delete=${sno}`;
          //TODO: Create a form and use a post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>

</body>

</html>

<!-- 1) First Xampp server must need in this to run this file (apache and mysql server) -->
<!-- 2) To run the file go to c: drive then xampp document then htdocs now open folder(Crud) with vscode -->
<!-- 3) Xamp server phpmyadmin database name = "dbyash" Table = "trees" in which data stores--> 
<!-- 4) path of crud folder http://localhost/crud/crud.php -->
<!-- 5) localhost/crud/crud.php -->
