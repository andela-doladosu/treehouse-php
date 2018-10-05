<?php
$pageTitle = "Full Catalog";

if (isset($_GET['cat'])) {
    if ($_GET['cat'] === 'books') {
        $pageTitle = 'Books';
    } elseif ($_GET['cat'] === 'movies') {
        $pageTitle = 'Movies';
    } elseif ($_GET['cat'] === 'music') {
        $pageTitle = 'Music';
    }
}

include("inc/header.php");
?>

<div class="page section">
    <h1><?php echo $pageTitle; ?></h1>
</div>

<?php include("inc/footer.php"); ?>
