<?php

include('./config/db_connect.php');

// query for all events
$sql = "SELECT username, event_name, descriptions, created_at, id FROM diaries ORDER BY created_at";

// query for results
$results = mysqli_query($conn, $sql);

// fectch results
$diaries = mysqli_fetch_all($results, MYSQLI_ASSOC);

// free results
mysqli_free_result($results);

// close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<?php include('./templates/header.php') ?>

<h4 class="center blue-text">My Diaries</h4>
<div class="container">
    <div class="row">

        <?php foreach ($diaries as $diary) : ?>

            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <span class="card-title left-align"><?php echo htmlspecialchars($diary['event_name']) ?></span>
                        <a href="details.php?id=<?php echo $diary['id']; ?>" class="btn-floating halfway-fab waves-effect waves-light blue"><i class="material-icons" title="more info">add</i></a>
                        <h6><?php echo htmlspecialchars($diary['username']) ?></h6>
                        <h6><?php echo htmlspecialchars($diary['descriptions']) ?></h6>
                        <span><?php echo htmlspecialchars($diary['created_at']) ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>


<?php include('./templates/footer.php') ?>

<script src="assets/materialize/js/materialize.min.js"></script>

</html>