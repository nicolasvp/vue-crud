<!DOCTYPE html>
<html>
<head>
    <title>Vue CRUD</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app">
        <v-nav></v-nav>
        <clients></clients>
    </div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>