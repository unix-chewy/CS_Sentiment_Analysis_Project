<?php
include "../../config/login-config.php";

// Get current page from request, default to 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 5;
$offset = ($page - 1) * $items_per_page;

// Base query for counting and fetching
$base_query = "FROM users 
        LEFT JOIN roles ON users.role_id = roles.id";

// Get total count of users
$count_query = "SELECT COUNT(*) as total " . $base_query;
$result_count = $conn->query($count_query);
$total_items = $result_count->fetch_assoc()['total'];
$total_pages = ceil($total_items / $items_per_page);

// Fetch users with pagination
$sql = "SELECT 
            users.id,
            users.first_name,
            users.last_name,
            users.email,
            roles.role_name,
            (SELECT MAX(last_login) FROM activity_logs WHERE user_id = users.id) as last_login
        " . $base_query . "
        ORDER BY last_login DESC
        LIMIT ? OFFSET ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $items_per_page, $offset);
$stmt->execute();
$result = $stmt->get_result();
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

// Add pagination info to the response
$pagination = [
    'current_page' => $page,
    'total_pages' => $total_pages,
    'total_items' => $total_items
];

echo json_encode([
    'html' => $output,
    'pagination' => $pagination
]);

$conn->close();
?> 