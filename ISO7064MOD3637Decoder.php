<?php 

#This is a PHP implementation of ISO 7064 Mod 37,36
# by Kardo Qadir
#This is implemented by way of example for the GRid Code (using an example e.g. A12425GABC1234002-x where x is the check digit (a1) that we want to find)
#The layout for this would be
#
# |A  |1  |2  |4  |2  |5  |G  |A  |B  |C  |1  |2  |3  |4  |0  |0  |2  |x  |
# |a18|a17|a16|a15|a14|a13|a12|a11|a10|a0 |a8 |a7 |a6 |a5 |a4 |a3 |a2 |a1 |

class ISO7064MOD3637Decoder {
    public static $char_to_value = ['0' => 0,'1' => 1,'2' => 2,'3' => 3,'4' => 4,'5' => 5,'6' => 6,'7' => 7,'8' => 8,'9' => 9,'A' => 10,'B' => 11,'C' => 12,'D' => 13,'E' => 14,'F' => 15,'G' => 16,'H' => 17,'I' => 18,'J' => 19,'K' => 20,'L' => 21,'M' => 22,'N' => 23,'O' => 24,'P' => 25,'Q' => 26,'R' => 27,'S' => 28,'T' => 29,'U' => 30,'V' => 31,'W' => 32,'X' => 33,'Y' => 34,'Z' => 35];
    public static $value_to_char = ['0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

    protected static function iso_7064_mod_37_36($grid)
    {
        #not part of the core algo, we are just splitting the string into a array of chars for processing step by step...
        $grid_list = str_split($grid);

        #initial value P1 is the Modulo, i.e. 36, as defined by ISO 7064 Mod 37, 36
        $Pj=36;

        #iterate through the 17 GRid identifier chars from a18 to a2 (TBD any error checking for bad chars)
        foreach($grid_list as $char)
        {
            #The ISO algo calls this "a(n-j+1)" which would be a(18-j+1), i.e. first time around a(18-1+1) = a(18)
            $value = self::$char_to_value[$char];
            $Sj = ($Pj%37) + $value;
            $Sjmod36 = $Sj%36;

            #zero is not allowed here
            if($Sjmod36==0) $Sjmod36=36;
            $Pj = $Sjmod36 * 2;
        }
        
        $x = 37-$Pj%37;

        #36 is not allowed here
        if($x==36)  $x=0;

        #'x' is a value, we need to look up the corresponding character...
        $chk_chr = self::$value_to_char[$x]; 
        return($chk_chr);
    }

    # Get the last charachter
    public static function getChr($grid)
    {
        return self::iso_7064_mod_37_36($grid);
    }
}


