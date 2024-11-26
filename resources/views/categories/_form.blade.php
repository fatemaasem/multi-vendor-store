
                        <!-- Category Name -->
                        <div class="form-group">
                            <label for="name">Category Name</label>
                           <x-form.input type="text" name="username" required="required" :value="$category->name??''" />
                        </div>

                        <!-- Category Description -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="3" placeholder="Enter category description" required>{{old('description',$category->description??'') }}</textarea>
                            @error('description')
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <x-form.select name="status" :array="['active'=>'Active','archived'=>'Archived']" :selected="$category->status??''"/>
                        </div>

                        <!-- Parent Category -->
                        <div class="form-group">
                            <label for="parent_cat_id">Parent Category</label>
                            <x-form.select name="parent_cat_id" :array="$parents->pluck('name', 'id')->toArray()" :selected="$category->parent_cat_id??''"/>
                        </div>

                        <!-- Category Image -->
                        <div class="form-group">
                            <label for="image">Category Image</label>
                            <x-form.input name='image' type='file'/>
                            @if(isset($category->image))
                            <img src="{{ asset('storage/' . $category->image) }}" width="100px">
                            @endif
                        </div>
