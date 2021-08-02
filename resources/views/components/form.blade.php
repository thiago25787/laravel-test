@props(['submit'])

<div {{ $attributes->merge(['class' => 'bg-white md:grid md:grid-cols-3 md:gap-6 shadow overflow-hidden sm:rounded-md']) }}>
    <div class="mt-5 md:mt-0 md:col-span-2 border-l border-gray-100">
        <form wire:submit.prevent="{{ $submit }}">
            <div class="">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        {{ $form }}
                    </div>
                </div>

                @if (isset($actions))
                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                        {{ $actions }}
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>
