<?php

namespace App\Services;

use App\DTO\CategoryDTO;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;

class CategoryService {

    /**
     * Store a new category.
     * 
     * @return void
     */
    protected $categoryRepository;
    public function __construct()
    {
        
        $this->categoryRepository=new CategoryRepository();
    }
    public function store(CategoryRequest $request) {
        // Create a CategoryDTO from the request data
        $category = CategoryDTO::create($request);
        
        // Generate a slug from the category name
        $category['slug'] = Str::slug($category['name']);
        
        // Handle image upload if image exists
        $this->image_path($category);
        
        // Save the new category to the database
        $this->categoryRepository->create($category);
        // Flash success message to the session
        Session::flash('success', 'Category added successfully');
    }

    /**
     * Update an existing category.
     * 
     * @param  int  $id
     * @return void
     */
    public function update(CategoryRequest $request, $id) {
        // Find the category by ID or fail
        $category = $this->categoryRepository->find($id);
        
        // Create a new CategoryDTO from the request data
        $updatedCategory = CategoryDTO::create($request);
        
        // Generate a new slug from the updated category name
        $updatedCategory['slug'] = Str::slug($updatedCategory['name']);
        
        // Handle image upload if image exists
        $this->image_path($updatedCategory);

        // Check if a new image is uploaded, if yes, delete the old image
        if ($category['image'] && $updatedCategory['image']) {
            Storage::disk('public')->delete($category->image);
        } else {
            // If no new image, retain the old image
            $updatedCategory['image'] = $category['image'];
        }

        // Update the category with new data
        $this->categoryRepository->update($id,$updatedCategory);
        // Flash success message to the session
        Session::flash('success', 'Category edited successfully');
    }

    /**
     * Soft delete a category.
     * 
     * @param  int  $id
     * @return void
     */
    public function destroy($id) {
         // Soft delete the category
        $this->categoryRepository->destroy($id);
        // Flash success message to the session
        Session::flash('success', 'Category deleted successfully');
    }

    /**
     * Restore a soft deleted category.
     * 
     * @param  int  $id
     * @return void
     */
    public function restore($id) {
        // Find the soft deleted category by ID
        $category = $this->categoryRepository->trash($id);

        // If the category exists, restore it
        if (!$this->checkCategory($category)) {
            $category->restore();
        }

        // Flash success message to the session
        Session::flash('success', 'Category restored successfully');
    }

    /**
     * Permanently delete a category from the database.
     * 
     * @param  int  $id
     * @return void
     */
    public function forceDelete($id) {
        // Find the soft deleted category by ID
        $category = $this->categoryRepository->trash($id);

        // If the category exists, delete it permanently
        if (!$this->checkCategory($category)) {
            $path_image = $category->image ?? "";

            // Delete the associated image from storage
            if ($path_image) {
                Storage::disk('public')->delete($path_image);
            }

            // Permanently delete the category
            $category->forceDelete();
        }

        // Flash success message to the session
        Session::flash('success', 'Category deleted successfully from database');
    }

    /**
     * Handle image upload and assign path to the category.
     * 
     * @param  array  $category
     * @return void
     */
    public function image_path(&$category) {
        // Check if image is provided in the request
        if (isset($category['image'])) {
            $image = $category['image'];
            
            // Store the image in 'categories' directory under public disk
            $path_image = $image->store('categories', ['disk' => 'public']);
            
            // Update the category image path
            $category['image'] = $path_image;
        }
    }

    /**
     * Check if the category exists.
     * 
     * @param  Category  $category
     * @return bool
     */
    public function checkCategory($category) {
        // If category does not exist, flash an error message and return true
        if (!$category) {
            Session::flash('error', 'Category not found');
            return true;
        }

        return false;
    }

    /**
     * Get the parent category name.
     * 
     * @param  Category  $category
     * @return string
     */
    public function parentName(Category $category) {
        // Return the name of the parent category if it exists, otherwise return an empty string
        return $category->parentCategory->name ?? '';
    }
}
