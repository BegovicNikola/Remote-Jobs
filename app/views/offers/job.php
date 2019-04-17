<?php require APPROOT . '/views/includes/header.php'; ?>    
    <a href="<?= URLROOT; ?>/offers" class="btn btn-dark btn-block mb-3">
        <span class="fa fa-backspace"></span>
        <span>Return to offers</span>
    </a>
    <h1><?php echo $data['offer']->title; ?></h1>
    <?php if($data['offer']->user_id == $_SESSION['user_id']) : ?>
        <a href="<?= URLROOT; ?>/offers/edit/<?= $data['offer']->id; ?>" class="btn btn-primary"/>
            <span class="fa fa-edit"></span>
        </a>
    <?php endif; ?> 
<?php require APPROOT . '/views/includes/footer.php'; ?>