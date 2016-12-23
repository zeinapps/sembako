@if (count(session('status')) > 0)
<div class="alert alert-success">
    <ul>
        @foreach (session('status') as $status)
        <li>{{ $status }}</li>
        @endforeach
    </ul>
</div>
@endif