<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Signup Confirmation</title>
</head>
<body>
  <h1>Thank you for your signing up!</h1>

  <p>
    Please click this link to finish sign up:
    <a href="{{route('confirm_email',$user->activation_token)}}">
      {{route('confirm_email',$user->activation_token)}}
    </a>
  </p>

  <p>
    If not your activation,pleas don't click this link.
  </p>
</body>
</html>
