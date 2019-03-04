<h5>Departments</h5>
<ul class="list-group">
    <li class="list-group-item">
        <a href="/items/dept/0">All</a><br/>
    </li>
    @foreach ($depts as $dept)
        <li class="list-group-item">
            <a
                    href="/items/dept/{{$dept->hierarchy_id}}">{{ $dept->name }}</a><br/>
        </li>
    @endforeach
</ul>