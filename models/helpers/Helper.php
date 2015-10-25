<?php

namespace models\helpers;
use DateTime;

/**
 * Class Helper store useful and helper methods
 * @package models\helpers
 */
class Helper
{
    /** int value for min percent amount */
    const PERCENT_MIN = 0;

    /** int value for max percent amount */
    const PERCENT_MAX = 100;


    /**
     *
     * Calculate total order price
     * @param decimal $product_price
     * @param int $product_discount
     * @param int $company_discount
     * @param int $order_qty
     * @return decimal
     */
    public static function calculateTotalPrice($product_price, $product_discount = 0, $company_discount = 0, $order_qty){
        $total_discount_percent = ($product_discount + $company_discount);
        $total_discount_amount = (($order_qty * $product_price) * $total_discount_percent) / 100;
        $total_price = ($order_qty * $product_price - $total_discount_amount);
        return $total_price;
    }

    /**
     * Convert IP address to human readable
     * @param $ip_address
     * @return string
     */
    public static function convertIpAddress($ip_address){
        return long2ip($ip_address);
    }

    /**
     * Validate is empty given data
     * @param string $data
     * @return bool
     */
    public static function isEmpty($data){
        return (empty(trim($data))) ? true : false;
    }

    /**
     * Validate is string given $data
     * @param string $data
     * @return bool
     */
    public static function isString($data){
        return (is_string($data)) ? true : false;
    }

    /**
     * @param $data
     * @return bool
     */
    public static function isInt($data){
        return (is_int($data)) ? true : false;
    }

    /**
     * Validate percents are in range 0-100 %
     * @param int $percents
     * @return bool
     */
    public static function validatePercentAmount($percents){
        return ($percents > self::PERCENT_MIN && $percents <= self::PERCENT_MAX);
    }

    /**
     *
     * Validate is valid email given data
     * @param string $email
     * @return bool
     */
    public static function isValidEmail($email){
        return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false;
    }


    /**
     * Check is valid IP address
     * @param string $ip_address
     * @return bool
     */
    public static function isValidIpAddress($ip_address){
        return (filter_var($ip_address, FILTER_VALIDATE_IP)) ? true : false;
    }

    /**
     * Validate float number
     * @param $float
     * @return bool
     */
    public static function isValidFloat($float){
        return (filter_var($float, FILTER_VALIDATE_FLOAT)) ? true : false;
    }

    /**
     * Validate for valid date
     * @param $date
     * @return bool
     */
    public static function isValidDate($date){
        return (DateTime::createFromFormat('d/m/Y', $date)) ? true : false;
    }

    /**
     *
     * Validate field not to overlimit field size
     * @param string $field_value
     * @param int $max
     * @return bool
     */
    public static function validateMaxFieldText($field_value, $max){
        return (strlen($field_value) <= $max) ? true : false;
    }


    /**
     * Static method to filter and validate data
     * @param string $data
     * @param string $types int|string|trim|strip_tags|specialchars
     * @return string
     */
    public static function validateData($data, $types) {
        $types = explode('|', $types);
        if (is_array($types)) {
            foreach ($types as $v) {
                if ($v === 'int') {
                    $data = (int) $data;
                }
                if ($v === 'string') {
                    $data = (string) $data;
                }
                if ($v === 'trim') {
                    $data = trim($data);
                }
                if ($v === 'strip_tags') {
                    $data = strip_tags($data);
                }
                if ($v === 'specialchars') {
                    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
                }
                if ($v === 'filter_special_chars') {
                    $data = str_replace(str_split('<>"&*~|<>#@$%^()!?+-=/\\`.,:;_' . "'" . ''), ' ', $data);
                }
            }
        }
        return $data;
    }

}