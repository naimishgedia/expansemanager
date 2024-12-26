<!DOCTYPE html>
<html lang="en"> 
<head> 
@include('layouts.partials.head')
</head>
<body>
@include('layouts.partials.sidebar')
@yield('content')
@include('layouts.partials.footer')
</body>
</html>