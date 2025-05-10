<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputted_word = trim(strtolower($_POST['word']));
    $type = $_POST['type'];
    $action = $_POST['action'];

    // Validate input
    if (empty($inputted_word)) {
        $message = "Word cannot be empty";
    } else {
        $root = $_SERVER['DOCUMENT_ROOT'] . '/CS_Sentiment_Analysis_Project/public/assets/lexicon-files/';
        if ($type === 'positive') {
            $file = $root . 'positive-words.txt';
        } else {
            $file = $root . 'negative-words.txt';
        }

        if (!file_exists($file)) {
            echo "<script>alert('File does not exist: $file'); window.location.href='../../views/admin/admin-functionalities/lexicon-management.php';</script>";
            exit;
        }

        // Read current words
        $words = file_get_contents($file);
        $words = explode("\n", $words);

        if ($action === 'add') {
            if (in_array($inputted_word, $words)) {
                $message = "The Inputted Word Already Exists in the Lexicon";
            } else {
                $words[] = $inputted_word;
                sort($words);
                if (file_put_contents($file, implode("\n", $words))) {
                    $message = "Word added successfully!";
                } else {
                    $message = "Failed to add word (path: $file)";
                }
            }
        } else if ($action === 'delete') {
            if (!in_array($inputted_word, $words)) {
                $message = "The Inputted Word Does Not Exist in the Lexicon";
            } else {
                $words = array_diff($words, [$inputted_word]);
                sort($words);
                if (file_put_contents($file, implode("\n", $words))) {
                    $message = "Word deleted successfully";
                } else {
                    $message = "Failed to delete word (path: $file)";
                }
            }
        }
    }
    // Output alert and redirect
    echo "<script>alert('{$message}'); window.location.href='../../views/admin/admin-functionalities/lexicon-management.php';</script>";
    exit();
}
?> 