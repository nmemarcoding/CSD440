<?php
/*
File: NimaResponse.php
Author: Nima Memarzadeh
Date: 2025-09-08
Description:
- PHP response script for Tech Workshop Registration assignment.
- Validates 7 required fields posted from NimaForm.html:
  * Full Name (letters/spaces only)
  * Student ID (7 digits)
  * Email (valid format)
  * Major (must be in list)
  * Graduation Year (allowed values)
  * Skills (at least one from list)
  * Bio (30–300 chars)
- Displays a formatted table of submitted data if valid.
- Displays error messages and a back button if invalid.
- Uses consistent styling to match NimaForm.html.
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
  "http://www.w3.org/TR/1999/REC-html-19991224/strict.dtd">
<html>
  <head>
    <title>Nima Form — Response</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style type="text/css">
      body { background-color: #f9f3ef; font-family: Arial, Helvetica, sans-serif; margin: 0; }
      .container { width: 820px; margin: 24px auto; background: #ffffff; border: 1px solid #e5c7b3; }
      .header { background: #ffa07a; color: #222; padding: 14px 18px; border-bottom: 1px solid #e29371; }
      .content { padding: 18px; }
      h2 { margin: 0 0 6px 0; }
      .errors { color: #b00020; }
      .ok { color: #064; }
      table { border-collapse: collapse; width: 100%; }
      th, td { border: 1px solid #ccc; padding: 8px; text-align: left; vertical-align: top; }
      th { background: #f2f2f2; width: 240px; }
      .actions { margin-top: 14px; }
      .hint { color: #444; }
      button {
        border: 1px solid #e29371; background: #ffa07a; padding: 8px 14px; cursor: pointer;
        font-size: 14px; border-radius: 4px;
      }
      button:hover { background: #ff9466; }
    </style>
  </head>

  <body>
    <div class="container">
      <div class="header">
        <h2>Tech Workshop Registration — Response</h2>
        <div class="hint">Review your submission below.</div>
      </div>

      <div class="content">
        <center>
        <?php
          // Safe HTML escape
          function h($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

          // Collect POST values (7 fields)
          $fullName  = trim($_POST['fullName']  ?? '');
          $studentId = trim($_POST['studentId'] ?? '');
          $email     = trim($_POST['email']     ?? '');
          $major     = $_POST['major']          ?? '';
          $gradYear  = $_POST['gradYear']       ?? '';
          $skills    = isset($_POST['skills']) ? (array)$_POST['skills'] : array();
          $bio       = trim($_POST['bio']       ?? '');

          // Validation
          $errors = array();

          // 1) Full Name
          if ($fullName === '') {
            $errors[] = "Full Name is required.";
          } elseif (!preg_match("/^[a-zA-Z .'-]{2,60}$/", $fullName)) {
            $errors[] = "Full Name may only contain letters, spaces, periods, apostrophes, and hyphens.";
          }

          // 2) Student ID
          if ($studentId === '') {
            $errors[] = "Student ID is required.";
          } elseif (!preg_match("/^[0-9]{7}$/", $studentId)) {
            $errors[] = "Student ID must be exactly 7 digits.";
          }

          // 3) Email
          if ($email === '') {
            $errors[] = "Email is required.";
          } elseif (!function_exists('filter_var') || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email format is invalid.";
          }

          // 4) Major
          $allowedMajors = array('Computer Science','Information Systems','Data Science','Cybersecurity','Undeclared');
          if ($major === '') {
            $errors[] = "Major is required.";
          } elseif (!in_array($major, $allowedMajors, true)) {
            $errors[] = "Selected Major is not allowed.";
          }

          // 5) Graduation Year
          $allowedYears = array('2026','2027','2028','2029');
          if ($gradYear === '') {
            $errors[] = "Graduation Year is required.";
          } elseif (!in_array($gradYear, $allowedYears, true)) {
            $errors[] = "Graduation Year is invalid.";
          }

          // 6) Skills
          $allowedSkills = array('PHP','JavaScript','SQL','UX/UI');
          if (empty($skills)) {
            $errors[] = "Please select at least one Skill.";
          } else {
            foreach ($skills as $s) {
              if (!in_array($s, $allowedSkills, true)) {
                $errors[] = "Invalid Skill value detected.";
                break;
              }
            }
          }

          // 7) Bio
          $bioLen = strlen($bio);
          if ($bioLen < 30 || $bioLen > 300) {
            $errors[] = "Bio must be between 30 and 300 characters.";
          }

          // Output
          if (!empty($errors)) {
            echo "<h2 class='errors'>Submission Errors</h2>";
            echo "<ul class='errors'>";
            foreach ($errors as $e) {
              echo "<li>" . h($e) . "</li>";
            }
            echo "</ul>";
            echo "<div class='actions'><button onclick='history.back()'>Go Back and Fix</button></div>";
          } else {
            echo "<h2 class='ok'>Thanks, Nima! Your registration is valid.</h2>";
            echo "<table>";
            echo "<tr><th>Full Name</th><td>" . h($fullName) . "</td></tr>";
            echo "<tr><th>Student ID</th><td>" . h($studentId) . "</td></tr>";
            echo "<tr><th>Email</th><td>" . h($email) . "</td></tr>";
            echo "<tr><th>Major</th><td>" . h($major) . "</td></tr>";
            echo "<tr><th>Graduation Year</th><td>" . h($gradYear) . "</td></tr>";
            echo "<tr><th>Skills</th><td>";
            foreach ($skills as $s) { echo "<div>" . h($s) . "</div>"; }
            echo "</td></tr>";
            echo "<tr><th>Short Bio</th><td><pre style='margin:0; white-space:pre-wrap;'>" . h($bio) . "</pre></td></tr>";
            echo "</table>";
            echo "<div class='actions'><button onclick='history.back()'>Submit Another Response</button></div>";
          }
        ?>
        </center>
      </div>
    </div>
  </body>
</html>
