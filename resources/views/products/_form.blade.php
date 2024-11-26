
                        <!-- Product Name -->
                        <div class="form-group">
                            <label for="name">product Name</label>
                           <x-form.input type="text" name="name" required="required" :value="$product['name']??''" />
                        </div>
                       
                        <!-- Product Description -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="3" placeholder="Enter product description" >{{old('description',$product['description']??'') }}</textarea>
                            @error('description')
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- Price -->
                        <div class="form-group">
                            <label for="price">product Price</label>
                           <x-form.input type="number" name="price" required="required" :value="$product['price']??''" />
                        </div>
                        <div class="form-group">
                            <label for="tag">product tags</label>
                           <x-form.input type="text" name="tags"  :value="$product['tags']??''" />
                        </div>
                         <!-- Status -->
                         <div class="form-group">
                            <label for="status">Status</label>
                            <x-form.select name="status" :array="['active'=>'Active','draft'=>'Draft','archived'=>'Archived']" :selected="$product['status']??''"/>
                        </div>
                       
                        <!--category_id -->
                        <div class="form-group">
                            <label for="category_id">Select Category</label>
                            <x-form.select name="category_id" :array="array_column($categories->toArray(),'name','id')" :selected="$product['category_id']??''"/>
                        </div>
                      
                        
                       
                        <!-- Product Image -->
                        <div class="form-group">
                            <label for="image">Product Image</label>
                            <x-form.input name='image' type='file'/>
                            @if(isset($product['image']))
                            <img src="{{ asset('storage/' . $product['image']) }}" width="100px">
                            @endif
                        </div>
