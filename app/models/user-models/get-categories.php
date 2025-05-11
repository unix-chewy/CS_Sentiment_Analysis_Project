<?php
include '../../config/login-config.php';


$sql_category = "SELECT id, product_category FROM categories";
$stmt_category = $conn->prepare($sql_category);
$stmt_category->execute();
$result_category = $stmt_category->get_result();

$checkboxesHtml = '';

// Categories and Checkbox
while ($row = $result_category->fetch_assoc()) {
    if (trim($row['product_category']) === "New Category") {
        continue;
    }
    $checkboxesHtml .= '<div class="form-check">';
    $checkboxesHtml .= '<input class="form-check-input" type="checkbox" value="' . $row['id'] . '" id="category-' . $row['id'] . '">';
    $checkboxesHtml .= '<label class="form-check-label" for="category-' . $row['id'] . '">' . $row['product_category'] . '</label>';
    $checkboxesHtml .= '</div>';
}

echo $checkboxesHtml;
?>
