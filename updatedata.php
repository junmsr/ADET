<!DOCTYPE html>
<html lang="en">
<?php
require_once "conn.php";

if(isset($_POST["name"]) && isset($_POST["grade"]) && isset($_POST["marks"])){

    $name = $_POST["name"];
    $grade = $_POST["grade"];
    $marks = $_POST["marks"];

    $sql = "UPDATE results SET `name`= '$name', `class`= '$grade', `marks`= $marks WHERE id=".$_GET["id"];

    if ($conn->query($sql)) {
        header("Location: index.php");
    } else {
        echo "Something went wrong. Please try again later.";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - MYSQL - CRUD</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <section>
        <div style="text-align: center; margin: 50px 0;">Update Data</div>
        <div class="container">
            <div class="row">
                <?php
                require_once "conn.php";
                $sql_query = "SELECT * FROM results WHERE id=".$_GET["id"];
                if ($result = $conn->query($sql_query)) {
                    while ($row = $result->fetch_assoc()) {
                        $Id = $row["id"];
                        $Name = $row["name"];
                        $Grade = $row["class"];
                        $Marks = $row["marks"];
                ?>
                    <form name = "student_form" action="updatedata.php?id=<?php echo $Id; ?>" method="post" onsubmit = "return validateForm()">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="name">Student Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="<?php echo $Name; ?>" required>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="grade">Grade</label>
                                <select name="grade" id="grade" class="form-control" required>
                                    <option value="">Select a Grade</option>
                                    <option value="Grade 6" <?php if($Grade == "grade6") { echo "selected"; } ?>>Grade 6</option>
                                    <option value="Grade 7" <?php if($Grade == "grade7") { echo "selected"; } ?>>Grade 7</option>
                                    <option value="Grade 8" <?php if($Grade == "grade8") { echo "selected"; } ?>>Grade 8</option>
                                    <option value="Grade 9" <?php if($Grade == "grade9") { echo "selected"; } ?>>Grade 9</option>
                                    <option value="Grade 10" <?php if($Grade == "grade10") { echo "selected"; } ?>>Grade 10</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="marks">Marks</label>
                                <input type="text" name="marks" id="marks" class="form-control" value="<?php echo $Marks; ?>" required>
                            </div>
                            <div class="form-group col-lg-2" style="display: grid; align-items: flex-end;">
                                <input type="submit" name="submit" class="btn btn-primary" value="Update">
                            </div>
                        </div>
                    </form>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <script src = "validate.js"></script>
</body>
</html>
