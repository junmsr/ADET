<?php
require_once "conn.php";

$id = $_GET['id'];

// Fetch student info
$sql_query = "SELECT * FROM activity WHERE id = $id";
$result = $conn->query($sql_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Student Activity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Student Activity Details</h2>

    <?php if ($result && $result->num_rows > 0): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Activity</th>
                    <th>Marks</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['activity']); ?></td>
                    <td><?php echo htmlspecialchars($row['marks']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning">No activity found for this student.</div>
    <?php endif; ?>
</body>
</html>
