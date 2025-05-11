<?php include "../../config/login-config.php";

// This is a model page for fetching products to be put into display within the view item modal
// Reused code just modified 

// Get current page from request, default to 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$items_per_page = 5;
$offset = ($page - 1) * $items_per_page;

// Base query for counting and fetching
$base_query = "FROM products p
               LEFT JOIN categories c ON c.id = p.category_id
               WHERE 1=1";

// Add search condition if search term exists
if (!empty($search)) {
    $search_condition = " AND (p.name LIKE ? OR p.description LIKE ?)";
    $base_query .= $search_condition;
}

// Get total count of products
$count_query = "SELECT COUNT(*) as total " . $base_query;
$stmt_count = $conn->prepare($count_query);

if (!empty($search)) {
    $search_param = "%$search%";
    $stmt_count->bind_param("ss", $search_param, $search_param);
}

$stmt_count->execute();
$total_items = $stmt_count->get_result()->fetch_assoc()['total'];
$total_pages = ceil($total_items / $items_per_page);

// Fetch products with pagination
$query = "SELECT
            p.id,
            p.name,
            p.photo,
            p.description,
            p.price,
            c.product_category
        " . $base_query . "
        ORDER BY p.id ASC
        LIMIT ? OFFSET ?";

$stmt = $conn->prepare($query);

if (!empty($search)) {
    $search_param = "%$search%";
    $stmt->bind_param("ssii", $search_param, $search_param, $items_per_page, $offset);
} else {
    $stmt->bind_param("ii", $items_per_page, $offset);
}

$stmt->execute();
$result = $stmt->get_result();
$output = "";

while ($row = $result->fetch_assoc()) {
    $output .= "
        <tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['photo']}</td>
            <td>{$row['description']}</td>
            <td>{$row['price']}</td>
            <td>{$row['product_category']}</td>
            <td>
                <button class='btn btn-secondary btn-edit' data-bs-toggle='modal' data-bs-target='#editModal' data-id='{$row['id']}' data-name='{$row['name']}' data-photo='{$row['photo']}' 
                data-description='{$row['description']}' data-price='{$row['price']}' data-category='{$row['product_category']}'> Edit </button>
                <button class='btn btn-primary' id='btn-delete' data-id='{$row['id']}'>Delete</button>
            </td>
        </tr>";
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
?>