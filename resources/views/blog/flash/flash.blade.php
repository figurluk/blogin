<div id="flashMessages">
    @if(Session::has('flash_notification.message'))
        <div id="flashMessage" class="alert alert-{{ Session::get('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

            {{ Session::get('flash_notification.message') }}
        </div>
    @endif
</div>