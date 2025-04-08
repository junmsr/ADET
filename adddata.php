<?php
require_once "conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $class = $_POST['grade'];
    $marks = $_POST['marks'];

    if (!empty($name) && !empty($class) && !empty($marks)) {
        $sql = "INSERT INTO results (name, class, marks) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssi", $name, $class, $marks);
            if ($stmt->execute()) {
                header("Location: index.php");
                exit;
            } else {
                echo "Error executing query: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request.";
}
?>