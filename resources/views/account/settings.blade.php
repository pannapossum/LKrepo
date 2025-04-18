@extends('account.layout')

@section('account-title')
    Settings
@endsection

@section('account-content')
    {!! breadcrumbs(['My Account' => Auth::user()->url, 'Settings' => 'account/settings']) !!}

    <h1>Settings</h1>


    <div class="row">
        <div class="col-6">
            <div class="card p-3 mb-2">
                <h3>Avatar</h3>
                <div class="text-left">
                    <div class="alert alert-warning">Please note a hard refresh may be required to see your updated avatar. Also please note that uploading a .gif will display a 500 error after; the upload should still work, however.</div>
                </div>
                {!! Form::open(['url' => 'account/avatar', 'files' => true]) !!}
                <div class="form-group row">
                    {!! Form::label('avatar', 'Update', ['class' => 'col-md-2 col-form-label']) !!}
                    <div class="col-md-10">
                        {!! Form::file('avatar', ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-6">
            <div class="card p-3 mb-2">
                <h3>Profile Header Image</h3>
                {!! Form::open(['url' => 'account/profile_img', 'files' => true]) !!}
                <div class="form-group row">
                    {!! Form::label('profile_img', 'Update', ['class' => 'col-md-2 col-form-label']) !!}
                    <div class="col-md-10">
                        {!! Form::file('profile_img', ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    @if (config('lorekeeper.settings.allow_username_changes'))
        <div class="card p-3 mb-2">
            <h3>Change Username</h3>
            @if (config('lorekeeper.settings.username_change_cooldown'))
                <div class="alert alert-info">
                    You can change your username once every {{ config('lorekeeper.settings.username_change_cooldown') }} days.
                </div>
                @if (Auth::user()->logs()->where('type', 'Username Change')->orderBy('created_at', 'desc')->first())
                    <div class="alert alert-warning">
                        You last changed your username on {{ Auth::user()->logs()->where('type', 'Username Change')->orderBy('created_at', 'desc')->first()->created_at->format('F jS, Y') }}.
                        <br />
                        <b>
                            You will be able to change your username again on
                            {{ Auth::user()->logs()->where('type', 'Username Change')->orderBy('created_at', 'desc')->first()->created_at->addDays(config('lorekeeper.settings.username_change_cooldown'))->format('F jS, Y') }}.
                        </b>
                    </div>
                @endif
            @endif
            {!! Form::open(['url' => 'account/username']) !!}
            <div class="form-group row">
                <label class="col-md-2 col-form-label">Username</label>
                <div class="col-md-10">
                    {!! Form::text('username', Auth::user()->name, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="text-right">
                {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    @endif

    <div class="card p-3 mb-2">
        <h3>Profile</h3>
        {!! Form::open(['url' => 'account/profile']) !!}
        <div class="form-group">
            {!! Form::label('text', 'Profile Text') !!}
            {!! Form::textarea('text', Auth::user()->profile->text, ['class' => 'form-control wysiwyg']) !!}
        </div>
        <div class="text-right">
            {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>

    <div class="card p-3 mb-2">
        <h3>Birthday Publicity</h3>
        {!! Form::open(['url' => 'account/dob']) !!}
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Setting</label>
            <div class="col-md-10">
                {!! Form::select(
                    'birthday_setting',
                    ['0' => '0: No one can see your birthday.', '1' => '1: Members can see your day and month.', '2' => '2: Anyone can see your day and month.', '3' => '3: Full date public.'],
                    Auth::user()->settings->birthday_setting,
                    ['class' => 'form-control'],
                ) !!}
            </div>
        </div>
        <div class="text-right">
            {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>

    <div class="card p-3 mb-2">
        <h3>Character Comments</h3>
        <p>If enabled, others will be able to comment on your characters and/or MYO slots.</p>
        {!! Form::open(['url' => 'account/character-comments']) !!}
        <div class="form-group">
            {!! Form::checkbox('character_comments', 1, Auth::user()->settings->character_comments, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
            {!! Form::label('character_comments', 'Characters', ['class' => 'form-check-label ml-3']) !!}
        </div>
        <div class="form-group">
            {!! Form::checkbox('myo_comments', 1, Auth::user()->settings->myo_comments, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
            {!! Form::label('myo_comments', 'MYO Slots', ['class' => 'form-check-label ml-3']) !!}
        </div>
        <div class="text-right">
            {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>

    <div class="card p-3 mb-2">
        <h3>Email Address</h3>
        <p>Changing your email address will require you to re-verify your email address.</p>
        {!! Form::open(['url' => 'account/email']) !!}
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Email Address</label>
            <div class="col-md-10">
                {!! Form::text('email', Auth::user()->email, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="text-right">
            {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>

    <div class="card p-3 mb-2">
        <h3>Change Password</h3>
        {!! Form::open(['url' => 'account/password']) !!}
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Old Password</label>
            <div class="col-md-10">
                {!! Form::password('old_password', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">New Password</label>
            <div class="col-md-10">
                {!! Form::password('new_password', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Confirm New Password</label>
            <div class="col-md-10">
                {!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="text-right">
            {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>

    <div class="card p-3 mb-2">
        <h3>Two-Factor Authentication</h3>

        <p>Two-factor authentication acts as a second layer of protection for your account. It uses an app on your phone-- such as Google Authenticator-- and information provided by the site to generate a random code that changes frequently.</p>

        <div class="alert alert-info">
            Please note that two-factor authentication is only used when logging in directly to the site (with an email address and password), and not when logging in via an off-site account. If you log in using an off-site account, consider enabling
            two-factor authentication on that site instead!
        </div>

        @if (!isset(Auth::user()->two_factor_secret))
            <p>In order to enable two-factor authentication, you will need to scan a QR code with an authenticator app on your phone. Two-factor authentication will not be enabled until you do so and confirm by entering one of the codes provided by your
                authentication app.</p>
            {!! Form::open(['url' => 'account/two-factor/enable']) !!}
            <div class="text-right">
                {!! Form::submit('Enable', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        @elseif(isset(Auth::user()->two_factor_secret))
            <p>Two-factor authentication is currently enabled.</p>

            <h4>Disable Two-Factor Authentication</h4>
            <p>To disable two-factor authentication, you must enter a code from your authenticator app.</p>
            {!! Form::open(['url' => 'account/two-factor/disable']) !!}
            <div class="form-group row">
                <label class="col-md-2 col-form-label">Code</label>
                <div class="col-md-10">
                    {!! Form::text('code', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="text-right">
                {!! Form::submit('Disable', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        @endif
    </div>
<div class="card p-3 mb-2">
    <h3>Character {{ ucfirst(__('character_likes.likes')) }} Setting</h3>
    {!! Form::open(['url' => 'account/character-likes']) !!}
    <div class="form-group row">
        <label class="col-md-2 col-form-label">Setting</label>
        <div class="col-md-10">
            {!! Form::select('allow_character_likes',['0' => 'Do not allow other users to ' . __('character_likes.like') . ' your characters.', '1' => 'Other users can ' . __('character_likes.like') . ' your characters.',],Auth::user()->settings->allow_character_likes,['class' => 'form-control'],) !!}
        </div>
    </div>
    <div class="text-right">
        {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>

@endsection
