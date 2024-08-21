@csrf
<div class="mb-3">
    <label class="form-label">Nama lengkap</label>
    <input type="text" class="form-control {{ $errors->get('name') ? 'is-invalid' : '' }}" placeholder="Masukan nama lengkap" name="name"
        value="{{ old('name',$user->name ?? '') }}" />
    <x-input-error :messages="$errors->get('name')" />
</div>
<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" class="form-control{{ $errors->get('email') ? ' is-invalid' : '' }}" placeholder="Alamat email" name="email"
        value="{{ old('email',$user->email ?? '') }}" />
    <x-input-error :messages="$errors->get('email')" />
</div>
<div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" class="form-control{{ $errors->get('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password"
        value="{{ old('password') }}" />
    <x-input-error :messages="$errors->get('password')" />
</div>
<div class="mb-3">
    <label class="form-label">Konfirmasi password</label>
    <input type="password" class="form-control{{ $errors->get('password_confirmation') ? ' is-invalid' : '' }}" placeholder="Konfirmasi Password" name="password_confirmation" />
    <x-input-error :messages="$errors->get('password_confirmation')" />
</div>
<div class="mb-3">
    <label class="form-label">Foto profil</label>
    <input type="file" class="form-control{{ $errors->get('password_confirmation') ? ' is-invalid' : '' }}" placeholder="Konfirmasi Password" name="image" />
    <x-input-error :messages="$errors->get('image')" />

    @isset($user)
    <div class="mt-3">
        @if($user->getFirstMediaUrl())
        <img src="{{ $user->getFirstMediaUrl() }}" class="rounded-pill" style="width:100px;height:100px;object-fit: cover;"/>
        @endif
    </div>
    @endisset

</div>
