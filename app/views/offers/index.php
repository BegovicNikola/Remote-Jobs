<?php require APPROOT . '/views/includes/header.php'; ?>    
    <div class="jumbotron text-center mb-0">
        <h1 class="display-4">Available Offers</h1>
        <a href="<?php echo URLROOT; ?>/offers/add" class="btn btn-dark">
            <span class="fa fa-edit"></span>
            Post Offer
        </a>
    </div>
    <?php foreach($data['offers'] as $offer): ?>
        <div class="card my-3">
            <div class="card-body">
                <div class="card-title d-flex align-items-end">
                    <h3 class="mb-0"><?= $offer->title; ?></h3>
                    <span>@</span>
                    <span><?= $offer->company; ?></span>
                    <a href="<?= URLROOT; ?>/offers/show/<?= $offer->o_id; ?>" class="ml-auto btn btn-dark btn-sm">
                        <span class="fa fa-clone"></span>
                        <span class="font-weight-bold">View</span>
                    </a> 
                </div>
                <p class="card-text"><?= $offer->description; ?></p>
                <div class="card-text d-flex justify-content-between">
                    <p>Posted by: <?= $offer->name; ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php require APPROOT . '/views/includes/footer.php'; ?>