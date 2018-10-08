<?php
include("inc/data.php");
include("inc/functions.php");
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

<div class="page catalog section">
    <div class="wrapper">
        <h1><?php echo $pageTitle; ?></h1>
        <ul class="items">
            <?php
            foreach ($catalog as $id => $item) {
                echo get_item_html($id, $item);
            }
            ?>
        </ul>
    </div>
</div>

<?php include("inc/footer.php"); ?>
