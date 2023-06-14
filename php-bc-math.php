<?php
function getBcRound($number, $precision = 0)
    {
        $precision = ($precision < 0)
                   ? 0
                   : (int) $precision;
        if (strcmp(bcadd($number, '0', $precision), bcadd($number, '0', $precision+1)) == 0) {
            return bcadd($number, '0', $precision);
        }
        if (getBcPresion($number) - $precision > 1) {
            $number = getBcRound($number, $precision + 1);
        }
        $t = '0.' . str_repeat('0', $precision) . '5';
        return $number < 0
               ? bcsub($number, $t, $precision)
               : bcadd($number, $t, $precision);
    }
   
    function getBcPresion($number) {
        $dotPosition = strpos($number, '.');
        if ($dotPosition === false) {
            return 0;
        }
        return strlen($number) - strpos($number, '.') - 1;
    }
   
    var_dump(getBcRound('3', 0) == number_format('3', 0));
    var_dump(getBcRound('3.4', 0) == number_format('3.4', 0));
    var_dump(getBcRound('3.56', 0) == number_format('3.6', 0));
    var_dump(getBcRound('1.95583', 2) == number_format('1.95583', 2));
    var_dump(getBcRound('5.045', 2) == number_format('5.045', 2));
    var_dump(getBcRound('5.055', 2) == number_format('5.055', 2));
    var_dump(getBcRound('9.999', 2) == number_format('9.999', 2));
    var_dump(getBcRound('5.0445', 5) == number_format('5.044500', 5));
    var_dump(getBcRound('5.0445', 4) == number_format('5.04450', 4));
    var_dump(getBcRound('5.0445', 3) == number_format('5.0445', 3));
    var_dump(getBcRound('5.0445', 2) == number_format('5.045', 2));
    var_dump(getBcRound('5.0445', 1) == number_format('5.05', 1));
    var_dump(getBcRound('5.0445', 0) == number_format('5.0', 0));//
    var_dump(getBcRound('5.04455', 2) == number_format('5.045', 2));
    var_dump(getBcRound('99.999', 2) == number_format('100.000', 2));
    var_dump(getBcRound('99.999') == number_format('99.999', 0));
    var_dump(getBcRound('99.999', 'a') == number_format('99.999', 0));
    var_dump(getBcRound('99.999', -1.5) == number_format('99.999', 0));
    var_dump(getBcRound('-0.00001', 2) == number_format('-0.000', 2));
    var_dump(getBcRound('-0.0000', 2) == number_format('0', 2));
    var_dump(getBcRound('-4.44455', 2) == number_format('-4.445', 2));
    var_dump(getBcRound('-4.44555', 0) == number_format('-4.5', 0));
    var_dump(getBcRound('-4.444444444444444444444444444444444444444444445', 0) == number_format('-4.5', 0));
