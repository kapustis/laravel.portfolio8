<div class="blog_item">
    <div class="post_preview">
        <div class="post_body2">
            <input type="text" class="form-control" v-model="form.title"/>
            <wysiwyg id="body" name="body" v-model="form.body"></wysiwyg>


            <button type="button" class="button" @click="update">Update</button>
            <button type="button" class="button" @click="cancelToggle">Cancel</button>
{{--            @can ('update', $thread)--}}
{{--                <form action="{{ $thread->path() }}" method="POST">--}}
{{--                    {{ csrf_field() }}--}}
{{--                    {{ method_field('DELETE') }}--}}

{{--                    <button type="submit" class="button btn-danger">Delete</button>--}}
{{--                </form>--}}
{{--            @endcan--}}
        </div>
    </div>
</div>
