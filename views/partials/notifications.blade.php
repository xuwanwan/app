
<?php $types = array('success', 'error', 'warning', 'info'); ?>

@foreach ($types as $type)
    @if ($message = Session::get($type))
        <?php if ($type === 'error') $type = 'danger'; ?>
        <div class="alert alert-{{{ $type }}} cms-alert">
            <a class="close" data-dismiss="alert">×</a>
            {{ $message }}
        </div>
    @endif
@endforeach
