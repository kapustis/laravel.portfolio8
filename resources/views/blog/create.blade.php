@extends('layouts.app')

@section('content')
    <section>
        <div class="panel">
            <div class="panel-heading">Create a New Thread</div>

            <div class="panel-body">
                <form method="post" action="/blog">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="channel_id">Тема:</label>
                        <select name="channel_id" id="channel_id" class="form-control" required>
                            <option value="">Выберите одну из тем ниже</option>
                            @foreach($channels as $channel)
                                <option value="{{$channel->id}}" {{old('channel_id') == $channel->id ? 'selected' : ''  }}>
                                    {{$channel->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Заголовок:</label>
                        <input name="title" id="title" type="text" class="form-control" value="{{old('title')}}" required>
                    </div>

                    <div class="form-group">
                        <label for="body">Body:</label>
                        <wysiwyg name="body"></wysiwyg>
                    </div>

                    <button type="submit" class="btn btn-primary">Опубликовать</button>
                </form>
                @if(count($errors))
                    <ul class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif

            </div>
        </div>

    </section>
@endsection
