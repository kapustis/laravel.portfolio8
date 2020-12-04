{{--<reply :attributes="{{ $reply }}" inline-template v-cloak>--}}
    {{--<div id="reply-{{ $reply->id }}" class="panel panel-default reply-content">--}}
        {{--<div class="panel-heading reply-head">--}}
            {{--<div class="level">--}}
                {{--<h5 class="flex">--}}
                    {{--<a href="{{route('profile',$reply->owner)}}">{{ $reply->owner->name }}</a>--}}
                    {{--сказал {{ $reply->created_at->diffForHumans() }}...--}}
                {{--</h5>--}}
                {{--@if(Auth::check())--}}
                    {{--<div>--}}
                        {{--<favorite :reply="{{$reply}}"></favorite>--}}
                    {{--</div>--}}
                {{--@endif--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="panel-body">--}}
            {{--<div v-if="editing">--}}
                {{--<div class="form-group">--}}
                    {{--<textarea class="form-control" v-model="body"></textarea>--}}
                {{--</div>--}}

                {{--<button class="btn btn-xs btn-primary" @click="update">Update</button>--}}
                {{--<button class="btn btn-xs btn-link" @click="editing = false">Cancel</button>--}}
            {{--</div>--}}
            {{--<div v-else v-text="body"></div>--}}
        {{--</div>--}}
        {{--@can ('update', $reply)--}}
            {{--<div class="panel-footer level">--}}
                {{--<button class="btn btn-xs mr-1" @click="editing = true">Edit</button>--}}
                {{--<button class="btn btn-xs btn-danger" @click="destroy">Delete</button>--}}
            {{--</div>--}}
        {{--@endcan--}}
    {{--</div>--}}{{--panel-body--}}

{{--</reply>--}}