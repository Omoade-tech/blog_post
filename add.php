<?php
include('config/blog_post_connet.php');

 $tittle = $content = '';

$errors = [ 'tittle' => '', 'content' => '',];

if (isset($_POST['submit'])) {


    // check the title
    if (empty($_POST['tittle'])) {
        $errors['tittle'] = 'Title must be input';
    } else {
        $tittle = $_POST['tittle'];

        if (!preg_match('/^[a-zA-Z\s]+$/', $tittle)) {
            $errors['tittle'] = 'tittle must contain letters and spaces';
        }
    }


    // check the ingredients
    if (empty($_POST['content'])) {
        $errors['content'] = 'content is required';
    } else {
        $content = $_POST['content'];

        if (!preg_match('/^[a-zA-Z\s]+$/', $content)) {
            $errors['content'] = 'content must contain letters and spaces';
        }
    }

    if (array_filter($errors)) {
        // echo errors in the form
    } else {
        // escape sql charts
        $tittle = mysqli_real_escape_string($connect, $_POST['tittle']);
        $content = mysqli_real_escape_string($connect, $_POST['content']);

        // create sql queries

        $sqlQueries = "INSERT INTO blog_post(tittle, content) VALUES ('$tittle',  '$content')";

        // save to database and check

        if (mysqli_query($connect, $sqlQueries)) {
            // success

            header("location: index.php");
        } else {
            echo 'Query Error: ' . mysqli_error($connect);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>

<section class="container py-5">
    <h4 class="text-seondary text-center mb-4">
        Create a BlogPost in the form below
    </h4>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-body p-4">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                   



                        <div class="mb-3">
                            <label for="tittle" class="form-label">
                                BlogPost Title
                            </label>

                            <input
                                type="text"
                                id="tittle"
                                name="tittle"
                                class="form-control"
                                value="<?php echo htmlspecialchars($tittle) ?>">

                            <div class="text-danger">
                                <?php echo $errors['tittle'] ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">
                                BlogPost Content
                            </label>

                            <textarea
                                type="text"
                                id="content"
                                name="content"
                                class="form-control"
                                value="<?php echo htmlspecialchars($content) ?>">

                            </textarea>

                            <div class="text-danger">
                                <?php echo $errors['content'] ?>
                            </div>
                        </div>

                        <div class="text-center">
                            <button name="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>