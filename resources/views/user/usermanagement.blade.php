@extends('header')
@section('content')
    <div class="sec-content">
        <p class="content-ttl">投稿管理</p>
        <div class="search-sec">
            <form action="{{ route('user#search') }}" method="post">
                @csrf
                <div class="card-body">
                    <input type="text" name="name" placeholder="氏名">
                    <input type="email" name="email" placeholder="メールアドレス">
                    <select name="role-type">
                        <option value="">権限種別</option>
                        <option value="1">アドミン</option>
                        <option value="2">ユーザー</option>
                    </select>
                    <input type="date" name="create_date" placeholder="作成日">~
                    <input type="date" name="create_date" placeholder="作成日">
                    <button type="reset" class="btn-clear">クリア</button>
                    <button type="submit" class="btn-search ">検索</button>
                </div>
            </form>
        </div>
        <div class="sec-two">
            <div class="search-result">
                <p>検査結果 : {{ $user_datas->total() }} 件</p>
                <div class="user-result">
                    <button type="button" class="select-user" id="deleteallrecord" data-bs-toggle="modal"
                        data-bs-target="#exampleModal" name="delete_id">
                        選択したユーザを削除
                    </button>
                    <a href="{{ route('user#create') }}" class="create"><i class="fa fa-circle-plus"></i>新規作成</a>
                </div>
            </div>
            <form action="{{ route('user#delete') }}" method="post">
                @csrf
                @method('Delete')
                <table class="user-tb">
                    <thead>
                        <th><input type="checkbox" name="" id="select_all_id"></th>
                        <th>
                            <span>氏名</span>
                            <hr>
                            <span>メールアドレス</span>
                        </th>
                        <th>
                            <span>生年月日</span>
                            <hr>
                            <span>携帯電話</span>
                        </th>
                        <th>住所</th>
                        <th>
                            <span>権限種別</span>
                            <hr>
                            <span>作成者</span>
                        </th>
                        <th>
                            <span>作成日</span>
                            <hr>
                            <span>更新日</span>
                        </th>
                        <th></th>
                    </thead>

                    <tbody>
                        @foreach ($user_datas as $data)
                            <tr id="sid{{ $data->id }}">
                                <td>
                                    <input type="checkbox" name="ids[{{ $data->id }}]" class="checked_id"
                                        value="{{ $data->id }}">
                                </td>
                                <td>
                                    <span>{{ $data->name }}</span>
                                    <hr>
                                    <span>{{ $data->email }}</span>
                                </td>
                                <td>
                                    <span>{{ Carbon\Carbon::parse($data->birthday)->format('d/m/Y') }}</span>
                                    <hr>
                                    <span>{{ $data->phone }}</span>
                                </td>
                                <td>{{ $data->address }}</td>
                                <td>

                                    @if ($data->role === 1)
                                        <span>アドミン</span>
                                    @else
                                        <span>ユーザー</span>
                                    @endif
                                    <hr>
                                    <span>aaa</span>
                                </td>
                                <td>
                                    <span>{{ $data->created_at->format('d/m/Y') }}</span>
                                    <hr>
                                    <span>{{ $data->updated_at->format('d/m/Y') }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('user#edit', $data->id) }}" class="edit">編集</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">選択したユーザを削除します。</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="cmn-btn cancel" data-bs-dismiss="modal">キャンセル</button>
                                <button type="submit" class="cmn-btn confirm-delete">削除</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div>
                {{ $user_datas->links() }}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function(e) {

            $('#select_all_id').click(function() {
                $('.checked_id').prop('checked', $(this).prop('checked'))
            });
            $('.checked_id').on('click', function() {
                if ($('.checked_id:checked').length == $('.checked_id').length) {
                    $('#select_all_id').prop('checked', true);
                } else {
                    $('#select_all_id').prop('checked', false);
                }
            });
            // $('#deleteallrecord').click(function(e) {
            //     e.preventDefault();
            //     var all_ids = [];
            //     $('input:checkbox[name=ids]:checked').each(function() {
            //         all_ids.push($(this).val());
            //     });
            //     // console.log(all_ids);
            //     $.ajax({
            //         url: "{{ route('user#delete') }}",
            //         type: "DELETE",
            //         data: {
            //             id: all_ids,
            //             _token: '{{ csrf_token() }}'
            //         },
            //         success: function(response) {
            //             $.each(all_ids, function(key, val) {
            //                 $('#sid' + val).remove();
            //             })
            //         }
            //     });
            // });
        });
    </script>
@endsection
