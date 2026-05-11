<?php

declare(strict_types=1);

it('prevents getTrace() regression on the AI input path', function (): void {
    $paths = [
        'src/Support',
        'src/Services/Ai',
        'src/Services/DataScrubber.php',
        'src/Listeners/MessageLoggedListener.php',
    ];

    $cmd = sprintf(
        "grep -rn -e '->getTrace(' %s | grep -v 'getTraceAsString' | grep -v ':comment' || true",
        implode(' ', array_map('escapeshellarg', $paths)),
    );

    $matches = shell_exec($cmd);

    expect(trim((string) $matches))->toBe('');
});
