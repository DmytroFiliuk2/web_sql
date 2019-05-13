<?php

error_reporting(-1);
ini_set('display_errors', 'On');
include 'src/main.php';
require_once "src/functions.php";
$links = $paginator->pageUrls();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Web task </title>

    <!-- Bootstrap core CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>


<body>

<div class="jumbotron text-center" style="margin-bottom:0">
    <h1>web hw </h1>

</div>

<div class="container">

    <div class="row">
        <div class="col-md-8">
            <!-- Sidebar Widgets Column -->
            <div class="container">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>name</th>
                        <th>url</th>
                        <th>price</th>
                        <th>tags</th>
                    </tr>
                    </thead>
                    <?php //if (count($currentPageContent) > 0) {
                    if (true) {

                        $dud = $paginator->getPageContent();
                        foreach ($dud as $book) {
                            ?>
                            <tr>
                                <td><?= (key_exists('ISBN', $book)) ? $book['ISBN'] : 'ISBN is not insert' ?></td>
                                <td><?= (key_exists('book_name',
                                        $book)) ? $book['book_name'] : 'name is not insert' ?></td>
                                <td><a href="<?= (key_exists('url', $book)) ? $book['url'] : 'url is not insert' ?>">
                                        <img src="<?= (key_exists('poster',
                                            $book)) ? $book['poster'] : 'poster is not insert' ?>" width="189"
                                             height="255">
                                    </a></td>
                                <td><?= (key_exists('ISBN', $book)) ? $book['price'] : 'price is not insert' ?></td>
                                <td><?= (key_exists('tags', $book)) ? $book['tags'] : 'tags is not insert' ?></td>

                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td>No results </td></tr>";
                    }
                    ?>
                </table>
            </div>
            <ul class="pagination">

                <li class="page-item">
                    <a class="page-link"
                       href="<?= $links[$paginator->previousPage]?>"
                       tabindex="-1" aria-label="Previous">
                        <span aria-hidden="false">&laquo;</span>
                        <span class="sr-only">First</span>
                    </a>
                </li>
                <?php

                foreach ($links as $id => $link) {
                    if ($id==$paginator->currentPage){
                        echo " <li class=\"page-item active\"><a class=\"page-link\" href=\"{$link}\">{$id}</a></li>";
                    }else{
                        echo "<li class=\"page-item\"><a class=\"page-link\" href=\"{$link}\">{$id}</a></li>";
                    }
                } ?>
                <li>
                    <a class="page-link"
                       href="<?= $links[$paginator->nextPage]?>"
                       aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Last</span>
                    </a>
                </li>
            </ul>

        </div>

        <div class="col-md-4">

            <!-- Search Widget -->
            <form action="src/RequestParams.php" method="GET">
                <div class="card my-4">
                    <h5 class="card-header">Search</h5>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search for..." name="searchParam"
                                   value="<?= isset($_SESSION['searchParam']) ? $_SESSION['searchParam'] : '' ?>"
                                   maxlength="300">

                        </div>
                        <div class="form-group">
                                <span class="input-group-btn">
                                        <button class="btn btn-info" type="submit">Go!</button>
                                </span>
                        </div>
                    </div>
                </div>
            </form>

            <form action="src/RequestParams.php" method="POST">
                <div class="card my-4">
                    <h5 class="card-header">Pagination value</h5>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="number" class="form-control" name="paginationParam"
                                   placeholder="books per page ..." value="<?= $currentPaginationValue ?>" max="100"
                                   min="1">
                        </div>
                        <div class="form-group">
                                <span class="input-group-btn">
                                        <button class="btn btn-info" type="submit">Go!</button>
                                </span>
                        </div>
                    </div>
                </div>
            </form>

            <form action="src/RequestParams.php" method="GET" name="sho">
                <div class="card my-4">
                    <h5 class="card-header">Ordered by </h5>
                    <div class="card-body">
                        <div class="form-group">
                            <p>
                                <label><input name="price_name" type="radio"
                                              value="price" <?= checkOrderCookies('price') ?>>Price</label>
                                <label><input name="price_name" type="radio"
                                              value="name" <?= checkOrderCookies('name') ?>>Name</label></p>
                        </div>
                        <div class="form-group">
                        <span class="input-group-btn">
                                        <button class="btn btn-info"
                                                type="submit">Go!</button>
                                </span>
                        </div>

                    </div>
                </div>
            </form>
            <form action="src/RequestParams.php" method="GET">
                <div class="card my-4">
                    <h5 class="card-header">Sort by tags</h5>
                    <div class="card-body">
                        <div class="form-group">
                            <?php
                            $tags = getTagsArr($dbConnection);
                            foreach ($tags as $tag) {
                                ?>
                                <p><label><input type="checkbox" name="tags[]"
                                                 value="<?= $tag['tag_name'] ?>" <?= checkTagCookies($tag['tag_name']) ?>><?= $tag['tag_name'] ?>
                                    </label></p>
                                <?php
                            }
                            ?>
                            <button type="submit" name="submit" value="tag" class="btn btn-info">Go!</button>
                        </div>
                    </div>
                </div>

            </form>


        </div>
    </div>
</div>

<div class="jumbotron text-center" style="margin-bottom:0">
    <p>Footer</p>
</div>
</body>