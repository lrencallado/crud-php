<?php
    require_once 'config/database.php';


        if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

            $id =  trim($_GET["id"]);

            $sql = "SELECT * FROM tbl_employee WHERE emp_id = ?";

            if($stmt = $conn->prepare($sql)){
                
                $stmt->bind_param("i", $paramID);

                $paramID = $id;
                
                if($stmt->execute()){
                    $result = $stmt->get_result();
                    
                    if($result->num_rows == 1){

                        $row = $result->fetch_array(MYSQLI_ASSOC);
                        
                        $name = $row["emp_name"];
                        $address = $row["emp_address"];
                        $contact = $row["emp_contact_no"];
                        $email = $row["emp_email"];
                        $dob = $row["emp_dob"];
                    } else{

                        echo "There is no record for this ID!";

                        exit();
                    }
                    
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
                $stmt->close();
            }
            
            $conn->close();
        }
        else{
            echo "Oops! Something went wrong. Please try again later.";
            exit();
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
            <header>
                <h1>Employee Database</h1>
            </header>
            <section id="content">
                <a class="btn" href="index.php"><i class="icon-arrow-left"></i> Back to list</a>
                <form class="form-horizontal">
                    <fieldset>
                        <legend>View '<?php echo $name; ?>'</legend>
                        <div class="control-group">
                            <label class="control-label">ID</label>
                            <div class="controls">
                                <span class="uneditable-input"><?php echo $id; ?></span>
                                <input type="hidden" id="name" name="id" value="<?php echo $id; ?>" readonly="" >
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="name">Name</label>
                            <div class="controls">
                                <input type="text" id="name" name="name" value="<?php echo $name; ?>" readonly="" maxlength="50">
                                <span class="help-block"><?php echo $nameErr;?></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="address">Address</label>
                            <div class="controls">
                                <textarea id="address" name="address" readonly=""><?php echo $address; ?></textarea>
                                <span class="help-block"><?php echo $addressErr;?></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="contact" >Contact Number</label>
                            <div class="controls">
                                <input type="text" id="contact" name="contact" value="<?php echo $contact; ?>" readonly="" maxlength="15">
                                <span class="help-block"><?php echo $contactErr;?></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="email">Email</label>
                            <div class="controls">
                                <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly="" maxlength="50">
                                <span class="help-block"><?php echo $emailErr;?></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="birthday">Date of Birth</label>
                            <div class="controls">
                                <input type="date" id="birthday" name="birthday" value="<?php echo $dob; ?>" readonly="">
                                <span class="help-block"><?php echo $dobErr;?></span>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-actions">
                    </div>
                </form>
            </section>
            <footer class="row show-grid">
                <div class="footer-text span12">
                    Copyright &copy; 2012 Sourcefit Philippines. All rights reserved
                </div>
            </footer>
        </div>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>