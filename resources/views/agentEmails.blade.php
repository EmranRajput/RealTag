<!DOCTYPE html>
<html>
<head>
    <title>Agent Emails</title>
</head>
<body>

    <h1>Agent Emails</h1>

    @if($agentEmails->isEmpty())
        <p>No agent emails found.</p>
    @else
        <ul>
            @foreach($agentEmails as $email)
                <li>{{ $email }}</li>
            @endforeach
        </ul>
    @endif

</body>
</html>
