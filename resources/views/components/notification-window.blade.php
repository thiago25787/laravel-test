<div
    x-data="{ open: false, success: null, message: null }"
    @notification-popup.window="
        success = $event.detail.success
        message = $event.detail.message
        open = true
        setTimeout(function () {
            open = false
        }, 2000)
    ">
    <div
        class="fixed z-50 top-8 right-8"
        x-show="open"
        x-transition:enter="transition-transform transition-opacity ease-out duration-1000"
        x-transition:enter-start="opacity-0 transform -translate-y-5"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-1000"
        x-transition:leave-end="opacity-0 transform -translate-y-5">
        <template x-if="success === true">
            <div class='grid max-w-sm grid-cols-1 mx-auto overflow-hidden bg-white rounded-lg shadow-md w-96'>
                <div class='flex px-4 py-3'>
                    <svg class='object-cover w-6 h-6 text-green-600 rounded-full' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class='mx-3'>
                        <p class='font-light text-gray-600'>{{ __('Success!') }}</p>
                        <p x-text="message" class='text-sm font-light text-gray-400' ></p>
                    </div>
                </div>
            </div>
        </template>
        <template x-if="success === false">
            <div class='grid max-w-sm grid-cols-1 mx-auto overflow-hidden bg-white rounded-lg shadow-md w-96'>
                <div class='flex px-4 py-3'>
                    <svg class='object-cover w-6 h-6 text-red-600 rounded-full' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class='mx-3'>
                        <p class='font-light text-gray-600'>{{ __('Failure!') }}</p>
                        <p x-text="message" class='text-sm font-light text-gray-400' ></p>
                    </div>
                </div>
            </div>
        </template>

    </div>
</div>
