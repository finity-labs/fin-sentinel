<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Listeners\MessageLoggedListener;

it('hashException equals the inline v1.0 md5 expression', function () {
    $e = new RuntimeException('the message');
    $expected = md5($e::class.$e->getMessage().$e->getFile().':'.$e->getLine());

    expect(MessageLoggedListener::hashException($e))->toBe($expected);
});

it('hashExceptionParts produces the documented md5 shape', function () {
    $expected = md5('App\\Foomsg/path/file.php:42');

    expect(MessageLoggedListener::hashExceptionParts('App\\Foo', 'msg', '/path/file.php', 42))->toBe($expected);
});

it('hashException is byte-identical to the v1.0 inline expression for arbitrary throwables', function () {
    $e = new LogicException('arbitrary text 12345', 7);
    $inline = md5($e::class.$e->getMessage().$e->getFile().':'.$e->getLine());

    expect(MessageLoggedListener::hashException($e))->toBe($inline);
});

it('hashExceptionParts is deterministic', function () {
    $a = MessageLoggedListener::hashExceptionParts('A', 'B', 'C', 1);
    $b = MessageLoggedListener::hashExceptionParts('A', 'B', 'C', 1);

    expect($a)->toBe($b);
});

it('both hash methods are public and static via Reflection', function () {
    foreach (['hashException', 'hashExceptionParts'] as $method) {
        $r = new ReflectionMethod(MessageLoggedListener::class, $method);
        expect($r->isPublic())->toBeTrue();
        expect($r->isStatic())->toBeTrue();
    }
});
