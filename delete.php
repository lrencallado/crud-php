<?php
	if(isset($_POST["id"]) && !empty($_POST["id"])){
	    
	    require_once "config/database.php";
	    

	    $sql = "DELETE FROM tbl_employee WHERE emp_id = ?";
	    
	    if($stmt = $conn->prepare($sql)){
	        // Bind variables to the prepared statement as parameters
	        $stmt->bind_param("i", $paramID);
	        
	        // Set parameters
	        $paramID = trim($_POST["id"]);
	        
	        // Attempt to execute the prepared statement
	        if($stmt->execute()){
	            // Records deleted successfully. Redirect to landing page
	            header("location: index.php");
	            exit();
	        } else{
	            echo "Oops! Something went wrong. Please try again later.";
	            print_r($stmt->error);
	        }
	        $stmt->close();
	    }
	     
	    
	    
	    $conn->close();
	}
	else{

	    // Check existence of id parameter
	    if(empty(trim($_GET["id"]))){
	        // URL doesn't contain id parameter. Redirect to error page
	        echo "Oops! Something went wrong. Please try again later.";
	
	        exit();
	    }
	}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Web Developer Exam | Sourcefit Philippines</title>
        <meta charset="utf-8">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sourcefit.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <section id="content">
            	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="alert alert-danger fade in">
                        <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Are you sure you want to delete this record?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="index.php" class="btn btn-default">No</a>
                            </p>
                    </div>
                </form>
            </section>
    </body>
</html>



