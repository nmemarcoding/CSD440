<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>NimaMyInteger Assignment</title>
</head>
<body>

<?php
/*
File: NimaMyInteger.php
Author: Nima Memarzadeh
Date: 2025-09-04
Description:
- Defines the NimaMyInteger class for working with integers.
- Holds a single integer set in the constructor.
- Provides getter/setter.
- Provides isEven(int) and isOdd(int) per spec, plus convenience no-arg versions.
- Provides isPrime() operating on the stored value.
- Includes test cases.
*/

class NimaMyInteger {

    private int $value;

    public function __construct(int $initialValue) {
        $this->value = $initialValue;
    }

    // Getter
    public function getValue(): int {
        return $this->value;
    }

    // Setter
    public function setValue(int $newValue): void {
        $this->value = $newValue;
    }

    // --- Spec-required signatures ---
    public function isEven(int $n): bool {
        return $n % 2 === 0;
    }

    public function isOdd(int $n): bool {
        return $n % 2 !== 0;
    }

    // --- Convenience: operate on stored value ---
    public function isEvenValue(): bool {
        return $this->isEven($this->value);
    }

    public function isOddValue(): bool {
        return $this->isOdd($this->value);
    }

    // Checks if the stored integer is prime
    public function isPrime(): bool {
        $num = $this->value;

        if ($num <= 1) return false;
        if ($num <= 3) return true;
        if ($num % 2 === 0 || $num % 3 === 0) return false;

        for ($i = 5; $i * $i <= $num; $i += 6) {
            if ($num % $i === 0 || $num % ($i + 2) === 0) {
                return false;
            }
        }
        return true;
    }
}

$newLine = "<br />";

echo "<h2>Testing NimaMyInteger Class — by Nima Memarzadeh</h2>" . $newLine;

// Create two instances
$obj1 = new NimaMyInteger(7);   // prime odd number
$obj2 = new NimaMyInteger(10);  // even composite number

// Display initial values
echo "<strong>Initial Object Values:</strong>" . $newLine;
echo "Object 1 value = " . $obj1->getValue() . $newLine;
echo "Object 2 value = " . $obj2->getValue() . $newLine . $newLine;

// Test parameterized methods explicitly (per spec)
echo "<strong>Testing parameterized methods isEven(int) / isOdd(int):</strong>" . $newLine;
echo "isEven(7)? " . ($obj1->isEven(7) ? "true" : "false") . $newLine;
echo "isOdd(7)? " . ($obj1->isOdd(7) ? "true" : "false") . $newLine;
echo "isEven(10)? " . ($obj2->isEven(10) ? "true" : "false") . $newLine;
echo "isOdd(10)? " . ($obj2->isOdd(10) ? "true" : "false") . $newLine . $newLine;

// Test no-arg convenience methods on stored values
echo "<strong>Testing Object 1 (value = " . $obj1->getValue() . "):</strong>" . $newLine;
echo "isEvenValue()? " . ($obj1->isEvenValue() ? "true" : "false") . $newLine;
echo "isOddValue()? " . ($obj1->isOddValue() ? "true" : "false") . $newLine;
echo "isPrime()? " . ($obj1->isPrime() ? "true" : "false") . $newLine . $newLine;

echo "<strong>Testing Object 2 (value = " . $obj2->getValue() . "):</strong>" . $newLine;
echo "isEvenValue()? " . ($obj2->isEvenValue() ? "true" : "false") . $newLine;
echo "isOddValue()? " . ($obj2->isOddValue() ? "true" : "false") . $newLine;
echo "isPrime()? " . ($obj2->isPrime() ? "true" : "false") . $newLine . $newLine;

// Demonstrate setter/getter on Object 2
echo "<strong>Updating Object 2 using Setter:</strong>" . $newLine;
$obj2->setValue(13);
echo "Object 2 new value = " . $obj2->getValue() . $newLine;
echo "isEvenValue()? " . ($obj2->isEvenValue() ? "true" : "false") . $newLine;
echo "isOddValue()? " . ($obj2->isOddValue() ? "true" : "false") . $newLine;
echo "isPrime()? " . ($obj2->isPrime() ? "true" : "false") . $newLine;

?>
</body>
</html>
