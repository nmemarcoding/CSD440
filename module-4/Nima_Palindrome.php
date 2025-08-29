<!DOCTYPE html>
<html lang='en'>
  <!--
    Name: Nima Memarzadeh
    File: Nima Palindrome.php
    Date: 2025-08-28
    Assignment:
      Program that checks if a string is a palindrome.
      I used six examples: three are palindromes and three are not.
      For each test it shows the original string, the reversed string,
      and the result from my function.
  -->
  <head>
    <meta charset='utf-8'>
    <title>Nima Palindrome</title>
  </head>
  <body>

    <h1>Palindrome Checker</h1>

    <?php
      // makes the string lowercase and removes spaces
      function normalize_string($str) {
        $str = strtolower($str);
        $str = str_replace(' ', '', $str);
        return $str;
      }

      // reverses a string using substr() and strlen()
      function reverse_with_substr($str) {
        $out = '';
        $len = strlen($str);
        for ($i = $len - 1; $i >= 0; $i--) {
          $out .= substr($str, $i, 1);
        }
        return $out;
      }

      // checks if the string is the same forwards and backwards
      function is_palindrome($str) {
        $norm = normalize_string($str);
        $rev  = reverse_with_substr($norm);
        return $norm === $rev;
      }

      // shows one test on the page
      function show_test($str) {
        $reversedVisible = reverse_with_substr($str);

        echo "Original: " . htmlspecialchars($str) . "<br />";
        echo "Reversed: " . htmlspecialchars($reversedVisible) . "<br />";

        if (is_palindrome($str)) {
          echo "Result: Palindrome<br />";
        } else {
          echo "Result: Not a palindrome<br />";
        }

        echo "---------------------------<br /><br />";
      }

      // six test strings
      // first three are palindromes
      // last three are not
      $tests = [
        'nimaamin',             // palindrome (your name doubled)
        'Never odd or even',    // classic palindrome phrase
        'A man a plan a canal Panama', // classic palindrome phrase
        'computer science',     // not palindrome
        'Bellevue University',  // not palindrome
        'PHP assignment four',   // not palindrome
      ];


      foreach ($tests as $t) {
        show_test($t);
      }
    ?>
  </body>
</html>
