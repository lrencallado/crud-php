<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Web Developer Exam | Sourcefit Philippines</title>
        <meta charset="utf-8">
        <!-- Bootstrap -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sourcefit.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <header>
                <h1>Employee Database</h1>
            </header>
            <section id="content">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php

                require_once 'config/database.php';

                $sql = 'SELECT * FROM tbl_employee';
                if($result = $conn->query($sql)){
                    if($result->num_rows > 0){
                        while($row = $result->fetch_array()){
                            echo '<tr>';
                            echo '<td>'.$row["emp_id"].'</td>';
                            echo '<td>'.$row["emp_name"].'</td>';
                            echo '<td>'.$row["emp_address"].'</td>';
                            echo '<td>'.$row["emp_contact_no"].'</td>';
                            echo '<td>'.$row["emp_email"].'</td>';
                            echo '<td >'.$row["emp_dob"].'</td>';
                            echo '<td>
                                    <div class="btn-group">
                                        <a class="btn btn-small" href="display.php?id='.$row['emp_id'].'"><i class="icon-eye-open"></i> View</a>
                                        <a class="btn btn-small" href="edit.php?id='.$row['emp_id'].'"><i class="icon-edit"></i> Edit</a>
                                        <a class="btn btn-small" href="delete.php?id='.$row['emp_id'].'"><i class="icon-trash"></i> Delete</a>
                                    </div>
                                </td>';
                        }
                        $result->free();

                    }
                    else{
                        echo '<tr>
                                <td colspan="7">
                                    <p class="lead" style="text-align:center;"><em>No records were found.</em></p>
                                </td>
                            </tr>';

                    }
                }
                else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                }
                $conn->close();
                
                ?>
                    </tbody>
                </table>
                <div class="row-fluid">
                    <a href="add.php" class="btn"><i class="icon-plus"></i> Add Record</a>
                </div>
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