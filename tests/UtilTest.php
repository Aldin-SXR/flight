<?php

require_once 'vendor/autoload.php';
require_once __DIR__ . '/../flight/util/Util.php';

use flight\util\Util;
use PHPUnit\Framework\TestCase;

class UtilTest extends TestCase {

    public function testDoesNothingToStringsBooleansAndIntegers () {
        $array = [
            'hello' => 'world',
            1 => 2,
            true => false
        ];

        $cleaned = Util::mongo_sanitize($array);
        $this->assertEquals($array, $cleaned);
    }

    public function testSanitizesMongoOperators() {
        $array = [
            'hello' => 'world',
            '$or' => [ [ 'hello' => 'world' ], [ 'foo' => 'bar' ] ]
        ];

        $cleaned = Util::mongo_sanitize($array);
        $this->assertEquals([
            'hello' => 'world'
        ], $cleaned);
    }

    public function testSanitizesEmbeddedMongoOperators() {
        $array = [
            'hello' => 'world',
            'foo' => [ '$eq' => 'bar' ],
            'test' => [ 'var' => 42, 'const' => [ '$ne' => 42 ] ]
        ];

        $cleaned = Util::mongo_sanitize($array);
        $this->assertEquals([
            'hello' => 'world',
            'foo' => [ ],
            'test' => [ 'var' => 42, 'const' => [ ] ]
        ], $cleaned);
    }
}

