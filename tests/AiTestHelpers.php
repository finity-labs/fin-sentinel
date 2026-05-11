<?php

declare(strict_types=1);

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\JsonSchema\Types\Type;
use Laravel\Ai\Contracts\Gateway\TextGateway;
use Laravel\Ai\Contracts\Providers\TextProvider;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Gateway\Anthropic\AnthropicGateway;
use Laravel\Ai\Gateway\TextGenerationOptions;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Providers\AnthropicProvider;
use Laravel\Ai\Responses\Data\Meta;
use Laravel\Ai\Responses\Data\Usage;
use Laravel\Ai\Responses\TextResponse;

if (! function_exists('fakeAnthropicGateway')) {
    /**
     * Build a TextGateway spy: counts calls, captures the timeout passed to
     * generateText, and optionally throws a configured exception on each call.
     */
    function fakeAnthropicGateway(?Throwable $throws = null): TextGateway
    {
        return new class($throws) implements TextGateway
        {
            public int $calls = 0;

            public ?int $capturedTimeout = null;

            public function __construct(private ?Throwable $throws) {}

            /**
             * @param  Message[]  $messages
             * @param  Tool[]  $tools
             * @param  array<string, Type>|null  $schema
             */
            public function generateText(
                TextProvider $provider,
                string $model,
                ?string $instructions,
                array $messages = [],
                array $tools = [],
                ?array $schema = null,
                ?TextGenerationOptions $options = null,
                ?int $timeout = null,
            ): TextResponse {
                $this->calls++;
                $this->capturedTimeout = $timeout;

                if ($this->throws !== null) {
                    throw $this->throws;
                }

                return new TextResponse('fake suggestion', new Usage, new Meta('anthropic', $model));
            }

            /**
             * @param  Message[]  $messages
             * @param  Tool[]  $tools
             * @param  array<string, Type>|null  $schema
             */
            public function streamText(
                string $invocationId,
                TextProvider $provider,
                string $model,
                ?string $instructions,
                array $messages = [],
                array $tools = [],
                ?array $schema = null,
                ?TextGenerationOptions $options = null,
                ?int $timeout = null,
            ): Generator {
                yield from [];
            }

            public function onToolInvocation(Closure $invoking, Closure $invoked): self
            {
                return $this;
            }
        };
    }
}

if (! function_exists('bindFakeAnthropicProvider')) {
    /**
     * Register a fake anthropic provider via AiManager::extend.
     *
     * Unlike `useTextGateway` on a cached provider, an extend() driver factory
     * is re-invoked every time the provider is resolved — surviving the
     * `Ai::forgetInstance($provider)` call AiErrorAnalyzer::withProviderKey()
     * makes to swap the DB-stored API key in.
     *
     * AnthropicProvider's ctor requires the full Gateway interface (Audio +
     * Embedding + Image + Text + Transcription). We hand it the real
     * AnthropicGateway to satisfy the typehint, then `useTextGateway` swaps
     * just the text path to the spy.
     */
    function bindFakeAnthropicProvider(TextGateway $gateway): void
    {
        $aiManagerClass = 'Laravel\\Ai\\AiManager';
        app($aiManagerClass)->extend('anthropic', function ($app, $config) use ($gateway) {
            return (new AnthropicProvider(
                new AnthropicGateway($app['events']),
                $config,
                $app->make(Dispatcher::class),
            ))->useTextGateway($gateway);
        });
    }
}
