@component('layouts.admin.master')

    @section('title', 'Edit Post')

    @slot('page_theme_name') {{ 'item-editor' }} @endslot

    @section('content')
        <div class="title-block">
            <h3 class="title"><i class="fa fa-edit"></i> Edit Post</h3>
        </div>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.posts.update', [$post]) }}">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            <div class="card card-block">
                <div class="form-group row">
                    <label for="title" class="col-sm-2 form-control-label text-xs-right">Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control boxed" id="title"
                               placeholder="Enter Post Title" value="{{ old('title', $post->title) }}" autofocus>
                        @if ($errors->has('title'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label for="body" class="col-sm-2 form-control-label text-xs-right">Body</label>
                    <div class="col-sm-10">
                            <textarea name="body" rows="5" class="form-control boxed" id="body"
                                      placeholder="Enter Post Details">{{ old('body', $post->body) }}</textarea>
                        @if ($errors->has('body'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right">Category</label>
                    <div class="col-sm-10">
                        <select name="category" id="" class="form-control custom-select">
                            <option value=""></option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        {{ old('category', $post->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                    @if($category->ancestors->count())
                                        ({{ implode(' > ', $category->ancestors->pluck('name')->toArray()) }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('category'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right">Status</label>
                    <div class="col-sm-10">
                        <label>
                            <input class="radio" name="status" type="radio"
                                   value="0" {{ old('status', $post->live) == 0 ? 'checked' : '' }}>
                            <span>Draft</span>
                        </label>
                        <label>
                            <input class="radio" name="status" type="radio"
                                   value="1" {{ old('status', $post->live) == 1 ? 'checked' : '' }}>
                            <span>Live</span>
                        </label>
                        @if ($errors->has('status'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div><!-- /.form-group -->
            </div><!-- /.card -->
        </form>
    @endsection

@endcomponent