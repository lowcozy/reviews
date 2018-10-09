<table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>First name</th>
                                                    <th>Last name</th>
                                                    <th>Role</th>
                                                    <th>Email</th>
                                                    <th>Since</th>
                                                    <th>Last login</th>
                                                    <th class="text-right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $user)
                                                    <tr>
                                                        <td class="text-center">{{ $user->id }}</td>
                                                        <td>{{ $user->first_name }}</td>
                                                        <td>{{ $user->last_name }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->created_at }}</td>
                                                        <td>{{ $user->last_login }}</td>

                                                        <td class="td-actions text-right">
                                                         <a type="button" rel="tooltip" 
                                                        href= {{ route('admin.user.edit', ['id'=> $user->id]) }} 
                                                        class="btn btn-success" data-original-title="" title="">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                         <button 
                                                            onclick = "changeDeleteUrl({{ $user['id'] }})"
                                                            data-toggle="modal" data-target="#exampleModal"
                                                            type="button" rel="tooltip" class="btn btn-danger">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                    </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                         
                                                @if (method_exists($users,'perPage'))
                                                    {{ $users->links('Admin.layouts.pagination') }}
                                                @endif
