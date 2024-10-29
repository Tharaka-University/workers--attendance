<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $attendanceData = $_POST['attendance'];
    foreach ($attendanceData as $employeeId => $days) {
        foreach ($days as $day => $status) {
            if (in_array($status, ['P', 'A', 'L'])) {
                $date = date('Y') . "-02-" . str_pad($day, 2, '0', STR_PAD_LEFT); // February dates
                $stmt = $conn->prepare("INSERT INTO attendance_records (employee_id, date, status) VALUES (?, ?, ?)");
                $stmt->bind_param("iss", $employeeId, $date, $status);
                $stmt->execute();
                $stmt->close();
            }
        }
    }
    echo "Attendance recorded successfully!";
}

$conn->close();
?>
