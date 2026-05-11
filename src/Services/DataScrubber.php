<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Services;

class DataScrubber
{
    // AKIA = long-term IAM user, ASIA = STS temporary; 16-char uppercase suffix.
    private const AWS_KEY_PATTERN = '/\b(?:AKIA|ASIA)[A-Z0-9]{16}\b/';

    // Three-segment base64url JWT; eyJ is the canonical encoding of `{"`.
    private const JWT_PATTERN = '/\beyJ[A-Za-z0-9_-]{4,}\.[A-Za-z0-9_-]{4,}\.[A-Za-z0-9_-]{4,}\b/';

    // Stripe documents keys as opaque case-sensitive strings; lower bound only.
    private const STRIPE_KEY_PATTERN = '/\b(?:sk|pk|rk)_(?:live|test)_[A-Za-z0-9]{16,}\b/';

    // RFC-5322 lite — defensive scrub, not validation.
    private const EMAIL_PATTERN = '/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}\b/';

    // Strict octet bounds 0-255, no leading zeros.
    private const IPV4_PATTERN = '/\b(?:25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])(?:\.(?:25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])){3}\b/';

    // Unix absolute path or Windows drive path; bounded character classes.
    private const FILE_PATH_PATTERN = '#(?:/[A-Za-z0-9._/-]+|[A-Z]:\\\\[A-Za-z0-9._\\\\ -]+)#';

    /**
     * Scrub sensitive values from request parameters.
     *
     * @param  array<string, mixed>  $data
     *
     * @return array<string, mixed>
     */
    public function scrubParams(array $data): array
    {
        /** @var string[] $keys */
        $keys = config('fin-sentinel.scrub.params', []);

        return $this->scrub($data, $keys);
    }

    /**
     * Scrub sensitive values from HTTP headers.
     *
     * @param  array<string, mixed>  $headers
     *
     * @return array<string, mixed>
     */
    public function scrubHeaders(array $headers): array
    {
        /** @var string[] $keys */
        $keys = config('fin-sentinel.scrub.headers', []);

        return $this->scrub($headers, $keys);
    }

    /**
     * Scrub sensitive values from environment variables.
     *
     * @param  array<string, mixed>  $env
     *
     * @return array<string, mixed>
     */
    public function scrubEnv(array $env): array
    {
        /** @var string[] $keys */
        $keys = config('fin-sentinel.scrub.env', []);

        return $this->scrub($env, $keys);
    }

    /**
     * Scrub sensitive values from stack trace arguments.
     *
     * @param  array<string, mixed>  $args
     *
     * @return array<string, mixed>
     */
    public function scrubTraceArgs(array $args): array
    {
        /** @var string[] $keys */
        $keys = config('fin-sentinel.scrub.trace_args', []);

        return $this->scrub($args, $keys);
    }

    public function scrubString(string $input): string
    {
        $patterns = [
            self::JWT_PATTERN => '[JWT_REDACTED]',
            self::AWS_KEY_PATTERN => '[AWS_KEY_REDACTED]',
            self::STRIPE_KEY_PATTERN => '[STRIPE_KEY_REDACTED]',
            self::EMAIL_PATTERN => '[EMAIL_REDACTED]',
            self::IPV4_PATTERN => '[IP_REDACTED]',
            self::FILE_PATH_PATTERN => '[PATH_REDACTED]',
        ];

        foreach ($patterns as $pattern => $label) {
            $result = preg_replace($pattern, $label, $input);
            if ($result !== null) {
                $input = $result;
            }
        }

        /** @var array<string, string> $extra */
        $extra = config('fin-sentinel.ai.scrub.patterns', []);
        foreach ($extra as $label => $pattern) {
            $result = preg_replace($pattern, sprintf('[%s_REDACTED]', strtoupper((string) $label)), $input);
            if ($result !== null) {
                $input = $result;
            }
        }

        return $input;
    }

    /**
     * Recursively scrub matching keys from data, replacing values with [REDACTED].
     *
     * @param  array<string, mixed>  $data
     * @param  string[]  $keys
     *
     * @return array<string, mixed>
     */
    private function scrub(array $data, array $keys): array
    {
        $normalizedKeys = array_map('strtolower', $keys);
        $result = [];

        foreach ($data as $key => $value) {
            if (in_array(strtolower((string) $key), $normalizedKeys, true)) {
                $result[$key] = '[REDACTED]';
            } elseif (is_array($value)) {
                $result[$key] = $this->scrub($value, $keys);
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}
