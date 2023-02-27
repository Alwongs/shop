@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать Продукт</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Главная</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <input type="text" name="title" value="{{ $product->title }}" class="form-control" placeholder="Наименование" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="description" value="{{ $product->description }}" class="form-control" placeholder="Описание" required>
                    </div>
                    <div class="form-group">
                        <textarea name="content" cols="30" rows="10" class="form-control" placeholder="Контент" required>{{ $product->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" name="price" value="{{ $product->price }}" class="form-control" placeholder="Цена" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="count" value="{{ $product->count }}" class="form-control" placeholder="Количество" required>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="preview_image" value="{{ $product->preview_image }}" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузка</span>
                            </div>
                        </div>
                    </div>                    

                    <div class="form-group">
                        <select name="category_id" class="form-control select2" style="width: 100%;">
                            {{-- <option disabled>Выберите категорию</option> --}}
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if ($category == $product->category) selected="selected" @endif>{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="tags[]" class="tags" multiple="multiple" data-placeholder="Выберите тег" style="width: 100%;">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" @if(in_array($tag->id, $productTagIds)) selected="selected" @endif>{{ $tag->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="colors[]" class="colors" multiple="multiple" data-placeholder="Выберите цвет" style="width: 100%;">
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}" @if (in_array($color->id, $productColorIds)) selected="selected" @endif>{{ $color->title }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Обновить">
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection