<?php
require 'classes/Database.php';

$database = new Database;
//var_dump($database);


$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if ($post['submit']) {
    $title = $post['title'];
    $body = $post['body'];

$database->query('INSERT INTO posts (title, body) VALUES(:title, :body)');
$database->bind(':title', $title);
$database->bind(':body', $body);
$database->execute();
if ($database->lastInsertId()) {
    echo '<p>Post Add</p>';
}

}

$database->query('SELECT * FROM posts');
//$database->bind(':id', 1);
$rows = $database->resultset();

?>
<h1>Add Post</h1>
<form method="post" method="<?php $_SERVER['PHP_SELF']; ?>">
    <label>Post Title</label><br />
    <input type="text" name="title" placeholder="Add a title..." /><br /><br />
    <label>Post Body</label><br />
    <textarea name="body"></textarea><br />
    <input type="submit" name="submit" value="Submit" />
</form>

<h1>Posts</h1>
<div>
<?php foreach($rows as $row): ?>
    <div>
        <h3><?php echo $row['title']; ?></h3>
        <p><?php echo $row['body']; ?></p>
    </div>
<?php endforeach; ?>
</div>