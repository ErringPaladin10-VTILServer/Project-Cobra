<?php

function search($keyword, $category, $resultsperpage=30, $pagenumber=1){
    echo file_get_contents('https://search.roblox.com/catalog/json?category='.urlencode($category).'&Keyword='.urlencode($keyword).'&ResultsPerPage='.urlencode($resultsperpage).'&PageNumber='.urlencode($pagenumber));
}

if (isset($_GET['Keyword'])) {
    search($_GET['Keyword'], $_GET['Category'], $_GET['ResultsPerPage'], $_GET['PageNumber']);
}

?>