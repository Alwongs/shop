@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать пользователя</h1>
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
                <form action="{{ route('user.update', $user->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <input type="text" value="{{ $user->name ?? old('name') }}" name="name" class="form-control" placeholder="Имя">
                    </div>

                    <div class="form-group">
                        <input type="text" value="{{ $user->surname ??  old('surname') }}" name="surname" class="form-control" placeholder="Фамилия">
                    </div>

                    <div class="form-group">
                        <input type="text" value="{{ $user->patronymic ??  old('patronymic') }}" name="patronymic" class="form-control" placeholder="Отчество">
                    </div>

                    <div class="form-group">
                        <input type="text" value="{{ $user->age ??  old('age') }}" name="age" class="form-control" placeholder="Возраст">
                    </div>

                    <div class="form-group">
                        <input type="text" value="{{ $user->address ??  old('address') }}" name="address" class="form-control" placeholder="Адрес">
                    </div>

                    <div class="form-group">
                        <select name="gender" class="custom-select form-control" id="exampleSelectBorder">
                            <option disabled selected>Пол</option>
                            <option {{ $user->gender == 1 || old('gender') == 1 ? ' selected' : '' }} value="1">Мужской</option>
                            <option {{ $user->gender == 2 || old('gender') == 2 ? ' selected' : '' }} value="2">Женский</option>
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