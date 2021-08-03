<div>
    <form wire:submit.prevent="register">
        <input wire:model.lazy="name" type="text">
        @error('name')  <span>{{$message}}</span> @enderror
        <input wire:model.lazy="email" type="text">
        @error('email')  <span>{{$message}}</span> @enderror
        <input wire:model.lazy="password" type="password">
        @error('password')  <span>{{$message}}</span> @enderror
        <input wire:model.lazy="passwordConfirmation" type="password">

        <button type="submit">Register</button>
    </form>
</div>
