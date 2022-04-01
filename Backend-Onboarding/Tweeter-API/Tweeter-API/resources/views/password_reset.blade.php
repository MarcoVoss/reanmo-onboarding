@include("header")
<body class="antialiased">
    Hello <strong>{{auth()->user()?->name}}</strong>, your password has been reset!
    <h3><a href="{{env("APP_URL_FRONTEND")}}">To our Website</a></h3>
</body>
@include("footer")

