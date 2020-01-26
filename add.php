<?php
    require_once 'config/database.php';
    $name = $address = $contact = $email = $dob = '';
    $nameErr = $addressErr = $contactErr = $emailErr = $dobErr = '';
                    
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //Validate Name
        $inputName = trim($conn->real_escape_string($_POST['name']));

        if(empty($inputName)){
            $nameErr = 'Please enter your name.';

        }
        else if(!filter_var($inputName, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp'=>'/^[a-zA-Z\s]+$/')))){
            $nameErr = 'Please enter a valid name.';
        }
        else{
            $name = $inputName;
        }

        //Validate Address
        $inputAddress = trim($conn->real_escape_string(($_POST['address'])));

        if(empty($inputAddress)){
            $addressErr = 'Please enter your address.';
        }
        else{
            $address = $inputAddress;
        }

        //Validate Address
        $inputContact = trim($conn->real_escape_string($_POST['contact']));

        if(empty($inputContact)){
            $contactErr = 'Please enter your contact number.';
        }
        else{
            $contact = $inputContact;
        }

        //Validate Address
        $inputEmail = trim($conn->real_escape_string($_POST['email']));

        if(empty($inputEmail)){
            $emailErr = 'Please enter your email address.';
        }
        else{
            $email = $inputEmail;
        }

        //Validate Address
        $inputDob= trim($conn->real_escape_string($_POST['birthday']));

        if(empty($inputDob)){
            $dobErr = 'Please enter your birthday.';
        }
        else{
            $dob = $inputDob;
        }


        if(empty($nameErr) && empty($addressErr) && empty($contactErr) && empty($emailErr) && empty($dobErr)){
            $sql = 'INSERT INTO tbl_employee (emp_name, emp_address, emp_contact_no, emp_email, emp_dob, date_created) VALUES (?, ?, ?, ?, ?, ?)';

            if($stmt = $conn->prepare($sql)){
                $stmt->bind_param('ssssss', $paramName, $paramAddress, $paramContactNo, $paramEmail, $paramDob, $paramDateCreated);

                $paramName = $name;
                $paramAddress = $address;
                $paramContactNo = $contact;
                $paramEmail = $email;
                $paramDob = $dob;
                $paramDateCreated = date('Y-m-d h:i:s');
                //$paramDateUpdated = date('Y-m-d h:i:s');

                if($stmt->execute()){
                    header('location: index.php');
                    exit();
                }
                else{
                    echo 'Something went wrong. Please try again later.';
                    //print_r($stmt->error);
                }
            }
            $stmt->close();
        }

        $conn->close();


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
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="form-horizontal">
                    <fieldset>
                        <legend>Add Record</legend>
                        <div class="control-group">
                            <label class="control-label" for="name">Name</label>
                            <div class="controls">
                                <input type="text" id="name" name="name" required="" maxlength="50" value="<?php echo $name;?>">
                                <span class="help-block"><?php echo $nameErr;?></span>
                            </div>
                        </div>                
                        <div class="control-group">
                            <label class="control-label" for="address">Address</label>
                            <div class="controls">
                                <textarea id="address" name="address" required=""> <?php echo $address;?></textarea>
                                <span class="help-block"><?php echo $addressErr;?></span>
                            </div>
                        </div>                
                        <div class="control-group">
                            <label class="control-label" for="contact" >Contact Number</label>
                            <div class="controls">
                                <input type="text" id="contact" name="contact" required="" value="<?php echo $contact;?>" maxlength="15">
                                <span class="help-block"><?php echo $contactErr;?></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="email" maxlength="50">Email</label>
                            <div class="controls">
                                <input type="email" id="email" name="email" required="" value="<?php echo $email;?>">
                                <span class="help-block"><?php echo $emailErr;?></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="birthday">Date of Birth</label>
                            <div class="controls">
                                <input type="date" id="birthday" name="birthday" required="" value="<?php echo $dob;?>">
                                <span class="help-block"><?php echo $dobErr;?></span>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-actions">
                        <input type="submit" name="add" id="add" value="Add" class="btn btn-primary btn-large">
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