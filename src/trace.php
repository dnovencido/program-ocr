<?php
    include 'session.php';
    include 'functions.php';

    if (isset($_GET['page_no'])) {
        $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
    }

    $search = (isset($_GET['search'])) ? $_GET['search'] : null;
    $date = (isset($_GET['date'])) ? $_GET['date'] : null;

    $total_records_per_page = 10;
    $offset = ($page_no - 1 ) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 

	$total_records = get_total_number_trace_records($search, $date);
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1;

    $transactions = get_all_trace_transactions($offset, $total_records_per_page, $search, $date);

?>

<?php include '_header.php'; ?>
    <div class="container">
        <h1 class="h3 mb-3 fw-normal"> Audit Trail </h1>
        <div class="search-trail">
            <form method="get">
                <div class="row">
                    <h5>Search audit trail</h5>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="search" placeholder="Enter username or action" value="<?= $search ?>" />
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control" name="date" value="<?= $date ?>" />
                    </div>
                    <div class="col-md-3">
                        <input type="submit" name="submit" class="btn btn-primary btn-md" value="Search" />
                    </div>
                </div>
                
            </form>
        </div>
        <hr class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Trail ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Action</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($transactions)) { ?>
                    <?php foreach ($transactions as $row) { ?>
                        <tr>
                            <td><?= $row['trailid'] ?></td>
                            <td><?= $row['uname'] ?></td>
                            <td><?= $row['action'] ?></td>
                            <td><?= $row['date'] ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="6">No audit trails to display as of the moment...</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php if(!empty($transactions)) { ?>
        <!-- Pagination -->
        <p>Page <?= $page_no." of ".$total_no_of_pages; ?></p>
        <ul class="pagination">
            <li class="page-item <?= ($page_no <= 1) ? 'disabled' : '' ?>"> 
                <a href="<?= ($page_no > 1) ? '?page_no='.$previous_page : '' ?>" class="page-link">Previous</a>
            </li>
                        
            <!-- Page numbers -->
            <?php for ($counter = 1; $counter <= $total_no_of_pages; $counter++) { ?>
                <?php if ($counter == $page_no) { ?>
                    <li class="page-item active"><a class="page-link"> <?= $counter ?> </a></li>
                <?php } else { ?>
                    <li class="page-item"><a href='?page_no=<?=$counter?>' class="page-link"><?= $counter ?></a></li>
                <?php } ?>
            <?php } ?>

             <!-- Next and Last btn -->
            <li class="page-item <?= ($page_no >= $total_no_of_pages) ? "disabled" : "" ?>">
                <a href="<?= ($page_no < $total_no_of_pages) ?  "?page_no=".$next_page : ""?>" class="page-link"> Next  &rsaquo;&rsaquo; </a>
            </li>
            <?php if($page_no < $total_no_of_pages) { ?>
                <li class="page-item"><a href="?page_no=<?=$total_no_of_pages?>" class="page-link">Last</a></li>
            <?php } ?>
        </ul>
        <?php } ?>        
    </div>
<?php include '_footer.php'; ?>