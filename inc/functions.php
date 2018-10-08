<?php
function get_item_html($id, $item) {
    $output = "<li><a href='#'><img src='"
        .$item['img']."' alt='"
        .$item['title']."' />"
        ."<p>view details</p>"
        ."</a></li>";

    return $output;
}

function array_category($catalog, $category) {
    if ($category === null) {
        return array_keys($catalog);
    }

    $output = [];
    foreach ($catalog as $id => $item) {
        if (strtolower($category) === strtolower($item['category'])) {
            $output[] = $id;
        }
    }

    return $output;
}
