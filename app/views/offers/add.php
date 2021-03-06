<?php require APPROOT . '/views/includes/header.php'; ?>   
    <a href="<?= URLROOT; ?>/offers" class="btn btn-dark btn-block mb-3">
        <span class="fa fa-chevron-circle-left"></span>
        <span>Return to offers</span>
    </a>
    <div class="card bg-light">
        <div class="card-body">
            <h2 class="card-title">Create Offer</h2>
            <p class="card-text">Make a new job offer by entering title, description and company</p>
            <form action="<?php echo URLROOT; ?>/offers/add" method="POST">
                <div class="form-group">
                    <label for="title">Title: </label>
                    <input type="text" name="title" class="form-control <?php echo (!empty($data['title_error'])) ? 'is-invalid' : '';?>" value="<?php echo $data['title']; ?>">
                    <span class="invalid-feedback"><?php echo $data['title_error']; ?></span>
                </div>
                <div class="form-group">
                    <label for="description">Description: </label>
                    <textarea rows="5" name="description" class="form-control <?php echo (!empty($data['description_error'])) ? 'is-invalid' : '';?>"><?php echo $data['description']; ?></textarea>
                    <span class="invalid-feedback"><?php echo $data['description_error']; ?></span>
                </div>
                <div class="form-group">
                    <label for="company">Company: </label>
                    <input type="company" name="company" class="form-control <?php echo (!empty($data['company_error'])) ? 'is-invalid' : '';?>" value="<?php echo $data['company']; ?>">
                    <span class="invalid-feedback"><?php echo $data['company_error']; ?></span>
                </div>   
                <button type="submit" class="btn btn-dark btn-block">
                    <span class="fa fa-share-square"></span>
                    <span>Submit</span>
                </button>
            </form>
        </div>
    </div>
<?php require APPROOT . '/views/includes/footer.php'; ?>