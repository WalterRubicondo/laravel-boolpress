<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categories = Category::all();

      return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'category_id' => 'exists:categories,id|nullable',
        'name' => 'required|string|max:255',
      ]);

      $data = $request->all();

      $category = new Category();
      $category->fill($data);

      $category->slug = $this->generateSlug($category->name);
      $category->save();

      return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      $category = Category::where('slug', $slug)->first();
      return view('admin.categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
      return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
      $request->validate([
        'category_id' => 'exists:categories,id|nullable',
        'name' => 'required|string|max:255',
      ]);

      $data = $request->all();

      $data['slug'] = $this->generateSlug($data['name'], $category->name != $data['name'], $category->slug);


      $category->update($data);

      return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
      $category->delete();

      return redirect()->route('admin.categories.index');
    }

    private function generateSlug(string $title, bool $change = true, string $old_slug = '')
    {
      if (!$change) {
        return $old_slug;
      }
      
      $slug = Str::slug($title, '-');
      $slug_base = $slug;
      $counter = 1;

      $post_with_slug = Post::where('slug', '=', $slug)->first();
      while($post_with_slug) {
        $slug = $slug_base . '-' . $counter;
        $counter++;

        $post_with_slug = Post::where('slug', '=', $slug)->first();
      }

      return $slug;
    }
}
