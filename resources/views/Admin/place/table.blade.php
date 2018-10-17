 <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Tên</th>
                                                    <th>Danh mục</th>
                                                    <th>Thành phố</th>
                                                    <th>Tỉnh</th>
                                                    <th>Điện thoại</th>
                                                    <th>Website</th>
                                                    <th>Mở Cửa</th>
                                                    <th>Đóng cửa</th>
                                                    <th>Lượt view</th>
                                                    <th class="text-right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                   @foreach($places as $place)
                                                    <tr>
                                                        <td class="text-center">{{ $place->id }}</td>
                                                        <td>{{ $place->name }}</td>
                                                        <td>{{ $place->category()->first()->name }}</td>
                                                        <td>{{ $place->city }}</td>
                                                        <td>{{ $place->district }}</td>
                                                        <td>{{ $place->phone }}</td>
                                                        <td>{{ $place->website }}</td>
                                                        <td>{{ $place->open }}</td>
                                                        <td>{{ $place->close }}</td>
                                                        <td>{{ $place->count_views }}</td>

                                                        <td class="td-actions text-right">
              
                                                        <a type="button" rel="tooltip" 
                                                        href= {{ route('admin.user.edit', ['id'=> $place->id]) }} 
                                                        class="btn btn-success" data-original-title="" title="">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                        <button 
                                                            onclick = "changeDeleteUrl({{ $place['id'] }})"
                                                            data-toggle="modal" data-target="#exampleModal"
                                                            type="button" rel="tooltip" class="btn btn-danger">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                    </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                         {{ $places->links('Admin.layouts.pagination') }}