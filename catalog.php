<?php
$pageTitle = "Full Catalog";
$section = null;

if (isset($_GET['cat'])) {
    if ($_GET['cat'] === 'books') {
        $pageTitle = 'Books';
        $section = 'books';
    } elseif ($_GET['cat'] === 'movies') {
        $pageTitle = 'Movies';
        $section = 'movies';
    } elseif ($_GET['cat'] === 'music') {
        $pageTitle = 'Music';
        $section = 'music';
    }
}

include("inc/header.php");
?>

<div class="page section">
    <h1><?php echo $pageTitle; ?></h1>
</div>

<?php include("inc/footer.php"); ?>
