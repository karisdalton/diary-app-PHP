<?php

include('./config/db_connect.php');

$username = $event_name = $descriptions = '';

$errors = array('username' => '', 'event_name' => '', 'descriptions' => '');

if (isset($_POST['submit'])) {
    // check event_name
    if (empty($_POST['event_name'])) {
        $errors['event_name'] = 'An event name is required <br/>';
    } else {
        $event_name = $_POST['event_name'];
        if (!preg_match("/^[a-zA-Z\s]*$/", $event_name)) {
            $errors['event_name'] = 'Event must letters and spaces only';
        }
    }

    // check username
    if (empty($_POST['username'])) {
        $errors['username'] = 'A username is required <br/>';
    } else {
        $username = $_POST['username'];
        if (!preg_match("/^[a-zA-Z\s]*$/", $event_name)) {
            $errors['username'] = 'Username must letters and spaces only';
        }
    }

    // check description
    if (empty($_POST['descriptions'])) {
        $errors['descriptions'] = 'A description is required <br/>';
    } else {
        $event_name = $_POST['descriptions'];
        if (!preg_match("/^[a-zA-Z\s]*$/", $event_name)) {
            $errors['descriptions'] = 'Description must letters and spaces only';
        }
    }

    if (array_filter($errors)) {
        // echo errors in the form
    } else {

        $event_name = mysqli_real_escape_string($conn, $_POST['event_name']);
        $descriptions = mysqli_real_escape_string($conn, $_POST['descriptions']);

        // sql
        $sql = "INSERT INTO diaries(username,event_name,descriptions) VALUES('$username', '$event_name', '$descriptions')";

        // save to database
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php');
        } else {
            echo 'Query error: ' . mysqli_error($conn);
        }
    }
} // end of post request



?>

<!DOCTYPE html>
<html lang="en">

<?php include('./templates/header.php') ?>

<section class="container blue-text">
    <h4 class="center">Add Event</h4>
    <div class="row">
        <form action="addEvent.php" method="POST" class="white">
            <div class="row">
                <div class="input-field">
                    <input type="text" class="validate" name="username" value="<?php echo htmlspecialchars($username) ?>">
                    <div class="red-text"><?php echo $errors['username']; ?></div>
                    <label for="username">Username</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field">
                    <input type="text" class="validate" name="event_name" value="<?php echo htmlspecialchars($event_name) ?>">
                    <div class="red-text"><?php echo $errors['event_name']; ?></div>
                    <label for="username">event name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field">
                    <textarea type="text" class="validate materialize-textarea" name="descriptions" value="<?php echo htmlspecialchars($descriptions) ?>"></textarea>
                    <div class="red-text"><?php echo $errors['descriptions']; ?></div>
                    <label for="username">description</label>
                </div>
            </div>
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </div>
</section>

<?php include('./templates/footer.php') ?>

<script src="assets/materialize/js/materialize.min.js"></script>

</html>