<div>
    <form wire:submit.prevent="register">
        <input wire:model="name" type="text">
        @error('name')  <span>{{$message}}</span> @enderror
        <input wire:model="email" type="text">
        @error('email')  <span>{{$message}}</span> @enderror
        <input wire:model="password" type="password">
        @error('password')  <span>{{$message}}</span> @enderror
        <input wire:model="passwordConfirmation" type="password">

        <button type="submit">Register</button>
    </form>
</div>
