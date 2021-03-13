# PHP MVC Framework

small php mvc framework build from scratch with php.

## What is included?

### basic routing


```php
    Router::get('/', function (){
        echo "Home Page";
    });
```
or 

```php
    Router::get('/', [Controllers\HomeController::class, 'index']);
```

### basic view rendring


```php
    public function index()
    {
        $posts = [
            ['title' => 'post 1', 'body' => 'lorem ipsum'],
            ['title' => 'post 2', 'body' => 'lorem ipsum'],
        ];
        View::page("index", ['posts' => $posts]);
    }
```

### basic query builder

```php
    // the Post model in app/models
    class Post extends Model {
        // specify the table name
        protected static $table = "posts";
    }
```

```php
    // retrieve all posts
    Post::all();

    // Get Post By Id
    Post::find(1);
    // Create a new Post

    $post = new Post();
    $post->title = "post 1";
    ...
    $post->save();

    // Or
    $post = Post::create([
        'title' => "post 1",
        ...
    ])
    $post->save();

    // Delete Post
    $post = Post::find(1);
    $post->delete();
```

### basic request validation

```php
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2|max:100'
            ....
        ]);
    }
```

