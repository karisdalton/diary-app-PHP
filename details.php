<?php 

    include('./config/db_connect.php');

    if (isset($_POST['delete'])) {
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM diaries WHERE id = $id_to_delete";

        if (mysqli_query($conn, $sql)) {
            header('Location: index.php');
        }else {
            echo 'Query error: ' . mysqli_error($conn);
        }
    }

    // check GET request id parameter
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        // sql
        $sql = "SELECT * FROM diaries WHERE id = $id";

        // get query results
        $result = mysqli_query($conn, $sql);

        // fetch result in array format
        $diary = mysqli_fetch_assoc($result);

        // free and close
        mysqli_free_result($result);
        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
<html lang="en">

    <?php include('./templates/header.php') ?>

        <div class="container center blue-text">
            <?php if($diary): ?>

                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <div class="card-content center">
                            <h4><?php echo htmlspecialchars($diary['event_name']) ?></h4>
                            <p>Created by: <?php echo htmlspecialchars($diary['username']) ?></p>
                            <p><?php echo date($diary['created_at']); ?></p>
                            <h5>Description:</h5>
                            <p><?php echo htmlspecialchars($diary['descriptions']); ?></p>
                        </div>

                        <!-- delete form -->
                        <form action="details.php" method="POST">
                            <input type="hidden" name="id_to_delete" value="<?php echo $diary['id'] ?>">
                            <input type="submit" name="delete" value="delete" class="btn brand z-depth-0">
                        </form>
                    </div>
                </div>

            <?php else: ?>

                <h5>No such entry exists!!!</h5>

            <?php endif; ?>
        </div>

    <?php include('./templates/footer.php') ?>


</html>