<table class="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Tên</th>
            <th>Lớp Cha</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($cats as $cat)
            <tr>
                <td class="text-center">{{ $cat->id }}</td>
                <td>{{ $cat->name }}</td>
                <td>{{ ($cat->parent != 0) ? $cat->parents()->first()->name : 'Parent ROOT' }}</td>
<!-- 
                <td class="td-actions text-right">
                    <button type="button" rel="tooltip" class="btn btn-info" data-original-title="" title="">
                        <i class="material-icons">person</i>
                    </button>
                    <button type="button" rel="tooltip" class="btn btn-success" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                    </button>
                    <button type="button" rel="tooltip" class="btn btn-danger" data-original-title="" title="">
                        <i class="material-icons">close</i>
                    </button>
                </td> -->
            </tr>
        @empty
        <tr><td>No category</td></tr>
        @endforelse
    </tbody>
</table>
{{ $cats->links('Admin.layouts.pagination') }}