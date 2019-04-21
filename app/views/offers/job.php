<?php require APPROOT . '/views/includes/header.php'; ?>    
    <a href="<?= URLROOT; ?>/offers" class="btn btn-dark btn-block mb-3">
        <span class="fa fa-chevron-circle-left"></span>
        <span>Return to offers</span>
    </a>
    <div class="card bg-light">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0"><?php echo $data['offer']->title; ?></h2>
                <?php if($data['offer']->user_id == $_SESSION['user_id']) : ?>
                    <div class="d-flex">
                        <a href="<?= URLROOT; ?>/offers/edit/<?= $data['offer']->id; ?>" class="btn btn-primary mr-3"/>
                            <span class="fa fa-edit"></span>
                        </a>
                        <form action="<?php echo URLROOT; ?>/offers/delete/<?= $data['offer']->id; ?>" method="POST">
                            <button type="submit" value="Delete" class="btn btn-danger">
                                <span class="fa fa-trash"></span>
                            </button>
                        </form>
                    </div>
                <?php endif; ?> 
            </div>
            <hr/>
            <h4 class="mt-3"><?= $data['offer']->company; ?></h4>
            <p class="card-text"><?= $data['offer']->description; ?></p>
        </div>
    </div>
<?php require APPROOT . '/views/includes/footer.php'; ?>