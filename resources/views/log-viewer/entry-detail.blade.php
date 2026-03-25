<div class="space-y-6">
    {{-- Level badge and timestamp --}}
    <div class="flex items-center gap-3">
        <x-filament::badge :color="$entry['level_color']">
            {{ $entry['level'] }}
        </x-filament::badge>
        <span class="text-sm text-gray-500 dark:text-gray-400">
            {{ $entry['timestamp'] }}
        </span>
    </div>

    {{-- Full message --}}
    <div>
        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            {{ __('fin-sentinel::fin-sentinel.log_column_message') }}
        </h4>
        <div class="font-mono text-sm whitespace-pre-wrap break-words bg-gray-50 dark:bg-gray-900 rounded-lg p-4 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-700">{!! nl2br(e($entry['message'])) !!}</div>
    </div>

    {{-- Stack trace --}}
    @if ($entry['has_stack_trace'])
        <div>
            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ __('fin-sentinel::fin-sentinel.error_section_trace') }}
            </h4>
            <div class="max-h-96 overflow-y-auto bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                @php
                    $lines = explode("\n", $entry['stack_trace']);
                    $frames = [];
                    $currentFrame = null;

                    foreach ($lines as $line) {
                        if (preg_match('/^#\d+\s/', $line)) {
                            if ($currentFrame !== null) {
                                $frames[] = $currentFrame;
                            }
                            $currentFrame = ['header' => $line, 'isVendor' => str_contains($line, '/vendor/')];
                        } elseif ($currentFrame !== null) {
                            $currentFrame['header'] .= "\n" . $line;
                        } else {
                            // Non-frame lines at the start (e.g., exception message continuation)
                            $frames[] = ['header' => $line, 'isVendor' => false, 'context' => true];
                        }
                    }

                    if ($currentFrame !== null) {
                        $frames[] = $currentFrame;
                    }
                @endphp

                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($frames as $frame)
                        @if (isset($frame['context']))
                            <div class="px-4 py-2">
                                <pre class="font-mono text-sm text-gray-800 dark:text-gray-200 whitespace-pre-wrap break-all">{{ $frame['header'] }}</pre>
                            </div>
                        @else
                            <div
                                x-data="{ expanded: {{ $frame['isVendor'] ? 'false' : 'true' }} }"
                                class="{{ $frame['isVendor'] ? 'opacity-60 hover:opacity-100 transition-opacity' : '' }}"
                            >
                                <button
                                    type="button"
                                    @click="expanded = !expanded"
                                    class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                                >
                                    <div class="flex items-center gap-2">
                                        <svg
                                            class="h-4 w-4 text-gray-400 transition-transform duration-200 shrink-0"
                                            :class="{ 'rotate-90': expanded }"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                        </svg>
                                        @php
                                            $headerText = $frame['header'];
                                            // Highlight file paths and line numbers
                                            $highlighted = preg_replace(
                                                '/([\/\w\-\.]+\.php)(\((\d+)\))?/',
                                                '<span class="text-blue-600 dark:text-blue-400">$1</span><span class="text-amber-600 dark:text-amber-400">$2</span>',
                                                e($headerText)
                                            );
                                        @endphp
                                        <pre class="font-mono text-xs whitespace-pre-wrap break-all flex-1">{!! $highlighted !!}</pre>
                                    </div>
                                </button>
                                <div
                                    x-show="expanded"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 -translate-y-1"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 -translate-y-1"
                                    class="px-4 pb-2"
                                >
                                    <pre class="font-mono text-xs text-gray-600 dark:text-gray-400 whitespace-pre-wrap break-all pl-6">{{ $frame['header'] }}</pre>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- Copy buttons --}}
    <div class="flex gap-3 pt-2 border-t border-gray-200 dark:border-gray-700">
        @if ($entry['has_stack_trace'])
            <div x-data="{ copied: false }">
                <x-filament::button
                    color="gray"
                    size="sm"
                    icon="heroicon-o-clipboard"
                    x-on:click="
                        navigator.clipboard.writeText(@js($entry['stack_trace']));
                        copied = true;
                        setTimeout(() => copied = false, 2000);
                    "
                >
                    <span x-show="!copied">{{ __('fin-sentinel::fin-sentinel.log_copy_trace') }}</span>
                    <span x-show="copied" x-cloak>{{ __('fin-sentinel::fin-sentinel.log_copied') }}</span>
                </x-filament::button>
            </div>
        @endif

        <div x-data="{ copied: false }">
            @php
                $fullEntry = $entry['message'];
                if ($entry['has_stack_trace']) {
                    $fullEntry .= "\n\n" . $entry['stack_trace'];
                }
            @endphp
            <x-filament::button
                color="gray"
                size="sm"
                icon="heroicon-o-clipboard-document"
                x-on:click="
                    navigator.clipboard.writeText(@js($fullEntry));
                    copied = true;
                    setTimeout(() => copied = false, 2000);
                "
            >
                <span x-show="!copied">{{ __('fin-sentinel::fin-sentinel.log_copy_entry') }}</span>
                <span x-show="copied" x-cloak>{{ __('fin-sentinel::fin-sentinel.log_copied') }}</span>
            </x-filament::button>
        </div>
    </div>
</div>
