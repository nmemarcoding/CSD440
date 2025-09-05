<?php
/* 
File: Nima_Customers.php
Author: Nima Memarzadeh
Date: 2025-09-4
Description:
- Create an array of customers (at least 10).
- Display all customers.
- Allow the user to search by:
    1) First Name
    2) Last Name
    3) Age Range
    4) Phone Area Code
- Use array methods (like array_filter) to find results.
- Styled with simple CSS for readability.
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nima Customers</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f8f8f8; }
        h1, h2, h3 { color: #333; }
        .customer-box { background: #fff; border: 1px solid #ccc; padding: 8px; margin: 4px 0; border-radius: 4px; }
        form { background: #fff; border: 1px solid #ccc; padding: 10px; margin: 10px 0; border-radius: 4px; }
        input[type=text], input[type=number] { padding: 5px; margin: 5px; border: 1px solid #aaa; border-radius: 3px; }
        input[type=submit] { padding: 6px 12px; background: #4CAF50; color: white; border: none; border-radius: 3px; cursor: pointer; }
        input[type=submit]:hover { background: #45a049; }
        hr { margin: 25px 0; }
    </style>
</head>
<body>

<h1>Customer Directory</h1>

<?php
// Customer data
$customers = array(
    array("first" => "Nima", "last" => "Memarzadeh", "age" => 27, "phone" => "402-555-1000"),
    array("first" => "Ava", "last" => "Karimi", "age" => 31, "phone" => "402-555-1001"),
    array("first" => "Omid", "last" => "Rahmani", "age" => 29, "phone" => "531-555-2002"),
    array("first" => "Leila", "last" => "Jafari", "age" => 22, "phone" => "531-555-2003"),
    array("first" => "Reza", "last" => "Azizi", "age" => 35, "phone" => "402-555-1004"),
    array("first" => "Sara", "last" => "Abbasi", "age" => 28, "phone" => "402-555-1005"),
    array("first" => "Arman", "last" => "Farahani", "age" => 40, "phone" => "531-555-2006"),
    array("first" => "Mina", "last" => "Shirazi", "age" => 26, "phone" => "402-555-1007"),
    array("first" => "Kian", "last" => "Esfandiari", "age" => 33, "phone" => "531-555-2008"),
    array("first" => "Shirin", "last" => "Hosseini", "age" => 30, "phone" => "402-555-1009")
);

// Display function
function showCustomer($c) {
    echo "<div class='customer-box'>";
    echo htmlspecialchars($c["first"] . " " . $c["last"]) . " | Age: " . $c["age"] . " | Phone: " . htmlspecialchars($c["phone"]);
    echo "</div>";
}

// Show all customers
echo "<h2>All Customers</h2>";
foreach ($customers as $c) {
    showCustomer($c);
}
?>

<hr>
<h2>Search Customers</h2>

<!-- Search Forms -->
<form method="get">
    <label>Search by First Name: <input type="text" name="first"></label>
    <input type="submit" value="Search">
</form>

<form method="get">
    <label>Search by Last Name: <input type="text" name="last"></label>
    <input type="submit" value="Search">
</form>

<form method="get">
    <label>Age From: <input type="number" name="ageMin"></label>
    <label>To: <input type="number" name="ageMax"></label>
    <input type="submit" value="Search">
</form>

<form method="get">
    <label>Search by Area Code: <input type="text" name="area" maxlength="3"></label>
    <input type="submit" value="Search">
</form>

<?php
// First Name
if (isset($_GET["first"]) && $_GET["first"] !== "") {
    $name = htmlspecialchars($_GET["first"]);
    echo "<h3>Results for First Name = $name</h3>";
    $results = array_filter($customers, function ($c) use ($name) {
        return strcasecmp($c["first"], $name) === 0;
    });
    if (empty($results)) {
        echo "No results found.";
    } else {
        foreach ($results as $c) showCustomer($c);
    }
}

// Last Name
if (isset($_GET["last"]) && $_GET["last"] !== "") {
    $name = htmlspecialchars($_GET["last"]);
    echo "<h3>Results for Last Name = $name</h3>";
    $results = array_filter($customers, function ($c) use ($name) {
        return strcasecmp($c["last"], $name) === 0;
    });
    if (empty($results)) {
        echo "No results found.";
    } else {
        foreach ($results as $c) showCustomer($c);
    }
}

// Age Range
if (isset($_GET["ageMin"]) && isset($_GET["ageMax"]) &&
    $_GET["ageMin"] !== "" && $_GET["ageMax"] !== "") {
    $min = (int)$_GET["ageMin"];
    $max = (int)$_GET["ageMax"];
    echo "<h3>Results for Age Range $min - $max</h3>";
    $results = array_filter($customers, function ($c) use ($min, $max) {
        return $c["age"] >= $min && $c["age"] <= $max;
    });
    if (empty($results)) {
        echo "No results found.";
    } else {
        foreach ($results as $c) showCustomer($c);
    }
}

// Area Code
if (isset($_GET["area"]) && $_GET["area"] !== "") {
    $area = htmlspecialchars($_GET["area"]);
    echo "<h3>Results for Area Code = $area</h3>";
    $results = array_filter($customers, function ($c) use ($area) {
        return substr($c["phone"], 0, 3) === $area;
    });
    if (empty($results)) {
        echo "No results found.";
    } else {
        foreach ($results as $c) showCustomer($c);
    }
}
?>

</body>
</html>
