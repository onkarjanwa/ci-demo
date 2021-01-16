<?= $this->extend('main') ?>

<?= $this->section('content') ?>
    <section class="container">

        <h1>Create Message</h1>

        <?php if(isset($_SESSION['message_create_success'])) { ?> 
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['message_create_success']; ?>
            </div>
        <?php } ?>

        <form method="post" action="/messages/create">
            <div class="form-group">
                <label for="selectSubject">Select Subject</label>
                <select class="form-control" id="selectSubject" name="subject_id">
                    <?php foreach($subjects as $subject) { ?>
                        <option value="<?php echo  $subject['id'] ?>"><?php echo  $subject['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="text">Text</label>
                <input type="text" class="form-control" id="text" placeholder="Text" name="text" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <h2 style="margin-top: 100px;">All messages</h2>

        <?php if(isset($_SESSION['message_delete_success'])) { ?> 
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['message_delete_success']; ?>
            </div>
        <?php } ?>

        <?php foreach($messages as $message) { ?>

        <div>
            <div>
                Subject: <?php echo $message['subject_name'] ?>
            </div>
            <div>
                User: <?php echo $message['user_name'] ?>
            </div>
            <div>
                <?php echo $message['text'] ?>
            </div>
            <div>
                <a href="/messages/<?= $message['id'] ?>/delete"><button type="button" class="btn btn-primary">Delete</button></a>
            </div>
        </div>

        <hr />
        <?php } ?>
    </section>
<?= $this->endSection() ?>