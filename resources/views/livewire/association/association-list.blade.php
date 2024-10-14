<div>
    {{ $this->table }}

    <x-modal name="add-association" :show="$errors->isNotEmpty()" focusable>
        <div class="mt-6 flex justify-end">
            <form wire:submit="deleteUser" class="p-6">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>
            </form>
        </div>
    </x-modal>

</div>
