<?php
include("config/blog_post_connet.php");

if (isset($_POST["delete"])) {
    $id_to_delete = mysqli_real_escape_string($connect, $_POST["id_to_delete"]);

    $sqlQueries = "DELETE FROM blog_post WHERE id = $id_to_delete";

    if (mysqli_query($connect, $sqlQueries)) {
        header('Location: index.php');
    } else {
        echo 'Query Error: ' . mysqli_error($connect);
    }
}

//check get request id param
if (isset($_GET['id'])) {
    //escape sql characters
    $id = mysqli_real_escape_string($connect, $_GET['id']);

    //make sql
    $sqlQueries = "SELECT * FROM blog_post WHERE id = $id";

    //get the query result
    $Result = mysqli_query($connect, $sqlQueries);

    //fetch the result in array format
    $blog = mysqli_fetch_assoc(result: $Result);

    //free the memory
    mysqli_free_result($Result);


    //close the connection
    mysqli_close($connect);
}
?>

<!DOCTYPE html>
<html>
    <style>
        .row{
            width: 50%;
            justify-content: center;
            align-items: center;
            
        }

    </style>

<?php include("templates/header.php"); ?>
<div class="cointainer text-center my-5">
    <?php
    if (isset($blog)) {
        if ($blog) {
            // if delecacies exists
    ?>
            <h4><?php echo $blog['tittle']; ?></h4>
          

            <div class="row mb-4 mx-auto">
                <div class="col text-align-center">
                    <h5 class="text-secondary">
                        content
                    </h5>
                    <p class="blog-content"><?php echo $blog['content'] ?> </p>
                </div>
            </div>
          

         


            <p>
                Created at <span class="fw-bold"> <?php echo date($blog['created_at']); ?>
                </span>
            </p>

            <!-- Deletion -->
            <form action="details.php" method="POST" onsubmit="return confirmDelete()">
                <input type="hidden" name="id_to_delete" value="<?php echo $blog['id']; ?>" />
                <input type="submit" name="delete" value="Delete" class="btn btn-danger" />
                <input type="hidden" name="id_to_edit" value="<?php echo $blog['id']; ?>" />
                <!-- <button type="edit" name="edit" value="edit" class="btn btn-success">
                    <a href="edit.php">EDIT</a></button> -->
            </form>
            <a href="edit.php?id=<?php echo $blog['id']; ?>" method="POST" name="id_to_update" class="edit_btn btn btn-primary" value="">Edit</a>
        <?php

        } else {
            //if delicacies does not exist
        ?>
            <div class="alert alert-warning" role="alert">
                <i class="bi 🔺m-2"></i>
                No such blog post exists
            </div>
        <?php
        }
    } else {
        //if no id is provided

        ?>
        <div class="alert alert-warning" role="alert">
            <i class="bi 🔺m-2"></i>
            No blog post ID provided
        </div>
    <?php
    }
    ?>
</div>

<!--Add a JS confirm dialog  -->
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this BlogPost? This action cannot be undone!.")
    }
</script>


<?php include("templates/footer.php"); ?>

</html>