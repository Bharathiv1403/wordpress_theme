<?php
// Set headers to allow cross-origin requests and return JSON responses
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

// Dummy data
$data = [
    ['id' => 1, 'name' => 'John Doe', 'email' => 'john.doe@example.com'],
    ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane.smith@example.com'],
    ['id' => 3, 'name' => 'Alice Johnson', 'email' => 'alice.johnson@example.com'],
];

// Helper function to send JSON response
function sendResponse($status, $data) {
    http_response_code($status);
    echo json_encode($data);
    exit;
}

// Process API request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // If ID is provided in the query, return a single user
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $user = array_filter($data, function ($item) use ($id) {
            return $item['id'] === $id;
        });

        if (!empty($user)) {
            sendResponse(200, array_values($user)[0]);
        } else {
            sendResponse(404, ['error' => 'User not found']);
        }
    } else {
        // Return all users
        sendResponse(200, $data);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode JSON input from POST request
    $input = json_decode(file_get_contents("php://input"), true);

    // Validate input
    if (!isset($input['name']) || !isset($input['email'])) {
        sendResponse(400, ['error' => 'Invalid input']);
    }

    // Add a new user to the data (dummy implementation)
    $newUser = [
        'id' => count($data) + 1,
        'name' => $input['name'],
        'email' => $input['email']
    ];
    $data[] = $newUser;

    // Return the newly created user
    sendResponse(201, $newUser);
} else {
    // If method is not GET or POST, return an error
    sendResponse(405, ['error' => 'Method not allowed']);
}
?>
