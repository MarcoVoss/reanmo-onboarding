@include("header")
<body class="antialiased">
    Hello {{auth()->user()->name}}, your password has been reset!
</body>
@include("footer")

