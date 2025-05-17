<?php
    require_once 'conn.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $activity = $_POST['activity'];
            $marks = $_POST['marks'];
            $id = $_GET['id'];

            mysqli_query($conn, "INSERT INTO activity (activity, marks, results_id) VALUES ('$activity', '$marks', '$id')");

            $result = mysqli_query($conn, "SELECT AVG(marks) AS average FROM activity WHERE results_id = $id");
            $avg = round(mysqli_fetch_assoc($result)['average']);

            mysqli_query($conn, "UPDATE results SET marks = $avg WHERE id = $id");
            $message = "Activity posted successfully, and average marks updated.";
        }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Post Activity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header">
            <h2>Post</h2>
        </div>
        <div class="card-body">
            <?php if (!empty($message)): ?>
                <div class="alert alert-info"><?php echo $message; ?></div>
            <?php endif; ?>
            <div class="mb-3">
                <?php
                require_once "conn.php";
                $sql_query = "SELECT * FROM results WHERE id=" . $_GET["id"];
                if ($result = $conn->query($sql_query)) {
                    while ($row = $result->fetch_assoc()) {
                        $Id = $row["id"];
                        $Name = $row["name"];
                        $Grade = $row["class"];
                        $Marks = $row["marks"];
                    }
                }
                ?>
                <strong>Name: <?php echo $Name; ?></strong>
                <br>
                <strong>Grade: <?php echo $Grade; ?></strong>
                <br>
                <strong>Marks: <?php echo $Marks; ?></strong>
                <br>
            </div>
            <form method="POST" action="" name="student_form" onsubmit="return validateForm()">
                <div class="mb-3">
                    <label class="form-label">Activity</label>
                    <input type="text" name="activity" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Marks</label>
                    <input type="text" name="marks" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Post</button>
                <a href="index.php" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
</body>

<script src="validate.js"></script>
<!-- <script>
    function calculateAverage() {
        var marks = document.getElementsByName('marks[]');
        var total = 0;
        var count = 0;
        for (var i = 0; i < marks.length; i++) {
            if (marks[i].value) {
                total += parseFloat(marks[i].value);
                count++;
            }
        }
        var average = total / count;
        var formattedAverage = average.toFixed(2);
    }
</script> -->
</html>