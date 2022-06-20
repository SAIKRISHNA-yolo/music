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
    <title>Music</title>

    <link href="https://getbootstrap.com//docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
    <link href="welcome.css" rel="stylesheet" />
    <style>

    </style>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" style="padding-left: 20px">
            <div class="container-fluid">
                <a class="navbar-brand" style="font-size: 28px;" href=""><?php echo ucfirst(userName()); ?></a>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0"></ul>
                    <form class="d-flex" style="padding-right: .1rem;" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                    </form>

                    <form class="d-flex" style="padding-right: .1rem;" method="post" action="newSong.php">
                        <button class="btn btn-outline-success" type="submit">
                            + Add Song
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main style="padding: 30px;">
        <!-- Three columns of text below the carousel -->
        <h1 style="padding-bottom: 20px; font-size: 50px;">Top 10 Songs</h1>
        <div class="row">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>Artwork</th>
                        <th>Song</th>
                        <th>Date of Release</th>
                        <th>Artists</th>
                        <th>Rate</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stm = $mysqli->query("SELECT *,(SELECT name FROM artists WHERE id=artist_id) AS artist FROM songs ORDER BY rate DESC LIMIT 10;");
                    while ($row = mysqli_fetch_array($stm)) {
                    ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="./images/<?php echo $row['artwork'] ?>" alt="" class="rounded-circle" />
                                </div>
                            </td>
                            <td>
                                <?php echo $row['name']; ?>
                            </td>
                            <td>
                                <?php echo date('F d, Y', strtotime($row['releaseDate']))?>
                            </td>
                            <td>
                                <?php echo $row['artist']; ?>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <?php if ($row['rate'] > 0) { ?>
                                        <span class="fa fa-star checked"></span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="fa fa-star"></span>
                                    <?php
                                    }
                                    if ($row['rate'] >= 1) {
                                    ?>
                                        <span class="fa fa-star checked"></span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="fa fa-star"></span>
                                    <?php
                                    }
                                    if ($row['rate'] >= 3) {
                                    ?>
                                        <span class="fa fa-star checked"></span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="fa fa-star"></span>
                                    <?php
                                    }
                                    if ($row['rate'] >= 4) {
                                    ?>
                                        <span class="fa fa-star checked"></span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="fa fa-star"></span>
                                    <?php
                                    }
                                    if ($row['rate'] == 5) {
                                    ?>
                                        <span class="fa fa-star checked"></span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="fa fa-star"></span>
                                    <?php
                                    } ?>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <hr class="featurette-divider" />

        <div class="row featurette">
            <h1 style="padding-bottom: 20px; font-size: 50px;">Top 10 Artists</h1>
            <div class="row">
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Artists</th>
                            <th>Date of Birth</th>
                            <th>Songs</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stm = $mysqli->query("SELECT *, (SELECT AVG(rate) FROM songs WHERE artist_id=artists.id ORDER BY artist_id) AS rate, (SELECT GROUP_CONCAT(name) FROM songs WHERE artist_id=artists.id) AS songs FROM `artists` ORDER BY rate DESC LIMIT 10");
                        while ($row = mysqli_fetch_array($stm)) { ?>
                        <tr>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo date('F d, Y', strtotime($row['dob']))?></td>
                            <td><?php
                            echo $row['songs'];
                            ?></td>
                        </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
</body>

</html>