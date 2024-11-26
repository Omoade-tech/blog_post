<?php
include("config/blog_post_connet.php");

if (isset($_POST["update"])) {
    
    $id =  $_POST['id'];
    $tittle =  $_POST['tittle'];
    $content =  $_POST['content'];
    

    // Update query
    $sqlQueries = "UPDATE blog_post 
                   SET tittle = '$tittle', content = '$content'
                   WHERE id = $id";

    if (mysqli_query($connect, $sqlQueries)) {
        header('Location: index.php');
    
    } else {
        echo 'Query Error: ' . mysqli_error($connect);
    }

    // Close connection
    mysqli_close($connect);
}

if (isset($_GET['id'])) {
    // Escape SQL characters
    $id = mysqli_real_escape_string($connect, $_GET['id']);

    // Fetch record by ID
    $sqlQueries = "SELECT * FROM blog_post WHERE id = $id";

    $Result = mysqli_query($connect, $sqlQueries);
    if ($Result) {
        $blog = mysqli_fetch_assoc($Result);
        if ($blog) {
        
            $tittle = $blog['tittle'];
            $content = $blog['content'];
        } else {
          echo 'Query Error: ' . mysqli_error($connect);
        }
    } else {
        echo 'Query Error: ' . mysqli_error($connect);
    }

    // Close connection
    mysqli_close($connect);
}


?>


<!DOCTYPE html>
<html>
    <!-- <style>
        textarea {
            resize: none;
            width: 200px;
            height: 50px;

        }
    </style> -->
<?php include("templates/header.php"); ?>

<section class="container py-5">
    <h4 class="text-secondary text-center mb-4">
        Edit BlogPost
    </h4>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-body p-4">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <!-- Hidden ID Field -->
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

                        <div class="mb-3">
                            <label for="title" class="form-label">BlogPost Title
                            </label>
                            <input
                                type="text"
                                id="tittle"
                                name="tittle"
                                class="form-control"
                                value="<?php echo htmlspecialchars($tittle); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">BlogPost content</label>
                       
                            <textarea 
                            class="form-control"
                             name="content"
                              rows="3">
                              <?php 
                              echo htmlspecialchars($content); ?>
                              </textarea>

                       
                        </div>

                        <div class="text-center">
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("templates/footer.php"); ?>
</html>