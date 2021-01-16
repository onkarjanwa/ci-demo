<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Demo CI App</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />

    <!-- STYLES -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <!-- HEADER: MENU + HEROE SECTION -->
    <header class="container">

        <nav class="navbar navbar-light bg-light">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="/">Home</a>
                </li>
                <?php if(session()->get('logged_in') == true) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/messages">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="/login">Login</a>
                    </li>
                <?php } ?>
            </ul>
        </nav>

    </header>

    <!-- CONTENT -->

    <section class="container" style="margin-top: 20px;">

        <?= $this->renderSection('content') ?>

    </section>

    <!-- FOOTER: DEBUG INFO + COPYRIGHTS -->

    <footer class="container">
    </footer>

</body>

</html>