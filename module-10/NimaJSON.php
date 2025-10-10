<!--
    Name: Nima Memarzadeh
    File: NimaJSON.php
    Date: 2025-09-30
    Assignment:
      Program that prompts the user to enter at least 8 fields of data in a form.
      When submitted, the PHP CGI encodes the input into JSON using json_encode().
      If all required fields are present, the program displays the JSON output 
      in a well-formatted block. Otherwise, it displays an error message listing 
      the missing fields.
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nima JSON Form</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { margin-bottom: 20px; }
        label { display: block; margin-top: 10px; }
        input, textarea { width: 300px; padding: 5px; }
        .output, .error { 
            border: 1px solid #ccc; 
            padding: 15px; 
            margin-top: 20px; 
            background: #f9f9f9;
            white-space: pre-wrap;
        }
        .error { background: #ffe0e0; color: darkred; border-color: red; }
    </style>
</head>
<body>

<h2>Nima's JSON Form</h2>

<form method="post" action="">
    <label>First Name: <input type="text" name="firstName" required></label>
    <label>Last Name: <input type="text" name="lastName" required></label>
    <label>Email: <input type="email" name="email" required></label>
    <label>Phone: <input type="text" name="phone" required></label>
    <label>Age: <input type="number" name="age" required></label>
    <label>City: <input type="text" name="city" required></label>
    <label>State: <input type="text" name="state" required></label>
    <label>Country: <input type="text" name="country" required></label>
    <label>Comments: <textarea name="comments"></textarea></label>
    <br><br>
    <input type="submit" value="Submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Collect data
    $data = array(
        "First Name" => trim($_POST["firstName"] ?? ""),
        "Last Name"  => trim($_POST["lastName"] ?? ""),
        "Email"      => trim($_POST["email"] ?? ""),
        "Phone"      => trim($_POST["phone"] ?? ""),
        "Age"        => trim($_POST["age"] ?? ""),
        "City"       => trim($_POST["city"] ?? ""),
        "State"      => trim($_POST["state"] ?? ""),
        "Country"    => trim($_POST["country"] ?? ""),
        "Comments"   => trim($_POST["comments"] ?? "")
    );

    // Validation: make sure all required fields are filled
    $missingFields = [];
    foreach ($data as $key => $value) {
        if ($key !== "Comments" && empty($value)) {
            $missingFields[] = $key;
        }
    }

    if (!empty($missingFields)) {
        echo "<div class='error'><strong>Error:</strong> Missing required fields: " 
             . implode(", ", $missingFields) . "</div>";
    } else {
        // Encode data into JSON with pretty print
        $jsonOutput = json_encode($data, JSON_PRETTY_PRINT);

        echo "<div class='output'><strong>Submitted Data in JSON:</strong><br><br>";
        echo htmlspecialchars($jsonOutput); 
        echo "</div>";
    }
}
?>

</body>
</html>
