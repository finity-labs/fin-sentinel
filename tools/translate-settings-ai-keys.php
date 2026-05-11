<?php

declare(strict_types=1);

// One-shot bootstrap: writes the full settings.ai.* block (minus test_connection_* which has its own script)
// into every non-English locale. Run from the package root: php tools/translate-settings-ai-keys.php
// Re-runnable. Existing keys in settings.ai are merged (overwriting same-keyed entries, preserving others).

$base = __DIR__.'/../resources/lang';

$translations = require __DIR__.'/translate-settings-ai-keys.data.php';

$wrote = 0;
$skipped = 0;

foreach ($translations as $locale => $values) {
    $file = $base.'/'.$locale.'/fin-sentinel.php';
    if (! is_file($file)) {
        echo "SKIP missing: {$file}\n";
        $skipped++;

        continue;
    }

    $existing = require $file;
    if (! is_array($existing) || ! isset($existing['settings']) || ! is_array($existing['settings'])) {
        echo "SKIP malformed: {$file}\n";
        $skipped++;

        continue;
    }

    $aiBlock = $existing['settings']['ai'] ?? [];
    $existingTestEmail = $aiBlock['test_email'] ?? [];
    $newTestEmail = $values['test_email'] ?? [];
    unset($values['test_email']);

    $aiBlock = array_merge($aiBlock, $values);
    $aiBlock['test_email'] = array_merge($existingTestEmail, $newTestEmail);

    $existing['settings']['ai'] = $aiBlock;

    $php = "<?php\n\ndeclare(strict_types=1);\n\nreturn ".var_export_short($existing, 0).";\n";
    file_put_contents($file, $php);
    echo "WROTE: {$file}\n";
    $wrote++;
}

echo "\nDone: {$wrote} written, {$skipped} skipped.\n";

function var_export_short(mixed $value, int $indent): string
{
    if (is_array($value)) {
        if ($value === []) {
            return '[]';
        }
        $isList = array_is_list($value);
        $pad = str_repeat('    ', $indent);
        $padInner = str_repeat('    ', $indent + 1);
        $parts = [];
        foreach ($value as $k => $v) {
            $key = $isList ? '' : (is_int($k) ? $k.' => ' : "'".addcslashes((string) $k, "'\\")."' => ");
            $parts[] = $padInner.$key.var_export_short($v, $indent + 1);
        }

        return "[\n".implode(",\n", $parts).",\n".$pad.']';
    }
    if (is_string($value)) {
        return "'".addcslashes($value, "'\\")."'";
    }
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }
    if ($value === null) {
        return 'null';
    }

    return var_export($value, true);
}
