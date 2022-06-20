<?php
// Initialize the session
require 'session.php';
require "config.php";
$val = isLoggedIn();

if ($val == false) {
  header("location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Music</title>

  <link href="https://getbootstrap.com//docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <link href="newSong.css" rel="stylesheet" />
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" style="padding-left: 20px">
      <div class="container-fluid">
        <a class="navbar-brand" style="font-size: 28px" href=""><?php echo ucfirst(userName()); ?></a>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0"></ul>
          <form class="d-flex" style="padding-right: .1rem;" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
          </form>

          <form class="d-flex" style="padding-right: .1rem;" role="search">
            <button class="btn btn-outline-success" type="submit">
              + Add Song
            </button>
          </form>
        </div>
      </div>
    </nav>
  </header>

  <main style="padding: 30px">
    <div class="container">
      <div class="py-5 text-center">
        <h2>Add a new Song</h2>
      </div>
    </div>
    <div class="container order-md-1">
      <form class="needs-validation" novalidate action="addMusic.php" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col mb-3">
            <label for="name">Song Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Song Name" required />
            <div class="invalid-feedback">
              Valid Song Name is required.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="date">Release Date</label>
          <div class="input-group">
            <input type="date" class="form-control" id="date" name="date" required />
            <div class="invalid-feedback" style="width: 100%">
              Release Date is required.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="image">Artwork</label>
          <div class="input-group">
            <input class="form-control" type="file" id="image" name="image">
          </div>
          <div class="invalid-feedback">
            Please enter a valid file addresss.
          </div>
        </div>

        <div class="mb-3">
          <label for="artist">Artists</label>
          <div class="input-group">
            <select class="custom-select" name="artist" id="artist" required>
              <option selected disabled>Choose...</option>
              <?php
              $stm = $mysqli->query("SELECT * FROM artists");
              while ($row = mysqli_fetch_array($stm)) {
                  ?>
                  <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option> 
                <?php
                }
              ?>
            </select>
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#modalLoginForm">Add New</button>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="rate">Rating</label>
          <div class="input-group">
            <select class="custom-select" name="rate" id="rate" required>
              <option selected value=0>0</option>
              <option value=1>1</option>
              <option value=2>2</option>
              <option value=3>3</option>
              <option value=4>4</option>
              <option value=5>5</option>
            </select>
          </div>
        </div>
        <button class="btn btn-primary" type="submit" name="addMusic">
          Save
        </button>
        <button class="btn btn-danger pull-center" type="reset">
          Clear
        </button>
        <button class="btn btn-secondary pull-right" type="reset" onclick="location.href='welcome.php'">
          Cancel
        </button>
      </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    </script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        "use strict";

        window.addEventListener(
          "load",
          function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName("needs-validation");

            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(
              forms,
              function(form) {
                form.addEventListener(
                  "submit",
                  function(event) {
                    if (form.checkValidity() === false) {
                      event.preventDefault();
                      event.stopPropagation();
                    }
                    form.classList.add("was-validated");
                  },
                  false
                );
              }
            );
          },
          false
        );
      })();
    </script>
  </main>

  <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold">Add Artist</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body mx-3">
          <div class="order-md-1">
            <form class="needs-validation" novalidate action="addArtist.php" method="post">
              <div class="row">
                <div class="col mb-3">
                  <label for="name">Artist Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Artist Name" required />
                  <div class="invalid-feedback">
                    Valid Artist Name is required.
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label for="dob">Date of Birth</label>
                <div class="input-group">
                  <input type="date" class="form-control" name="dob" id="dob" required />
                  <div class="invalid-feedback" style="width: 100%">
                    Date of Birth is required.
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label for="bio">Bio</label>
                <div class="input-group">
                  <input type="textarea" class="form-control" name="bio" id="bio" style="height: 100px" />
                </div>
              </div>
              <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                Cancel
              </button>
              <button class="btn btn-primary pull-right" type="submit">
                Add Artist
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>