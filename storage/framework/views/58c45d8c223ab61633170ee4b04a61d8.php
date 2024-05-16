<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="<?php echo e(mix('public/css/app.css')); ?>">
</head>
<body>
    <div id="app">
        <h1>Welcome to My App</h1>
        <coupon-list></coupon-list>
    </div>

    <!-- Include Vue.js library -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/vue@2"></script> -->
    <script src="<?php echo e(mix('public/js/app.js')); ?>"></script>

    <!-- <script>
        // Define Vue component
        Vue.component('coupon-list');

        // Initialize Vue app
        new Vue({
            el: '#app'
        });
    </script> -->
</body>
</html>
<?php /**PATH C:\xampp\htdocs\coupon-mgt\resources\views/welcome.blade.php ENDPATH**/ ?>