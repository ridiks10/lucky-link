<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        Register Page
    </title>
</head>
<body>
<h1>Register Page</h1>

@error('error')
<p style="color: red;">{{ $message }}</p>
@enderror

<form action="{{ route('register.store') }}" method="post">
    @csrf

    <label for="username">Username:</label>
    <input type="text" name="username" value="{{old('username')}}" id="username" required>
    @error('username')
    <p style="color: red;">{{ $message }}</p>
    @enderror

    <br>

    <label for="phone_number">Phone Number:</label>
    <input type="text" name="phone_number" value="{{old('phone_number')}}" id="phone_number" required>
    @error('phone_number')
    <p style="color: red;">{{ $message }}</p>
    @enderror
    <br>
    <input type="submit" value="Register">
</form>

</body>
</html>
