<div class="max-w-3xl mx-auto">
    <form wire:submit.prevent="ask">
        <x-text-input  wire:model="input"/>
        <x-primary-button type="submit">Submit</x-primary-button>
    </form>
</div>
