 <!-- <select name="parent_cat_id" class="form-control" id="parent_cat_id">
                                <option value="">None</option>
                                @foreach($parents as $parentCategory)
                                    <option value="{{ $parentCategory->id }}" {{(old('parent_cat_id',$category->parent_cat_id)== $parentCategory->id ) ? "selected" : "" }}>{{ $parentCategory->name }}</option>
                                @endforeach
                            </select>
                            @error('parent_cat_id')
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ $message }}
                            </div>
                            @enderror -->