<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lucky Game</title>
</head>
<body>
<h1>Lucky Game</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@error('error')
<p style="color: red;">{{ $message }}</p>
@enderror

<p>
    Username: {{$user->username}}
    <br>
    Phone Number: {{$user->phone_number}}
    <br>
    Expires Link: {{$link->expires_at->format('D d M Y H:i')}} ({{ $link->expiresIn() }})
    <br>
    <a href="{{ route('link.regenerate', $link) }}">Regenerate Link</a>
    |
    <a href="{{ route('link.deactivate', $link) }}">Deactivate Link</a>
</p>
<hr>

<form action="{{ route('lucky.play', $link) }}" method="post" style="display:inline">
    @csrf
    <input type="submit" value="Imfeelinglucky">
</form>
|
<form action="{{ route('lucky.history', $link) }}" method="post" style="display:inline">
    @csrf
    <input type="submit" value="History">
</form>

@if(session('play_result'))
    @php($res = session('play_result'))
    <div>
        <h3>Game Result</h3>
        <ul>
            <li><strong>Rolled Number:</strong> {{ $res['roll'] }}</li>
            <li><strong>Result:</strong> {{ $res['result'] }}</li>
            <li><strong>Payout:</strong> {{ $res['payout'] }}</li>
        </ul>
    </div>
@endif

@if(session('history'))
    <h3>Game History</h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
        <tr>
            <th>Played At</th>
            <th>Rolled Number</th>
            <th>Result</th>
            <th>Payout</th>
        </tr>
        </thead>
        <tbody>
        @foreach(session('history') as $game)
            <tr>
                <td>{{ $game['created_at'] }}</td>
                <td>{{ $game['roll'] }}</td>
                <td>{{ $game['result'] }}</td>
                <td>{{ $game['payout'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

</body>
</html>
