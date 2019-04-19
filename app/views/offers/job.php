<?php require APPROOT . '/views/includes/header.php'; ?>    
    <a href="<?= URLROOT; ?>/offers" class="btn btn-dark btn-block mb-3">
        <span class="fa fa-backspace"></span>
        <span>Return to offers</span>
    </a>
    <h1><?php echo $data['offer']->title; ?></h1>
    <?php if($data['offer']->user_id == $_SESSION['user_id']) : ?>
        <div class="d-flex justify-content-between">
            <a href="<?= URLROOT; ?>/offers/edit/<?= $data['offer']->id; ?>" class="btn btn-primary"/>
                <span class="fa fa-edit"></span>
            </a>
            <form action="<?php echo URLROOT; ?>/offers/delete/<?= $data['offer']->id; ?>" method="POST">
                <button type="submit" value="Delete" class="btn btn-danger">
                    <span class="fa fa-trash"></span>
                </button>
            </form>
        </div>
    <?php endif; ?> 
<?php require APPROOT . '/views/includes/footer.php'; ?>