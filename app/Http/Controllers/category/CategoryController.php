<?php

namespace App\Http\Controllers\Category;

use App\DTO\CategoryDTO;
use App\DTO\SearchDTO;
use App\Facades\CategoryFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\searchRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
      
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a paginated list of categories, with an optional search filter.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(searchRequest $request)
    {
        // Perform search based on request input and paginate the results
     
        $categories =$this->categoryRepository->categoryFilter($request);

        // Return the 'categories.index' view with the paginated categories
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Get all categories to display as potential parent categories
        $parents = $this->categoryRepository->all();

      
        // Return the 'categories.create' view with parents 
        return view('categories.create', ['parents'=>$parents]);
    }

    /**
     * Store a newly created category in the database.
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        // Delegate the store operation to the CategoryService
        CategoryFacade::store($request);

        // Redirect to the categories index page after successful storage
        return redirect()->route('categories.index');
    }

    /**
     * Display the details of a specific category by ID.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show(string $id,searchRequest $request)
    {
        // Find the category by ID
        $category = $this->categoryRepository->find($id);
       $products=$category->products()->with('store')->search(SearchDTO::create($request))->paginate(2);
       
        // If category is not found, redirect to the index page
        if (CategoryFacade::checkCategory($category)) {
            return redirect()->route("categories.index");
        }

        // Convert the category to array format for display
        $categoryArray = CategoryDTO::toArray($category);

        // Return the 'categories.show' view with the category details
        return view('categories.show', ['category' => $categoryArray,'products'=>$products]);
    }

    /**
     * Show the form for editing a specific category.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(string $id)
    {
        // Find the category by ID
        $category = $this->categoryRepository->find($id);

        // If category is not found, redirect to the index page
        if (CategoryFacade::checkCategory($category)) {
            return redirect()->route("categories.index");
        }

        // Get all parent categories, excluding the current category and its children
        $parents = $this->categoryRepository->categoryParents($id);

        // Return the 'categories.edit' view with the category and parent categories
        return view('categories.edit', compact(['category', 'parents']));
    }

    /**
     * Update the specified category in the database.
     *
     * @param CategoryRequest $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, string $id)
    {
        // Delegate the update operation to the CategoryService
       CategoryFacade::update($request, $id);

        // Redirect to the categories index page after successful update
        return redirect()->route('categories.index');
    }

    /**
     * Soft delete the specified category.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        // Delegate the delete operation to the CategoryService
       CategoryFacade::destroy($id);

        // Redirect to the categories index page after successful deletion
        return redirect()->route('categories.index');
    }

    /**
     * Display a list of soft deleted (trashed) categories.
     *
     * @return \Illuminate\View\View
     */
    public function trashed()
    {
        // Retrieve all soft deleted categories and paginate the results
        $categories = $this->categoryRepository->trash();

        // Return the 'categories.trashed' view with the trashed categories
        return view("categories.trashed", compact('categories'));
    }

    /**
     * Restore a soft deleted category by ID.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        // Delegate the restore operation to the CategoryService
       CategoryFacade::restore($id);

        // Redirect to the trashed categories page after successful restoration
        return redirect()->route('categories.trash');
    }

    /**
     * Permanently delete a soft deleted category by ID.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($id)
    {
        // Delegate the force delete operation to the CategoryService
       CategoryFacade::forceDelete($id);

        // Redirect to the trashed categories page after successful permanent deletion
        return redirect()->route('categories.trash');
    }
}
