@section('content')
    <table style="border: 1px solid;">
        <tbody>
            <tr>
                <th scope="row" style="text-align: center; border: 1px solid; padding: 0 20px;"><label>タイトル</label></th>
                <td style="padding: 20px; border: 1px solid;">
                    <p>【リセットパスワード】アカウント情報</p>
                </td>
            </tr>
            <tr>
                <th scope="row" style="text-align: center; border: 1px solid; padding: 0 20px;"><label>本文</label></th>
                <td style="padding: 20px; border: 1px solid;">
                    <p>{!! $body !!}<a href="{{ $action_link }}">Click the link</a></p>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
