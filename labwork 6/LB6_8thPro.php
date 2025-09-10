<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Inventory Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            max-width: 800px;
        }
        h1, h2 {
            color: #2c3e50;
            border-bottom: 2px solid #2980b9;
            padding-bottom: 8px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #bbb;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #2980b9;
            color: white;
        }
        .query-result {
            margin-top: 20px;
            padding: 15px;
            background: #ecf0f1;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<h1>Inventory Management System</h1>

<?php
// Inventory associative array: Each item is keyed by an ID with details as associative array
$inventory = [
    101 => ['name' => 'Laptop', 'category' => 'Electronics', 'quantity' => 15, 'price' => 850],
    102 => ['name' => 'Desk Chair', 'category' => 'Furniture', 'quantity' => 30, 'price' => 120],
    103 => ['name' => 'Pen Set', 'category' => 'Stationery', 'quantity' => 200, 'price' => 5],
    104 => ['name' => 'Smartphone', 'category' => 'Electronics', 'quantity' => 25, 'price' => 600],
];

// Function to add new item to inventory
function addItem(&$inventory, $id, $name, $category, $quantity, $price) {
    if (isset($inventory[$id])) {
        return "Item with ID $id already exists.";
    }
    $inventory[$id] = [
        'name' => $name,
        'category' => $category,
        'quantity' => $quantity,
        'price' => $price
    ];
    return "Item '$name' added successfully.";
}

// Function to update quantity of an item
function updateQuantity(&$inventory, $id, $newQuantity) {
    if (!isset($inventory[$id])) {
        return "Item with ID $id not found.";
    }
    $inventory[$id]['quantity'] = $newQuantity;
    return "Quantity for item ID $id updated to $newQuantity.";
}

// Function to get items by category
function getItemsByCategory($inventory, $category) {
    $results = [];
    foreach ($inventory as $id => $item) {
        if (strcasecmp($item['category'], $category) === 0) {
            $results[$id] = $item;
        }
    }
    return $results;
}

// Function to search items by name keyword (case-insensitive)
function searchItemsByName($inventory, $keyword) {
    $results = [];
    foreach ($inventory as $id => $item) {
        if (stripos($item['name'], $keyword) !== false) {
            $results[$id] = $item;
        }
    }
    return $results;
}

// Function to display inventory table
function displayInventory($inventory) {
    if (empty($inventory)) {
        echo "<p>No items found.</p>";
        return;
    }

    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Category</th><th>Quantity</th><th>Price ($)</th></tr>";
    foreach ($inventory as $id => $item) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($id) . "</td>";
        echo "<td>" . htmlspecialchars($item['name']) . "</td>";
        echo "<td>" . htmlspecialchars($item['category']) . "</td>";
        echo "<td>" . htmlspecialchars($item['quantity']) . "</td>";
        echo "<td>" . number_format($item['price'], 2) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

// Demonstration of functions

echo "<h2>Full Inventory</h2>";
displayInventory($inventory);

// Add a new item
echo "<h2>Adding New Item</h2>";
$msg = addItem($inventory, 105, 'Notebook', 'Stationery', 150, 3.5);
echo "<p>$msg</p>";

// Update quantity
echo "<h2>Updating Quantity</h2>";
$msg = updateQuantity($inventory, 102, 45);
echo "<p>$msg</p>";

// Query by category
echo "<h2>Items in Category: Electronics</h2>";
$electronics = getItemsByCategory($inventory, 'Electronics');
displayInventory($electronics);

// Search by name
echo "<h2>Search Items by Keyword: 'note'</h2>";
$searchResults = searchItemsByName($inventory, 'note');
displayInventory($searchResults);

?>

</body>
</html>