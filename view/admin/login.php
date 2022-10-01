<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/sign-in/signin.css" rel="stylesheet">
</head>

<body class="text-center">
    <form class="form-signin" method="POST">
        <input type="hidden" name="module" value="dashboard">
        <input type="hidden" name="action" value="login">
        <input type="hidden" name="postAction" value="1">

        <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="username" class="sr-only">Name</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus
            value="<?= $_POST['username'] ?? ''?>">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required
            value="<?= $_POST['password'] ?? ''?>">
        <div class="text-danger">
            
            <?php foreach ($_SESSION['validationRules']['errors'] ?? array() as $error) { ?>
                 <?= $error ?> 
                 <br>
            <?php } ?>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2022</p>
    </form>
</body>

</html>