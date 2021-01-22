<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>

<div class="container">
    <h2>Случайная запись</h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">NAME</th>
            <th scope="col">START</th>
            <th scope="col">END</th>
            <th scope="col">STATUS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row"><?php echo $random['id']; ?></th>
            <td><?php echo $random['name']; ?></td>
            <td><?php echo $random['start_date']; ?></td>
            <td><?php echo $random['end_date']; ?></td>
            <td><?php echo $random['status']; ?></td>
        </tr>
        </tbody>
    </table>

    <h2>Все записи</h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">NAME</th>
            <th scope="col">START</th>
            <th scope="col">END</th>
            <th scope="col">STATUS</th>
            <th scope="col">SLUG</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $sale): ?>
            <tr>
                <th scope="row"><?php echo $sale['id']; ?></th>
                <td><?php echo $sale['name']; ?></td>
                <td><?php echo $sale['start_date']; ?></td>
                <td><?php echo $sale['end_date']; ?></td>
                <td><?php echo $sale['end_date']; ?></td>
                <td><a href="<?php echo $sale['link']; ?>"><?php echo $sale['link']; ?></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
</body>
</html>