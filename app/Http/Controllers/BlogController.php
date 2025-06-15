<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Status;

class BlogController extends Controller
{
    public function index() {
        $user = "admin";
        $password = "admin12345";
        
        Log::debug('BlogController index ====> START-DEBUG' . " user: ". $user . " password: ". $password);

        Log::info('BlogController index ====> START-INFO');

        Log::notice('BlogController index ====> START-NOTICE');
 
        Log::warning('BlogController index ====> START-WARNING');

        Log::error('BlogController index ====> START-ERROR');
        
        Log::critical('BlogController index ====> START-CRITICAL');

        Log::alert('BlogController index ====> START-ALERT');

        Log::emergency('BlogController index ====> START-EMERGENCY');

        Log::info('BlogController index ====> END');
        return view('admin.adminProfile');
    }

    public function retrieveBlogs() {
        // $blogs = [
        //     ['title' => 'Title 1', 'body' => 'Body 1', 'status' => 1],
        //     ['title' => 'Title 2', 'body' => 'Body 2', 'status' => 0],
        //     ['title' => 'Title 3', 'body' => 'Body 3', 'status' => 1],
        //     ['title' => 'Title 4', 'body' => 'Body 4', 'status' => 0],
        //     ['title' => 'Title 5', 'body' => 'Body 5', 'status' => 1],
        //     ['title' => 'Title 6', 'body' => 'Body 6', 'status' => 0],
        // ];
        // $blogs = DB::table('blogs as b')
        //     ->join('categories as c', 'c.id', '=', 'b.category_id')
        //     ->join('statuses as s', 's.id', '=', 'b.status_id')
        //     ->select('b.id as id', 'b.title as title', 's.name as status', 'c.name as category', 'b.description as description')
        //     ->get();

        $blogs = Blog::withTrashed()->with('category', 'status')->get();

        return view('blogs', compact('blogs'));
    }

    public function createBlog(BlogRequest $request) {
        // DB::table('blogs')->insert([
        //     'title' => $request->input('title'),
        //     'description' => $request->input('description'),
        //     'status_id' => $request->input('status'),
        //     'category_id' => $request->input('category'),
        //     'author_id' => 1, // Assuming author_id is 1 for now
        // ]);

        $post = new Blog();
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->status_id = $request->input('status');
        $post->category_id = $request->input('category');
        $post->author_id = 1;
        $post->save();

        // dd($post->id);

        return redirect()->route('blog.index')->with('success', 'Blog created successfully!');
    }

    public function createBlogIndex() {
        // $categories = DB::table('categories')
        //     ->get();
        $categories = Category::all();

        // $statuses = DB::table('statuses')
        //     ->get();
        $statuses = Status::all();

        $blogs = Blog::withTrashed()->with('category', 'status', 'tags', 'author')->get();

        return view('createBlog', compact('categories', 'statuses', 'blogs'));
    }

    public function getBlog() {
        // $blogs = DB::table('blogs as b')
        //     ->join('categories as c', 'c.id', '=', 'b.category_id')
        //     ->join('statuses as s', 's.id', '=', 'b.status_id')
        //     ->select('b.title', 's.name as status', 'c.name as category', 'b.description')
        //     ->get();

        // $blogs = Blog::all(); // di kasama mga naka soft delete
        $blogs = Blog::withTrashed()->get();
        
        return $blogs;
    }

    public function updateBlog() {
        $blogs = DB::table('blogs')
            ->where('id', 1234)
            ->update([
                'title' => 'updated title',
                'description' => 'updated description',
                'status' => 1,
                'category_id' => 123,
                'author_id' => 1,
            ]);
    }

    public function blogModel() {
        // return Blog::all();
        // return Status::all();
        // return MyBlog::all();
        // $blog = Blog::find('1445');
        // return $blog->title . " - " . $blog->description;
        // return Blog::findOrFail('4');
        // $post = Blog::where('status_id', 2)
        //     // WHERE category_id = 2
        //     // ->where('category_id', 2)
        //     ->where('category_id', '!=' , 2)
        //     ->get();

        // return $post;

        // $post = Blog::findOrFail(1449)->delete();
        // return $post;

        $this->softDeleteBlogPage(1449);
    }

    public function retrieveBlogPage($id) {
        $blog = Blog::findOrFail($id);
        return view('blogPage', compact('blog'));
    }

    public function softDeleteBlogPage($id) {
        // Blog::onlyTrashed()->findorFail($id)->forceDelete();
        Blog::where('id', $id)->update(['status_id' => 3]);
        Blog::findOrFail($id)->delete();
        return redirect()->route('blogs.index')->with('delete', 'Blog deleted successfully!');
    }

    public function restoreBlogPage($id) {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->restore();

        $blog->status_id = 2;
        $blog->save();
        return redirect()->route('blogs.index')->with('restore', 'Blog restored successfully!');
    }

    public function oneToOneRel() {
        $blogs = Blog::with('category', 'status')->get();
        return $blogs;
    }
    
    public function oneToManyRel() {
        // $categories = Category::with('blog')->find(2);
        $categories = Category::with('blog')->get();
        return $categories;
    }

    public function manyToManyRel() {
        $tags = Blog::with('tags')->get();
        return $tags;
    }

    public function insertTags() {
        $blog = Blog::findOrFail(1445);

        $blog->tags()->attach([1, 2, 3]);

        return $blog;
    }
}
