<?php

/**
 * Flight: An extensible micro-framework.
 *
 * @copyright   Copyright (c) 2012, Mike Cao <mike@mikecao.com>
 * @license     MIT, http://flightphp.com/license
 */

require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../flight/Flight.php';

class RenderTest extends TestCase {
    /**
     * @var \flight\Engine
     */
    private $app;

    protected function setUp(): void {
        $this->app = new \flight\Engine();
        $this->app->set('flight.views.path', __DIR__ . '/views');
    }

    // Render a view
    function testRenderView() {
        $this->app->render('hello', array('name' => 'Bob'));

        $this->expectOutputString('Hello, Bob!');
    }

    // Renders a view into a layout
    function testRenderLayout() {
        $this->app->render('hello', array('name' => 'Bob'), 'content');
        $this->app->render('layouts/layout');

        $this->expectOutputString('<html>Hello, Bob!</html>');
    }
}
