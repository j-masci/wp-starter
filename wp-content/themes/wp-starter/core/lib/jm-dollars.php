<?php

/**
 * Working with dollar amounts is not as trivial as
 * you would expect in PHP since there are many ways
 * that floating point numbers can get incorrectly rounded.
 *
 * For now this is more of an experiment. I've written
 * helpers in the past that generally work but then
 * when things didn't work, I didn't know why.
 *
 * Testing is hard... How do we assert that some operation produces
 * the value when the most logical way to get the value is to do
 * the operation? I don't know... some creativity will be needed maybe.
 *
 * Class JM_Dollars
 */
Class JM_Dollars{

    /**
     * Assume that $amt can come from many places and be
     * of any type. Might be an integer or float stored
     * in a database, or string from user input, or float
     * which was the result of some operation.
     *
     * Return a string with 1 decimal point and correctly rounded.
     *
     * @param $amt
     */
    public static function to_dollar_string_1( $amt ){
        // the naive approach but who knows maybe its even the correct one.
        return trim( number_format( (float) $amt, 2, '.', '' ) );
    }




}