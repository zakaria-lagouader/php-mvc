<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts Page</title>
</head>
<body>
    <h1>Hello World</h1>
    <?php foreach($posts as $post): ?>
        <div>
            <h2><?= $post->titre ?></h2>
            <p><?= $post->text ?></p>
            <hr>
        </div>
    <?php endforeach; ?>
    <form action="/" method="post">
        <input type="text" name="titre" value="test"> <br>
        <textarea name="text" rows="10"></textarea> <br>
        <button>test</button>
    </form>
</body>
</html>