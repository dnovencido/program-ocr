<?php
    include 'session.php';
    include 'check_login.php';
    include 'functions.php';
    

    if (isset($_GET['page_no'])) {
        $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
    }

    $total_records_per_page = 10;
    $offset = ($page_no - 1 ) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 

	$total_records = get_total_number_records();
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1


    $transactions = get_all_transactions($offset, $total_records_per_page);
?>
<?php include '_header.php'; ?>
    <div class="container">
        <h1 class="h3 mb-3 fw-normal"> Transactions </h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Transaction ID</th>
                    <th scope="col">Reference Number</th>
                    <th scope="col">Number</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($transactions)) { ?>
                    <?php foreach ($transactions as $row) { ?>
                        <tr>
                            <td><?= $row['tranID'] ?></td>
                            <td><?= $row['refnum'] ?></td>
                            <td><?= $row['number'] ?></td>
                            <td><?= $row['amount'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['date_created'] ?></td>
                            <td>
                                <a href="edit-transaction.php?id=<?=$row['tranID']?>" class="btn btn-outline-secondary btn-sm">Edit</a>
                                <a data-id="<?= $row['tranID'] ?>" href="#" class="btn btn-outline-danger btn-sm btn-delete-transaction">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="6">No transactions as of the moment...</td>
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