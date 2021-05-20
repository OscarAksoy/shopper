<x-shopper-modal
    headerClasses="bg-white p-4 sm:px-6 sm:py-4 border-b border-gray-100"
    contentClasses="relative p-4 sm:px-6 sm:px-5"
    footerClasses="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
>

    <x-slot name="title">
        {{ __('Update payment method') }}
    </x-slot>

    <x-slot name="content">
        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
            <div class="sm:col-span-2">
                <div>
                    <x-shopper-label value="{{ __('Provider Logo') }}" />
                    <div class="mt-2">
                        <x-shopper-input.file-upload id="logo" wire:model.lazy='logo'>
                            <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                @if($logo)
                                    <img class="h-full w-full bg-center" src="{{ $logo->temporaryUrl() }}" alt="">
                                @elseif($logoUrl)
                                    <img class="h-full w-full bg-center" src="{{ $logoUrl }}" alt="">
                                @else
                                    <span class="h-12 w-12 flex items-center justify-center">
                                        <svg class="h-8 w-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                @endif
                            </span>
                        </x-shopper-input.file-upload>
                    </div>
                </div>
            </div>
            <div class="sm:col-span-2">
                <x-shopper-input.group label="Custom payment method name" for="title" :error="$errors->first('title')" isRequired>
                    <x-shopper-input.text wire:model.lazy="title" id="title" />
                </x-shopper-input.group>
            </div>
            <div class="sm:col-span-2">
                <x-shopper-input.group label="Payment Website Documentation" for="link_url">
                    <x-shopper-input.text wire:model.lazy="linkUrl" type="url" id="link_url" placeholder="https://doc.myprovider.com" />
                </x-shopper-input.group>
            </div>
            <div class="sm:col-span-2">
                <x-shopper-input.group label="Additional details" for="description" helpText="Displays to customers when they’re choosing a payment method.">
                    <x-shopper-input.textarea wire:model.lazy="description" id="description" />
                </x-shopper-input.group>
            </div>
            <div class="sm:col-span-2">
                <x-shopper-input.group label="Payment instructions" for="instructions" helpText="Displays to customers after they place an order with this payment method.">
                    <x-shopper-input.textarea wire:model.lazy="instructions" id="instructions" />
                </x-shopper-input.group>
            </div>
        </div>
    </x-slot>

    <x-slot name="buttons">
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
            <x-shopper-button wire:click="save" type="button">
                <x-shopper-loader wire:loading wire:target="save" class="text-white" />
                {{ __('Update') }}
            </x-shopper-button>
        </span>
        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <x-shopper-default-button wire:click="$emit('closeModal')" type="button">
                {{ __('Cancel') }}
            </x-shopper-default-button>
        </span>
    </x-slot>

</x-shopper-modal>
