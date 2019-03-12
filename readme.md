# ISO7064MOD3637Decoder For PHP and Python

This is an implementation of ISO 7064 Mod 37,36 for both php and python.
This is implemented by way of example for the GRid Code (using an example e.g. A12425GABC1234002-x where x is the check digit (a1) that we want to find)

The layout for this would be

| A   | 1   | 2   | 4   | 2   | 5   | G   | A   | B  | C    | 1   | 2   | 3   | 4   | 0   | 0   | 2   | x   |
| --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- |
| a18 | a17 | a16 | a15 | a14 | a13 | a12 | a11 | a10 | a0  | a8  | a7  | a6  | a5  | a4  | a3  | a2  | a1  |

-----

## PHP Usage

You should include the class to your code then pass the grid code through getChr method staticly.

```php
<?php

require "ISO7064MOD3637Decoder.php";

echo ISO7064MOD3637Decoder::getChr('A12425GABC1234000');

```




------------

## Python usage
Run the file in command line
```
pyhton ISO7064MOD3637Decoder.py
```
