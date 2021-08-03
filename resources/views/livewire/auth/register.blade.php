<div>
    <form wire:submit.prevent="register">
        <input wire:model="name" type="text">
        <input wire:model="email" type="text">
        <input wire:model="password" type="password">
        <input wire:model="passwordConfirmation" type="password">

        <button type="submit">Register</button>
    </form>
</div>
