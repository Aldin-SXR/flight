<?php

/**
 * Flight: An extensible micro-framework.
 *
 * @copyright   Copyright (c) 2012, Mike Cao <mike@mikecao.com>
 * @license     MIT, http://flightphp.com/license
 */

require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../flight/autoload.php';
require_once __DIR__ . '/classes/Hello.php';

class MapTest extends TestCase {
    /**
     * @var \flight\Engine
     */
    private $app;

    protected function setUp(): void {
        $this->app = new \flight\Engine();
    }

    // Map a closure
    function testClosureMapping() {
        $this->app->map('map1', function () {
            return 'hello';
        });

        $result = $this->app->map1();

        $this->assertEquals('hello', $result);
    }

    // Map a function
    function testFunctionMapping() {
        $this->app->map('map2', function () {
            return 'hello';
        });

        $result = $this->app->map2();

        $this->assertEquals('hello', $result);
    }

    // Map a class method
    function testClassMethodMapping() {
        $h = new Hello();

        $this->app->map('map3', array($h, 'sayHi'));

        $result = $this->app->map3();

        $this->assertEquals('hello', $result);
    }

    // Map a static class method
    function testStaticClassMethodMapping() {
        $this->app->map('map4', array('Hello', 'sayBye'));

        $result = $this->app->map4();

        $this->assertEquals('goodbye', $result);
    }

    // Unmapped method
    function testUnmapped() {
        $this->expectException('Exception');
        $this->expectErrorMessage('doesNotExist must be a mapped method.');

        $this->app->doesNotExist();
    }
}
