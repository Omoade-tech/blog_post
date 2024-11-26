<?php
include("config/blog_post_connet.php");
// write queries for all delicacies
$sqlQueries = 'SELECT tittle, content, id FROM blog_post ORDER BY created_at';

// get the result set
$Result = mysqli_query($connect, $sqlQueries);

// fetch the resulting rows as an array
$blog = mysqli_fetch_all($Result, MYSQLI_ASSOC);

// free the result from memory
mysqli_free_result($Result);

// close connection
mysqli_close($connect);
?>


<!DOCTYPE html>
<html lang="en">
    <style type="text/css">

        .line{
        
            width: 100%;
            /* background-color: aqua; */
            border: 1px solid black;
        }
        .post{
            text-decoration: none;
            color: #fff;
            background-color: cadetblue;
        }
        .welcome{
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            font-weight: 900;
            color: forestgreen;
            line-height: 2;
            padding: 15px;
        }
 
    </style>
    <?php
    include("templates/header.php");
    ?>
      <h6 class="welcome">
                        <span class="nav-link">Welcome <?= htmlspecialchars($name) ?></span>
    </h6>
    <h4 class="text-center text-priamary mb-4">
    <a href="add.php" class="btn btn-success text-white">Create a Post</a>
            
    </h4>

    <div class="container my-5">
    <div class="row g-4">
        <?php
        foreach($blog as $blogs):
        ?>
            <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card-body text-start">
                        <h6 class="card-title">
                            <?php echo htmlspecialchars($blogs['tittle']) ?>
                        </h6>
                        <p class="card-text text-secondary mb-3">
                                <?= substr(htmlspecialchars($blogs['content']), 0, 100); ?>...
                            </p>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-start">
                        <a href="details.php?id=<?php echo $blogs['id'] ?>" class="btn btn-secondary text-decoration-none ">
                            view details...
                        </a>
                        
                    </div>
                

            </div>
            <?php endforeach; ?>
    </div>
</div>
<div class="line"></div>


<?php
include("templates/footer.php");
?>

</html>
