<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - MYSQL - CRUD</title>
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">PHP CRUD operations with MySQL</h2>

    <form name="student_form" action="adddata.php" method="post" class="mb-4" onsubmit = "return validateForm()">
        <div class="row">
            <div class="col-md-4">
                <label for="name" class="form-label">Student Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="grade" class="form-label">Grade</label>
                <select name="grade" id="grade" class="form-control" required>
                    <option value="">Select a Grade</option>
                    <option value="Grade 1">Grade 1</option>
                    <option value="Grade 2">Grade 2</option>
                    <option value="Grade 3">Grade 3</option>
                    <option value="Grade 4">Grade 4</option>
                    <option value="Grade 5">Grade 5</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="marks" class="form-label">Marks</label>
                <input type="text" name="marks" id="marks" class="form-control" required>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
    </form>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Student Name</th>
                <th>Grade</th>
                <th>Marks</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Post</th>
                <th>View Post</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once "conn.php";
            $sql_query = "SELECT * FROM results";
            if ($result = $conn->query($sql_query)) {
                while ($row = $result->fetch_assoc()) {
                    $Id = $row['id'];
                    $Name = $row['name'];
                    $Grade = $row['class'];
                    $Marks = $row['marks'];
                    ?>
                    <tr>
                        <td><?php echo $Id; ?></td>
                        <td><?php echo $Name; ?></td>
                        <td><?php echo $Grade; ?></td>
                        <td><?php echo $Marks; ?></td>
                        <td><a href="updatedata.php?id=<?php echo $Id; ?>" class="btn btn-primary btn-sm">Edit</a></td>
                        <td><a href="deletedata.php?id=<?php echo $Id; ?>" class="btn btn-danger btn-sm" onclick="return confirmDelete();">Delete</a></td>
                        <td><a href="postdata.php?id=<?php echo $Id; ?>" class="btn btn-success btn-sm">Post</td>
                        <td><a href="viewedata.php?id=<?php echo $Id; ?>" class="btn btn-secondary btn-sm">View Post</td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this record?");
    }

    function validateForm(){
        let x = document.forms['student_form']['marks'].value;
        if (!((x >= 65) && (x <= 100))) {
            alert("Invalid Grade!");
            return false;
        }
    }
</script>
</body>
</html>
