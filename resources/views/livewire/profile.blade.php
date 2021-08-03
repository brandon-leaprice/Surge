<div>
    <form wire:submit.prevent="save">
        <input wire:model="username" type="text">
        <input wire:model="about" type="text">

        <button type="submit">Save</button>
    </form>
</div>
