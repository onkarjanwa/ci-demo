<?= $this->extend('main') ?>

<?= $this->section('content') ?>
    <div class="hero">
        <h1>Login</h1>
    </div>

    <form method="post" action="/login">

        <?php if($error) { ?> 
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

        <div style="margin-top: 10px;">
            User: user@cidemo.com/user@123
            <br/>
            Admin: admin@cidemo.com/admin@123
            <br/>
            Superadmin: superadmin@cidemo.com/superadmin@123
        </div>
    </form>
<?= $this->endSection() ?>