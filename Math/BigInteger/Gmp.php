<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Crypt
 * @subpackage Math
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend\Crypt\Math\BigInteger;

/**
 * Support for arbitrary precision mathematics in PHP.
 *
 * Zend\Crypt\Math\BigInteger\Gmp is a wrapper across the PHP GMP
 * extension.
 *
 * @uses       Zend\Crypt\Math\BigInteger\BigIntegerCapable
 * @category   Zend
 * @package    Zend_Crypt
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Gmp implements BigIntegerCapable
{
    /**
     * Initialise a big integer into an extension specific type.
     *
     * @param  string $operand
     * @param  int $base
     * @return string
     */
    public function init($operand, $base = 10)
    {
        return $operand;
    }

    /**
     * Adds two arbitrary precision numbers
     *
     * @param  string $left_operand
     * @param  string $right_operand
     * @return string
     */
    public function add($left_operand, $right_operand)
    {
        $result = gmp_add($left_operand, $right_operand);
        return gmp_strval($result);
    }

    /**
     * @param  string $left_operand
     * @param  string $right_operand
     * @return string
     */
    public function subtract($left_operand, $right_operand)
    {
        $result = gmp_sub($left_operand, $right_operand);
        return gmp_strval($result);
    }

    /**
     * Compare two big integers and returns result as an integer where 0 means
     * both are identical, 1 that left_operand is larger, or -1 that
     * right_operand is larger.
     *
     * @param  string $left_operand
     * @param  string $right_operand
     * @return int
     */
    public function compare($left_operand, $right_operand)
    {
        $result = gmp_cmp($left_operand, $right_operand);
        return gmp_strval($result);
    }

    /**
     * Divide two big integers and return result or NULL if the denominator
     * is zero.
     * @param  string $left_operand
     * @param  string $right_operand
     * @return string|null
     */
    public function divide($left_operand, $right_operand)
    {
        $result = gmp_div($left_operand, $right_operand);
        return gmp_strval($result);
    }

    /**
     * @param  string $left_operand
     * @param  string $right_operand
     * @return string
     */
    public function modulus($left_operand, $modulus)
    {
        $result = gmp_mod($left_operand, $modulus);
        return gmp_strval($result);
    }

    /**
     * @param  string $left_operand
     * @param  string $right_operand
     * @return string
     */
    public function multiply($left_operand, $right_operand)
    {
        $result = gmp_mul($left_operand, $right_operand);
        return gmp_strval($result);
    }

    /**
     * @param  string $left_operand
     * @param  string $right_operand
     * @return string
     */
    public function pow($left_operand, $right_operand)
    {
        $result = gmp_pow($left_operand, $right_operand);
        return gmp_strval($result);
    }

    /**
     * @param  string $left_operand
     * @param  string $right_operand
     * @return string
     */
    public function powmod($left_operand, $right_operand, $modulus)
    {
        $result = gmp_powm($left_operand, $right_operand, $modulus);
        return gmp_strval($result);
    }

    /**
     * @param  string $left_operand
     * @param string $right_operand
     * @return string
     */
    public function sqrt($operand)
    {
        $result = gmp_sqrt($operand);
        return gmp_strval($result);
    }

    /**
     * @param  string $operand 
     * @return integer
     */
    public function binaryToInteger($operand)
    {
        $result = '0';
        while (strlen($operand)) {
            $ord = ord(substr($operand, 0, 1));
            $result = gmp_add(gmp_mul($result, 256), $ord);
            $operand = substr($operand, 1);
        }
        return gmp_strval($result);
    }

    /**
     * @param  string|integer $operand 
     * @return string
     */
    public function integerToBinary($operand)
    {
        $bigInt = gmp_strval($operand, 16);
        if (strlen($bigInt) % 2 != 0) {
            $bigInt = '0' . $bigInt;
        } else if ($bigInt[0] > '7') {
            $bigInt = '00' . $bigInt;
        }
        $return = pack("H*", $bigInt);
        return $return;
    }

    /**
     * @param  string $operand
     * @return string
     */
    public function hexToDecimal($operand)
    {
        $result = '0';
        while(strlen($operand)) {
            $dec     = hexdec(substr($operand, 0, 4));
            $result  = gmp_add(gmp_mul($result, 65536), $dec);
            $operand = substr($operand, 4);
        }
        return gmp_strval($result);
    }
}
