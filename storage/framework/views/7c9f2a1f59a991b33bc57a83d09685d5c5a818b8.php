<!DOCTYPE html>
<html>
<head>
    <title>Vue CRUD</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<body>
    <div id="app">
        <v-nav></v-nav>
        <clients></clients>
    </div>
<script src="<?php echo e(asset('js/app.js')); ?>"></script>
</body>
</html>