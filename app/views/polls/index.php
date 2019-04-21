<?php require APPROOT . '/views/includes/header.php'; ?>  
    <div class="card bg-light mb-3">
        <div class="card-body">
            <h3 class="card-title text-center">Our mission</h3>
            <p class="card-text text-center">RemoteJobs is a company that values attitude over everything. Our vision is to be the greatest talent company in the world, and we've will give our best to scale faster than any other talent company in history through our relentless attitude toward innovation and strong execution.</p>
        </div>
    </div>
    <?php if(!$data['liked']): ?>
        <div class="card bg-light"> 
            <h3 class="card-title text-center mt-3 mb-1">Did you find any interesting offers?</h3>
            <div class="card-body">
                <form action="<?php echo URLROOT; ?>/polls/add" method="POST">
                    <div class="d-flex justify-content-around">
                        <div class="form-group d-flex align-items-center">
                            <label class="mb-0 mr-1">Yes: </label>
                            <input type="radio" name="liked" value="1" checked>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label class="mb-0 mr-1">No: </label>
                            <input type="radio" name="liked" value="0">
                        </div> 
                    </div>
                    <button type="submit" class="btn btn-dark btn-block">
                        <span class="fa fa-share-square"></span>
                        <span>Submit</span>
                    </button>  
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="card bg-light">
            <h3 class="card-title text-center mt-3 mb-1">Thank you for the feedback!</h3>
            <div class="card-body">
                <p class="card-text d-flex justify-content-around">
                    <span>Positive: <?= $data['positive']; ?></span>
                    <span>Negative: <?= $data['negative']; ?></span>
                </p>
            </div>
        </div>
    <?php endif; ?>
<?php require APPROOT . '/views/includes/footer.php'; ?>