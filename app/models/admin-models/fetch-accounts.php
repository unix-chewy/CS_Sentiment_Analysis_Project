<?php
include "../../config/login-config.php";

$sql = "SELECT 
            users.id,
            users.first_name,
            users.last_name,
            users.email,
            roles.role_name,
            (SELECT MAX(last_login) FROM activity_logs WHERE user_id = users.id) as last_login
        FROM users 
        LEFT JOIN roles ON users.role_id = roles.id 
        ORDER BY last_login DESC";
$result = $conn->query($sql);
$output = "";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $output .= "
            <tr>
                <td>" . htmlspecialchars($row['id']) . "</td>
                <td>" . htmlspecialchars($row['first_name']) . "</td>
                <td>" . htmlspecialchars($row['last_name']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['role_name']) . "</td>
                <td>" . htmlspecialchars($row['last_login']) . "</td>
                <!--<td>
                    <button class='btn btn-primary btn-sm edit-user' data-id='" . $row['id'] . "'>Edit</button>
                    <button class='btn btn-danger btn-sm delete-user' data-id='" . $row['id'] . "'>Delete</button>
                </td>-->
            </tr>";
    }
} else {
    $output = "<tr><td colspan='6' class='text-center'>No users found</td></tr>";
}

echo $output;
$conn->close();
?> 