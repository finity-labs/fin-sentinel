<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Tests\PanelTestCase;
use FinityLabs\FinSentinel\Tests\TestCase;

require_once __DIR__.'/AiTestHelpers.php';

/*
 * The plain harness for Unit and the top-level Feature files; the panel
 * harness for Feature/Pages, whose tests request the plugin's pages over
 * HTTP through a real Filament panel. Pest refuses two base classes on one
 * file, so the glob keeps the bindings apart: a new Feature subfolder needs
 * its own uses() line here, or its tests run on PHPUnit's bare TestCase.
 */
uses(TestCase::class)->in('Unit', 'Feature/*.php');
uses(PanelTestCase::class)->in('Feature/Pages');
